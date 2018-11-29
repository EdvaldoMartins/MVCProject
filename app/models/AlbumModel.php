<?php


class AlbumModel  extends Model{
    public $_tabela = "albuns";
    private $_faixas = "musicas";


    public function faixas($id_musica){
        $vector = array();
        $where = ($id_musica != null ? "where {$id_musica}":"");
        $tdos = $this->conexao->query("select * from `{$this->_faixas}` {$where} ");
        foreach ($tdos as $linha){
            $vector[] = $linha;
        }
        return $vector;
    }
   
}
