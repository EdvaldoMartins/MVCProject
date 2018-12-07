<?php

class Artista extends Controller {

    
    public function all_artistas($idArtista = null, $totalElements = null) {
         $idArtista = $this->getParam('idArtista');
        $totalElements= $this->getParam('totalElements');
        $db = new ArtistaModel();
        $datas = $db->allArtistas($idArtista,$totalElements);
        echo json_encode($datas);
    }

    public function get_artista($idUsuario =  null) {
        $idArtista = $this->getParam('idUsuario');
        $db = new ArtistaModel();
        $datas = $db->get_artista($idArtista);
        echo json_encode($datas);
    }

    public function tracks($idArtista = null) {
        
            $idArtista = $this->getParam('idArtista');
            $db = new ArtistaModel();
            $resultado = $db->get_musicas($idArtista);
            echo json_encode($resultado);
        
    }

    public function albuns($idArtista = null) {
        $idArtista = $this->getParam('idArtista');
        $db = new ArtistaModel();
        $resultado = $db->get_albuns($idArtista);
        echo json_encode($resultado);
    }

    public function contacto($idArtista = null) {
        $idArtista = $this->getParam('idArtista');
        $db = new ArtistaModel();
        $resultado = $db->get_contacto($idArtista);
        echo json_encode($resultado);
    }

    public function insertTrack($idTrack = null, $idArtista = null, $uid = null) {
        $idArtista = $this->getParam('idArtista');
        $idTrack = $this->getParam('idTrack');
        $uid = $this->getParam('uid');
        $db = new ArtistaModel();
        $resultado = $db->insertTrack($idTrack, $idArtista, $uid);
        echo json_encode($resultado);
    }
    public function insertAlbum($idArtista = null,$idAlbum = null) {
        $idArtista = $this->getParam('idArtista');
        $idAlbum = $this->getParam('idAlbum');
        $db = new ArtistaModel();
        $resultado = $db->insertAlbum($idArtista, $idAlbum);
        echo json_encode($resultado);
    }

    public function removeTrack($idArtista = null, $idTrack = null) {
        $idArtista = $this->getParam('idArtista');
        $idTrack = $this->getParam('idTrack');

        $db = new ArtistaModel();
        $resultado = $db->removeTrack($idArtista, $idTrack);
        echo json_encode($resultado);
    }

    public function removeAlbum($idArtista = null, $idAlbum = null) {
        $idArtista = $this->getParam('idArtista');
        $idAlbum = $this->getParam('idAlbum');

        $db = new ArtistaModel();
        $resultado = $db->removeAlbum($idArtista, $idAlbum);
        echo json_encode($resultado);
    }

    public function create_artista($nome = null ,$aka = null ,$uid = null){
        $nome = $this->getParam('nome');
        $aka = $this->getParam('aka');
        $uid = $this->getParam('uid');

      $db = new ArtistaModel();
      $resultado = $db->createArtista($nome, $aka, $uid);
      echo json_encode($resultado);
      // print_r($nome);
      // print_r($aka);
      // print_r($uid);
    }
}
