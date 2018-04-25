<?php
require_once 'config/configuracion.php';
require_once 'datos.php';
session_start();

$id = $_GET['id'];

$fotos = glob("".FOTOS."/".$id."/*");

$publicacion = obtenerPublicacion($id);

if(!empty($publicacion)){
    $miSmarty = smarty();
    $miSmarty->assign("titulo",$publicacion['titulo']);
    $miSmarty->assign("descripcion",$publicacion['descripcion']);
    $miSmarty->assign("especie",buscarEspecie($publicacion['especie_id']));
    $miSmarty->assign("raza",buscarRaza($publicacion['raza_id']));
    $miSmarty->assign("barrio",buscarBarrio($publicacion['barrio_id']));
    $miSmarty->assign("id_usuario",$publicacion['usuario_id']);
    $miSmarty->assign("latitud",$publicacion['latitud']);
    $miSmarty->assign("longitud",$publicacion['longitud']);
    $miSmarty->assign("preguntas",buscarPreguntas($id));
    $miSmarty->assign("usuario",usuarioLogueado());
    $miSmarty->assign("fotos",$fotos);
    $miSmarty->assign("publicacion",$id);
    $miSmarty->assign("api",'AIzaSyAOM_nUFT2U6DktanSnXAIc-Uox_U3vZqc');

    $usuario = usuarioLogueado();
    if($usuario['id'] == $publicacion['usuario_id']) {
        $miSmarty->assign("creador",true);
    }

    if($publicacion['tipo'] == 'P') {
        $miSmarty->assign("tipo",'PERDIDA');
    } else {
        $miSmarty->assign("tipo",'ENCONTRADA');
    }

    $miSmarty->assign("abierto",ord($publicacion['abierto']));
    $miSmarty->assign("exitoso",ord($publicacion['exitoso']));
} else{
    die("This never should happen!");
}

$miSmarty -> display("publicacion.tpl");

?>
