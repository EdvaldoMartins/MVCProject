<?php

//require_once './app/domain/util/Obj.php';
//require_once(DOMAIN.'/util/Obj.php');
class Track2 extends Obj {

    //put your code here

    const TOTAL_TRACK = 6;

    private $idTrack;
    private $titulo;
    private $descrisao;
    private $genero;
    private $ano;
    private $capa_url;
    private $estado;
    private $link;
    private $uid;
    private $data_postagem;
    private $download;
    private $albumCollection;
    private $destaqueCollection;
    private $artistaCollection;

//    public Track(Integer idTrack, String titulo, String descrisao, String genero, int ano, String capa_url, String link, String uid, Integer download) {
//        this.idTrack = idTrack;
//        this.titulo = titulo;
//        this.descrisao = descrisao;
//        this.genero = genero;
//        this.ano = ano;
//        this.capa_url = capa_url;
//        this.link = link;
//        this.uid = uid;
//        this.download = download;
//    }
    function __construct($idTrack, $titulo, $descrisao, $genero, $ano, $capa_url, $link, $uid, $download) {
        $this->idTrack = $idTrack;
        $this->titulo = $titulo;
        $this->descrisao = $descrisao;
        $this->genero = $genero;
        $this->ano = $ano;
        $this->capa_url = $capa_url;
        //$this->estado = $estado;
        $this->link = $link;
        $this->uid = $uid;
       // $this->data_postagem = $data_postagem;
        $this->download = $download;
    }

    function __destruct() {
        
    }

    function getIdTrack() {
        return $this->idTrack;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescrisao() {
        return $this->descrisao;
    }

    function getGenero() {
        return $this->genero;
    }

    function getAno() {
        return $this->ano;
    }

    function getCapa_url() {
        return $this->capa_url;
    }

    function getEstado() {
        return $this->estado;
    }

    function getLink() {
        return $this->link;
    }

    function getUid() {
        return $this->uid;
    }

//    function getData_postagem() {
//        return $this->data_postagem;
//    }

    function getDownload() {
        return $this->download;
    }

    function getAlbumCollection() {
        return $this->albumCollection;
    }

    function getDestaqueCollection() {
        return $this->destaqueCollection;
    }

    function getArtistaCollection() {
        return $this->artistaCollection;
    }

    function setIdTrack($idTrack) {
        $this->idTrack = $idTrack;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescrisao($descrisao) {
        $this->descrisao = $descrisao;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

    function setCapa_url($capa_url) {
        $this->capa_url = $capa_url;
    }

//    function setEstado($estado) {
//        $this->estado = $estado;
//    }

    function setLink($link) {
        $this->link = $link;
    }

    function setUid($uid) {
        $this->uid = $uid;
    }

//    function setData_postagem($data_postagem) {
//        $this->data_postagem = $data_postagem;
//    }

    function setDownload($download) {
        $this->download = $download;
    }

    function setAlbumCollection($albumCollection) {
        $this->albumCollection = $albumCollection;
    }

    function setDestaqueCollection($destaqueCollection) {
        $this->destaqueCollection = $destaqueCollection;
    }

    function setArtistaCollection($artistaCollection) {
        $this->artistaCollection = $artistaCollection;
    }

    public function getDataJSON() {
        $aux = array(
            'idATrack' => $this->getIdTrack(),
            'titulo' => $this->getTitulo(),
            'descrisao' => $this->getDescrisao(),
            'genero' => $this->getGenero(),
            'ano' => $this->getAno(),
            'capa_url' => $this->getCapa_url(),
           // 'estado' => $this->getEstado(),
            'link' => $this->getLink(),
            'uid' => $this->getUid(),
            //'data_postagem' => $this->getData_postagem(),
            'download' => $this->getDownload(),
            //'albumCollection' => $this->getAlbumCollection(),
            //'destaqueCollection' => $this->getDestaqueCollection(),
            //'artistaCollection' => $this->getArtistaCollection()
            );
          $aux = $this->setArrayToUtf8($aux);

        return ($aux);
    }

}
