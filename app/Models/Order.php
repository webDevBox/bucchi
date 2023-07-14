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

    // protected $with =['client'];

    public function client()
    {
        $this->belongsTo(Client::class);
    }

    public function scopeProduction($query)
    {
        return $query->whereProduction(0);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}
