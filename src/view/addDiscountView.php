<script>getProductsAjax($('#searchBar').val());</script>

<div class="wrapper">
    <div id="divContent" style="max-width: 90%;">

        <div class="divTitle">
            <h2>Agregar Descuento</h2>
        </div>

        <form>
            <label for="startDate" class="">Fecha de Inicio</label>
            <br>
            <input type="date" id="startDate">

            <br>
            <br>
            <label for="endDate" class="">Fecha de Fin</label>
            <br>
            <input type="date" id="endDate">

            <br>
            <br>
            <label for="discountPercent" class="">Porcentaje del descuento</label>
            <br>
            <input type="number" min="0" max="100" id="discountPercent" placeholder="Descuento">

            <div>
                <br>
                <label class="" for="products">Seleccionar Productos</label>
                <br>
                <input type="text" id='searchBar' oninput="getProductsAjax($('#searchBar').val()); return false;" placeholder="Buscar Producto...">
                <br>
                
                <select id="products" onchange="addProductInTable('tproductBody', $('#products').children(':selected').attr('id'), $('#products').children(':selected').attr('value'))" type="text" class=""></select>

                <div id="loadingMessage"></div>
            </div>

            <table id="productsTable" class="table table-striped table-bordered table-sm" cellspacing="0" style="margin-left: 7.5%; width: 85%;">
                <thead style="background-color: rgba(163, 209, 233, 0.4);">
                    <tr>
                        <th scope="col">Acción</th>
                        <th scope="col">Producto</th>
                    </tr>
                </thead>
                <tbody id="tproductBody"></tbody>
            </table>

            <div id="message"></div>

            <input type="button" class="btn mainButton" href="javascript:;" 
            onclick="addDiscountAjax($('#startDate').val(), $('#endDate').val(), $('#discountPercent').val()); return false;" value="Registrar Descuento"/>

        </form>

    </div>
</div>

<div class="verticalMargin"></div>