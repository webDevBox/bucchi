<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials))
        {
            $user = auth()->user();
            if($user->role == 0)
            {
                return redirect()->route('adminDashboard')->with('success','Ok ki awaz hai');
            }
            if($user->role == 1)
            {
                return redirect()->route('officeDashboard');
            }
        }
        return redirect()->back()->withError('Wrong Credentials');
        

    }

    public function auth(Request $request)
    {
        if($request->role == 'admin')
        {
            return redirect()->route('adminDashboard');
        }
        return redirect()->route('officeDashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
