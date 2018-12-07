<?php

class ArtistaModel extends Model {

//    public $_tabela = "artista";
//    public $_musicas = "track";
//    public $_artista_track = "artista_track";
//    public $_albuns = "album";

    public function get_contacto($idArtista) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            
            $sql = "CALL artistaContactos({$idArtista})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            $d->closeCursor();
            return ($retuns);
        } catch (PDOException $ex) {
            // die("Error " . $ex->getMessage());
            $retuns = array('RESULTADO', 'FALHA');
            return ($retuns);
        } finally {
            $d->closeCursor();
        }
    }

    public function get_musicas($idArtista) {

        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            //$sql = "SELECT allTrackList()";
            $sql = "CALL artistaTracks({$idArtista})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            //die("RESULTADO" . $ex->getMessage());
            $retuns = array('RESULTADO', 'FALHA');
            return ($retuns);
        } finally {
            $d->closeCursor();
        }
    }

    public function get_artista($idUsuario) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL get_artista({$idUsuario});";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        } finally {
            $d->closeCursor();
        }
    }

    public function get_albuns($idArtista = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL artistaAlbuns({$idArtista});";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        } finally {
            $d->closeCursor();
        }
    }

    public function insertTrack($idTrack = null, $idArtista = null, $uid = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL trackInsertOld({$idArtista},{$idTrack},'{$uid}')";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 1, PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns[0]);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        } finally {
            $d->closeCursor();
        }
    }

    public function insertAlbum($idArtista, $idAlbum) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL artistaInsertAlbum({$idArtista},{$idAlbum})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 1, PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns[0]);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        } finally {
            $d->closeCursor();
        }
    }

    public function removeTrack($idArtista = null, $idTrack = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL removeTrack({$idArtista},{$idTrack})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 1, PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            $d->closeCursor();
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        } finally {
            $d->closeCursor();
        }
    }

    public function removeAlbum($idArtista = null, $idAlbum = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL removeAlbum({$idArtista},{$idAlbum})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 1, PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        } finally {
            $d->closeCursor();
        }
    }

    public function allArtistas($idArtista = null, $totalElements = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            //$sql = "SELECT allTrackList()";
            $sql = "CALL allArtistas({$idArtista},{$this->LIMIT})";

            $d = $this->conexao->prepare($sql);
            $d->execute(); 
            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
            $d->closeCursor();
//            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
//            $d = $this->conexao->prepare($sql);
//            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
//            $d->execute();
//            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            // return ($retuns);

            foreach ($retuns as $data) {
                $a = array('artista' => $data);
                $this->arrays [] = ($a);
            }
            $i = 0;
            $rest = $this->count_itens("CALL allArtistas({$i},{$i})") - $totalElements;
            $this->arrays [] = array('isElements' => $rest > 0 ? TRUE : FALSE);
            return ($this->arrays);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        } finally {
            $d->closeCursor();
        }
    }

    public function createArtista($nome, $aka, $uid) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL creatArtista('{$nome}','{$aka}','','ON','','{$uid}')";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 1, PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

}
