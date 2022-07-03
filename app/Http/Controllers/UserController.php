<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'error' => 'The provided credentials are invalid.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        try {
            User::create($data);
        } catch (QueryException $e) {
            return back()->withErrors([
                'error' => 'An error occurred during user registration.',
            ])->withInput(['name', 'email']);
        }

        return redirect('/login')->withInput(['registered' => true]);
    }
}
