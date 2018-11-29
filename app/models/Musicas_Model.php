<?php

class Musicas_Model extends Model{
    public $_tabela = "musicas";
     public $_artista = "artistas";
    
     public function musico($id = null){
        $vector = array();
        $where = ($id != null ? "where {$id}":"");
        $result = $this->conexao->query("select * from `{$this->_artista}` {$where}");
        if (count($result) > 0){
            foreach ($result as $linha){
                $vector[] = $linha;
            }
        }
        return $vector;
    }
   
}

