<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pedidos';

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function products()
    {
        return $this->hasMany('App\PedidoProduct');
    }
 


}
