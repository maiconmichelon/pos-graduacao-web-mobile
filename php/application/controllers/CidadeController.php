<?php

class CidadeController extends Blog_Controller_Action {

    public function indexAction() {
        $adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $select = $adapter->select();
        $select->from(array('c' => 'cidade'), array('idcidade', 'nome_cidade', 'populacao'))
               ->joinInner(array('e' => 'estado'), 'c.idestado = e.idestado', array('sigla_estado'))
               ->order('nome_cidade asc');
        
        $cidades = $select->query()->fetchAll();
        $this->view->cidades = $cidades;
        $this->podeApagar = $this->aclIsAllowed('cidade', 'delete');
        $this->podeEditar = $this->aclIsAllowed('cidade', 'update');
    }

    public function createAction() {
        $frm = new Application_Form_Cidade();
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $vo = new Application_Model_Vo_Cidade();
                $vo->setCidade($params['nome_cidade']);
                $vo->setPopulacao($params['populacao']);
                $vo->setIdestado($params['idestado']);
                $vo->setIdadmin(0);
                
                $model = new Application_Model_Cidade();
                $model->salvar($vo);
                
                $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Registro salvo');
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }
        
        $this->view->form = $frm;
    }

    public function deleteAction() {
        $idcidade = (int) $this->getParam('idcidade');
        $model = new Application_Model_Cidade();
        $flash = $this->_helper->FlashMessenger;
        
        try {
            $model->apagar($idcidade);
            $flash->addMessage('Registro Apagado');
        } catch (Exception $exc) {
            $flash->addMessage($exc->getMessage());
        }
        
        $this->_helper->Redirector->gotoSimpleAndExit('index');
      }

    public function updateAction() {
        $idCidade = (int) $this->getParam('idcidade');
        $tab = new Application_Model_DbTable_Cidade();
        $row = $tab->fetchRow('idcidade = ' . $idCidade);
        
        if($row === null){
            echo 'Registro inexistente';
            exit;
        }
        
        $frm = new Application_Form_Cidade();
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $vo = new Application_Model_Vo_Cidade();
                $vo->setCidade($params['nome_cidade']);
                $vo->setPopulacao($params['populacao']);
                $vo->setIdestado($params['idestado']);
                $vo->setIdadmin(0);
                $vo->setIdcidade($idCidade);
                
                $model = new Application_Model_Cidade();
                $model->atualizar($vo);
                
                $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Registro atualizado');
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        } else {
            $frm->populate(array(
               'nome_cidade' => $row->nome_cidade,
               'populacao' => $row->populacao,
               'idestado' => $row->idestado,
            ));
        }
        
        $this->view->form = $frm;
    }

}
