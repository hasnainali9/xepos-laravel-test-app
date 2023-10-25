<?php
namespace App\Services;
class AuthService{


    public function GenerateUserSession($request){
        $request->authenticate();
        $request->session()->regenerate();
        return true;
    }


}
