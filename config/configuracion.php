<?php
  require_once 'includes/smarty/Smarty.class.php';
  require_once 'includes/class.Conexion.BD.php';

  //Configuración de SMARTY
  define("TEMPLATEDIR", "templates");
  define("COMPILEDIR", "templates_c");
  define("CONFIG", "cache");
  define("CACHE", "config");

  //Configuración de PDO
  define("SERVIDOR", "localhost");
  define("BASEDATOS", "mascotas");
  define("USUARIO", "root");
  define("CLAVE", "root");
  
  //Configuración sitio web
  define("FOTOS", "fotos");

?>

