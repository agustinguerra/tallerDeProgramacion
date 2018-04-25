<?php

require_once 'datos.php';

$pregunta = $_POST['pregunta'];
$publicacion = $_POST['publicacion'];
$pregunta = $_POST['pregunta'];

$logueado = usuarioLogueado();

if($logueado != null) {
    $usuario = $logueado['id'];
    agregarPregunta($publicacion,$usuario,$pregunta);
    header('location:publicacion.php?id='.$publicacion);
} else {
    header('location:login.php');
}