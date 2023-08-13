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
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $thisMonth = Order::whereMonth('created_at', '=', Carbon::now()->month)
        ->whereYear('created_at', '=', Carbon::now()->year)->count();
        
        $lastMonth = Order::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
        ->whereYear('created_at', '=', Carbon::now()->subYear()->year)->count();

        $totalOrders = Order::count();
        $inCompleteOrders = Order::production()->count();
        $clients = Client::count();
        $products = Outfit::distinct('name')->count('name');
        $revenue = Outfit::sum('price');
        
        $orderTotal = Order::count();
        
        
        $totalOutfits = OutfitStatus::distinct('outfit_id')
        ->count('outfit_id');

        $inProgressOutfits = OutfitStatus::whereNotIn('outfit_id', function($query) {
            $query->select('outfit_id')
                ->from('outfit_statuses')
                ->where('status', '=', 'Completed');
        })
        ->distinct('outfit_id')
        ->count();

        $completedOutfits = OutfitStatus::where('status', 'Completed')
        ->groupBy('outfit_id')
        ->selectRaw('count(*) as count')
        ->get()
        ->sum('count');

        
        if($totalOutfits > 0)
        {
            $order_over = round(($inProgressOutfits/$totalOutfits)*100 , 0);
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
                                    ->paginate(4);
        
        return view('dashboard',compact('totalOutfits', 'completedOutfits', 'inProgressOutfits', 'outfitProduction', 'outfitEmbroidery','order30Days',
        'outfitCompleted', 'outfitTailoring', 'thisMonth', 'lastMonth', 'order_over',
        'clients', 'products', 'revenue', 'totalOrders','inCompleteOrders'));
    }

    public function production()
    {
        $outfits = Outfit::production()->with('order')->get();
        return view('order.production',compact('outfits'));
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        return view('admin.profile.index',compact('user'));
    }

    public function updateAdmin(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => ['required','unique:users,email,'.auth()->user()->id],
            'old_password' => 'required_with:password',
            'password' => 'required_with:old_password',
        ]);

        if(isset($request->old_password))
        {
            if (Hash::check($request->old_password, auth()->user()->password))
            {
                User::where('id',auth()->user()->id)->update([
                    'password' => bcrypt($request->password)
                ]);
            }
            else
            {
                return redirect()->back()->withError('Wrong Old Password');
            }
        }

        User::where('id',auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back()->withSuccess('Your Profile Updated');
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
