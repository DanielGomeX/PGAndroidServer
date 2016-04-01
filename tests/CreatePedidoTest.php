<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Coordenada;
use App\User;
class CreatePedidoTest extends TestCase
{
  
  

   public function testeSendPost()
   {


      
       $dados = ['name'=>date('YmdHis').rand(1,000),
        'user_id' => 1,
        'produtosSelecionados' => [1,2,3],
        'quantidadesSelecionados' => [10,100,1000]
        ];

       $response = $this->call('POST','http://localhost:8000/pedido/store', $dados);
       
        echo $response->getContent();
      
   }
}
