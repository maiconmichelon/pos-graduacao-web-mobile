<?php

class Application_Form_Cidade extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        
        // Campo estado
        $estado = new Zend_Form_Element_Select('idestado',array(
            'label' => 'Estado',
            'required' => true
        ));
        
        $estado->setMultiOptions($this->estados())
                ->addFilter(new Zend_Filter_Null());
        
        $this->addElement($estado);
        
        // Campo cidade
        $cidade = new Zend_Form_Element_Text('nome_cidade', array(
            'label' => 'Nome da Cidade',
            'required' => true
        ));
        
        $validator_cidade = new Zend_Validate_StringLength(array(
            'min' => 1,
            'max' => 300
        ));
        
        $cidade->addValidator($validator_cidade)
                ->addFilter(new Zend_Filter_StringToUpper());
        
        $this->addElement($cidade);
        
        // Campo população
        $populacao = new Zend_Form_Element_Text('populacao', array(
            'label' => 'População',
            'required' => true
        ));
        
        $validator_populacao = new Zend_Validate_StringLength(array(
            'min' => 1,
            'max' => 12
        ));
        
        $populacao->addValidator($validator_populacao);
        $populacao->addValidator(new Zend_Validate_Digits());
        
        $this->addElement($populacao);
        
        $submit = new Zend_Form_Element_Submit('submit',array(
            'label' => 'Salvar'
        ));
        
        $this->addElement($submit);
    }
    
    private function estados(){
        $tab = new Application_Model_DbTable_Estado();
        $estados = $tab->fetchAll(null,'idestado');
        
        $r = array(
            0 => 'Selecione uma opção'
        );
        
        foreach ($estados as $estado){
            $r[$estado->idestado] = $estado->sigla_estado;
        }
        
        return $r;
    }

}
