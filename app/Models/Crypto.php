<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    protected $fillable = [
        'symbol',
        'name',
        'price',
        'percent_change_24h'
    ];
}
