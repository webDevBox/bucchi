<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'status', 'delivery', 'completion_date', 'currency',
        'notes'
    ];

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}
