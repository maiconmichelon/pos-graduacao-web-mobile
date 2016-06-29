<?php

class Application_Form_Estado extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        
        $sigla_estado = new Zend_Form_Element_Text('sigla_estado', array(
            'label' => 'Sigla do Estado',
            'required' => true
        ));
        
        $sigla_estado->addFilter(new Zend_Filter_StringToUpper);
        $sigla_estado->addValidator(new Zend_Validate_StringLength(array(
            'min' => 2,
            'max' => 2
        )));
        
        $this->addElement($sigla_estado);
        
        $estado = new Zend_Form_Element_Text('nome_estado', array(
            'label' => 'Nome do Estado',
            'required' => true
        ));
        
        $estado->addValidator(new Zend_Validate_StringLength(array(
            'min' => 4
        )));
        
        $estado->addFilter(new Zend_Filter_StringToUpper);
        $this->addElement($estado);
        
        $submit = new Zend_Form_Element_Submit('submit',array(
            'label' => 'Salvar'
        ));
        
        $this->addElement($submit);
    }

}
