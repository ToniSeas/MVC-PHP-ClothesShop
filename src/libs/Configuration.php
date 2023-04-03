<?php
    require 'libs/PHPDictionary.php';
    require 'libs/Global.PHP';

    $dictionary=PHPDictionary::getInstance();
    
    $dictionary->set($controllerFolderPath, 'controller/');
    $dictionary->set($modelFolderPath, 'model/');
    $dictionary->set($viewFolderPath, 'view/');
   
    require 'libs/Global.PHP';
    $dictionary->set($serverIP, 'localhost'); // server ip

    $dictionary->set('dbhost', $dictionary->get($serverIP));
    $dictionary->set('dbname', 'tiendavestir');
    $dictionary->set('dbuser', 'root');
    $dictionary->set('dbpass', '');

?>
