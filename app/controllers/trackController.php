<?php

//require_once '../../../AndroidSongPhp/domain/Track.php';
class Track extends Controller {

//    private $_tabela = "track";
//    private $_tabela2 = "artista";

    public function all_tracks($idTrack = null, $totalElements = null, $genero = null) {
        $idTrack = $this->getParam('idTrack');
        $genero = $this->getParam('genero');
        $totalElements = $this->getParam('totalElements');
        /**
         * Lista todas as tracks

          $db = new TrackModel();
          $select = "select * from `{$this->_tabela}`";
          $datas = $db->readTudo(" estado != 'Off' ", null, null, " idTrack desc", $select);
         * 
         */
        $idTrack == null ? 0 : $idTrack;
        $totalElements == null ? 0 : $totalElements;
        $genero == null ? '' : $genero;
        $db = new TrackModel();
        $datas = $db->allTrackList($idTrack, $totalElements, $genero);
        echo json_encode($datas);
    }

    public function creat_track($idArtista = null, $titulo = null, $descrisao = null
    , $genero = null, $ano = null, $capa_url = null, $estado = null
    , $link = null, $uid = null) {
        /**
         * Este metodo é responsavel pela inserção de uma nova track no banco de dados
         */
        $idArtista = $this->getParam('idArtista');
        $titulo = $this->getParam('titulo');
        $capa_url = $this->getParam('capa_url');
        $estado = $this->getParam('estado');
        $link = $this->getParam('link');
        $descrisao = $this->getParam('descrisao');
        $genero = $this->getParam('genero');
        $ano = $this->getParam('ano');
        $uid = $this->getParam('uid');

        $db = new TrackModel();
        $resultado = $db->creatTrack($idArtista, $titulo, $descrisao, $genero, $ano, $capa_url, $estado, $link, $uid);
        echo json_encode($resultado);
    }

    public function get_track($idTrack = null) {
        /**
         * Recebe 2 ids e retorna a musica correspondente a estes ids
         */
        $idTrack = $this->getParam('idTrack');
        $db = new TrackModel();
        $datas = $db->get_track($idTrack);
        echo json_encode($datas);
    }

    public function track_artistas($idTrack = null) {
        /**
         * Recebe um id de uma musica e retorna todos o artistas que são propietarios da mesma
         */
        $idTrack = $this->getParam('idTrack');
        $db = new TrackModel();
        $datas = $db->track_artistas("{$idTrack}");
        echo json_encode($datas);
    }

    public function track_downloads($idTrack = null) {
        /**
         * Recebe um id de uma musica e retorna todos o artistas que são propietarios da mesma
         */
        $idTrack = $this->getParam('idTrack');
        $db = new TrackModel();
        $datas = $db->get_num_downloads("{$idTrack}");
        echo($datas);
    }

    public function track_albuns($idTrack = null) {
        /**
         * Recebe um id de uma musica e retorna todos o albuns em  que ela faz parte 
         */
        $idTrack = $this->getParam('idTrack');
        $db = new TrackModel();
        $datas = $db->track_albuns("{$idTrack}");
        echo json_encode($datas);
    }

    public function get_size_tracks() {
        /**
         * Retorna quantas musicas existem
         */
        $db = new TrackModel();
        $datas = $db->getCountTracks();
        echo json_encode($datas);
    }

    public function get_tracks_baixadas() {
        /**
         * Retorna quantas musicas existem
         */
        $db = new TrackModel();
        $datas = $db->mais_baixadas();
        echo json_encode($datas);
    }

}
