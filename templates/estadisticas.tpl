<!DOCTYPE html>

<html>
<head>
    <title>Estadísticas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estadisticas.css">
</head>
<body>
    <div id="encabezado">
            <h1>Mascotas Perdidas</h1>
            <h2>Portal de busqueda de mascotas</h2>
    </div>
    <div id="menu">
        <ul>
            <li><a href="index.php">Pagina Principal</a></li>
            <li><a href="nuevaPublicacion.php">Registrar Aviso</a></li>
            <li><a href="estadisticas.php">Estadísticas</a></li>
            <li><a href="doLogout.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div id="contenido">
        <h1>Estadísticas</h1>
        <div class="estadisticas">
            <p>Total de publicaciones: <b>{if empty($total)}0{else}{$total}{/if}</b></p>
            <p>Total de publicaciones abiertas: <b>{if empty($totalAbiertos)}0{else}{$totalAbiertos}{/if}</b></p>
            <p>Total de publicaciones cerradas: <b>{if empty($totalCerrados)}0{else}{$totalCerrados}{/if}</b>
                <p>Con éxito: <b>{if empty($totalExitosos)}0{else}{$totalExitosos}{/if}</b></p>
                <p>Sin éxito: <b>{if empty($totalSinExito)}0{else}{$totalSinExito}{/if}</b></p>
            </p>
            {foreach from=$datos item=especie}
                <h2>{$especie.nombre}</h2>
                <p>Publicaciones abiertas: <b>{if empty($especie.abierto)}0{else}{$especie.abierto}{/if}</b></p>
                <p>Publicaciones cerradas: <b>{if empty($especie.cerrado)}0{else}{$especie.cerrado}{/if}</b>
                    <p>Con éxito: <b>{if empty($especie.exitoso)}0{else}{$especie.exitoso}{/if}</b></p>
                    <p>Sin éxito: <b>{if empty($especie.noexitoso)}0{else}{$especie.noexitoso}{/if}</b></p>
                </p>
            {/foreach}
        </div>
    <div>
</body>
</html>