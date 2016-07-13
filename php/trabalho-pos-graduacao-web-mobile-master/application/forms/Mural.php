<?php

class Application_Form_Mural extends Zend_Form {

    public function init() {
        // nome, email, recado, captcha, termos, submit

        $nome = new Zend_Form_Element_Text('nome', array(
            'label' => 'Nome completo',
            'required' => true,
        ));
        $nome->addValidator(new Zend_Validate_StringLength(array(
            'min' => 10
        )));
        $nome->addFilter(new Zend_Filter_StringToUpper());

        $this->addElement($nome);

        $email = new Zend_Form_Element_Text('email', array(
            'label' => 'Email',
            'required' => true,
        ));
        $email->addValidator(new Zend_Validate_EmailAddress());

        $this->addElement($email);

        $recado = new Zend_Form_Element_Text('recado', array(
            'label' => 'Recado',
            'required' => true
        ));

        $this->addElement($recado);

        $captcha = new Zend_Form_Element_Captcha('captcha', array(
            'label' => "Please verify you're a human",
            'captcha' => array(
                'captcha' => 'Figlet',
                'wordLen' => 6,
                'timeout' => 300,
            ),
        ));

        $this->addElement($captcha);

        $termos = new Zend_Form_Element_Checkbox('termos', array(
            'label' => 'Aceito os termos de uso',
            'required' => true,
        ));
        $termos->addValidator(new Zend_Validate_NotEmpty());
        $termos->addFilter(new Zend_Filter_Null());

        $this->addElement($termos);

        $submit = new Zend_Form_Element_Submit('submit', array(
            'label' => 'Salvar'
        ));

        $this->addElement($submit);
    }

}
