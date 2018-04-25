<?php

require_once 'datos.php';

$respuesta = $_POST['respuesta'];
$publicacion = $_POST['publicacion'];
$pregunta = $_POST['pregunta'];

$logueado = usuarioLogueado();

if($logueado != null) {
    agregarRespuesta($pregunta,$respuesta);
    header('location:publicacion.php?id='.$publicacion);
} else {
    header('location:login.php');
}