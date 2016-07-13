<?php

class PostController extends Blog_Controller_Action {

    public function indexAction() {
        //pego um adapter para conexao com o banco de dados default
        $adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        //crio uma variavel que retorna o estado que o adapter retorna no caso select
        $select = $adapter->select();
        //indico qual tabela e qual os campos dessa tabela que farao parte do select
        $select->from(array('p' => 'post'),array('idpost','titulo'));
        //indico qual tabela e quais os campos do inner join 
        $select->joinInner(array('c' => 'categoria'), 'c.idcategoria = p.idcategoria',array('categoria'));
        //indico a ordenacao
        $select->order('idpost desc');
        
        //faco retornar o query
        $posts = $select->query()->fetchAll();
        
        //passo para a view o resultado da select
        $this->view->posts = $posts;
        $this->view->podeApagar = $this->aclIsAllowed('post', 'delete');
    }

    public function createAction() {
        //instancio o form para apresentar a view
        $frm = new Application_Form_Post();
        
        //Verifico se retorna informacao via POST da view
        if($this->getRequest()->isPost()){
            //Pego todos os parametros retornados da view
            $params = $this->getAllParams();
            
            //Faco a validacao com os parametros retornados
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $vo = new Application_Model_Vo_Post();
                $vo->setIdcategoria($params['idcategoria']);
                $vo->setIdadmin($dados->idadmin);
                $vo->setTexto($params['texto']);
                $vo->setTitulo($params['titulo']);
                
                $model = new Application_Model_Post();
                $model->salvar($vo);
                
                $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Registro Salvo');
                
                //Redirecionamento para outra pagina
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }
        
        $this->view->form = $frm;
    }

    public function deleteAction() {
        $idPost = (int)$this->getParam('idpost');
        
        $model = new Application_Model_Post();
        $model->apagar($idPost);
        
        $flash = $this->_helper->FlashMessenger;
        $flash->addMessage('Registro Excluido');
                
        //Redirecionamento para outra pagina
        $this->_helper->Redirector->gotoSimpleAndExit('index');
    }

    public function updateAction() {
       $idPost = (int)$this->getParam('idpost');
       $tab = new Application_Model_DbTable_Post();
       $row = $tab->fetchRow('idpost = '.$idPost);
       if($row === null){
           echo 'Registro inexistente';
            exit;
       }
       
       $frm = new Application_Form_Post();
       
       if($this->getRequest()->isPost()){
           $params = $this->getAllParams();
           if($frm->isValid($params)){
               $params = $frm->getValues();
               
               $vo = new Application_Model_Vo_Post;
               $vo->setIdadmin(0);
               $vo->setIdcategoria($params['idcategoria']);
               $vo->setTexto($params['texto']);
               $vo->setTitulo($params['titulo']);
               $vo->setIdpost($idPost);
               
               $model = new Application_Model_Post();
               $model->atualizar($vo);
               
               $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Registro Atualizado');
                
                //Redirecionamento para outra pagina
                $this->_helper->Redirector->gotoSimpleAndExit('index');
           }
       }else{
           $frm->populate(array(
               'idpost' => $row->idpost,
               'idcategoria' => $row->idcategoria,
               'titulo' => $row->titulo,
               'texto' => $row->texto
           ));
       }
       
       $this->view->form = $frm;
    }
    
    

}
