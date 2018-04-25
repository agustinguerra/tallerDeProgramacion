<?php

require_once 'datos.php';

$publicacion = $_POST['publicacion'];
$exitoso = $_POST['exito'];

$logueado = usuarioLogueado();

if($logueado != null) {
    cerrarPublicacion($publicacion,$exitoso);
    header('location:publicacion.php?id='.$publicacion);
} else {
    header('location:login.php');
}