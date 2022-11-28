<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AuthenticateAdmin{


    public function authenticated($request){
        $user = Admin::where('username',$request->post(config('fortify.username')))->first();
        $password = $request->password;
        if($user && Hash::check($password, $user->password)){
            return $user;
        }
        return false;
    }
}
