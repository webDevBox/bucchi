<?php

function percentage($value,$total)
{
    if($value > 0)
    {
        $percentage = ($value/$total)*100;
        $formattedPercentage = number_format($percentage, 2) . "%";
        return $formattedPercentage;
    }
    return 0 . "%";
}

function remainingDays($time)
{
    $currentDate = now()->startOfDay();
    $targetDate = \Illuminate\Support\Carbon::parse($time)->startOfDay();
    $remainingDays = $currentDate->diffInDays($targetDate);
    
    if ($targetDate < $currentDate || $remainingDays == 0) {
        // $remainingDays *= -1;
        return 'Due date passed';
    }
    
    return $remainingDays;
}