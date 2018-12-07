<?php

class AlbumModel extends Model {

   // public $_tabela = "album";
    //private $_faixas = "track";

    public function allAlbumList($idAlbum,$totalElements) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            //$sql = "SELECT allTrackList()";
            $sql = "CALL allAlbumList({$idAlbum},{$this->LIMIT});";
//            $d = $this->conexao->prepare($sql);
//            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
//            $d->execute();
//            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
//            return ($retuns);
            
            
           
            $d = $this->conexao->prepare($sql);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
            $d->closeCursor();
            foreach ($retuns as $data) {

                $arts = $this->get_artista_in_album($data->idAlbum);
                $tracks = $this->getTracksAlbum($data->idAlbum);
                $a = array('album' => $data
                    , 'numFaixas' => count($tracks)
                    , 'artistas' => $arts);
                $this->arrays [] = ($a);
            }
            $i = 0;
            $rest = $this->count_itens("CALL allAlbumList ({$i},{$i})") - $totalElements;
            $this->arrays [] = array('isElements' => $rest > 0 ? TRUE : FALSE);
            return ($this->arrays);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    public function getAlbum($idAlbum) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL get_album({$idAlbum});";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }
    public function get_artista_in_album($idAlbum) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL get_artista_in_album({$idAlbum});";
            $d = $this->conexao->prepare($sql);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
            $d->closeCursor();
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    public function getTracksAlbum($idAlbum) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL getTracksAlbum({$idAlbum});";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    public function addTrack($idAlbum, $idTrack, $uid) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL albumInsertTrack({$idAlbum},{$idTrack},'{$uid}');";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

}
