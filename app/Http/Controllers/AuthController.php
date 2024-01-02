<?php

namespace App\Http\Controllers;

use App\Http\Requests\login;
use App\Http\Requests\register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function postRegister(register $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            return redirect()->route('login')->with(['messages', 'You have register sucessfully']);
        }
    }

    public function login()
    {
        return view('login');
    }

    public function postLogin(login $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('team.index')->with('messages', 'You are sucessfully login.');
        } else {
            return redirect()->back()->with('messages', 'Something went to wrong, please try again');
        }
    }

    public function logout()
    {
        // dd("asfasfd");
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
