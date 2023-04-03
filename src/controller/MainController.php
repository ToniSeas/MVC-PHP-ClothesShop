<?php

class MainController {
   
    public function __construct() {
        $this->view=new View();
    }
    
    public function show () {
        $this->view->show("mainView.php", null);
    }

    public function getProductsView() {

        require 'model/MainModel.php';
        $mainModel=new MainModel();
        $data['products'] = $mainModel->getProducts($_POST['signal'], $_POST['value'], $_POST['order']);
        
        foreach ($data['products'] as $product) {
            $discount = $mainModel->getDiscount($product['product_id']);
            if ($discount != 'F' && $discount != 'N' && $discount != 'D') {
                $data['discountTo'.$product['product_id']] = $discount;
            }   
        }

        $this->view->show('productsView.php', $data);
    }  

    public function addProductCartAjax() {
        require 'model/MainModel.php';
        $mainModel=new MainModel();
        $data = $mainModel->addProductToCart($_POST['userId'], $_POST['productId']);
    }

}

?>
