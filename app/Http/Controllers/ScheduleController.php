<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Outfit;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Note;
use Carbon\Carbon;
use App\Models\OutfitStatus;
use App\Models\Scheduling;
use App\Models\AvailableHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    public function index()
    {
        $currentWeek = Carbon::now()->startOfWeek();
        $weeks = [];

        for ($i = 0; $i < 12; $i++) {
            $weeks[] = [
                'start' => $currentWeek->format('M d'),
                'end' => $currentWeek->copy()->endOfWeek()->format('M d'),
            ];

            $currentWeek->addWeek();
        }
        $orders = Order::active()->production()->with('scheduling')->get();

        foreach ($orders as $order) {
            $currentWeek = Carbon::now()->startOfWeek();

            $completionDate = Carbon::parse($order->completion_date);
            $currentDate = Carbon::now();

            $weekDifference = $completionDate->diffInWeeks($currentWeek);
            $weekNumber = $weekDifference + 1;

            if($completionDate->isSameDay($currentDate))
            {
                $order['passed'] = false;
                $order['week'] = $weekNumber;
            }
            elseif($completionDate->isFuture())
            {
                $order['passed'] = false;
                $order['week'] = $weekNumber;
            }
            else
            {
                $order['passed'] = true;
                $order['week'] = 0;
            }

            $remainingHour = 0;
            foreach ($order->outfits as $outfit) {
                if($outfit->statuses->where('status','Embr Out')->isEmpty())
                {
                    $remainingHour+=$outfit->hours;
                }
                $order['remaining'] = $remainingHour;
            }

        }

        $availableHour = AvailableHours::get();
        return view('admin.scheduling.index',compact('availableHour', 'orders','weeks'));
    }

    public function create(Request $request)
    {
        try {
            Scheduling::where('order_id',$request->order)->delete();
            foreach ($request->scheduling as $schedule) {
                Scheduling::create([
                    'order_id' => $request->order,
                    'week' => $schedule['week'],
                    'hours' => $schedule['hours']
                ]);
            }
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage()
            ]);
        }
        

    }
    
    public function availability(Request $request)
    {
        try {
            AvailableHours::truncate();
            foreach ($request->availability as $availability) {
                AvailableHours::create([
                    'week' => $availability['week'],
                    'hours' => $availability['hours']
                ]);
            }
            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage()
            ]);
        }
        

    }
}
