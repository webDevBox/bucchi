<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'name', 'description', 'price', 'hours', 'fabric'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
