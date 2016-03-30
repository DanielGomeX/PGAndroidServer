<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Checkpoint extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'checkpoints';

   
    public function itinerario()
    {
        return $this->belongsTo('App\Itinerario', 'itinerario_id');
    }
  
    public function ronda()
    {
        return $this->belongsTo('App\Ronda', 'ronda_id');
    }
}
