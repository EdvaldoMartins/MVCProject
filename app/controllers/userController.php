<?php

//require_once '../../../AndroidSongPhp/domain/Track.php';
class User extends Controller {

//    private $_tabela = "track";
//    private $_tabela2 = "artista";

    public function login($email = null, $password = null) {
        $email = $this->getParam('email');
        $password = $this->getParam('password');
        $db = new UserModel();
        $datas = $db->login($email, $password);
        echo json_encode($datas);
    }

}
