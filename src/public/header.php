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
    
        <header>
            <nav class="navbar navbar-fixed-top mainNav" role="navigation">
                <div class="navbarContainer">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand navText" href='?controller=MainController'>Tienda "el Proyecto"</a>
                    </div>
                    <div class="collapse navbar-collapse " id="myNavbar">
                        <ul class="nav navbar-nav navText" id="myNavbar">
                            <li><a class="navText" href='?controller=MainController'>Inicio</a></li>
                            <?php
                                if ($_SESSION['UserType']=='S' || $_SESSION['UserType']=='A') {
                                    echo "<li><a class=\"navText\" href='?controller=AdminController'>Administración</a></li>";
                                }
                            ?>                     
                        </ul>
                        <ul class="nav navbar-nav navbar-right navText" id="myNavbar">

                            <li class="disabled"><a href="#" class="dropdown-toggle navText" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo $_SESSION['ClientName'] ?></a>
                            </li>
                            <li><a class="navText" id="carritoTag" href='?controller=CartController&action=getProductsView'>Ver Carrito</a></li>
                            <li><a class="navText" href="javascript:;" onclick="logoutAjax()">Cerrar Sesión</a></li>
                            

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
           
             