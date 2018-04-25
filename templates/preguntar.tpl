<!DOCTYPE html>
<html>
<head>
    <title>Preguntar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/preguntar.css">
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
    <div id="formulario">
        <form method="POST" action="doPreguntar.php">
            <p><label>Pregunta</label><br />
            <input type="text" name="pregunta"/></p>
    
            <input type="hidden" name="publicacion" value="{$publicacion}"/>

            <input type="submit" value="Preguntar"/>
        </form>
    </div>
</body>
</html>