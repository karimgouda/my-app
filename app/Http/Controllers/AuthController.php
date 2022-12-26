<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }
    public function register(Request $request){
        $data = $request->validate([
            "name"=>'required|string|max:100',
            "email"=>"required|email",
            "password"=>'required|string|min:6'
        ]);
        $data['password']= bcrypt($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect(url('/'));
    }
    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            "email"=>"required|email",
            "password"=>'required|string|min:6'
        ]);

        $is_login = Auth::attempt(["email"=>$data['email'],"password"=>$data['password']]);
        if($is_login != true){
            return redirect(url('login'))->withErrors("");
        }
        return redirect(url('/'));
    }

    public function logout(){
        Auth::logout();
        return redirect(url('login'));
    }
}
