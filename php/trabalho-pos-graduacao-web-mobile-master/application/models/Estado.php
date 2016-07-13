<?php

class Application_Model_Estado {

    public function apagar($idestado) {
        $tabela_cidade = new Application_Model_DbTable_Cidade();
        $cidades = $tabela_cidade->fetchRow('idestado = ' . $idestado);
        
        if($cidades !== null){
            throw new Exception('Existem cidades cadastradas para esse estado', 1);
        }
        
        $tabela_estado = new Application_Model_DbTable_Estado();
        $tabela_estado->delete('idestado = ' . $idestado);
        
        return true;
    }

    public function atualizar(Application_Model_Vo_Estado $estado) {
        $tab = new Application_Model_DbTable_Estado();
        $tab->update(array(
            'sigla_estado' => $estado->getSiglaEstado(),
            'nome_estado' => $estado->getNomeEstado(),
            'idadmin' => $estado->getIdadmin()
        ), 'idestado = ' . $estado->getIdestado());
        
        return true;
    }

    public function salvar(Application_Model_Vo_Estado $estado) {
        $tab = new Application_Model_DbTable_Estado();
        $tab->insert(array(
            'sigla_estado' => $estado->getSiglaEstado(),
            'nome_estado' => $estado->getNomeEstado(),
            'idadmin' => $estado->getIdadmin()
        ));
        
        $estado->setIdestado($tab->getAdapter()->lastInsertId());
        
        return true;
    }

}
