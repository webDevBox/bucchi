<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Permission;
use App\Models\PettyCash;
use Illuminate\Http\Request;

class PettyController extends Controller
{
    public function index()
    {
        $petty = PettyCash::whereUserId(auth()->user()->id)->latest()->get();
        return view('petty.index',compact('petty'));
    }
    
    public function pettyListAdmin()
    {
        $petty = PettyCash::latest()->get();
        return view('admin.Petty.index',compact('petty'));
    }

    public function pettyDelete($id)
    {
        try {
            PettyCash::whereId($id)->delete();
            return redirect()->back()->withSuccess('Transaction Deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Transaction Not Deleted');
        }
    }

    public function createPetty(Request $request)
    {
        try {
            PettyCash::create([
                'user_id' => auth()->user()->id,
                'entry_type' => $request->entry_type,
                'expense_type' => $request->expense_type,
                'particular' => $request->particular,
                'weight' => $request->weight,
                'amount' => $request->amount
            ]);
            return redirect()->back()->withSuccess('Transaction Created');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Transaction Not Created');
        }
    }
}
