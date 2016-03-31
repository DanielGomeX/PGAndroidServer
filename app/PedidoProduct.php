<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PedidoProduct extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pedido_products';


    public function pedido()
    {
        return $this->belongsTo('App\Pedido');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }


}
