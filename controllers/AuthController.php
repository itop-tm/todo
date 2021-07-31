<?php

namespace App\Controllers;
use App\App\App;
use App\App\Session;
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
                Session::put('error', 'User not found');
                return back();
            }

            if (!password_verify($_POST['password'], $user->password)) {
                Session::put('error', 'Wrong password');
                return back();
            }
            
            Session::put('auth_user', $user);

            session()
                ->put('success', 'You are logged in');

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