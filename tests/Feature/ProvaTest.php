<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvaTest extends TestCase
{

     /** 
      * Teste de cadastro de prova sucesso
      * @test 
      */
    public function cadastro_prova_sucesso_request()
    {
        $response = $this->postJson('/api/prova',[
            'data' => (new \DateTime('now'))->format('Y-m-d'),
            'tipo' =>  3
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response['success']);
           
    }

    /** 
      * Teste de cadastro de prova com falha na data

      * @test 
      */
      public function cadastro_prova_falha_formato_data_request()
      {
          $response = $this->postJson('/api/prova',[
              'data' => (new \DateTime('now'))->format('Y-m-d').' abs',
              'tipo' =>  3
          ]);
  
          $response->assertStatus(500);
          $this->assertFalse($response['success']);
             
      }

    /** 
    * Teste de cadastro de prova com falha na data

    * @test 
    */
    public function cadastro_prova_falha_formato_tipo_request()
    {
        $response = $this->postJson('/api/prova',[
            'data' => (new \DateTime('now'))->format('Y-m-d'),
            'tipo' =>  6
        ]);

        $response->assertStatus(500);
        $this->assertFalse($response['success']);
    }
  


}
