<?php

class IndexController extends Blog_Controller_Action {

    public function indexAction() {
        $tabela_estado = new Application_Model_DbTable_Estado();
        $estados = $tabela_estado->fetchAll(null, 'sigla_estado')->toArray();
        $this->view->estados = $estados;
        
        $select = $this->consulta();
        $select->order('nome_cidade desc');
        $cidades = $select->query()->fetchAll();
        $this->view->cidades = $cidades;
        
        $usuario = $this->getAuthRole();
        $this->view->usuario = $usuario;
    }

    public function estadoAction() {
        $tab = new Application_Model_DbTable_Estado();
        $idestado = (int) $this->getParam('idestado');
        $estado = $tab->fetchRow('idestado = ' . $idestado);
        $this->view->estado = $estado;
        
        $tabela_cidade = new Application_Model_DbTable_Cidade();
        $cidades = $tabela_cidade->fetchAll('idestado = ' . $idestado, 'populacao desc')->toArray();
        $this->view->cidades = $cidades;
    }

    public function postAction() {
        $idpost = (int) $this->getParam('idpost');
        $select = $this->consulta();
        $select->where('p.idpost = '.$idpost);
        
        $post = $select->query()->fetch();
        
        if(!$post){
            throw new Zend_Controller_Action_Exception();
        }
        
        $this->view->post = $post;
    }
    
    private function consulta(){
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $select = $dbAdapter->select()
                ->from(array('c' => 'cidade'), array('nome_cidade', 'populacao'))
                ->joinInner(array('e' => 'estado'), 'e.idestado = c.idestado', array('sigla_estado', 'nome_estado'));
        
        return $select;
    }

}
