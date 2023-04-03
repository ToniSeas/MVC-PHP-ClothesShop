<div class="row">
    <?php
        if (!isset($vars['products']) || count($vars['products']) == 0) {
    ?>
            <div class="col-md-12" style="text-align:center">
                <span style="color:black; text-transform: uppercase; font-weight: 600;">No hay productos en la tienda...</span>
            </div>

    <?php
        } else {
            
            # "http://indicadoreseconomicos.bccr.fi.cr/indicadoreseconomicos/WebServices/wsIndicadoresEconomicos.asmx";
            # Intenté obtener el valor de dolar, pero no pude. Incluso hasta me subscribí en la página de BCCR.
            $exchangeValue = 685; #  1 Dólar en Colones
            
            foreach ($vars['products'] as $product) {
 
                if (isset($vars['discountTo'.$product['product_id']])) {
                    $discount = ($vars['discountTo'.$product['product_id']]) / 100;
    ?>

                    <div class="col-md-4">
                        <div class="card" id="<?php echo $product['product_id']?>">
                            <img src="<?php echo $product['image_path']; ?>" alt="Sin imagen" style="width:100%; height:20em">
                            <h1 class="cardTitle"><?php echo $product['name']; ?></h1>
                            <p class="price" style="font-size: 1em;">Descuento de: <?php echo $discount*100;?>%</p>
                            <p class="price">
                                <span class="price" style="text-decoration-line: line-through; color:#a62b2b">₡<?php echo $product['price'];?></span>
                                <span class="price">₡<?php echo $product['price'] - ($product['price']*($discount));?></span>
                            </p>
                            <p class="price">
                                <span class="price" style="text-decoration-line: line-through; color:#a62b2b">$<?php echo number_format($product['price']/$exchangeValue, 2);?></span>
                                <span class="price">$<?php echo number_format(($product['price']/$exchangeValue) - (($product['price']*$discount)/$exchangeValue), 2);?></span>
                            </p>
                            <p style="overflow-wrap: break-word; font-weight: 600;"><?php echo $product['description']; ?></p>
                            <p><button type="button" onclick="addProductCartAjax(<?php echo $_SESSION['user_id']?>, <?php echo $product['product_id']?>)">Agregar al carrito</button></p>
                            <p><button type="button" value="F" id="fav<?php echo $product['product_id']?>" onclick="toggleFavProduct('fav<?php echo $product['product_id']?>')">Añadir a favoritos</button></p>
                            <div id="message<?php echo $product['product_id']?>"></div>
                        </div>
                    </div>

    <?php

                } else {

    ?>
                    <div class="col-md-4">
                        <div class="card" id="<?php echo $product['product_id']?>">
                            <img src="<?php echo $product['image_path']; ?>" alt="Sin imagen" style="width:100%; height:20em">
                            <h1 class="cardTitle"><?php echo $product['name']; ?></h1>
                            <p class="price">₡<?php echo $product['price']; ?></p>
                            <p class="price">$<?php echo number_format($product['price']/$exchangeValue, 2); ?></p>
                            <p style="overflow-wrap: break-word; font-weight: 600;"><?php echo $product['description']; ?></p>
                            <p><button type="button" onclick="addProductCartAjax(<?php echo $_SESSION['user_id']?>, <?php echo $product['product_id']?>)">Agregar al carrito</button></p>
                            <p><button type="button" value="F" id="fav<?php echo $product['product_id']?>" onclick="toggleFavProduct('fav<?php echo $product['product_id']?>')">Añadir a favoritos</button></p>
                            <div id="message<?php echo $product['product_id']?>"></div>
                        </div>
                    </div>
    <?php 
                }
            } 
        }
    ?>
</div>