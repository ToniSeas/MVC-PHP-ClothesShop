<?php

class LoginModel {
   
    private $db;
    
    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::getInstance();
    }
    
    public function login($userName, $userPassword) {
        $sql = "call sp_exists_user('".$userName."', '".$userPassword."');";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $isUserName = $result[0]['is_user_name'];
        $isPassword = $result[0]['is_password'];
        $userType = $result[0]['user_type'];     

        if ($isUserName == 'Yes' && $isPassword == 'Yes') {
            echo '1';
            $_SESSION['UserType']=$userType;

            $sql = "SELECT CONCAT (person_name, ' ', person_surnames) AS clientName, user_id, user_name FROM tb_users WHERE user_name LIKE '".$userName."';";
            #echo $sql;
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $query->closeCursor();
            
            $_SESSION['ClientName'] = $result[0]['clientName'];
            $_SESSION['user_id'] = $result[0]['user_id'];
            $_SESSION['user_name'] = $result[0]['user_name'];
            $_SESSION['IsLogin'] = 'Yes';
        } else if ($isUserName == 'Yes' && $isPassword == 'No') {
            echo '2';
        } else {
            echo '3';
        }

        if ($userType == 'S' || $userType == 'A') {

        } else {

        }
    }

    public function logout() {
        #Global user variables
        unset($_SESSION['UserType']);
        unset($_SESSION['user_id']);
        unset($_SESSION['productsInCart']);
        unset($_SESSION['user_name']);
        $_SESSION['ClientName'] = 'Sin iniciar Sesión';
        $_SESSION['IsLogin'] = 'No';

        echo 'Logout Successfull';
    }

    public function addClient($personName, $personSurnames, $emainAddress, $userName, $userPassword, $personGender) {

        if ($personName == '') {
            echo '4';
        } else if ($personSurnames == '') {
            echo '5';
        }  else if ($emainAddress == '') {
            echo '6';
        }  else if ($userName == '') {
            echo '7';
        }  else if ($userPassword == '') {
            echo '8';
        } else if ($personGender == '') {
            echo '9';
        } else {

            $sql = "call sp_add_client('".$personName."', '".$personSurnames."','".$emainAddress."', '".$userName."','".$userPassword."', '".$personGender."');";
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $query->closeCursor();

            echo $result[0]['query_state'];
            
        }
    }
    
}

?>
