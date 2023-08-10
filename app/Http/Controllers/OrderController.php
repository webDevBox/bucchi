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

class OrderController extends Controller
{

    public function updateOutfitProductin(Request $request, $id)
    {
        try {
            //Add Material Images
            $notesImages = $request->file('material_images');
            if(isset($notesImages))
            {
                foreach ($notesImages as $file) {
                    $path = $file->store('images');
                    Note::create([
                        'outfit_id' => $id,
                        'file' => $path,
                        'type' => 0,
                        'image_type' => 0
                    ]);
                }
            }
            
            //Add Status Photos
            $statusphoto = $request->file('status_photos');
            if(isset($statusphoto))
            {
                foreach ($statusphoto as $file) {
                    $path = $file->store('images');
                    Note::create([
                        'outfit_id' => $id,
                        'file' => $path,
                        'type' => 0,
                        'image_type' => 1
                    ]);
                }
            }

            //Add Article Number and Additional Notes
            $outfit = Outfit::whereId($id)->update([
                'article' => $request->article_number,
                'production_notes' => $request->additionals,
            ]);

            //Add Status of Outfit
            $outfitStatus = OutfitStatus::where('status',$request->outfitStatus)
            ->where('outfit_id',$id)->first();

            if(!isset($outfitStatus))
            {
                OutfitStatus::where('outfit_id',$id)->update(['current' => 1]);
                OutfitStatus::create([
                    'outfit_id' => $id,
                    'status' => $request->outfitStatus,
                    'current' => 0,
                    'date_time' => date('Y-m-d H:i:s')
                ]);
            }

            return redirect()->back()->withSuccess('Outfit Production Updated');
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th->getMessage());
        }
    }

    public function deleteMaterialImage($id)
    {
        try {
            $image = Note::find($id);
            Storage::delete($image->file);
            $image->delete();
            return redirect()->back()->withSuccess('Image Deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Image Not Deleted');
        }
    }


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
        foreach ($orders as $order) {
            $remainingHour = 0;
            foreach ($order->outfits as $outfit) {
                if($outfit->statuses->where('status','Embr In')->isEmpty())
                {
                    $remainingHour+=$outfit->hours;
                }
                $order['remaining'] = $remainingHour;
            }
        }
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
            $invoice = self::getOrderInvoice();
            if($request->select == '..other..')
            {
                $client = Client::create([
                    'name' => $request->client_name,
                    'contact' => $request->contact,
                    'email' => $request->email,
                    'country' => $request->country,
                    'file_num' => $request->file
                ]);
            }
            else
            {
                $client = Client::find($request->selectedOptionId);
            }
            
            $order = Order::create([
                'client_id' => $client->id,
                'invoice' => $invoice,
                'client_name' => $request->invoice_name
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

    public function getOrderInvoice()
    {
        $checker = false;
        $lastOrder = Order::latest()->first();
        if(isset($lastOrder))
        {
            $lastOrder = $lastOrder->invoice;
        }
        else{
            $lastOrder = 999;
        }
        $invoice = (int)$lastOrder + 1;
        while($checker != true)
        {
            if(Order::where('invoice',$invoice)->count() == 0)
            {
                $checker = true;
            }
            else{
                $invoice++;
            }
        }
        return $invoice;
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
                'currency' => $request->currency,
                'shipping_cost' => $request->shipping_cost
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
                'status_list' => $outfit->statuses,
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

        OutfitStatus::create([
            'outfit_id' => $request->id,
            'status' => 'Production Started',
            'current' => 0,
            'date_time' => date('Y-m-d H:i:s')
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
