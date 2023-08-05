<?php

function percentage($value,$total)
{
    if($total > 0)
    {
        $percentage = ($value/$total)*100;
        $formattedPercentage = number_format($percentage, 2) . "%";
        return $formattedPercentage;
    }
    return 0 . "%";
}

function formateDateTime($created_at)
{
    return $created_at->format('d F Y');
}

function formateDateAndTime($created_at)
{
    $dateTime = new DateTime($created_at);
    return $dateTime->format('j F Y \a\t g:i A');
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