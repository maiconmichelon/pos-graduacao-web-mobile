<?php

class Application_Model_Cidade {

    public function apagar($idcidade) {
        $tab = new Application_Model_DbTable_Cidade();
        $tab->delete('idcidade = ' . $idcidade);
        
        return true;
    }

    public function atualizar(Application_Model_Vo_Cidade $cidade) {
        $tab = new Application_Model_DbTable_Cidade();
        
        $tab->update(array(
            'nome_cidade' => $cidade->getCidade(),
            'idestado' => $cidade->getIdestado(),
            'populacao' => $cidade->getPopulacao()
        ), 'idcidade = ' . $cidade->getIdcidade());
        
        return true;
    }

    public function salvar(Application_Model_Vo_Cidade $cidade) {
        $tab = new Application_Model_DbTable_Cidade();
        $tab->insert(array(
            'nome_cidade' => $cidade->getCidade(),
            'populacao' => $cidade->getPopulacao(),
            'idestado' => $cidade->getIdestado(),
            'idadmin' => $cidade->getIdadmin(),
        ));
        
        $cidade->setIdcidade($tab->getAdapter()->lastInsertId());
        
        return true;
    }

}
