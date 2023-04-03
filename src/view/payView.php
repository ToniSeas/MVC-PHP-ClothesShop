<?php
    include_once './public/header.php';
?>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #abe1f5;">
                    <div class="row">

                      <div class="col-xs-12">
                        <h3 class="text-center">Detalles del pago</h3>
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-xs-12">
                        <div class="inlineimage"> 
                          <img class="img-responsive images" src="public\img\credomaticlogo.png"> 
                          <img class="img-responsive images" src="public\img\mastercardlogo.webp"> 
                          <img class="img-responsive images" src="public\img\paypallogo.webp"> 
                          <img class="img-responsive images" src="public\img\visalogo.png"> 
                        </div>
                      </div>

                    </div>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group"> 
                                  <label>Número de tarjeta</label>
                                  <div class="input-group"> 
                                    <input type="tel" id="cardNumber" class="form-control" placeholder="Número de tarjeta" /> 
                                    <span class="input-group-addon"></span> 
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group"> 
                                  <label><span class="">Fecha de expiración</span>
                                  <input type="tel" id="cardExp" class="form-control" placeholder="MM / YY" /> 
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group"> 
                                  <label>CVV</label> 
                                  <input type="tel" id="cardCVV" class="form-control" placeholder="CVV" /> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group"> 
                                  <label>Nombre del dueño</label> 
                                  <input type="tel" id="cardOwner" class="form-control" placeholder="Nombre del dueño de la tarjerta" /> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer" style="background-color: #abe1f5;">
                    <div class="row">
                        <div class="col-xs-12"> 
                          <button style="background-color: #47ade0;" class="btn btn-success btn-lg btn-block" 
                            onclick="doPaymentAjax($('#cardNumber').val(), $('#cardBrand').val(), $('#cardExp').val(), $('#cardCVV').val(), $('#cardOwner').val())">Realizar pago
                          </button> 
                        </div>
                    </div>
                </div>
                <div id="message"></div>
            </div>
        </div>
    </div>
</div>



<?php
    include_once './public/footer.php';
?>

<div class="verticalMargin"></div>