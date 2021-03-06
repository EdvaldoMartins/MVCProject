<?php

class System {

    private $_url;
    private $_explode;
    public $_controller;
    public $_action;
    public $_params;

    public function __construct() {
        $this->setUrl();
        $this->setExplode();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    private function setUrl() {
        $_GET['url'] = (isset($_GET['url']) ? $_GET['url'] : 'index/index_action');
        $this->_url = $_GET['url'];
    }

    private function setExplode() {
        $this->_explode = explode('/', $this->_url);
    }

    private function setController() {
        $this->_controller = $this->_explode[0];
    }

    private function setAction() {
        if ($this->_explode[1] == null || $this->_explode[1] == "index") {
            $ac = "index_action";
        } else {
            $ac = $this->_explode[1];
        }
        $this->_action = $ac;
    }

    private function setParams() {
        unset($this->_explode[0], $this->_explode[1]);

        if (end($this->_explode) == null)
            array_pop($this->_explode);

        $i = 0;

        if (!empty($this->_explode)) {
            foreach ($this->_explode as $valor) {
                if ($i % 2 == 0) {
                    $ind[] = $valor;
                } else {
                    $value[] = $valor;
                }
                $i++;
            }
        } else {
            $ind = array();
            $value = array();
        }
        // print_r( $value );
        if (count($ind) == count($value) && !empty($ind) && !empty($value)) {
            $this->_params = array_combine($ind, $value);
        } else {
            $this->_params = array();
        }
        //print_r( $this->_params);
    }

    public function getParam($nome = null) {
        if ($nome != null) {
            return $this->_params[$nome];
        } else {
            return $this->_params;
        }
    }

    public function run() {
        $controller_pasta = CONTROLLERS . $this->_controller . 'Controller.php';

        if (!file_exists($controller_pasta)) {
            die(" Controller não existe");
        }
        require_once ($controller_pasta);
        $app = new $this->_controller();

        if (!method_exists($app, $this->_action)) {
            die(" Erro... Esta Action ñ existe");
        }

        $action = $this->_action;
        $app->$action();
    }

}
