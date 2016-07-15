<?php

class Application_Model_Vo_Estado{
    
    private $idestado;
    private $sigla_estado;
    private $nome_estado;
    private $id_admin;
    
    function getIdestado() {
        return $this->idestado;
    }

    function getSiglaEstado() {
        return $this->sigla_estado;
    }
    
    function getNomeEstado() {
        return $this->nome_estado;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }
    
    function setSiglaEstado($sigla_estado) {
        $this->sigla_estado = $sigla_estado;
    }
    
    function setNomeEstado($nome_estado) {
        $this->nome_estado = $nome_estado;
    }
    
    function getIdAdmin() {
        return $this->id_admin;
    }

    function setIdAdmin($id_admin) {
        $this->id_admin = $id_admin;
    }    

}