<div class="wrapper">
    <div id="divContent" style="max-width: 90%;">

        <div class="divTitle">
            <a class="underlineHover" href="javascript:;" onclick="getLoginViewHTML(2, ''); return false;">Volver al Inicio</a>
            <br>
            <h2>Registrarse</h2>
        </div>

        <form>
            
            <label for="personName" class="">Nombre</label>
            <br>
            <input type="text" id="personName" placeholder="Nombre" required>

            <br>
            <label for="personSurnames" class="">Apellidos</label>
            <br>
            <input type="text" id="personSurnames" placeholder="Apellidos" required>

            <br>
            <label for="personSurnames" class="">Correo Electrónico</label>
            <br>
            <input type="text" id="emainAddress" placeholder="Correo" required>

            <br>
            <label for="userName" class="">Nombre de Usuario</label>
            <br>
            <input type="text" id="userName" placeholder="Nombre de Usuario" required>

            <br>
            <label for="userPassword" class="">Contraseña</label>
            <br>
            <input type="password" id="userPassword" placeholder="Contraseña" required>

            <br>
            <div>
                <label for="gender" class="">Genero</label>
                <br>
                <input class="form-check-input" type="radio" name="gender" value="M" checked>
                <label class="form-check-label" for="personGender">
                Masculino
                </label>

                <input class="form-check-input" type="radio" name="gender" value="F">
                <label class="form-check-label" for="personGender">
                Femenino
                </label>

                <input class="form-check-input" type="radio" name="gender" value="N">
                <label class="form-check-label" for="personGender">
                Indefinido
                </label>
            </div>

            <div id="message"></div>

            <input type="button" class="btn mainButton" href="javascript:;" 
            onclick="addClientAjax($('#personName').val(),$('#personSurnames').val(),$('#emainAddress').val(),
            $('#userName').val(),$('#userPassword').val(), getRadioChecked('gender')); return false;" value="Registrar cuenta"/>

        </form>

    </div>
</div>

<div class="verticalMargin"></div>