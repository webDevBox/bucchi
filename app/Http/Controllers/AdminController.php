<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard')->with('success','All OK');
    }

    public function production()
    {
        return view('order.production');
    }

    public function outfitProfile()
    {
        return view('order.adminOutfitProfile');
    }

}
