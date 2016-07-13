<?php

class Application_Form_Post extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        
        $categoria = new Zend_Form_Element_Select('idcategoria',array(
            'label' => 'Categoria',
            'required' => true
        ));
        //incluir as categorias dentro de um combobox
        $categoria->setMultiOptions($this->categorias());
        //converte valores inteiros 0 em valores null
        $categoria->addFilter(new Zend_Filter_Null());
        $this->addElement($categoria);
        
        $titulo = new Zend_Form_Element_Text('titulo', array(
            'label' => 'Titulo do Post',
            'required' => true
        ));
        $min10 = new Zend_Validate_StringLength(array(
            'min' => 10
        ));
        $titulo->addValidator($min10);        
        $titulo->addFilter(new Zend_Filter_StringToUpper);
        $this->addElement($titulo);
        
        $texto = new Zend_Form_Element_Textarea('texto',array(
            'label' => 'Conteudo',
            'required' => true
        ));
        $this->addElement($texto);
        
        $submit = new Zend_Form_Element_Submit('submit',array(
            'label' => 'Salvar'
        ));
        $this->addElement($submit);
    }
    
    private function categorias(){
        //funcao para retornar as categorias cadastradas
        
        //instancio uma conexao com a tabela no banco de dados
        $tab = new Application_Model_DbTable_Categoria();
        //retorno todas as informacoes por ordem crescente de id
        $categorias = $tab->fetchAll(null,'idcategoria');
        
        //atribuo no indice 0 uma informacao fixa
        $r = array(
            0 => 'Selecione uma opcao'
        );
        
        //atribuo ao array as categorias vindas do banco
        foreach ($categorias as $categoria){
            $r[$categoria->idcategoria] = $categoria->categoria;
        }
        
        //retorna o array com as categorias
        return $r;
    }

}
