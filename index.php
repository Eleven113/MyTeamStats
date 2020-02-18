<?php
session_start();

require('controller/FrontEnd/controller.php');
// require('controller/BackEnd/controller.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'matchs'){
        if ($_SESSION['admin_user'] == TRUE){
            AdminMatchs();
        }
        else {
            PublicMatchs();
        }
    }
}
else {
    $controllerFront = new ControllerFront();
    $controllerFront->PublicAccueil();
}
