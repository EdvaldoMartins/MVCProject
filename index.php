<?php

define('CONTROLLERS', 'app/controllers/');
define('VIEWS', 'app/views/');
define('MODELS', 'app/models/');
define('HELPERS', 'system/helpers/');
define('DOMAIN', 'app/domain/');
define('WEB_FILE', 'web');

require_once './system/model.php';
require_once './system/system.php';
require_once './system/Controller.php';

function __autoload($file) {
    if (file_exists(MODELS . $file . '.php')) {
        require_once (MODELS . $file . '.php');
    } else if (file_exists(HELPERS . $file . '.php')) {
        require_once (HELPERS . $file . '.php');
    } else if (file_exists(DOMAIN . $file . '.php')) {
        require_once (DOMAIN . $file . '.php');
    } else {
        die("Model ou Helper ñ encontrado");
    }
}

$start = new System;
$start->run();

