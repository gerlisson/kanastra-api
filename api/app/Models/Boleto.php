<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;

    protected $table = 'boletos';

    protected $fillable = [
        'historico_id',
        'name',
        'governmentId',
        'email',
        'debtAmount',
        'debtDueDate',
        'debtId'
    ];
}
