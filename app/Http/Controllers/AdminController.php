<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard')->with('success','All OK');
    }

    public function production()
    {
        $outfits = Outfit::production()->with('order')->get();
        return view('order.production',compact('outfits'));
    }

    public function outfitProfile($id)
    {
        $outfit = Outfit::with('order')->find($id);
        return view('order.adminOutfitProfile',compact('outfit'));
    }

}
