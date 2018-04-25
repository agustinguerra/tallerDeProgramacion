<?php
    require_once 'config/configuracion.php';
    require_once 'datos.php';

    session_start();

    $usuario = usuarioLogueado()['id'];

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $barrio = $_POST['barrio'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];

    $imgs = $_FILES['img']['tmp_name'];

    if(strlen($titulo) == 0) {
        $_SESSION['failNuevaPublicacion'] = "true";
        $_SESSION['mensajeNuevaPublicacion'] = "Debe ingresar un título";
        header('location:nuevaPublicacion.php');
    } else if(strlen($descripcion) == 0) {
        $_SESSION['failNuevaPublicacion'] = "true";
        $_SESSION['mensajeNuevaPublicacion'] = "Debe ingresar una descripción";
        header('location:nuevaPublicacion.php');
    } else if($latitud == "invalido" || $longitud == "invalido") {
        $_SESSION['failNuevaPublicacion'] = "true";
        $_SESSION['mensajeNuevaPublicacion'] = "Debe seleccionar un punto en el mapa";
        header('location:nuevaPublicacion.php');
    } else if(empty($_FILES['img'])) {
        $_SESSION['failNuevaPublicacion'] = "true";
        $_SESSION['mensajeNuevaPublicacion'] = "Debe subir al menos 1 imágen";
        header('location:nuevaPublicacion.php');
    } else {
        $id = registrarPublicacion($titulo, $descripcion, $tipo, $especie, $raza, $barrio, $usuario, $latitud, $longitud);
        if($id) {
            $folder_path = "./".FOTOS."/".$id;
            mkdir($folder_path, 0777);
            for($i = 0; $i < count($imgs); $i++) {
                $img = $imgs[$i];
                move_uploaded_file($img,$folder_path."/".$i.".png");
            }
            header('location:publicacion.php?id='.$id);
        } else {
            $_SESSION['failNuevaPublicacion'] = "false";
            $_SESSION['mensajeNuevaPublicacion'] = "Error comunicando con la base de datos";
            header('location:nuevaPublicacion.php');
        }
    }