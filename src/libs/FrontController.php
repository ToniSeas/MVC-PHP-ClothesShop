<?php
 
if(isset($_SESSION['InSession'])) {
}

class FrontController {
    
    public static function main() {

        require 'libs/View.php';
        require 'libs/Configuration.php';
        require 'libs/Global.PHP';
        
        if(!empty($_GET[$controllerGET]) && isset($_SESSION['UserType']))
            $controllerName = $_GET[$controllerGET];
        else
            $controllerName = 'LoginController';

        if(!empty($_GET[$actionGET]))
            $actionName=$_GET[$actionGET];
        else
            $actionName='show';
        
        $pathController=$dictionary->get($controllerFolderPath).$controllerName.'.php';

        if(is_file($pathController))
            require $pathController;
        else 
            die ('Controlador no encontrado - 404 not found');

        if (!method_exists($controllerName, $actionName)) {
            trigger_error($controllerName . '-' . $actionName . ' does not exist', E_USER_NOTICE);
            return;
        }
        
        $controller=new $controllerName();
        $controller->$actionName();       
    }
}

?>
