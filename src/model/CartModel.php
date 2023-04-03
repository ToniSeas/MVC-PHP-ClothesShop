<?php

class CartModel {
   
    private $db;
    
    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::getInstance();
    }
    
    public function getProducts() {
        $sql = "SELECT SC.user_id, SC.product_id, P.name, P.image_path, P.price, COUNT(SC.product_id) as quantity, SUM(P.price) AS total FROM tb_shopping_cart AS SC
                    INNER JOIN tb_products AS P
                        ON P.product_id = SC.product_id
                GROUP BY product_id, user_id
                HAVING user_id = ".$_SESSION['user_id'].";";        
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        for ($i = 0; $i < count($result); $i++) {
            $discount = $this->getDiscount($result[$i]['product_id']);
            if ($discount != 'F' && $discount != 'N' && $discount != 'D') {
                $result[$i]['total'] = $result[$i]['total'] - ($result[$i]['total'] * ($discount/100));
                $result[$i]['price'] = $result[$i]['price'] - ($result[$i]['price'] * ($discount/100));
            }
        }
        
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

    public function removeProduct($userId, $productId) {
        $sql = "call sp_remove_product_cart('".$userId."', '".$productId."');";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $stateResult = 0;
        echo $stateResult;
    }

}

?>
