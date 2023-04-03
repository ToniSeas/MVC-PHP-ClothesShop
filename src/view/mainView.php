<?php
    include_once './public/header.php';
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center;">
        <input type="button" id="orderProductButton" class="btn mainButton" onclick="toggleProductsOrder()" value="Orden ascendente por precio">
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center;">
        <input type="button" id="searchProductButton" class="btn mainButton" onclick="searchProductBy(1)" value="Buscar por categoría">
        <input type="button" id="searchProductButton" class="btn mainButton" onclick="searchProductBy(2)" value="Buscar por nombre">
        <div id=searchProductContainer></div>
    </div>
    <div class="col-md-4"></div>
</div>
<br>
<br>
<br>
<br>
<div class="container mt-5" id="productsContainer"><script>getProductsViewHTML('N', '', 'A')</script></div>

<?php
    include_once './public/footer.php';
?>

<div class="verticalMargin"></div>