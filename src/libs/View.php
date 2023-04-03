<?php

class View {
    public function __construct() {;}
    
    public function show($viewName, $vars=array()) {
        require 'libs/Global.PHP';

        $dictionary = PHPDictionary::getInstance();
        $path = $dictionary->get($viewFolderPath).$viewName;
        
        if(is_file($path)==FALSE) {
            trigger_error('Página '.$path.' No existe', E_USER_NOTICE);
            return false;
        }
        
        if(is_array($vars)){
            foreach($vars as $key=>$value){
                $key=$value;
            }
        }
        
        include $path;
        
    }   
}

?>