<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'cpf', 'whatsapp', 'email', 'nascimento', 'sexo', 'equipe'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
