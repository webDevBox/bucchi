<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Permission;
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

    public function outfitProfile()
    {
        return view('office.outfitProfile');
    }

    public function orderSearch()
    {
        return view('office.search');
    }
}
