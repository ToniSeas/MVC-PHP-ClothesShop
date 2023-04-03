<div class="wrapper">
    <div id="divContent" style="max-width: 90%;">

        <div class="divTitle">
            <h2>Agregar Categoría</h2>
        </div>

        <form>
            
            <label for="categorýName" class="">Nombre de la categoría</label>
            <br>
            <input type="text" id="categorýName" placeholder="Nombre" required>

            <div id="message"></div>

            <input type="button" class="btn btn-primary mainButton" href="javascript:;" 
            onclick="addCategoryAjax($('#categorýName').val()); return false;" value="Registrar Categoría"/>

        </form>

    </div>
</div>
<div class="verticalMargin"></div>