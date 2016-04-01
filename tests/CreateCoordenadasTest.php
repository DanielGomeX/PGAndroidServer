<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Coordenada;

class ExampleTest extends TestCase
{
  
  

   public function testeSendPost()
   {
       $dados = ['user_id' => 1, 'lat' => '-14.423423', 
                'lng' => '-10.1412312',
                'data' => date('Y-m-d H:i:s')];

       $response = $this->call('POST','http://localhost:8000/coordenadas/new/', $dados);
       
       $this->assertEquals(200, $response->getStatusCode());
      
   }
}
