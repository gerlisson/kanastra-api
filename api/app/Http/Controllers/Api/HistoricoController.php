<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Historico;

class HistoricoController extends Controller
{
    public function index(Historico $historico)
    {
        return response()->json($historico->orderBy('id', 'desc')->get());
    }
}
