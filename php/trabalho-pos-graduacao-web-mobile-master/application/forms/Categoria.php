<?php

class Application_Form_Categoria extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        
        $categoria = new Zend_Form_Element_Text('categoria',array(
            'label' => 'Nome da Categoria',
            'required' => true
        ));
        $categoria->addFilter(new Zend_Filter_StringToUpper);
        $this->addElement($categoria);
        
        $submit = new Zend_Form_Element_Submit('submit',array(
            'label' => 'Salvar'
        ));
        $this->addElement($submit);
    }

}
