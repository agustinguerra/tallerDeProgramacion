<?php

require_once 'datos.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password_confirm'];

session_start();

if(strlen($name) == 0) {
    $_SESSION['mensajeRegistro'] = "El campo nombre no puede estar vacío";
    header('location:register.php');
} else if(strlen($email) == 0) {
    $_SESSION['mensajeRegistro'] = "El campo email no puede estar vacío";
    header('location:register.php');
} else if(strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) ) {
    $_SESSION['mensajeRegistro'] = "La contraseña debe tener al menos 8 caracteres, 1 mayúscula y 1 número";
    header('location:register.php');
} else if($password != $password2) {
    $_SESSION['mensajeRegistro'] = "Las claves no coinciden";
    header('location:register.php');
} else if(emailExistente($email)) {
    $_SESSION['mensajeRegistro'] = "El email ya existe en la base de datos";
    header('location:register.php');
} else if(registrarUsuario($name,$email,$password)){
    header('location:index.php');
} else if(strpos($email,"@") === false){
    $_SESSION['mensajeRegistro'] = "No se ha ingresado un email válido";
    header('location:register.php');
} else {
    $_SESSION['mensajeRegistro'] = "Fallo desconocido";
    header('location:register.php');
}

