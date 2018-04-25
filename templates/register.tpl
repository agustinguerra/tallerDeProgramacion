<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
        <link rel="stylesheet" type="text/css" href="css/register.css">
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/register.js"></script>
    </head>
<body>
    <div id="encabezado">
        <h1>Mascotas Perdidas</h1>
        <h2>Portal de busqueda de mascotas</h2>
    </div>
    <div id="menu">
        <ul>
            <li><a href="index.php">Pagina Principal</a></li>
            <li><a href="login.php">Iniciar Sesión</a></li>
        </ul>
    </div>

    <div id="formulario">
      <form class="" action="doRegister.php" method="POST">
        <label><b>Registro en la plataforma</b></label> <br />
        <label>Nombre</label>
        <input type="text" placeholder="Ingrese Nombre Completo" name="name" id="name" required>
        <br />

        <label>Email</label>
        <input type="email" placeholder="Ingrese Email" name="email" id="email" required>
        <br />

        <label>Contraseña</label>
        <input type="password" placeholder="Ingrese contraseña" name="password" id="password" required>
        <br />

        <label>Confirme contraseña</label>
        <input type="password" placeholder="Ingrese contraseña nuevamente" name="password_confirm" id="password_confirm" required>
        <br />
        
        <button type="submit">Registrar</button>
        <button type="button" class="cancelbtn">Cancelar</button>
      </div>
    </form>
  <center>
  <div class="error"><center>{$mensajeRegistro}<center></div>
</center>

</body>
</html>
