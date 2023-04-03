<!DOCTYPE html>
<html lang="es">
  <head>
		<meta charset="utf-8">
		<title>SistemaGestiónVentasAntonySeasSemestreIAnno2022</title>
		<meta name="description" content="Este es el proyecto 2 de programación 
            de Antony Seas para el curso IF4101 de la UCR; año 2022">
		<meta name="viewport" content="width=device-width,initial-scale=1">
                <link href="public/css/bootstrap.css" rel="stylesheet" type="text/css"/>
                <link href="public/css/style.css" rel="stylesheet" type="text/css"/>
                <script src="public/js/jquery.js" type="text/javascript"></script>                
                <script src="public/js/script.js" type="text/javascript"></script>  
	</head>
	<body>

    <form id="login-content">

      <div class="wrapper" style="margin-top: 15em;">
        <div id="divContent" style="max-width: 90%;">

          <div class="divTitle">
            <h2>Iniciar Sesión</h2>
          </div>

          <input type="text" id="login" name="userName" placeholder="Nombre de Usuario">
          <br>
          <input type="password" id="password" name="userPassword" placeholder="Contraseña">
          <br>
          <input type="button" class="btn mainButton" href="javascript:;" onclick="loginAjax($('#login').val(),$('#password').val()); return false;" value="Iniciar Sesión"/>
          <br>
          <div>
                  <span id="message"></span>
          </div>

          <div id="divFooter">
            <a class="underlineHover" href="javascript:;" onclick="getLoginViewHTML(1, ''); return false;">Crear Nueva Cuenta</a>
          </div>

        </div>
      </div>
    
    </form>

  </body>	
</html>	

