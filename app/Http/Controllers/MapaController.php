<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use DB;

class MapaController extends Controller
{
    

    public function index(Request $get)
    {    
      
        return view('mapa.view');
           
    }
    
}