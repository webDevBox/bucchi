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
        $order = Order::inactive()->get();
        return view('order.create',compact('order'));
    }
    
    public function view()
    {
        $orders = Order::production()->get();
        return view('order.view',compact('orders'));
    }

    public function OutFitDetails($id)
    {
        $outfit = Outfit::with('order.client')->find($id);
        return view('order.outfit',compact('outfit'));
    }
    
    public function changes()
    {
        $orders = Order::completed()->active()->get();
        return view('order.changes',compact('orders'));
    }
    
    public function search()
    {
        $orders = Order::completed()->get();
        return view('order.search',compact('orders'));
    }
    
    public function update($id)
    {
        $order = Order::find($id);
        $counter = 1;
        return view('order.update',compact('order','counter'));
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
    
    
    public function byId(Request $request)
    {
        try {
            $order = Order::find($request->order);

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

    public function getOrderOutfits(Request $request)
    {
        $orderId = $request->orderId;

        // Fetch the outfits based on the order ID
        $outfits = Outfit::where('order_id', $orderId)->get();
    
        // Process the fetched outfits and create an array with the necessary data
        $data = [];
        foreach ($outfits as $outfit) {
            $data[] = [
                'id' => $outfit->id,
                'article' => $outfit->article,
                'name' => $outfit->name,
                'hours' => $outfit->hours,
                'status' => $outfit->production,
                'detailsRoute' => route('OutFitDetails', ['id' => $outfit->id]),
            ];
        }
    
        // Return the outfits as a JSON response
        return response()->json(['outfits' => $data]);
    }

    public function OutfitProduction(Request $request)
    {
        Outfit::whereId($request->id)->update([
            'production' => 1
        ]);

        return response()->json(['ok' => true]);
    }
    
}
