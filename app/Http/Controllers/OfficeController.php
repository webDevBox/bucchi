<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        return view('office.dashboard');
    }

    public function outfits()
    {
        return view('office.outfit');
    }
    
   

    public function outfitProfile()
    {
        return view('office.outfitProfile');
    }

    public function orderSearch()
    {
        return view('office.search');
    }
}
