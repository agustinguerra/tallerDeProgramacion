<?php
require_once 'config/configuracion.php';
require_once 'datos.php';
session_start();

$miSmarty = smarty();
$miSmarty->assign("barrios",obtenerBarrios());
$miSmarty->assign("especies",obtenerEspecies());
$miSmarty->assign("pagProx",0);
$miSmarty->assign("pagina",0);
$miSmarty->assign("pagUlt",0);
$miSmarty->assign("carpetaFotos",FOTOS);
$miSmarty->assign("usuario",usuarioLogueado());

$miSmarty -> display("index.tpl");

?>
