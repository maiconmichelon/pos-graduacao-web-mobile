<?php
// Routes

/* @var $app \Slim\App */

/* ********************************** */
/* ********************************** */
/* Estados */
/* ********************************** */
/* ********************************** */
$app->get('/estados', function ($request, $response, $args) {
    $tab = new Application_Model_DbTable_Estado();
    $estados = $tab->fetchAll()->toArray();
    
    return $response->withJson($estados);
});

$app->get('/estado/{id}', function($request, Slim\Http\Response $response, $args) {
    $idestado = (int) $args['id'];
    
    $tabela = new Application_Model_DbTable_Estado();
    $estado = $tabela->fetchRow('idestado = ' . $idestado);
    
    if (!$estado) {
        $response->withJson(array (
                    'mensagem' => 'Estado nao encontrado'
                ), 404);
        
        return $response;
    }
    
    return $response->withJson($estado->toArray());
});

$app->post('/estado', function (Slim\Http\Request $request, $response, $args) {
    $sigla_estado = $request->getParsedBodyParam('sigla_estado');
    $estado = $request->getParsedBodyParam('estado');
    
    $vo = new Application_Model_Vo_Estado();
    $vo->setSiglaEstado($sigla_estado);
    $vo->setNomeEstado($estado);
    $vo->setIdAdmin(0);
    
    $model = new Application_Model_Estado();
    $model->salvar($vo);
    
    $dados = array (
        'idestado' => $vo->getIdestado(),
        'sigla_estado' => $vo->getSiglaEstado(),
        'estado' => $vo->getNomeEstado()
    );
    
    return $response->withJson($dados);
});

$app->delete('/estado/{id}', function(Slim\Http\Request $request, $response, $args) {
    $idestado = (int) $args['id'];
    
    $model = new Application_Model_Estado();
    
    $tabela = new Application_Model_DbTable_Estado();
    $estado = $tabela->fetchRow('idestado = ' . $idestado);
    
    if (!$estado) {
        return $response->withJson(array (
                    'mensagem' => 'Estado nao encontrado para remocao'
                ));
    }
    
    try {
        $model->apagar($idestado);
    } catch (Exception $ex) {
        return $response->withJason(array (
            'mensagem' => $ex->getMessage()
        ), 400);
    }
    
    return $response->withJson(array (
        'mensagem' => 'Estado excluido'
    )); 
});

$app->put('/estado', function(Slim\Http\Request $request, $response, $args) {
    $idestado = (int) $request->getParsedBodyParam('idestado');
    $nome_estado = $request->getParsedBodyParam('estado');
    $sigla_estado = $request->getParsedBodyParam('sigla_estado');
    
    $vo = new Application_Model_Vo_Estado();
    $vo->setIdestado($idestado);
    $vo->setNomeEstado($nome_estado);
    $vo->setSiglaEstado($sigla_estado);
    $vo->setIdAdmin(0);
    
    $model = new Application_Model_Estado();
    $model->atualizar($vo);
    
    $dados = array (
        'idestado' => $vo->getIdestado(),
        'sigla_estado' => $vo->getSiglaEstado(),
        'estado' => $vo->getNomeEstado()
    );
    
    return $response->withJson($dados);
});

/* ********************************** */
/* ********************************** */
/* Cidades */
/* ********************************** */
/* ********************************** */
$app->get('/cidades', function ($request, $response, $args) {
    $tab = new Application_Model_DbTable_Cidade();
    $cidades = $tab->fetchAll()->toArray();
    
    return $response->withJson($cidades);
});

$app->post('/cidade', function (Slim\Http\Request $request, $response, $args) {
    $idestado = (int) $request->getParsedBodyParam('idestado');
    $nome_cidade = $request->getParsedBodyParam('nome_cidade');
    $populacao = $request->getParsedBodyParam('populacao');
    
    $vo = new Application_Model_Vo_Cidade();
    $vo->setIdadmin(0);
    $vo->setIdestado($idestado);
    $vo->setCidade($nome_cidade);
    $vo->setPopulacao($populacao);
    
    $model = new Application_Model_Cidade();
    $model->salvar($vo);
    
    $dados = array (
        'idcidade' => $vo->getIdcidade(),
        'idestado' => $vo->getIdestado(),
        'nome_cidade' => $vo->getCidade(),
        'populacao' => $vo->getPopulacao()
    );
    
    return $response->withJson($dados);
});

$app->delete('/cidade/{id}', function($request, $response, $args) {
    $idcidade = (int) $args['id'];
    
    $model = new Application_Model_Cidade();
    $model->apagar($idcidade);
    
    return $response->withJson('Sucesso');
});

$app->put('/cidade', function(Slim\Http\Request $request, $response, $args) {
    $idcidade = (int) $request->getParsedBodyParam('idcidade');
    $idestado = (int) $request->getParsedBodyParam('idestado');
    $nome_cidade = $request->getParsedBodyParam('nome_cidade');
    $populacao = $request->getParsedBodyParam('populacao');
    
    $vo = new Application_Model_Vo_Cidade();
    $vo->setIdcidade($idcidade);
    $vo->setIdadmin(0);
    $vo->setIdestado($idestado);
    $vo->setCidade($nome_cidade);
    $vo->setPopulacao($populacao);
    
    $model = new Application_Model_Cidade();
    $model->atualizar($vo);
    
    $dados = array (
        'idcidade' => $vo->getIdcidade(),
        'idestado' => $vo->getIdestado(),
        'nome_cidade' => $vo->getCidade(),
        'populacao' => $vo->getPopulacao()
    );
    
    return $response->withJson($dados);
});





