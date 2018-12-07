<?php

class Album extends Controller {

    private $_tabela = "album";
    private $_tabela2 = "artista";
    public function all_albuns($idAlbum = null, $totalElements = null) {

        $idAlbum = $this->getParam('idAlbum');
        $totalElements = $this->getParam('totalElements');
        $db = new AlbumModel();
        $resultados = $db->allAlbumList($idAlbum, $totalElements);
        echo json_encode($resultados);
    }

    public function get_album($idAlbum = null) {
        $idAlbum = $this->getParam('idAlbum');
        $db = new AlbumModel();
        $resultados = $db->getAlbum($idAlbum);
        echo json_encode($resultados);
    }
    public function tracks_album($idAlbum = null) {
        $idAlbum = $this->getParam('idAlbum');
        $db = new AlbumModel();
        $resultados = $db->getTracksAlbum($idAlbum);
        echo json_encode($resultados);
    }
    public function album_add_track($idAlbum = null,$idTrack = null,$uid = null) {
        $idAlbum = $this->getParam('idAlbum');
        $idTrack = $this->getParam('idTrack');
        $uid = $this->getParam('uid');
        
        $idAlbum = $idAlbum = null ? 0 : $idAlbum;
        $idTrack = $idTrack = null ? 0 : $idTrack;
        
        $db = new AlbumModel();
        $resultados = $db->addTrack($idAlbum, $idTrack, $uid);
        echo json_encode($resultados);
    }

}
