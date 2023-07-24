<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'article', 'name', 'description', 'price', 'hours', 'fabric',
        'production'
    ];

    protected $with =[
        'statuses', 'notes'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function statuses()
    {
        return $this->hasMany(OutfitStatus::class);
    }
    
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function scopeProduction($query)
    {
        return $query->whereProduction(1);
    }
}
