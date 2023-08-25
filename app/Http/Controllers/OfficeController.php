<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Currency;
use App\Models\Permission;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\OutfitStatusType;

class OfficeController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();
        $endDate = $currentDate->copy()->addDays(30);
        $order30Days = Order::whereBetween('completion_date', [$currentDate, $endDate])
        ->paginate(4);
        return view('office.dashboard',compact('order30Days'));
    }

    public function outfits()
    {
        $outfits = Outfit::production()->with('order')->get();
        return view('office.outfit',compact('outfits'));
    }
    
    public function list()
    {
        $offices = User::whereRole(1)->get();
        return view('admin.office.list',compact('offices'));
    }
    
    public function editOffice($id)
    {
        $office = User::find($id);
        return view('admin.office.edit',compact('office'));
    }

    public function createOffice(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => bcrypt($request->password),
                'role' => 1,
                'status' => 0
            ]);
            Permission::create([
                'user_id' => $user->id,
                'client'=> ($request->client_permission == 1) ? true : false, 
                'production' => ($request->production_permission == 1) ? true : false, 
                'search' => ($request->search_permission == 1) ? true : false, 
                'petty' => ($request->cash_permission == 1) ? true : false, 
            ]);
            return redirect()->back()->withSuccess('Officer Created');
        } catch (\Throwable $th) {
            return redirect()->back()->withSuccess('Officer Not Created');
        }
    }
    
    public function updateOffice(Request $request,$id)
    {
        try {
            User::whereId($id)->update([
                'name' => $request->name,
                'email'=> $request->email
            ]);
            if(isset($request->password))
            {
                User::whereId($id)->update([
                    'password' => bcrypt($request->password)
                ]);
            }
            Permission::whereUserId($id)->update([
                'client'=> ($request->client_permission == 1) ? true : false, 
                'production' => ($request->production_permission == 1) ? true : false, 
                'search' => ($request->search_permission == 1) ? true : false, 
                'petty' => ($request->cash_permission == 1) ? true : false, 
            ]);
            return redirect()->back()->withSuccess('Officer Updated');
        } catch (\Throwable $th) {
            return redirect()->back()->withSuccess('Officer Not Updated');
        }
    }

    public function officeDelete($id)
    {
        try {
            User::whereId($id)->delete();
            return redirect()->back()->withSuccess('Officer Deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Officer Not Deleted');
        }
    }

    public function outfitProfile($id)
    {
        $outfit = Outfit::with('order')->find($id);
        $statuses = OutfitStatusType::get();
        return view('office.outfitProfile',compact('outfit','statuses'));
    }

    public function orderSearch()
    {
        $orders = Order::completed()->get();
        return view('office.search',compact('orders'));
    }
}
