<?php

class CartController {
   
    public function __construct() {
        $this->view=new View();
    }
    
    public function show () {
        $this->getProductsView();
    }

    public function getProductsView() {

        require 'model/CartModel.php';
        $cartModel=new CartModel();
        $data['products'] = $cartModel->getProducts();
        $_SESSION['productsInCart'] = $data['products'];
        $this->view->show('cartView.php', $data);

    }

    public function removeProductAjax() {

        require 'model/CartModel.php';
        $cartModel=new CartModel();
        $data = $cartModel->removeProduct($_SESSION['user_id'], $_POST['productId']);

    }

}

?>
