<script>getAdminsAjax($('#searchBar').val());</script>

<div class="wrapper">
    <div id="divContent" style="max-width: 90%;">

        <div class="divTitle">
            <h2>Eliminar Administrador</h2>
        </div>

        <form>
            
            <div class="">
                <input type="text" id='searchBar' oninput="getAdminsAjax($('#searchBar').val()); return false;" placeholder="Buscar administrador/a...">
            </div>

            <label class="" for="admins">Administradores</label>
            <br>
            <select id="admins" type="text" class=""></select>

            <div id="message"></div>
            <div id="loadingMessage"></div>

            <input type="button" class="btn mainButton" href="javascript:;" 
                onclick="removeAdminAjax($('#admins :selected').text()); return false;" value="Eliminar Administrador"/>

        </form>

    </div>
</div>

<div class="verticalMargin"></div>