<?php
    require_once 'datos.php';

    $accion = $_POST['accion'];

    $resultados = array();

    if($accion === "cargar-razas") {
        $especie = $_POST['especie'];

        $resultados = obtenerRazasParaEspecie($especie);
    }

    if ($accion === "realizar-busqueda") {
        $especie = $_POST['especie'];
        $raza = $_POST['raza'];
        $barrio = $_POST['barrio'];
        $searchText = $_POST['searchText'];
        $estado = $_POST['estado'];

        $publicaciones = obtenerPublicaciones();

        foreach ($publicaciones as $publicacion) {
            if ($barrio != null && $barrio != -1) {
                if ($publicacion['barrio_id'] != $barrio) {
                    continue;
                }
            }
            if ($estado != null && $estado != -1) {
                if ($publicacion['tipo'] != $estado) {
                    continue;
                }
            }
            if ($searchText != null && $searchText != -1) {
                if (strpos($publicacion['descripcion'], $searchText) === false) {
                    continue;
                }
            }
            if ($especie != null && $especie != -1) {
                if ($publicacion['especie_id'] != $especie) {
                    continue;
                }
                if ($raza != null && $raza != -1 && $raza != 'null') {
                    if ($publicacion['raza_id'] != $raza) {
                        continue;
                    }
                }
            }
            $resultados[] = $publicacion;
        }
    }

    if ($accion === "allPublicaciones") {
        $resultados = obtenerPublicaciones();
    }

    echo json_encode($resultados);
?>