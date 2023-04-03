<?php

class SPDO {
    
    private static $instance=null;
    private $db;
    
    public function __construct() {
        $dictionary = PHPDictionary::getInstance();
        
        // Connection to the database
        $hostName = 'localhost';
        $dbName = 'tiendavestirdb';
        $userName = 'root_tienda';
        $userPassword = 'LPlma0MoqlwLv{p0';
        $this->db = new PDO ('mysql:host='.$hostName.';dbname='.$dbName,$userName, $userPassword);
    }
    
    /*Singleton Pattern get intance*/
    public static function getInstance() {
        if(self::$instance==null) {
            self::$instance=new self();
        }
        return self::$instance;
    }

    public function changeConection($hostName, $dbName, $userName, $userPassword) {
        $this->db = new PDO ('mysql:host='.$hostName.';dbname='.$dbName, $userName, $userPassword);
    }

    public function prepare ($sql) {
        return $this->db->prepare($sql);
    }
        
}

?>