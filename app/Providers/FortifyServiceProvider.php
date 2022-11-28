<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\AuthenticateAdmin;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(request()->is('admin/*')){

            config(['fortify.guard' => 'admin']);
            config(['fortify.prefix' => 'admin']);
             config(['fortify.home' => 'dashboard']);
             config(['fortify.features'=>[]]);
        }
        else{
            config(['fortify.prefix' => '']);
            config(['fortify.home' => '/']);

        }
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

       Fortify::createUsersUsing(CreateNewUser::class);
       Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
       Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        if(config('fortify.guard') == 'admin'){
            Fortify::authenticateUsing([new AuthenticateAdmin,'authenticated']);
        }else{
            Fortify::authenticateUsing([new AuthenticateUser,'authenticated']);
        }

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


        Fortify::loginView(function () {
            if(request()->is('admin/*')){
            return view('admin-auth.login');
            }else{
                return view('auth.login');
            }
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function () {
            return view('auth.reset-password');
        });

        // Fortify::authenticateUsing(function (Request $request) {
        //     if(request()->is('/admin/login')){

        //         Fortify::authenticateUsing(function (Request $request) {
        //             $user = Admin::where('username', $request->username)->first();

        //             if ($user &&
        //                 Hash::check($request->password, $user->password)) {
        //                 return $user;
        //             }
        //         });
        //     }else{
        //         Fortify::authenticateUsing(function (Request $request) {
        //             $user = Admin::where('email', $request->email)->first();

        //             if ($user &&
        //                 Hash::check($request->password, $user->password)) {
        //                 return $user;
        //             }
        //         });
        //     }
            // $username = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'username' : 'email';
            // if($username == 'username'){
            //     $admin = Admin::where($username, $request->username)
            //     ->first();
            //     if(Hash::check($request->password, $admin->password)){
            //         return $admin;
            //     }


            // }elseif($username == 'email'){
            //     $user = User::where($username, $request->username)
            //     ->first();
            //     if(Hash::check($request->password, $user->password)){
            //         return $user;
            //     }
            // }


        // });


    }
}
