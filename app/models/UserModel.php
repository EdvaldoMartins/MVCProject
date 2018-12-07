<?php

class UserModel extends Model {

    private $bool = TRUE;

    public function login($email = null, $password = null) {
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try {

            $sql = "CALL getUser('{$email}','{$password}')";
            $d = $this->conexao->prepare($sql);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
            $d->closeCursor();
            $this->bool = $this->check($retuns);
            if ($this->bool) {
                foreach ($retuns as $data) {
                    //$this->arrays [] = array('isLogin' => $this->bool);
                    if ($data->type_user == "Musico") {
                        $artista = $this->get_user_artista($data->idUsuario);
                        // echo ''.$this->getIdArtista($artista);
                        // $contactos = $this->get_user_contactos(0);

                        $this->arrays = array();
                        if (count($artista) > 0) {
                            $this->arrays [] = array('isLogin' => TRUE);
                            $this->arrays [] = array('usuario-type' => 'usuario-musico');
                            $this->arrays [] = array('usuario' => $data);
                            // $this->arrays [] = array('artista_user' => $artista);
                            // $this->arrays [] = array('contactos' => $contactos);
                        } else {
                            $this->arrays [] = array('isLogin' => FALSE);
                        }
                    } else {
                        $this->arrays = array();
                        $this->arrays [] = array('isLogin' => TRUE);
                        $this->arrays [] = array('usuario-type' => 'usuario-ouvinte');
                        $this->arrays [] = array('usuario' => $data);
                    }
                }
            } else {
                $this->arrays [] = array('isLogin' => $this->bool);
                $this->arrays [] = array('usuario-type' => 'usuario-ouvinte');
            }
            return ($this->arrays);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }

    private function getIdArtista($retuns) {
        //print_r($retuns);
        foreach ($retuns as $data) {
            return $data->idArtista;
        }
    }

    public function get_user_artista($idUsuario) {
//        if ($this->conexao == null) {
//            $retuns = array('RESULTADO' => 'Não há conexão.');
//            return ($retuns);
//        }
//        try {
//            $sql = "CALL getUserArtista({$idUsuario},'Musico')";
//            $d = $this->conexao->prepare($sql);
//            $d->execute();
//            $retuns = $d->fetchAll(PDO::FETCH_OBJ);
//            $d->closeCursor();
//            return ($retuns);
//        } catch (PDOException $ex) {
//            die("Error " . $ex->getMessage());
//        }
        $db = new ArtistaModel();
        $resultado = $db->get_artista($idUsuario);
        return $resultado;
    }

    private function get_user_contactos($idArtista) {
        $db = new ArtistaModel();
        $resultado = $db->get_contacto($idArtista);
        return $resultado;
    }

    private function check($retuns) {
        try {
            foreach ($retuns as $data) {
                $value = $data;
                //echo '' . key_exists('RESULTADO', $retuns);
                return $value;
            }
        } catch (Exception $e) {
            return TRUE;
        }
    }

}
