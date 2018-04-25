<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{$titulo}</title>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/publicacion.js"></script>
    <link rel="stylesheet" type="text/css" href="css/publicacion.css">
</head>
  <body>
    <div id="encabezado">
      <h1>Mascotas Perdidas</h1>
      <h2>Portal de busqueda de mascotas</h2>
    </div>
    <div id="menu">
      <ul>
        {if (!isset($usuario))}
          <li><a href="login.php">Iniciar Sesión</a></li>
          <li><a href="register.php">Registrarse</a></li>
        {else}
          <li><a href="nuevaPublicacion.php">Registrar Aviso</a></li>
          <li><a href="estadisticas.php">Estadísticas</a></li>
          <li><a href="doLogout.php">Cerrar Sesión</a></li>
        {/if}
      </ul>
    </div>
    <div id="publicacion">
      <h2>{$titulo}</h2>
      <div id="imagenes">
        {if !empty($fotos)}
          {foreach from=$fotos item=foto}
            <img class="mySlides" src="{$foto}">
          {/foreach}
          <button class="w3-button w3-display-left">&#10094;</button>
          <button class="w3-button w3-display-right">&#10095;</button>
        {/if}
      </div>
      <div class="{$tipo}">
        {$tipo}
      </div>
      <p>Especie: {$especie}</p>
      <p>Raza: {$raza}</p>
      <p></p>
      <p>Descripción: {$descripcion}</p>
      Lugar: <br />
      <iframe
        width="600"
        height="450"
        frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/place?key={$api}&q={$latitud},{$longitud}&zoom=18" allowfullscreen>
      </iframe>
      <div class="preguntas">
        <b>Preguntas: </b><br />
        {foreach from=$preguntas item=pr}
          <p><b>{$pr.texto}</b> <br/>
          {if empty($pr.respuesta)}
            {if $creador && $abierto}
              <form method="POST" action="doResponder.php">
                Responder <input type="text" name="respuesta"/>
                <input type="hidden" name="pregunta" value="{$pr.id}"/>
                <input type="hidden" name="publicacion" value="{$publicacion}"/>
                <input type="submit" value="Responder"/>
              </form>
            {/if}
          {else}
            {$pr.respuesta}
          {/if}
          </p>
        {/foreach}
        {if $abierto}
          {if empty($usuario)}
            <a href="login.php?publicacion={$publicacion}">Inicia sesión para realizar una pregunta</a>
          {elseif !empty($usuario) && $usuario.id != $id_usuario}
            <a href="preguntar.php?publicacion={$publicacion}">Nueva Pregunta</a>
          {/if}
        {/if}
      </div>
      <div class="cerrar">
        {if $creador && $abierto}
          <form method="POST" action="doCerrar.php">
            <input type="hidden" name="publicacion" value="{$publicacion}"/>
            Cerrar Publicación con estado:<br>
            <input type="radio" name="exito" value="1" checked> Exitoso<br>
            <input type="radio" name="exito" value="0"> Sin éxito<br>
            <input type="submit" value="Cerrar Publicacion"/>
          </form>
        {/if}
      </div>
      <p><a href="publicacionPDF.php?id={$publicacion}">Exportar PDF</a></p>
    </div>
</body>
</html>
