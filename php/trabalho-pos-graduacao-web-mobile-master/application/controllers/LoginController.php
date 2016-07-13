<?php

class LoginController extends Blog_Controller_Action {

    public function indexAction() {
        $form = new Application_Form_Login();
        
        if ($this->getRequest()->isPost()) {
            $values = $this->getAllParams();
            if ($form->isValid($values)) {
                // autenticacao do usuario
                
                $dbtable = new Zend_Auth_Adapter_DbTable();
                $dbtable->setTableName('admin');
                $dbtable->setCredentialColumn('senha');
                $dbtable->setIdentityColumn('email');
                
                $dbtable->setIdentity($form->getValue('email'));
                $dbtable->setCredential($form->getValue('senha'));
                
                $auth = Zend_Auth::getInstance();
                $autenticacao = $auth->authenticate($dbtable);
                
                if ($autenticacao->isValid()) {
                    $dados = $dbtable->getResultRowObject(null, array('senha'));
                    
                    $auth->getStorage()->write($dados);
                    
                    $this->_helper->Redirector->gotoSimpleAndExit('index', 'index');
                } else {
                    //$flash = $this->_helper->FlashMessenger;
                    //$flash->addMessage('Login e/ou senha incorretos.');
                    
                    $this->view->msg = 'Email e/ou senha incorretos.';
                }
            }
        }
        
        $this->view->form = $form;
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->Redirector->gotoSimpleAndExit('index');
    }

}
