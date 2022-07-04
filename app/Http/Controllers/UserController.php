<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name'     => 'required|string|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput(['name', 'email']);
        }

        $data = $request->all(['name', 'email', 'password']);

        try {
            User::create($data);
        } catch (QueryException $e) {
            return back()->withErrors([
                'error' => 'The email or password is incorrect, please try again.',
            ])->withInput(['name', 'email']);
        }

        return redirect('/login')->withInput(['registered' => true]);
    }

    public function login(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput(['email']);
        }

        $remember = $request->has('rememberme') ? $request->input('rememberme') : false;

        if (Auth::attempt($request->all(['email', 'password']), $remember)) {
            $request->session()->regenerate();

            return redirect('dashboard');
        }

        return back()->withErrors([
            'error' => 'The provided credentials are invalid.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
