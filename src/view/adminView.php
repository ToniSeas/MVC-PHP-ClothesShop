<?php
    include_once './public/header.php';
?>

<div class="btn-group" id="adminAction">
    <input type="button" id="adminButton" class="btn mainButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="Administrar">
    <div class="dropdown-menu">
        <a class="navText" href="javascript:;" onclick="getAdminViewHTML(5, ''); return false;"><i class="fa fa-plus-square"></i> Agregar Producto</a>
        <a class="navText" href="javascript:;" onclick="getAdminViewHTML(3, ''); return false;"><i class="fa fa-minus-square"></i> Agregar Categoría</a>
        <a class="navText" href="javascript:;" onclick="getAdminViewHTML(4, ''); return false;"><i class="fa fa-minus-square"></i> Agregar Descuento</a>
        <?php
            if ($_SESSION['UserType'] == 'S') {
                echo "<a class=\"navText\" href='javascript:;' onclick='getAdminViewHTML(1, \"\"); return false;'><i class='fa fa-plus-square navText'></i> Agregar Administrador</a>";
                echo "<a class=\"navText\" href='javascript:;' onclick='getAdminViewHTML(2, \"\"); return false;'><i class='fa fa-minus-square navText'></i> Eliminar Administrador</a>";
            }
        ?>
    </div>
</div>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <form id="admin-content">
            <div class="wrapper">
                <div id="divContent" style="max-width: 90%; margin-top: 5em;">

                    <div class="divTitle">
                        <h2>Modo administrador: En esta sección se puede gestionar el sitio.</h2>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <script src="public/js/bootstrap.js" type="text/javascript"></script>
</body>