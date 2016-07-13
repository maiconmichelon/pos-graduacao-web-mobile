<?php

class AulaController extends Blog_Controller_Action {
    
    public function aulaAction() {
        $params = $this->getAllParams();
        //var_dump($params);
        
        $id = (int) $this->getParam('id', 0);
        // var_dump($id);
        
        $nome = $this->getParam('nome');
        // var_dump($nome);
        
        // exit;
        
        $this->view->id = $id;
        $this->view->nome = $nome;
        
        if ($this->hasParam('idade')) {
            $this->view->idade = $this->getParam('idade');
        }
    }
    
    public function somaAction() {
        $a = $this->getParam('a', 0);
        $b = $this->getParam('b', 0);
        
        $this->view->resultado = $a + $b;
    }
    
}







