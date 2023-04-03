<?php

class PayModel {
   
    private $db;
    
    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::getInstance();
    }
    
    public function getProducts() {
        $sql = "SELECT SC.user_id, SC.product_id, P.name, P.price, COUNT(SC.product_id) as quantity, SUM(P.price) AS total FROM tb_shopping_cart AS SC
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
                $result[$i]['total'] = $result[$i]['total'] * ($discount/100);
                $result[$i]['price'] = $result[$i]['price'] * ($discount/100);
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

    #(INT, IN param_card_number VARCHAR(200), IN param_card_brand VARCHAR(200), IN param_card_owner VARCHAR(500),
    #IN param_card_exp VARCHAR(100), IN param_card_cvv VARCHAR(50),
    #IN param_product_id INT, IN quantity INT) 
    public function doPayment($products, $userId, $cardNumber, $cardBrand, $cardExp, $cardCVV, $cardOwner) {

        if ($products != '-1') {
            if (count($products) == 0) {
                echo 2;
            } else {
                $saleId = -1;

                for ($i = 0; $i < count($products); $i++) {
                    $sql = "call sp_add_sale('".$saleId."', '".$userId."', '".$cardNumber."', '".$cardBrand."', 
                                '".$cardOwner."', '".$cardExp."', '".$cardCVV."', '".$products[$i]['product_id']."', '".$products[$i]['quantity']."');";
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll();
                    $query->closeCursor();

                    $stateResult = $result[0]['query_state'];
                    if ($stateResult != '2') {
                        $saleId = $result[0]['sale_id'];
                    }
                }

                $sql = "call sp_empty_cart('".$userId."');";
                $query = $this->db->prepare($sql);
                $query->execute();
                $result = $query->fetchAll();
                $query->closeCursor();

                $stateResult = '0';
                echo $stateResult;
                return $stateResult;
            }
        } else {
            echo 1;
        }
        
    }

}

?>
