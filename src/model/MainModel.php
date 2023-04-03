<?php

class MainModel {
   
    private $db;
    
    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::getInstance();
    }
    
    public function getProducts($signal, $value, $order) {
        $sql = "SELECT name, price, description, image_path, product_id FROM tb_products";
        $orderBy = 'ASC';

        if ($order == 'A') {
            $orderBy = 'ASC';
        } else if ($order == 'D') {
            $orderBy = 'DESC';
        }
  
        if ($signal == 'C') {
            if ($value != '') {
                $sql = "SELECT name, price, description, image_path, product_id, C.category_name FROM tb_products AS P 
                    INNER JOIN tb_category AS C
                        ON C.category_id = P.category_id
                    WHERE C.category_id = $value
                    ORDER BY P.price ".$orderBy.";";
            } else {
                $sql = "SELECT name, price, description, image_path, product_id, C.category_name FROM tb_products AS P 
                    INNER JOIN tb_category AS C
                        ON C.category_id = P.category_id
                    ORDER BY P.price ".$orderBy.";";
            }
            

        } else if ($signal == 'N') {

            $sql = "SELECT name, price, description, image_path, product_id FROM tb_products AS P WHERE name LIKE '%".$value."%' ORDER BY P.price ".$orderBy.";";
            
        }
        
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        return $result;
    }

    public function getDiscount($productId) {
        $sql = "call sp_get_discount('".$productId."');";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $stateResult = $result[0]['query_state'];

        return $stateResult;
    }

    public function addProductToCart($userId, $productId) {
        $sql = "call sp_add_product_cart('".$productId."', '".$userId."');";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $stateResult = $result[0]['query_state'];

        echo $stateResult;
    }

}

?>
