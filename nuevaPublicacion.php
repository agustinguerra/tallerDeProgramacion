<?php

    require_once 'config/configuracion.php';
    require_once 'datos.php';
    session_start();

    $miSmarty = smarty();
    $miSmarty->assign("api",'AIzaSyDeUpliKisD3vMZ0YqP4cldnwILflCRqy4');
    $miSmarty->assign("especies",obtenerEspecies());
    $miSmarty->assign("barrios",obtenerBarrios());
    $miSmarty->assign("fail",$_SESSION['failNuevaPublicacion']);
    $miSmarty->assign("mensaje",$_SESSION['mensajeNuevaPublicacion']);
    $miSmarty->display("nuevaPublicacion.tpl");

    unset($_SESSION['failNuevaPublicacion']);
    unset($_SESSION['mensajeNuevaPublicacion']);
?>
