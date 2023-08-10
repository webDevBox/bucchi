<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice', 'client_id', 'status', 'delivery', 'completion_date', 'currency',
        'notes', 'client_name', 'shipping_cost'
    ];

    protected $with =['client','outfits','transactions'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::Class);
    }

    public function outfits()
    {
        return $this->hasMany(Outfit::class);
    }

    public function scopeProduction($query)
    {
        return $query->whereProduction(0);
    }
    
    public function scopeCompleted($query)
    {
        return $query->whereProduction(1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
