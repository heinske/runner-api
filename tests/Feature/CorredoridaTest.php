<?php

namespace Tests\Feature;

use App\Model\Corrida;
use App\Model\Prova;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CorredoridaTest extends TestCase
{
    
        /** 
      * Teste de cadastro de prova sucesso
      * @test 
      */
      public function cadastro_corrida_sucesso_request()
      {
          $prova_id = Prova::all()->last()->id;
          $corredor_id = Corrida::all()->last()->id;

          $response = $this->postJson('/api/corrida',[
              'prova_id' => $prova_id,
              'corredor_id' =>  $corredor_id
          ]);
  
          $response->assertStatus(200);
          $this->assertTrue($response['success']);
             
      }
  
}
