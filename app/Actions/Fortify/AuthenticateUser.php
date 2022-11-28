<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser{
    public function authenticated($request){
        $email = $request->post(config('fortify.username'));
        $password = $request->password;
        $user = User::where('phone',$email)->first();
        if($user && Hash::check($password, $user->password)){
            return $user;
        }
        return false;
    }
}
