<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Coordenada;

class CoordenadaController extends Controller
{ 
  

    public function store(Request $request)
    {
        Coordenada::create($request->all());
    }
}
