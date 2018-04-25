<?php

require_once 'datos.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$redirect = $_POST['redirect'];

$logueado = login($usuario, $clave);

if($logueado != null) {
    if($redirect !==null) {
        header('location:publicacion.php?id='.$redirect);
    } else {
        header('location:index.php');
    }
} else {
    session_start();
    $_SESSION['error'] = true;
    header('location:login.php');
}

