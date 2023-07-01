<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        if($request->role == 'admin')
        {
            return redirect()->route('adminDashboard');
        }
        return redirect()->route('officeDashboard');
    }
}
