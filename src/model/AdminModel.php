<?php

class AdminModel {
   
    private $db;
    
    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::getInstance();
    }

    public function addAdmin($personName, $personSurnames, $emainAddress, $userName, $userPassword, $personGender) {

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

            $sql = "call sp_add_admin('".$personName."', '".$personSurnames."','".$emainAddress."', '".$userName."','".$userPassword."', '".$personGender."');";
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $query->closeCursor();

            echo $result[0]['query_state'];
            
        }
    }

    public function removeAdmin($userName) {
        $sql = "call sp_remove_admin('".$userName."');";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        if ($userName != $_SESSION['user_name']) {
            echo $result[0]['query_state'];
        } else {
            echo 2;
        }
        
    }

    public function addCategory($categoryName) {
        $sql = "call sp_add_category('".$categoryName."');";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        echo $result[0]['query_state'];
    }

    public function addDiscount($startDate, $endDate, $discountPercent, $products) {
        $products = json_decode($products);
        if (count($products) == 0) {
            echo '4';
        }else if ($discountPercent == '') {
            echo '1';
        } else if ($startDate == '' || $endDate == '') {
            echo '3';
        } else {
            $sql = "call sp_add_discount('".$startDate."', '".$endDate."','".$discountPercent."');";
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $query->closeCursor();

            if ($result[0]['query_state'] == '0') {
                $sql = "SELECT LAST_INSERT_ID() AS identity;";
                $query = $this->db->prepare($sql);
                $query->execute();
                $result = $query->fetchAll();
                $query->closeCursor();

                $discount_id = $result[0]['identity'];
               
                for ($i = 0; $i < count($products); $i++) {
                    $sql = "call sp_add_discount_to_product('".$discount_id."','".$products[$i]."');";
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll();
                    $query->closeCursor();
            
                    echo $result[0]['query_state'];
                }

            } else {
                echo $result[0]['query_state'];
            }
            
        }
    }

    public function addProduct($name, $price, $description, $imagePath, $categoryId) {
        if ($imagePath == '1') {
            echo '2';
        }else if ($name == '') {
            echo '3';
        } else if ($price == '') {
            echo '4';
        } else if ($description == '') {
            echo '5';
        } else if ($categoryId == 'None') {
            echo '6';
        } else {
            $sql = "call sp_add_product('".$name."', '".$price."','".$description."', '".$imagePath."', '".$categoryId."');";
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $query->closeCursor();

            $stateResult = $result[0]['query_state'];

            echo $stateResult;
        }
    }

    public function uploadProductImage($imgFile, $imgName) {
        $imagesPath = $_SERVER['DOCUMENT_ROOT']."/"."Images";
        if (!file_exists($imagesPath)) {
            mkdir($imagesPath, 0777, true);
        }

        $src = $imgFile['tmp_name'];
        $imagePoints = explode(".", $imgFile['name']);
        $imageExtension = $imagePoints[count($imagePoints)-1];
        $targ = $imagesPath."/".$imgName.".".$imageExtension;
        
        if (move_uploaded_file($src, $targ)) {
            return "/"."Images"."/".$imgName.".".$imageExtension;
        } else {
            return '1';
        }
    }

    public function getAdmins($userName) {
        $sql = "SELECT user_name FROM tb_users WHERE user_name LIKE '%".$userName."%' AND user_type != 'S' AND user_type != 'C' AND is_deleted = B'0';";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        return $result;
    }

    public function getCategories($categoryName) {
        $sql = "SELECT category_id, category_name FROM tb_category WHERE category_name LIKE '%".$categoryName."%';";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        return $result;
    }

    public function getProducts($productName) {
        $sql = "SELECT product_id, name FROM tb_products  WHERE name LIKE '%".$productName."%';";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        return $result;
    }
    
}

?>
