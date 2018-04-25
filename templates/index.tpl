<!DOCTYPE html>
<html>
    <head>
        <title>Mascotas Perdidas</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>

        <div id="encabezado">
            <h1>Mascotas Perdidas</h1>
            <h2>Portal de busqueda de mascotas</h2>
        </div>
        <div id="menu">
            <ul>
                <li><a href="index.php">Pagina Principal</a></li>
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
        <div id="categorias">
            <h2>Buscador</h2>
            <ul>
                Especie
                <select name="especie" id="especie" class="especie">
                    <option value="-1"></option>
                    {foreach from=$especies item=especie}
                        <option value="{$especie.id}">{$especie.nombre}</option>
                    {/foreach}
                </select>
            </ul>
            <ul>
                Raza
                <select name="raza" id="raza" class="raza">
                </select>
            </ul>
            <ul>
                Barrio
                <select name="barrio" id="barrio" class="barrio">
                    <option value="-1"></option>
                    {foreach from=$barrios item=barrio}
                        <option value="{$barrio.id}">{$barrio.nombre}</option>
                    {/foreach}
                </select>
            </ul>
            <ul>
                Tipo
                <select name="estado" id="estado" class="estado">
                    <option value="-1"></option>
                    <option value="E">Perdida</option>
                    <option value="P">Encontrada</option>
                </select>
            </ul>
            <ul>
                <input type="hidden" class="cargaInicial" value="1"/>
                
                <input type="hidden" class="savedEspecie" value=""/>
                <input type="hidden" class="savedRaza" value=""/>
                <input type="hidden" class="savedBarrio" value=""/>
                <input type="hidden" class="savedText" value=""/>
                <input type="hidden" class="savedEstado" value=""/>

                <input type="hidden" class="paginationValue" value="10"/>
                <input type="hidden" class="paginationPage" value="1"/>
                <input type="hidden" class="totalPages" value=""/>
                <input type="hidden" class="carpetaFotos" value="{$carpetaFotos}"/>

                <input type="text" id="searchText" class="searchText" placeholder="Texto a buscar"/> <br><br>
                <input type="button" id="button" class="button" value="Buscar"/>
            </ul>
        </div>
        <div id="publicacionesContainer">
            <div id="publicaciones">
            </div>
            <center>
                <button class="primera">&#10094;&#10094;</button>
                <button class="anterior">&#10094;</button>
                <span class="paginado"></span>
                <button class="siguiente">&#10095;</button>
                <button class="ultima">&#10095;&#10095;</button>

                Elementos por página:
                <button class="pagination10" disabled>10</button>
                <button class="pagination20">20</button>
                <button class="pagination50">50</button>
                <button class="paginationAll">Todos</button>
            </center>
        </div>
    </body>
</html>
