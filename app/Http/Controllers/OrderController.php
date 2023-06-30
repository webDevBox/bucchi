<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('order.create');
    }
    
    public function view()
    {
        return view('order.view');
    }

    public function OutFitDetails()
    {
        return view('order.outfit');
    }
}
