<script>getCategoriesAjax($('#searchBar').val());</script>

<div class="wrapper">
    <div id="divContent" style="max-width: 90%;">

        <div class="divTitle">
            <h2>Agregar Producto</h2>
        </div>

        <form>
            
            <label for="name" class="">Nombre del Producto</label>
            <br>
            <input type="text" id="name" placeholder="Nombre" required>

            <br>
            <label for="price" class="">Precio del Producto</label>
            <br>
            <input type="number" id="price" placeholder="Precio" required>

            <br>
            <label for="description" class="">Descripción del Producto</label>
            <br>
            <input type="text" id="description" placeholder="Descripción" required>

            <div>
                <br>
                <label class="" for="categories">Categoría</label>
                <br>
                <input type="text" id='searchBar' oninput="getCategoriesAjax($('#searchBar').val()); return false;" placeholder="Buscar categoría...">
                <br>
                
                <select id="categories" type="text" class=""></select>

                <div id="loadingMessage"></div>
            </div>



            <div class="container-fluid">

            <br>
                <label class="" for="">Imagen del producto</label>

                <div class="box">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <span class="control-fileupload">
                                <label for="fileInput" class="text-left">Seleccionar una imagen.</label>
                                <input type="file" id="fileInput" accept=".png, .jpg, .jpeg" onchange="$('#imageName').html($('#fileInput').val()); previewImg('frame');">
                            </span>
                            <span class="control-fileupload" id="imageName"></span>
                            <br>
                            <br>
                            <img id="frame" name="frame" src="" class="rounded mx-auto d-block" style="max-height: 20em; max-width: 20em"/>
                            <br>
                            <br>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
            </div>

            <div id="message"></div>

            <input type="button" class="btn mainButton" href="javascript:;" 
            onclick="addProductAjax($('#name').val(),$('#price').val(),$('#description').val(),
            $(categories).children(':selected').attr('id')); return false;" value="Registrar Producto"/>

        </form>
        
    </div>
</div>

<div class="verticalMargin"></div>