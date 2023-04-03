<?php

class LoginController {
   
    public function __construct() {
        $this->view=new View();
    }
    
    public function show () {
        $this->view->show("indexView.php", null);
    }

    public function loginAjax() {
 
        require 'model/LoginModel.php';
        $loginModel=new LoginModel();
        $data = $loginModel->login($_POST['userName'], $_POST['userPassword']);

    }

    public function logoutAjax() {
 
        require 'model/LoginModel.php';
        $loginModel=new LoginModel();
        $data = $loginModel->logout();

    }

    public function addClientAjax() {
        require 'model/LoginModel.php';
        $loginModel = new LoginModel();
        $data = $loginModel->addClient($_POST['personName'], $_POST['personSurnames'], $_POST['emainAddress'], $_POST['userName'], $_POST['userPassword'], $_POST['personGender']);
    }
    
    public function getAddClientView() {
        $this->view->show('addClientView.php', null);
    }       

    public function getLoginView() {
        $this->show();
    }  
}

?>
