<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use Carbon\Carbon;
use App\Models\Note;
use App\Models\OutfitStatus;
use App\Models\OutfitStatusType;

class AdminController extends Controller
{
    public function index()
    {
        $thisMonth = Order::whereMonth('created_at', '=', Carbon::now()->month)
        ->whereYear('created_at', '=', Carbon::now()->year)->count();
        
        $lastMonth = Order::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
        ->whereYear('created_at', '=', Carbon::now()->subYear()->year)->count();

        $totalOrders = Order::completed()->count();
        $inCompleteOrders = Order::production()->count();
        $clients = Client::count();
        $products = Outfit::distinct('name')->count('name');
        $revenue = Outfit::sum('price');

        $orderTotal = Order::count();

        if($orderTotal > 0)
        {
            $order_over = round(($inCompleteOrders/$orderTotal)*100 , 0);
        }
        else{
            $order_over = 0;
        }


        $outfitProduction = Outfit::production()->count();
        $outfitEmbroidery = OutfitStatus::where('current',0)
        ->where('status','Embr In')->count();
        $outfitTailoring = OutfitStatus::where('current',0)
        ->where('status','Tailor In')->count();
        $outfitCompleted = OutfitStatus::where('current',0)
        ->where('status','Completed')->count();

        $currentDate = Carbon::now();
        $endDate = $currentDate->copy()->addDays(30);

        $order30Days = Order::whereBetween('completion_date', [$currentDate, $endDate])
                                    ->get();
        
        return view('dashboard',compact('outfitProduction', 'outfitEmbroidery','order30Days',
        'outfitCompleted', 'outfitTailoring', 'thisMonth', 'lastMonth', 'order_over',
        'clients', 'products', 'revenue', 'totalOrders','inCompleteOrders'));
    }

    public function production()
    {
        $outfits = Outfit::production()->with('order')->get();
        return view('order.production',compact('outfits'));
    }

    public function outfitProfile($id)
    {
        $outfit = Outfit::with('order')->find($id);
        $statuses = OutfitStatusType::get();
        return view('order.adminOutfitProfile',compact('statuses','outfit'));
    }

    public function sendMaterial(Request $request)
    {
            $paths = [];
            foreach ($request->all() as $audioId => $note) {
                try {
                    $path = $note->store('notes');
                } catch (\Throwable $th) {
                    return response()->json([$th->getMessage()]);
                }
                $paths[] = $path;
            }
            return response()->json([
                'success' => true,
                'note' => $paths
            ]);
        
    }

}
