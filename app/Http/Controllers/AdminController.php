<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Note;
use App\Models\OutfitStatus;
use App\Models\OutfitStatusType;

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
