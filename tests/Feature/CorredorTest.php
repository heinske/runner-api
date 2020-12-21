<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CorredorTest extends TestCase
{
      /** 
      * Teste de cadastro de corredor sucesso
      * @test 
      */
      public function cadastro_corredor_sucesso_request()
      {
          $response = $this->postJson('/api/corredor',[
              'nome' => 'Eduardo H',
              'cpf' =>  '01653696988',
              'data_nascimento' => '1995-01-24'
          ]);
  
          $response->assertStatus(200);
          $this->assertTrue($response['success']);
             
      }
  
        /** 
        * Teste de cadastro de prova com falha na data
        * @test 
        */
        public function cadastro_corredor_falha_menor_idade_request()
        {
            $response = $this->postJson('/api/corredor',[
                'nome' => 'Eduardo H',
                'cpf' =>  '01653696988',
                'data_nascimento' => '2010-01-24'
            ]);

            $response->assertStatus(500);
            $this->assertFalse($response['success']);  
        }
  
}
