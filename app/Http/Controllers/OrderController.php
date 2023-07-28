<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $order = Order::inactive()->get();
        $currencies = Currency::get();
        $clients = Client::get();
        return view('order.create',compact('clients','currencies','order'));
    }
    
    public function view()
    {
        $orders = Order::active()->production()->latest()->get();
        return view('order.view',compact('orders'));
    }

    public function OutFitDetails($id)
    {
        $outfit = Outfit::with('order.client')->find($id);
        return view('order.outfit',compact('outfit'));
    }
    
    public function changes()
    {
        $orders = Order::active()->production()->latest()->get();
        return view('order.changes',compact('orders'));
    }
    
    public function draft()
    {
        $orders = Order::inactive()->latest()->get();
        return view('order.draft',compact('orders'));
    }
    
    public function search()
    {
        $orders = Order::completed()->get();
        return view('order.search',compact('orders'));
    }
    
    public function update($id)
    {
        $clients = Client::get();
        $order = Order::findOrFail($id);
        $currencies = Currency::get();
        $counter = 1;
        return view('order.update',compact('currencies','clients','order','counter'));
    }

    public function storeClient(Request $request)
    {
        try
        {    
            if($request->select == '..other..')
            {
                $client = Client::create([
                    'name' => $request->client_name,
                    'contact' => $request->contact,
                    'email' => $request->email
                ]);
            }
            else
            {
                $client = Client::find($request->selectedOptionId);
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
            if($request->selected == '..other..')
            {
                $newCurrency = Currency::updateOrCreate(['name' => $request->currency]);
            }

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
    
    public function markAsComplete(Request $request)
    {
        try {
            Order::where('id',$request->id)->update([
                'production' => 1
            ]);
            $order = Order::find($request->id);
            
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
            Outfit::whereOrderId($request->order)->delete();

            foreach($request['outfitsObj'] as $outfit)
            {
                Outfit::create([
                    'order_id' => $request->order ,
                    'name' => $outfit['outfitName'] ,
                    'description' => $outfit['outfitDescription'] ,
                    'price' => $outfit['price'] ,
                    'hours' => $outfit['hours'] ,
                    'fabric' => $outfit['fabric']
                ]);
            }

            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'Error' => $th->getMessage()
            ]);
        }
    }
    
    
    public function updateOutfits(Request $request)
    {
        try {
            $ids = [];
            foreach($request['outfitsObj'] as $outfit)
            {
                $id = $outfit['outfitId'];
                if($id != null)
                {
                    $ids[] = (int)$id;
                    Outfit::whereId($id)->update([
                        'name' => $outfit['outfitName'] ,
                        'description' => $outfit['outfitDescription'] ,
                        'price' => $outfit['price'] ,
                        'hours' => $outfit['hours'] ,
                        'fabric' => $outfit['fabric']
                    ]);
                }
                else
                {
                    $outfit = Outfit::create([
                        'order_id' => $request->order ,
                        'name' => $outfit['outfitName'] ,
                        'description' => $outfit['outfitDescription'] ,
                        'price' => $outfit['price'] ,
                        'hours' => $outfit['hours'] ,
                        'fabric' => $outfit['fabric']
                    ]);
                    $ids[] = $outfit->id;
                }
            }
            $existingOutfits = Outfit::whereIn('id', $ids)->pluck('id')->toArray();
            Outfit::where('order_id',$request->order)->whereNotIn('id', $existingOutfits)->delete();
            return response()->json([
                'success' => true,
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
            $transaction = null;

            if($request->payment != '' && $request->payment > 0)
            {
                $transaction = Transaction::create([
                    'order_id' => $order->id,
                    'payment' => $request->payment,
                    'date' => $request->date
                ]);
            }

            $order = Order::find($request->order);
            
            return response()->json([
                'success' => true,
                'data' => $order,
                'transaction' => $transaction
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

    public function delete($id)
    {
        if(Order::whereId($id)->count() > 0)
        {
            Order::whereId($id)->delete();
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
    
}
