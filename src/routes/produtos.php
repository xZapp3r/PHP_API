<?php

use Slim\App;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;
use App\Models\Produto;

/* ORM -> Object Relational Mapper (Mapeador de objeto relacional) 
Illuminate -> e o motor da base de dados do Laravel sem o Laravel Eloquent ORM
*/

return function (App $app) {
    // $container = $app->getContainer();Request $request, Response $response
    $container = $app->getContainer();
    $app->group('/api/v1', function (){
        $this->get('/produtos/lista', function(Request $request, Response $response){
            $produtos = Produto::get();
            return $response->withJson($produtos);
        });
        $this->post('/produtos/adiciona', function(Request $request, Response $response){
            $dados = $request->getParsedBody();
            $produto = Produto::create( $dados );
            return $response->withJson($produto );
        });

    });
};



