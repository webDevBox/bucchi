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
        $orders = Order::active()->production()->get();

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

        }
        return view('admin.scheduling.index',compact('orders','weeks'));
    }
}
