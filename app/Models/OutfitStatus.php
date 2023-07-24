<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutfitStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'outfit_id', 'status', 'date_time'
    ];
}
