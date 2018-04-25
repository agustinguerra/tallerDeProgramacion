<?php

require_once 'config/configuracion.php';

function smarty() {
    $miSmarty = new Smarty();
    $miSmarty -> template_dir = TEMPLATEDIR;
    $miSmarty -> compile_dir = COMPILEDIR;
    $miSmarty -> config = CONFIG;
    $miSmarty -> cache_dir = CACHE;

    return $miSmarty;
}

function getConexion() {
    $cn = new ConexionBD("mysql", SERVIDOR, BASEDATOS, USUARIO, CLAVE);

    if(!$cn->conectar()) {
        die("Error al iniciar la conexión");
    };
    return $cn;
}

function obtenerPublicacion($id) {
    $cn = getConexion();
    $params = array(array('publicacion',$id,'int'));
    $sql = "SELECT * FROM publicaciones WHERE id = :publicacion";
    if($cn->consulta($sql,$params)){
        $publicacion = $cn->siguienteRegistro();
    } else {
        die("Error de conexion SQL");
    }
    return $publicacion;
}

function obtenerPublicaciones() {
    $cn = getConexion();
    $params = array(array('abierto',1,'int'));
    $sql = "SELECT * FROM publicaciones WHERE abierto = :abierto";
    if($cn->consulta($sql,$params)){
        $publicaciones = $cn->restantesRegistros();
    }
    else {
        die("Error de conexion SQL");
    }
    return $publicaciones;
}

function obtenerBarrios() {
    $cn = getConexion();
    $sql = "SELECT * FROM barrios";
    if($cn->consulta($sql)){
        $barrios = $cn->restantesRegistros();
    }
    else {
        die("Error de conexion SQL");
    }
    return $barrios;
}

function obtenerEspecies() {
    $cn = getConexion();
    $sql = "SELECT * FROM especies";
    if($cn->consulta($sql)){
        $especies = $cn->restantesRegistros();
    }
    else {
        die("Error de conexion SQL");
    }
    return $especies;
}

function obtenerPreguntas() {
    $cn = getConexion();
    $sql = "SELECT * FROM preguntas";
    if($cn->consulta($sql)){
        $preguntas = $cn->restantesRegistros();
    }
    else {
        die("Error de conexion SQL");
    }
    return $preguntas;
}

function obtenerRazas() {
    $cn = getConexion();
    $sql = "SELECT * FROM razas";
    if($cn->consulta($sql)){
        $razas = $cn->restantesRegistros();
    }
    else {
        die("Error de conexion SQL");
    }
    return $razas;
}

function obtenerRazasParaEspecie($especie) {
    $cn = getConexion();
    $params = array(
        array('especie',$especie,'int')
    );
    $sql = "SELECT * FROM razas WHERE especie_id = :especie";
    if ($cn->consulta($sql,$params)){
        $resultados = $cn->restantesRegistros();
    } else {
        die("Error de conexion SQL");
    }
    return $resultados;
}


function login($usuario, $clave){
    $cn = getConexion();
    $params = array(array('usuario',$usuario,'string'),array('password',$clave,'string'));
    $sql = "SELECT * FROM usuarios WHERE email = :usuario and password = :password";
    if ($cn->consulta($sql,$params)){
        if ($cn->cantidadRegistros() > 0) {
            $db_usuario = $cn->siguienteRegistro();
            $usuario =  array( "nombre" => $db_usuario['nombre'],"id" => $db_usuario['id']);

            session_start();
            $_SESSION['usuario'] = $usuario;
            
            return $usuario;
        }
    } else {
        die("Error de conexion SQL");
    }
    return null;
}

function usuarioLogueado() {
    session_start();
    if(isset($_SESSION['usuario'])) {
        return $_SESSION['usuario'];
    }
    
    return null;
}


function buscarEspecie($id) {
    $cn = getConexion();
    $params = array(array('id',$id,'int'));
    $sql = "SELECT * FROM especies WHERE id = :id";
    if ($cn->consulta($sql,$params)){

        $db_usuario = $cn->siguienteRegistro();
        $especie =  $db_usuario['nombre'];

        return $especie;

    } else {
        die("Error de conexion SQL");
    }
}

function buscarRaza($id) {
    $cn = getConexion();
    $params = array(array('id',$id,'int'));
    $sql = "SELECT * FROM razas WHERE id = :id";
    if ($cn->consulta($sql,$params)){

        $db_usuario = $cn->siguienteRegistro();
        $raza =  $db_usuario['nombre'];

        return $raza;

    } else {
        die("Error de conexion SQL");
    }
}

function buscarBarrio($id)
{
    $cn = getConexion();
    $params = array(array('id',$id,'int'));
    $sql = "SELECT * FROM barrios WHERE id = :id";
    if ($cn->consulta($sql,$params)) {

        $db_usuario = $cn->siguienteRegistro();
        $barrio = $db_usuario['nombre'];

        return $barrio;

    } else {
        die("Error de conexion SQL");
    }
}

function emailExistente($email) {
    $cn = getConexion();
    $params = array(array('email',$email,'string'));
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    if ($cn->consulta($sql,$params)){
        if ($cn->cantidadRegistros() > 0) {
            return true;
        }
    } else {
        die("Error de conexion SQL");
    }
    return false;
}

function registrarUsuario($nombre, $email, $contraseña) {
    $cn = getConexion();
    $params = array(array('email',$email,'string'),array('nombre',$nombre,'string'),array('password',$contraseña,'string'));
    $sql = "INSERT INTO `usuarios` VALUES (NULL,:email,:nombre,:password)";
    if ($cn->consulta($sql,$params)){
        login($email,$contraseña);
        return true;
    } else {
        die("Error de conexion SQL");
    }
    return false;
}

function registrarPublicacion($titulo, $descripcion, $tipo, $especie, $raza, $barrio, $usuario, $latitud, $longitud) {
    $cn = getConexion();
    $param = array (
        array("titulo",$titulo,"string"),
        array("descripcion",$descripcion,"string"),
        array("tipo",$tipo,"string"),
        array("especie",$especie,"int"),
        array("raza",$raza,"int"),
        array("barrio",$barrio,"int"),
        array("usuario",$usuario,"int"),
        array("latitud",$latitud,"string"),
        array("longitud",$longitud,"string"),
        array("abierto",true,"bool"),
        array("exitoso",false,"bool")
    );
    $sql = "INSERT INTO `publicaciones` (`titulo`, `descripcion`, `tipo`,"
            . " `especie_id`, `raza_id`, `barrio_id`, `abierto`, `usuario_id`,"
            . " `exitoso`, `latitud`, `longitud`) VALUES (:titulo,:descripcion,"
            . ":tipo,:especie,:raza,:barrio,:abierto,:usuario,:exitoso,:latitud,:longitud);";
    if ($cn->consulta($sql,$param)){
        return $cn->ultimoIdInsert();
    } else {
        die("Error de conexion SQL: " . $cn -> ultimoError() . "<br /> Consulta: " . $sql . json_encode($param));
    }
    return -1;
}

function buscarPreguntas($id) {
    $cn = getConexion();
    $param = array (
        array("publicacion",$id,"int")
    );
    $sql = "SELECT * FROM preguntas WHERE id_publicacion = :publicacion";
    if ($cn->consulta($sql,$param)){
        return $cn->restantesRegistros();
    } else {
        die("Error de conexion SQL: " . $cn -> ultimoError() . "<br /> Consulta: " . $sql . json_encode($param));
    }
    return array();
}

function agregarPregunta($publicacion,$usuario,$pregunta) {
    $cn = getConexion();
    $param = array (
        array("publicacion",$publicacion,"int"),
        array("usuario",$usuario,"int"),
        array("pregunta",$pregunta,"string")
    );
    $sql = "INSERT INTO `preguntas`(`id`, `id_publicacion`, `texto`, `respuesta`,"
            ." `usuario_id`) VALUES (NULL,:publicacion,:pregunta,NULL,:usuario)";
    if ($cn->consulta($sql,$param)){
        return $cn->ultimoIdInsert();
    } else {
        die("Error de conexion SQL: " . $cn -> ultimoError() . "<br /> Consulta: " . $sql . json_encode($param));
    }
    return -1;
}

function agregarRespuesta($pregunta,$respuesta) {
    $cn = getConexion();
    $param = array (
        array("respuesta",$respuesta,"string"),
        array("pregunta",$pregunta,"int")
    );
    $sql = "UPDATE `preguntas` SET `respuesta`=:respuesta WHERE `id`=:pregunta";
    if ($cn->consulta($sql,$param)){
        return true;
    } else {
        die("Error de conexion SQL: " . $cn -> ultimoError() . "<br /> Consulta: " . $sql . json_encode($param));
    }
    return false;
}

function cerrarPublicacion($publicacion, $exito) {
    $cn = getConexion();
    $param = array (
        array("abierto",false,"bool"),
        array("exitoso",$exito,"bool"),
        array("publicacion",$publicacion,"int"),
    );
    $sql = "UPDATE `publicaciones` SET `abierto`=:abierto,`exitoso`=:exitoso WHERE `id`=:publicacion";
    if ($cn->consulta($sql,$param)){
        return true;
    } else {
        die("Error de conexion SQL: " . $cn -> ultimoError() . "<br /> Consulta: " . $sql . json_encode($param));
    }
    return false;
}

function obtenerTodasLasPublicaciones() {
    $cn = getConexion();
    $sql = "SELECT * FROM publicaciones";
    if($cn->consulta($sql)){
        $publicaciones = $cn->restantesRegistros();
    }
    else {
        die("Error de conexion SQL");
    }
    return $publicaciones;
}
