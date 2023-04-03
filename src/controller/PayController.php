<?php

class PayController {
   
    public function __construct() {
        $this->view=new View();
    }
    
    public function show () {
        $this->view->show("payView.php", null);
    }

    public function doPaymentAjax() {
        require 'model/PayModel.php';
        $payModel=new PayModel();
        $data = $payModel->doPayment($_SESSION['productsInCart'], $_SESSION['user_id'], $_POST['cardNumber'], $_POST['cardBrand'], $_POST['cardExp'], $_POST['cardCVV'], $_POST['cardOwner']);
        if ($data == '0') {
            $_SESSION['productsInCart'] = '-1';
        }
    }

}

?>
