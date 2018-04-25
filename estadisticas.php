<?php 
    require_once 'config/configuracion.php';
    require_once 'datos.php';

    $usuario = usuarioLogueado();

    if($usuario != null) {
        $especies = obtenerEspecies();
        $allPublications = obtenerTodasLasPublicaciones();

        $total = count($allPublications);
        $totalExitosos = 0;
        $totalSinExito = 0;
        $totalAbiertos = 0;
        $totalCerrados = 0;
        $datos = array();
        foreach ($especies as $especie) {
            $datos[$especie['id']]['nombre'] = $especie['nombre'];
        }
        foreach ($allPublications as $publicacion) {
            $especie = $publicacion['especie_id'];
            if(ord($publicacion['abierto'])) {
                $estado = 'abierto';
                $totalAbiertos++;
            } else {
                $estado = 'cerrado';
                $totalCerrados++;
                if(ord($publicacion['exitoso'])) {
                    $totalExitosos++;
                    $datos[$especie]['exitoso']++;
                } else {
                    $totalSinExito++;
                    $datos[$especie]['noexitoso']++;
                }
            }

            $datos[$especie][$estado]++;
        }

        $miSmarty = smarty();
        $miSmarty->assign("total",$total);
        $miSmarty->assign("totalExitosos",$totalExitosos);
        $miSmarty->assign("totalSinExito",$totalSinExito);
        $miSmarty->assign("totalAbiertos",$totalAbiertos);
        $miSmarty->assign("totalCerrados",$totalCerrados);
        $miSmarty->assign("datos",$datos);
        $miSmarty->assign("prueba",0);

        $miSmarty -> display("estadisticas.tpl");
    } else {
        header('location:login.php');
    }