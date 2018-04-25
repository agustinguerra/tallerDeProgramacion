<?php

    require_once 'config/configuracion.php';
    require_once 'datos.php';

    session_start();

    $redirect = $_GET['publicacion'];

    $miSmarty = smarty();
    $miSmarty->assign("error",$_SESSION['error']);
    $miSmarty->assign("redirect",$redirect);
    $miSmarty->display("login.tpl");

    unset($_SESSION['error']);
?>