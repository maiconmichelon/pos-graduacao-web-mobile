<?php
// Routes

/* @var $app \Slim\App */

/* post */
$app->get('/posts', function ($request, $response, $args) {
    $tab = new Application_Model_DbTable_Post();
    $posts = $tab->fetchAll()->toArray();
    
    return $response->withJson($posts);
});

$app->post('/post', function (Slim\Http\Request $request, $response, $args) {
    $model = new Application_Model_Post();
    
    $idcategoria = (int) $request->getParsedBodyParam('idcategoria');
    $titulo = $request->getParsedBodyParam('titulo');
    $texto = $request->getParsedBodyParam('texto');
    
    $vo = new Application_Model_Vo_Post();
    $vo->setIdadmin(0);
    $vo->setIdcategoria($idcategoria);
    $vo->setTitulo($titulo);
    $vo->setTexto($texto);
    
    $model->salvar($vo);
    
    $dados = array (
        'idpost' => $vo->getIdpost(),
        'idcategoria' => $vo->getIdcategoria(),
        'titulo' => $vo->getTitulo(),
        'texto' => $vo->getTexto()
    );
    
    return $response->withJson($dados);
});

$app->put('/post', function(Slim\Http\Request $request, $response, $args) {
    $idpost = (int) $request->getParsedBodyParam('idpost');
    $idcategoria = (int) $request->getParsedBodyParam('idcategoria');
    $titulo = $request->getParsedBodyParam('titulo');
    $texto = $request->getParsedBodyParam('texto');
    
     // print $idpost . ' - ' . $idcategoria . ' - ' . $titulo . ' - ' . $texto; exit;
    
    $vo = new Application_Model_Vo_Post();
    $vo->setIdpost($idpost);
    $vo->setIdadmin(0);
    $vo->setIdcategoria($idcategoria);
    $vo->setTitulo($titulo);
    $vo->setTexto($texto);
    
    $model = new Application_Model_Post();
    $model->atualizar($vo);
    
    $dados = array (
        'idpost' => $vo->getIdpost(),
        'idcategoria' => $vo->getIdcategoria(),
        'titulo' => $vo->getTitulo(),
        'texto' => $vo->getTexto()
    );
    
    return $response->withJson($dados);
});

$app->delete('/posts/{id}', function($request, $response, $args) {
    $idpost = (int) $args['id'];
    
    $model = new Application_Model_Post();
    $model->apagar($idpost);
    
    return $response->withJson('Sucesso');
});

/* categorias */
$app->get('/categorias', function($request, $response, $args) {
    $tabela = new Application_Model_DbTable_Categoria();
    $categorias = $tabela->fetchAll()->toArray();
    
    return $response->withJson($categorias);
});

$app->get('/categoria/{id}', function($request, Slim\Http\Response $response, $args) {
    $idcategoria = (int) $args['id'];
    
    $tabela = new Application_Model_DbTable_Categoria();
    $categoria = $tabela->fetchRow('idcategoria = ' . $idcategoria);
    
    if (!$categoria) {
        $response->withJson(array (
                    'mensagem' => 'Categoria nao encontrada'
                ), 404);
        
        return $response;
    }
    
    return $response->withJson($categoria->toArray());
});

$app->post('/categoria', function (Slim\Http\Request $request, $response, $args) {
    $categoria = $request->getParsedBodyParam('categoria');
    
    $vo = new Application_Model_Vo_Categoria();
    $vo->setCategoria($categoria);
    
    $model = new Application_Model_Categoria();
    $model->salvar($vo);
    
    $dados = array (
        'idcategoria' => $vo->getIdcategoria(),
        'categoria' => $vo->getCategoria()
    );
    
    return $response->withJson($dados);
});

$app->delete('/categoria/{id}', function(Slim\Http\Request $request, $response, $args) {
    $idcategoria = (int) $args['id'];
    
    $model = new Application_Model_Categoria();
    
    $tabela = new Application_Model_DbTable_Categoria();
    $categoria = $tabela->fetchRow('idcategoria = ' . $idcategoria);
    
    if (!$categoria) {
        return $response->withJson(array (
                    'mensagem' => 'Categoria nao encontrada para remocao'
                ));
    }
    
    try {
        $model->apagar($idcategoria);    
    } catch (Exception $ex) {
        return $response->withJason(array (
            'mensagem' => $ex->getMessage()
        ), 400);
    }
    
    return $response->withJson(array (
        'mensagem' => 'Categoria excluida'
    )); 
});

$app->put('/categoria', function(Slim\Http\Request $request, $response, $args) {
    $idcategoria = (int) $request->getParsedBodyParam('idcategoria');
    $categoria = $request->getParsedBodyParam('categoria');
    
    $vo = new Application_Model_Vo_Categoria();
    $vo->setIdcategoria($idcategoria);
    $vo->setCategoria($categoria);
    
    $model = new Application_Model_Categoria();
    $model->atualizar($vo);
    
    $dados = array (
        'idcategoria' => $vo->getIdcategoria(),
        'categoria' => $vo->getCategoria()
    );
    
    return $response->withJson($dados);
});

/* estado */

