<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->get();
        return view('client.index',compact('clients'));
    }

    public function checkFileNum(Request $request)
    {
        if(Client::whereFileNum($request->file)->count() == 0)
        {
            return response()->json([
                'success' => false
            ]);
        }
        return response()->json([
            'success' => true
        ]);
    }

    public function getFile()
    {
        $files = Client::pluck('file_num')->toArray();
        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }
    
    public function deleteClient(Request $request)
    {
        try {
            Client::whereId($request->id)->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage()
            ]);
        }
        
    }

    public function updateClient(Request $request,$id)
    {
        try {
            $client = Client::find($id);
            $client->update([
                'name' => $request->name,
                'contact' => $request->contact, 
                'email' => $request->email, 
                'country' => $request->country
            ]);

            return redirect()->back()->withSuccess('Client Updated');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Client Not Updated');
        }
        
    }

    public function editClient($id)
    {
        $client = Client::find($id);
        return view('client.update',compact('client'));
    }

    public function createClient(Request $request)
    {
        try {
            $client = Client::create([
                'name' => $request->name, 
                'contact' => $request->contact, 
                'email' => $request->email, 
                'country' => $request->country, 
                'file_num' => $request->file
            ]);
            return response()->json([
                'success' => true,
                'client' => $client
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' -> $th->getMessage()
            ]);
        }
        
    }
}
