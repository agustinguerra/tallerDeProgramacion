<!DOCTYPE html>
<html>
    <head>
        <title>Nueva Publicación</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/nuevaPublicacion.js"></script>
        <link rel="stylesheet" type="text/css" href="css/nuevaPublicacion.css">
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
            {if {$fail} == "true"}
            <p class="error"><center>{$mensaje}</center></p>
            {/if}
            <form class="" action="doNuevaPublicacion.php" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <label><b>Titulo</b></label>
                    <input type="text" placeholder="Ingrese un título" name="titulo" required>
                    <br />

                    <label><b>Descripcion</b></label>
                    <input type="textarea" placeholder="Ingrese una descripcion" name="descripcion" required>
                    <br />

                    <label><b>Tipo</b></label><br>
                    <input type="radio" name="tipo" value="E" checked> Encontrado<br>
                    <input type="radio" name="tipo" value="P"> Perdido<br>
                    <br />

                    <label><b>Especie</b></label>
                    <select name="especie" id="especie" class="especie">
                    {foreach from=$especies item=especie}
                        <option value="{$especie.id}">{$especie.nombre}</option>
                    {/foreach}
                    </select>
                    <br />

                    <label><b>Raza</b></label>
                    <select class="raza" id="raza" name="raza">
                    </select>
                    <br />

                    <label><b>Barrio</b></label>
                    <select name="barrio">
                    {foreach from=$barrios item=barrio}
                        <option value="{$barrio.id}">{$barrio.nombre}</option>
                    {/foreach}
                    </select>
                    <br />

                    <input name='img[]' type='file' multipart="multipart"/> <br >
                    <button class="masImagenes">Agregar más imagenes</button>
        
                    <div id="map"></div>
                    <input id="latitud" name="latitud" type="hidden" value="invalido">
                    <input id="longitud" name="longitud" type="hidden" value="invalido">
        
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key={$api}&callback=initMap"></script>
                    <button type="submit">Registrar</button>
                    <button class="cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </body>
</html>
