<?php

class AdminController {
   
    public function __construct() {
        $this->view=new View();
    }
    
    public function show () {
        $this->view->show("adminView.php", null);
    }

    public function addAdminAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data = $adminModel->addAdmin($_POST['personName'], $_POST['personSurnames'], $_POST['emainAddress'], $_POST['userName'], $_POST['userPassword'], $_POST['personGender']);
    }

    public function removeAdminAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data = $adminModel->removeAdmin($_POST['userName']);
    }

    public function getAdminsAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data['admins'] = $adminModel->getAdmins($_POST['userName']);
        foreach ($data['admins'] as $userName) {
            echo "<option>".$userName[0]."</option>";
        }
    }

    public function getCategoriesAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data['categories'] = $adminModel->getCategories($_POST['categoryName']);
        echo "<option id='None'> </option>";
        foreach ($data['categories'] as $category) {
            echo "<option id='".$category['category_id']."'>".$category['category_name']."</option>";
        }
    }

    public function getProductsAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data['products'] = $adminModel->getProducts($_POST['productName']);
        echo "<option id='None'> </option>";
        foreach ($data['products'] as $product) {
            echo "<option id='".$product['product_id']."' value='".$product['name']."'>".$product['name']."</option>";
        }
    }

    public function addCategoryAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data = $adminModel->addCategory($_POST['categoryName']);
    }

    public function addDiscountAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data = $adminModel->addDiscount($_POST['startDate'], $_POST['endDate'], $_POST['discountPercent'], $_POST['products']);
    }

    public function addProductAjax() {
        require 'model/AdminModel.php';
        $adminModel=new AdminModel();
        $data = $adminModel->addProduct($_POST['name'], $_POST['price'], $_POST['description'], $adminModel->uploadProductImage($_FILES['imgFile'], $_POST['name'].$_POST['price']), $_POST['categoryId']);
    }

    public function getAddAdminView(){
        $this->view->show('addAdminView.php', null);
    }

    public function getAddCategoryView() {
        $this->view->show('addCategoryView.php', null);
    }

    public function getAddDiscountView() {
        $this->view->show('addDiscountView.php', null);
    }

    public function getAddProductView() {
        $this->view->show('addProductView.php', null);
    }

    public function getRemoveAdminView(){
        $this->view->show('removeAdminView.php', null);
    }

}

?>
