<?php
    session_start();
    $_SESSION['InSession'] = 'Yes';

    require 'libs/FrontController.php';
    FrontController::main();
?>
	