<?php
    require_once 'config/configuracion.php';
    require_once 'datos.php';
    session_start();

    if(usuarioLogueado() === null) {
        header('location:login.php');
    }

    $publicacion = $_GET['publicacion'];

    $miSmarty = smarty();
    $miSmarty->assign("publicacion",$publicacion);
    $miSmarty->display("preguntar.tpl");
?>