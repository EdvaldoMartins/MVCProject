<?php
define('URL_SONGS','../../web/_musicas/');
//require_once('../../app/domain/Track.php');
//require_once 'DOMAIN/Track.php';
//require_once('domain/Track.php');
//require_once(DOMAIN.'/Track.php');
class TrackModel extends Model {

//    public $_tabela = "track";
//    public $_artista = "artista";
//    public $_artista_track = "artista_track";
//    public $_album_track = "album_track";
//    public $_album = "album";
  
   

    public function track_artistas($idTrack = null) {
        /**
         * Este metodo lista todos os artistas que estao ligados a uma certa musica
         */
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            //$sql = "SELECT allTrackList()";
            $sql = "CALL get_artista_track({$idTrack})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            $d->closeCursor();
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    public function allTrackList($index = null, $totalElements = null,$genero = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $genero = $genero == null ? "" : 
                    $genero == "Todos" ? "" : $genero;
            $sql = "CALL allTrackList ({$index},'{$genero}',{$this->LIMIT})";
            $d = $this->conexao->prepare($sql);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
            $d->closeCursor();
            foreach ($retuns as $data) {

                $arts = $this->track_artistas($data->idTrack);
                $data->download = $this->get_num_downloads($data->idTrack);
                $a = array('track' => $data
                    , 'artistas' => $arts);
                $this->arrays [] = ($a);
            }
            $i = 0;
            $rest = $this->count_itens("CALL allTrackList ({$i},'{$genero}',{$i})") 
            - $totalElements;
            $this->arrays [] = array('isElements' => $rest > 0 ? TRUE : FALSE);
            return ($this->arrays);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    public function get_track($idTrack) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {

            $sql = "CALL get_track({$idTrack})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            $d->closeCursor();
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    public function creatTrack($idArtista = null, $titulo = null, $descrisao = null
    , $genero = null, $ano = null, $capa_url = null, $estado = null
    , $link = null, $uid = null) {

        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            //CALL creatTrack(7,'Rimas de saudades','','Kuduro',2014,'','Livre','','RDS1234567');
            $sql = "CALL creatTrack({$idArtista},'{$titulo}','{$descrisao}'
                ,'{$genero}',{$ano},'{$capa_url}','{$estado}','{$link}','{$uid}')";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            $d->closeCursor();
            return ($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

//    public function getCountTracks($genero = null) {
//        if ($this->conexao == null) {
//            $retuns = array('RESULTADO' => 'Não há conexão.');
//            return ($retuns);
//        }
//        $i = 0;
//        try {
//            $sql = "CALL allTrackList({$i},'{$genero}',{$i})";
//            $d = $this->conexao->prepare($sql);
//            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
//            $d->execute();
//            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
//            $d->closeCursor();
//            return count($retuns);
//        } catch (PDOException $ex) {
//            die("Error " . $ex->getMessage());
//        }
//    }
    
     public function get_num_downloads($idTrack = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }

        try {
            $sql = "CALL get_track_downloads({$idTrack})";
            $d = $this->conexao->prepare($sql);
            $d->bindValue(1, 'CONT', PDO::PARAM_INT);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            $d->closeCursor();
            $flattern = array();
            foreach ($retuns as $key => $value) {
                $new_key = array_keys($value);
                $flattern[] = $value[$new_key[0]];
            }
            return $flattern[0];
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    
     public function mais_baixadas() {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {
            $sql = "CALL get_mais_baixadas_track()";
            $d = $this->conexao->prepare($sql);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
            $d->closeCursor();
            foreach ($retuns as $data) {

                $arts = $this->track_artistas($data->idTrack);
                $data->download = $this->get_num_downloads($data->idTrack);
                $a = array('track' => $data
                    , 'artistas' => $arts);
                $this->tracks [] = ($a);
            }
            
             
            $this->tracks [] = array('isElements' =>FALSE);
            return ($this->tracks);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }
}
