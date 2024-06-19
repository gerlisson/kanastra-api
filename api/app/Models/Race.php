<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'local',
        'active',
        
        'lote_1_price',
        'lote_1_date',

        'lote_2_price',
        'lote_2_date',

        'lote_3_price',
        'lote_3_date',

        'lote_4_price',
        'lote_4_date',

        'lote_5_price',
        'lote_5_date',

        'image',
        'slug',
    ];
}
