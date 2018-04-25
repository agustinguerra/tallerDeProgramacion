<!DOCTYPE html>

<html>
<head>
    <title>Inicio de Sesión</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div id="encabezado">
        <h1>Mascotas Perdidas</h1>
        <h2>Portal de busqueda de mascotas</h2>
    </div>
    <div id="menu">
        <ul>
            <li><a href="index.php">Pagina Principal</a></li>
        </ul>
    </div>
    <div id="formulario">
        <form method="POST" action="doLogin.php">
            <label><b>Ingrese usuario y contraseña</b></label>
            <p><label>Usuario</label> <input type="text" name="usuario"/></p>
            <p><label>Clave</label> <input type="password" name="clave"/></p>
    
            {if !empty({$redirect})}
                <input type="hidden" name="redirect" value="{$redirect}"/>
            {/if}
    
            {if !empty({$error})}
                <div class="error"><b>Usuario/Clave Incorrectos</b></div>
            {/if}

            <input type="submit" value="Iniciar Sesión"/>
        </form>
    </div>
</body>
</html>