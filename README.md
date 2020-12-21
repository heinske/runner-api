<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.flaticon.com/svg/static/icons/svg/606/606712.svg" width="400"></a></p>
<h1>Runner Api</h1>

## 1. Pré Requisitos de Instalação

- Docker instalado na máquina
- Docker compose instalado na máquina

## 2. Instalação

Executar o comando abaixo na raiz. 

    docker-compose up -d --build 

## 3. Configuração

Caso não seja executado automaticamente, entrar no container **runner-app** e executar os comandos:

    php composer.phar install
    php artisan migrate
    chmod 777 -R storage
    
Obs: Os comandos acima são aplicáveis apenas para ambiente de desenvolvimento. Em ambiente de homologação e produção ficaria com o código fonte dentro da imagem e com as permissões corretas aplicadas. 


## 4. Execução dos testes

    php artisan test

## 5. Serviços disponibilizados

#### 5.1 Inclusão de corredor

**Método:** POST 
**URL:** http://localhost:8080/api/corredor
**Parâmetros de entrada:** 

- nome
- cpf
- data_nascimento

#### 5.2 Inclusão de prova

**Método:** POST 
**URL:** http://localhost:8080/api/prova
**Parâmetros de entrada:** 

- data
- tipo (3, 5, 10, 21, 42)

#### 5.3 Inclusão de corrida (corredor x prova)

**Método:** POST 
**URL:** http://localhost:8080/api/corrida
**Parâmetros de entrada:** 

- corredor_id
- prova_id

#### 5.4 Inclusão de resultados da corrida

**Método:** POST 
**URL:** http://localhost:8080/api/corrida/ID_CORRIDA/resultado
**Parâmetros de entrada:** 

- id
- hora_inicio
- hora_termino

#### 5.5 Relatório Geral

**Método:** GET 
**URL: ** http://localhost:8080/api/corrida/relatorio/geral

#### 5.6 Relatório por Idade

**Método:** GET 
**URL:** http://localhost:8080/api/corrida/relatorio/idade


