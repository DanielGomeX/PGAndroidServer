<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenada extends Model
{
    protected $fillable = [
    	'user_id',
    	'lat',
    	'lng',
    	'data'
    ];
}
