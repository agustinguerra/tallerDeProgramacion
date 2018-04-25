<?php
    session_start();
    require_once 'config/configuracion.php';
    require_once 'datos.php';
    
    $usuario = usuarioLogueado();

    if($usuario != null) {
        header('location:index.php');
    } else {
        $miSmarty = smarty();
        $miSmarty ->assign("mensajeRegistro",$_SESSION['mensajeRegistro']);
        $miSmarty ->display("register.tpl");
        unset($_SESSION['mensajeRegistro']);
    }
?>