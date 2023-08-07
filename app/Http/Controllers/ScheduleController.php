<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Note;
use App\Models\OutfitStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    public function index()
    {
        $orders = Order::active()->production()->latest()->get();
        return view('admin.scheduling.index',compact('orders'));
    }
}
