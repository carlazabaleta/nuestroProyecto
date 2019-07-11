<?php
session_start();

//TOD LO Q PIDIERON
//Nombre completo
//Nombre de usuario
//País de nacimiento
// Correo electrónico
//Imagen de perfil
//Contraseña
//Repetir contraseña

function validarRegistro($datos)
{
  $errores = [];

  //quitando espacios bb:)
  $nombreCompleto = trim($datos["nombreCompleto"]);
  $usuario = trim($datos["usuario"]);
  $paisDeNacimiento = trim($datos["paisDeNacimiento "]);
  $email = trim($datos["email"]);
  $contrasenia = trim($datos["contrasenia"]);
  $confirmarcontrasenia = trim($datos["contraseniaConfirmar"]);

  //valido cada uno = verifica carla!!!
  if ($nombreCompleto == "") {
    $errores["nombreCompleto"] = "Completa el nombre";

  }
  if ($usuario == "") {
    $errores["usuario"] = "Completa el usuario";

  }
  if ($paisDeNacimiento == "") {
    $errores["paisDeNacimiento"] = "Completa el Pais De Nacimiento";

  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errores["email"] = "Email no es válido";

  } else if(existeUsuario($email)){
    $errores["email"] = "El email ya se encuentra registrado.";
  }
  if ($contrasenia ==""){
    $errores["password"] = "Completa la contraseña";
  }
  else if (strlen($contrasenia)>5)
  {
    $errores["password"] = "La contraseña debe tener mas de 5 letras";

  }
//  else if ($contrasenia)
//    {
//      $errores["password"] = "La contraseña debe tener las letras DH MAYUSCULA Y SEGUIDAS";
//    }
  else if($contrasenia != $confirmarcontrasenia){
    $errores["password"] = "Las contraseñas no coinciden";
  }
  return $errores;
}

function nextId()
{
  $json = file_get_contents("usuarios.json");
  $toArray = json_decode($json, true);

  if(!$toArray){
    return $nextId = 1;
   }

  $ultimoUsuario = array_pop($toArray["usuarios"]);
  $nextId = $ultimoUsuario["id"] + 1;

  return $nextId;
}

function armarUsuario()
{
  $usuario =[
    "id" => nextId(),
    "nombreCompleto" => trim($_POST["nombreCompleto"]),
    "usuario" => trim($_POST["usuario"]),
    "email" => trim($_POST["email"]),
    "paisDeNacimiento" => trim($_POST["paisDeNacimiento"]),
    "password" => password_hash($_POST["contrasenia"], PASSWORD_DEFAULT),
  ];

  return $usuario;
}

function guardarUsuario($usuario)
{
  $json = file_get_contents("usuarios.json");
  $toArray = json_decode($json, true);
  $toArray["usuarios"][] = $usuario;

  $json = json_encode($toArray, JSON_PRETTY_PRINT);
  file_put_contents("usuarios.json", $json);

}

function buscarUsuarioPorEmail($email)
{
  $json = file_get_contents("usuarios.json");
  $toArray = json_decode($json, true);
  $usuarios = $toArray["usuarios"];

  foreach ($usuarios as $usuario) {
    if($email == $usuario["email"]){
      return $usuario;
    }
  }
  return null;
}

function existeUsuario($email)
{
  return buscarUsuarioPorEmail($email) !== null;
}


function loguearUsuario($email)
{
  if(isset($_COOKIE["email"])){
    $_SESSION["email"] = $_COOKIE["email"];
  } else {
    $_SESSION["email"] = $email;
  }

  if(isset($_POST["recordame"]))
  {
    setcookie("email", $email, time()+3600);
  }

}
