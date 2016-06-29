<?php

class Application_Model_Vo_Cidade {
    
    private $idcidade;
    private $cidade;
    private $idestado;
    private $populacao;
    private $idadmin;
    
    function getIdcidade() {
        return $this->idcidade;
    }
    
    function getCidade() {
        return $this->cidade;
    }
    
    function getIdestado() {
        return $this->idestado;
    }
    
    function getPopulacao() {
        return $this->populacao;
    }
    
    function getIdadmin() {
        return $this->idadmin;
    }

    function setIdcidade($idcidade) {
        $this->idcidade = $idcidade;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }
    
    function setPopulacao($populacao) {
        $this->populacao = $populacao;
    }
    
    function setIdadmin($idadmin) {
        $this->idadmin = $idadmin;
    }

}