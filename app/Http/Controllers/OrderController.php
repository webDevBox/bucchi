<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
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
    
    public function changes()
    {
        return view('order.changes');
    }
    
    public function search()
    {
        return view('order.search');
    }
    
    public function update($id)
    {
        return view('order.update');
    }

    public function storeClient(Request $request)
    {
        try
        {    
            $client = Client::whereEmail($request->email)->first();

            if(!isset($client))
            {
                $client = Client::create([
                    'name' => $request->client_name,
                    'contact' => $request->contact,
                    'email' => $request->email
                ]);
            }
            $order = Order::create([
                'client_id' => $client->id
            ]);

            return response()->json([
                'success' => true,
                'data' => $order
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'Error' => $th->getMessage()
            ]);
        }
    }

    public function storeOrder(Request $request)
    {
        try {
            $order = Order::find($request->order);

            $order->update([
                'delivery' => $request->delivery,
                'completion_date' => $request->completionDate,
                'currency' => $request->currency
            ]);

            return response()->json([
                'success' => true,
                'data' => $order
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'Error' => $th->getMessage()
            ]);
        }
        
    }

    public function storeOutfits(Request $request)
    {
        try {
            $outfits = [];

            foreach($request['outfitsObj'] as $outfit)
            {
                $outfits[] = [
                    'order_id' => $request->order ,
                    'name' => $outfit['outfitName'] ,
                    'description' => $outfit['outfitDescription'] ,
                    'price' => $outfit['price'] ,
                    'hours' => $outfit['hours'] ,
                    'fabric' => $outfit['fabric'] 
                ];
            }

            $outfitCreate = Outfit::insert($outfits);
            return response()->json([
                'success' => true,
                'data' => $outfitCreate
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'Error' => $th->getMessage()
            ]);
        }
    }

    public function completeOrder(Request $request)
    {
        try {
            $order = Order::find($request->order);

            $order->update([
                'notes' => $request->notes,
                'status' => 1
            ]);

            if($request->payment != '')
            {
                Transaction::create([
                    'order_id' => $order->id,
                    'payment' => $request->payment,
                    'date' => $request->date
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $order
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'Error' => $th->getMessage()
            ]);
        }
    }
    
}
