<?php

function exploited(){
  if($_POST['Usuario'] === "" || strpos($_POST['Usuario']," ") || strpos($_POST['Usuario'],"<") || strpos($_POST['Usuario'],">")){
    return true;
  }
  return false;
}

function loginExploited(){
  if($_POST['loginUserEmail'] === "" || strpos($_POST['loginUserEmail']," ") || strpos($_POST['loginUserEmail'],"<") || strpos($_POST['loginUserEmail'],">")){
    return true;
  }
  return false;
}

function duplicatedUser(){
  $fileName = 'usuarios.json';
  if (file_exists($fileName)){
    $jsonFile = file_get_contents($fileName);
    $jsonArray = json_decode($jsonFile,true);
    foreach ($jsonArray as $userData) {

        if ($userData['usuario'] === $_POST['Usuario'] || $userData['email'] === $_POST['Email']) {
          return true;
        }

    }
  }
  return false;

}

function validarPassword($password){
  $validUserPassword=true;
  $mensaje="";
  if(strlen($password)<5){
    $validUserPassword=false;
    $mensaje=$mensaje."La contraseña debe tener más de 5 caracteres.<br>";
  }
  if(strpos($password," ") !== false){
    $validUserPassword=false;
    $mensaje=$mensaje."La contraseña no puede contener espacios.<br>";
  }
  if(strpos($password,"DH") === false){
    $validUserPassword=false;
    $mensaje=$mensaje."La contraseña debe contener lo siguiente: DH.";
  }

  if ($validUserPassword == false){
    return $mensaje;
  }
  return true;
}

function userImg(){
  if($_FILES["img-file"]["error"] != 0){
    $mensaje = "Error inesperado al intentar cargar de la imagen";
    return $mensaje;
  }else{
    $ext = pathinfo($_FILES["img-file"]["name"],PATHINFO_EXTENSION);
    if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
      $dir = 'archivos/'.$_POST['Usuario'].'-img.'.$ext;
      move_uploaded_file($_FILES["img-file"]["tmp_name"],$dir);
      return $dir;
    }else{
      $mensaje = "Solo se permiten archivos 'jpg', 'jpeg' o 'png'";
      return $mensaje;
    }
  }
}

function createUser(){
$array = [
  "nombre" => $_POST["Nombre"],
  "apellido" => $_POST["Apellido"],
  "email" => $_POST["Email"],
  "usuario" => $_POST["Usuario"],
  "password" => password_hash($_POST["userPassword"], PASSWORD_DEFAULT),
  "user-img" => userImg(),
];
return $array;
}

function addUser(){
  $fileName = 'usuarios.json';
  if (file_exists($fileName)){
    $jsonFile = file_get_contents($fileName);
    $jsonArray = json_decode($jsonFile,true);
    $howMany = count($jsonArray);
    $jsonArray[$howMany] = createUser();
    $jsonFile = json_encode($jsonArray);
    file_put_contents($fileName,$jsonFile);
  }else{
    $jsonArray[0] = createUser();
    $jsonFile = json_encode($jsonArray);
    file_put_contents($fileName,$jsonFile);
  }
}

function login($user, $pass){
  $fileName = 'usuarios.json';
  $usuarioEmail= $user;
  if(file_exists($fileName)){
    $jsonFile = file_get_contents($fileName);
    $jsonArray = json_decode($jsonFile,true);

    foreach ($jsonArray as $userData) {
      if ($userData['usuario'] === $usuarioEmail || $userData['email'] === $usuarioEmail) {
        if (password_verify($pass,$userData['password'])) {
          return true;
        }
      }
    }
    return false;
  }
}

function createRememberUser(){
$array = [
  "usuario" => $_POST["loginUserEmail"],
  "password" => password_hash($_POST["loginPassword"], PASSWORD_DEFAULT),
];
return base64_encode(json_encode($array));
}

function addRememberUser(){
  $fileName = 'usuarios-recordados.json';
  if (file_exists($fileName)){
    $jsonFile = file_get_contents($fileName);
    $jsonArray = json_decode($jsonFile,true);
  }
  setcookie("Remember",base64_encode($_POST["loginUserEmail"]),time() + 60*60*24*7);
  $jsonArray[base64_encode($_POST["loginUserEmail"])] = createRememberUser();
  $jsonFile = json_encode($jsonArray);
  file_put_contents($fileName,$jsonFile);
}

function getName($user){
  $fileName = 'usuarios.json';
  $jsonFile = file_get_contents($fileName);
  $jsonArray = json_decode($jsonFile,true);

  foreach ($jsonArray as $userData) {
    if ($userData['usuario'] === $user || $userData['email'] === $user) {
      return $userData['nombre'];
    }
  }
  return "";
}

function getImg($user){

  $fileName = 'usuarios.json';
  $jsonFile = file_get_contents($fileName);
  $jsonArray = json_decode($jsonFile,true);

  foreach ($jsonArray as $userData) {
    if ($userData['usuario'] === $user || $userData['email'] === $user) {
      return $userData['user-img'];
    }
  }
  return "";
}

function getRememberUser(){
  $fileName = 'usuarios-recordados.json';
  if (file_exists($fileName)){
    $jsonFile = file_get_contents($fileName);
    $jsonArray = json_decode($jsonFile,true);
  }
  if(isset($jsonArray[$_COOKIE["Remember"]])){
    return $jsonArray[$_COOKIE["Remember"]];
  }
  return "";
}
