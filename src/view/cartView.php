<?php
    include_once './public/header.php';
?>

<div class="container">
  <table id="cart" class="table table-hover table-condensed">
    <thead>
      <tr>
        <th style="width:50%">Producto</th>
        <th style="width:10%">Precio</th>
        <th style="width:8%">Cantidad</th>
        <th style="width:22%" class="text-center">Subtotal</th>
        <th style="width:10%"></th>
      </tr>
    </thead>
    <tbody>
    
<?php            

    $allTotal = 0;
    foreach ($vars['products'] as $product) {
        $allTotal += $product['total'];
    }

    foreach ($vars['products'] as $product) {
?>
        <tr>
            <td data-th="Product">
            <div class="row">
                <div class="col-sm-2 hidden-xs"><img src="<?php echo $product['image_path']?>" alt="..." class="img-responsive" /></div>
                <div class="col-sm-10">
                <h4 class="nomargin"><?php echo $product['name']; ?></h4>
                </div>
            </div>
            </td>
            <td data-th="Price">₡<?php echo $product['price'];?></td>
            <td data-th="Quantity" style="text-align: center;"><?php echo $product['quantity'];?></td>
            <td data-th="Subtotal" class="text-center">₡<?php echo $product['total'];?></td>
            <td class="actions" data-th="">
            <button class="btn btn-danger btn-sm" onclick="removeProductAjax(<?php echo $product['product_id']?>)">Eliminar</button>
            </td>
        </tr>
        </tbody>

 <?php            
    }
?>

    <tfoot>
      <tr>
        <td><a href='?controller=MainController' class="btn btn-warning" style="background-color: #47ade0;">Continuar comprando...</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>₡<?php echo $allTotal;?></strong></td>
        <td><a href='?controller=PayController' class="btn btn-success btn-block">Pagar<i class="fa fa-angle-right"></i></a></td>
      </tr>
    </tfoot>
  </table>
</div>


<?php
    include_once './public/footer.php';
?>

<div class="verticalMargin"></div>