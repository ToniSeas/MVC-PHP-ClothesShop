<?php

class PHPDictionary {
    
    private $vars;
    private static $instance;
    
    private function __construct() {
        $this->vars=array();
    }
    
    /*Generic setter*/
    public function set($varibleName, $value) {
        if(!isset($this->vars[$varibleName])){
            $this->vars[$varibleName]=$value;
        }
    }
    
    /*Generic getter*/
    public function get($varibleName) {
        if(isset($this->vars[$varibleName]))
            return $this->vars[$varibleName];
    }
    
    /*Singleton Pattern get intance*/
    public static function getInstance() {
        if(!isset(self::$instance)){
            $tmpClass = __CLASS__;
            self::$instance = new $tmpClass;
        }
        return self::$instance;
    }

}

?>
