<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public static function index()
    {
        $title = 'Administration login page';

        return view('auth.index', compact('title'));
    }

    public static function login()
    {  
        try {

            $user = User::fetchFirst(['login' => $_POST['login']]);
        
            if (!$user){
                session()->put('error', 'User not found');
                return back();
            }

            if (!password_verify($_POST['password'], $user->password)) {
                session()->put('error', 'Wrong password');
                return back();
            }
            
            session()->put('auth_user', $user);

            return redirect('tasks');

        } catch (Exception $e) {
            require "views/500.php";
        }
    }

    public static function logout()
    {  
        session()
            ->clear('auth_user');

        return redirect('tasks');
    }
}