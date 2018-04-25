<?php
    require_once "includes/fpdf/fpdf.php";
    require_once 'config/configuracion.php';
    require_once 'datos.php';

    function imprimirEnPDF($fpdf, $txt) {
        $txt = utf8_decode($txt);
        $fpdf->MultiCell(0,12,$txt,0);
        $fpdf->Ln();
    }

    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    const MAX_WIDTH = 500;
    const MAX_HEIGHT = 800;

    function pixelsToMM($val) {
        return $val * MM_IN_INCH / DPI;
    }
    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);
        $widthScale = MAX_WIDTH / $width;
        $heightScale = MAX_HEIGHT / $height;
        $scale = min($widthScale, $heightScale);
        return array(
            round(pixelsToMM($scale * $width)),
            round(pixelsToMM($scale * $height))
        );
    }
    function centreImage($fpdf, $img) {
        list($width, $height) = resizeToFit($img);
        $fpdf->Image(
            $img, (A4_WIDTH - $width) / 2,
            (A4_HEIGHT - $height) / 2,
            $width,
            $height
        );
    }

    $id = $_GET['id'];

    $pdf = new FPDF();
    $pdf->AddPage();

    $publicacion = obtenerPublicacion($id);

    if(!empty($publicacion)){
        $pdf->SetFont('Arial','B',20);
        $titulo = "Titulo: ".$publicacion['titulo'];
        imprimirEnPDF($pdf, $titulo);

        $pdf->SetFont('Arial','U',14);
        if($publicacion['tipo'] == 'E') {
            $tipo = "Perdido";
        } else {
            $tipo = "Encontrado";
        }
        imprimirEnPDF($pdf, $tipo);

        $pdf->SetFont('Arial','',14);
        if(ord($publicacion['abierto'])) {
            imprimirEnPDF($pdf, "Publicación abierta");
        } else {
            imprimirEnPDF($pdf, "Publicación cerrada");
            if(ord($publicacion['exitoso'])) {
                imprimirEnPDF($pdf, "Mascota reencontrada con su dueño");
            } else {
                imprimirEnPDF($pdf, "Mascota reencontrada no con su dueño");
            }
        }
        
        $especie = obtenerEspecies()[$publicacion['especie_id']]['nombre'];
        $especieTxt = "Especie: ".$especie;
        imprimirEnPDF($pdf, $especieTxt);

        $raza = obtenerRazas()[$publicacion['raza_id']]['nombre'];
        $razaTxt = "Raza: ".$raza;
        imprimirEnPDF($pdf, $razaTxt);

        $descripcion = "Descripcion: " . $publicacion['descripcion'];
        imprimirEnPDF($pdf, $descripcion);

        imprimirEnPDF($pdf, "Preguntas: ");
        $preguntas = buscarPreguntas($id);
        foreach($preguntas as $pregunta) {
            $txt = "Pregunta: " . $pregunta['texto'];
            imprimirEnPDF($pdf, $txt);

            if(strlen($pregunta['respuesta']) > 0) {
                $txt = "Respuesta: " . $pregunta['respuesta'];
            } else {
                $txt = "Sin responder";
            }
            imprimirEnPDF($pdf, $txt);
        }

        $pdf->Cell(90,12,"Fotos:",0);
        $pdf->Ln();

        $fotos = glob("".FOTOS."/".$id."/*");
        if(!empty($fotos)){
            foreach($fotos as $foto) {
                $pdf->AddPage();
                centreImage($pdf, $foto);
            }
        }

        $pdf->Output();
    }
?>