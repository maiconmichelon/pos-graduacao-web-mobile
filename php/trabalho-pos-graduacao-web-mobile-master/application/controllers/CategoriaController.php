<?php

class CategoriaController extends Blog_Controller_Action {

    public function indexAction() {
        //Buscando informaçoes da tabela categoria
        $tab = new Application_Model_DbTable_Categoria();
        $categorias = $tab->fetchAll(null,'idCategoria desc')->toArray();
        $this->view->categorias = $categorias;
    }

    public function createAction() {
        $frm = new Application_Form_Categoria();
        
        //entra aqui caso clicou no submit
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            //se os parametros forem validos entrar aqui
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                //instancia um objeto de Vo_Categoria
                $vo = new Application_Model_Vo_Categoria();
                $vo->setCategoria($params['categoria']);
                
                //instancia o objeto model_Categoria
                $model = new Application_Model_Categoria();
                $model->salvar($vo);
                
                //Utilizando helper para exibir mensagem de Registro salvo
                $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Registro Salvo');
                
                //Redirecionamento para outra pagina
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }
        
        $this->view->form = $frm;
    }

    public function deleteAction() {
        //pego o id da categoria da view
        $idcategoria = (int) $this->getParam('idcategoria');
        //instancio um objeto de model
        $model = new Application_Model_Categoria();
        //instancio um objeto do helper para mensagem
        $flash = $this->_helper->FlashMessenger;
        
        //efetuo a exclusao do registro, caso ocorra um erro entra no catch
        try {
            $model->apagar($idcategoria);
            $flash->addMessage('Registro Apagado');
        } catch (Exception $exc) {
            $flash->addMessage($exc->getMessage());
        }
        
        $this->_helper->Redirector->gotoSimpleAndExit('index');
      }

    public function updateAction() {
        //faco a verificacao se o idcategoria existe no banco de dados
        $idCategoria = (int) $this->getParam('idcategoria');
        $tab = new Application_Model_DbTable_Categoria();
        $row = $tab->fetchRow('idcategoria = '.$idCategoria);
        if($row === null){
            echo 'Registro inexistente';
            exit;
        }
        
        $frm = new Application_Form_Categoria();
        
        //entra aqui caso clicou no submit
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            //se os parametros forem validos entrar aqui
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                //instancia um objeto de Vo_Categoria
                $vo = new Application_Model_Vo_Categoria();
                $vo->setCategoria($params['categoria']);
                $vo->setIdcategoria($idCategoria);
                
                //instancia o objeto model_Categoria
                $model = new Application_Model_Categoria();
                $model->atualizar($vo);
                
                //Utilizando helper para exibir mensagem de Registro salvo
                $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Registro Atualizado');
                
                //Redirecionamento para outra pagina
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }else{
            //entra para apresentar a informacao nessa tela
            $frm->populate(array(
               'categoria' => $row->categoria 
            ));
        }
        
        $this->view->form = $frm;
    }

}
