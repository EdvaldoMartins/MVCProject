<?php

class Controller extends System {
    protected function view($sms , $vars = null){
        if (is_array($vars) && count ($vars) > 0)
            extract ($vars,EXTR_PREFIX_ALL, 'view');
        
        require_once (VIEWS.$sms.'.phtml');
        exit();
    }
}
