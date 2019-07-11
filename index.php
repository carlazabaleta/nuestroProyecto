<!DOCTYPE html>

<?php

include "funciones1.php";

//si llegan datos por post...
if($_POST){
  $usuariosExistentes = file_get_contents("usuarios.json");
  //los paso de JSON a array asociativo
  $usuariosExistentes = json_decode($usuariosExistentes,true);
  //recorro todos los usuarios
  foreach ($usuariosExistentes as $cadaUsuario) {
    //si coinciden los emails...
    if($cadaUsuario['email'] == $_POST['email']){
      //guardo el usuario encontrado
      $usuario = $cadaUsuario;
      if(password_verify($_POST["password"],$usuario["contrasenia"])){
        session_start();
        if(isset($_POST["remember"])){
          setcookie("email",$usuario["email"],time()+3600*24*365*5);
        }
        $_SESSION['email'] = $usuario["email"];
        header("Location:home.php");
      }
      break;
    }
  }
  echo "Usuario y/o contraseña inválida.";
}

$errornombreCompleto = "";
$errorUsuario = "";
$errorpaisDeNacimiento = "";
$errorEmail = "";
$errorFoto = "";
$errorCV = "";
$errorContrasenia = "";
$hayErrores = false;
$errores = 0;
$nombreOk="";

if($_POST){

  $errores = validarRegistro($_POST);

  $nombreCompletoOk = trim($_POST["nombreCompleto"]);
  $usuarioOk= trim($_POST["usuario"]);
  $emailOk =trim($_POST["email"]);
  $cv = $_FILES["CV"];
  $foto = $_FILES["foto"];
  $paisDeNacimiento=trim($_POST["paisDeNacimiento"]);
  $contraseniaOk=trim($_POST["contrasenia"]);
  $confirmarcontrasenia = trim($_POST["contraseniaConfirmar"]);
}

if ($nombreCompleto == "") {
  $errornombreCompleto = "Completa el nombre";
  $hayErrores = true;
  $errores++;
}
if ($usuario == "") {
  $errorUsuario = "Completa el usuario";
  $hayErrores = true;
  $errores++;
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $errorEmail = "Email no válido";
  $hayErrores = true;
}
if ($contrasenia ==""){
$errorContrasenia = "Completa la contraseña";
$hayErrores = true;
}
else if (strlen($contrasenia)<4)
{
  $errorContrasenia = "La contraseña debe tener al menos 4 caracteres";
  $hayErrores = true;
}else if($contrasenia != $confirmarcontrasenia){
  $errorContrasenia = "Las contraseñas no coinciden";
  $hayErrores = true;
}



if(isset($_FILES["foto"])){
  //si el dato de error es OK...
  if($_FILES["foto"]["error"] === UPLOAD_ERR_OK){
    //guardo el nombre del archivo
    $nombreFoto = $_FILES["foto"]["name"];
    //guardo el nombre temporal del archivo
    $origen = $_FILES["foto"]["tmp_name"];
    //uso la informacion del path que es la url, para tomar y guardar la extension
    $ext = pathinfo($nombreFoto,PATHINFO_EXTENSION);

    $destino = "";
    $destino = $destino."archivos/";
    //genero la ruta donde guardo el archivo
    $destino = $destino.$nombre."fotodeperfil.".$ext;

    //guardo el archivo con esta funcion
    move_uploaded_file($origen,$destino);
    $errorFoto = "archivo subido con exito";
  }

}else{
    $errorFoto = "error con la foto";
    $hayErrores = true;
}


if(isset($_FILES["cv"])){
  //si el dato de error es OK...
  if($_FILES["CV"]["error"] === UPLOAD_ERR_OK){
    //guardo el nombre del archivo
    $nombreCV = $_FILES["CV"]["name"];
    //guardo el nombre temporal del archivo
    $origenCV = $_FILES["CV"]["tmp_name"];
    //uso la informacion del path que es la url, para tomar y guardar la extension
    $extCV = pathinfo($nombreCV,PATHINFO_EXTENSION);


    $destinoCV = "";
    $destinoCV = $destinoCV."archivos/";
    //genero la ruta donde guardo el archivo
    $destinoCV = $destinoCV.$nombreCV."CV.".$extCV;

    //guardo el archivo con esta funcion
    move_uploaded_file($origenCV,$destinoCV);
    $errorCV = "archivo subido con exito";
  }
}else{
    $errorCV = "error con el CV";
    $hayErrores = true;

}

if(!$errores){
  $usuario= armarUsuario();
  guardarUsuario($usuario);
  //ARMO UN ARRAY ASOCIATIVO DEL USUARIO CON SUS DATOS YA VALIDADOS
  $usuario = [
  "nombreCompleto"=> $nombreCompleto,
  "usuario" => $usuario,
  "email"=> $email,
  "foto" => $nombre."fotodeperfil.".$ext,
  "CV" => $nombre."CV.".$extCV,
  "contrasenia" => password_hash($contrasenia, PASSWORD_DEFAULT)
  ];
  $usuariosExistentes = file_get_contents('usuarios.json');
  $usuariosExistentes = json_decode($usuariosExistentes,true);
  $usuariosExistentes[] = $usuario;
  $usuariosEnJson = json_encode($usuariosExistentes);
  file_put_contents('usuarios.json',$usuariosEnJson);
  echo "<h2>Gracias por su registro!</h2>";
  $usuariosExistentes = file_get_contents('usuarios.json');
  $usuariosExistentes = json_decode($usuariosExistentes,true);
  var_dump($usuariosExistentes);
  exit;
 }


 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale-1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>INDEX</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  </head>

  <body>
<center class="background-index">
<br><br><br>
    <div class="modal-fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-header">
         <div class="toggle">
           <span>Crear Cuenta</span>
         </div>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

  <div class="formulario">
    <h2>Iniciar Sesion</h2>
    <form class="" action="index.php" method="post"enctype="multipart/form-data">
      <input type="text" placeholder="usuario">
             <?= $errorUsuario ?>
     <input type="email" placeholder="Your Email">
             <?= $errorEmail ?>
      <input type="password" placeholder="password">
             <?= $errorContrasenia ?>
      <input type="submit" value="Iniciar Sesion" >
    </form>
  </div>

    <div class="formulario">
      <h2>Crea Tu Cuenta</h2>
      <form class="" action="index.php" method="post"enctype="multipart/form-data">
        <?php if (isset($errores["nombreCompleto"])):?>
          <input type="text" placeholder="nombreCompleto">
        <?= $errores["nombreCompleto"] ?>
      <?php else: ?>
        <input type="text" placeholder="nombreCompleto"value="<?= $nombreOk?>">
      <?php endif ?>
        <?= $errornombreCompleto ?>

        <input type="text" placeholder="paisDeNacimiento">
        <?php if (isset($errores["paisDeNacimiento"])):?>
        <?= $errores["paisDeNacimiento"] ?>
        <?php endif ?>
        <?= $errorpaisDeNacimiento ?>

        <input type="text" placeholder="usuario">
        <?php if (isset($errores["usuario"])):?>
        <?= $errores["usuario"] ?>
        <?php endif ?>
        <?= $errorUsuario ?>

        <input type="file" placeholder="CV">
        <?php if (isset($errores["CV"])):?>
        <?= $errores["CV"] ?>
        <?php endif ?>
         <?= $errorCV ?>

        <input type="file" placeholder="fotodeperfil">
        <?php if (isset($errores["fotodeperfil"])):?>
        <?= $errores["fotodeperfil"] ?>
        <?php endif ?>
        <?= $errorFoto ?>

        <input type="email" placeholder="Your Email">
        <?php if (isset($errores["email"])):?>
        <?= $errores["email"] ?>
        <?php endif ?>
        <?= $errorEmail ?>

        <input type="password" placeholder="password">
        <?php if (isset($errores["contrasenia"])):?>
        <?= $errores["contrasenia"] ?>
        <?php endif ?>
        <?= $errorContrasenia ?>

        <input type="submit" value="Regístrate">
      </form>
      </div>

      <div class="reset-password">
        <a href="#">Olvide mi contraseña </a>
      </div>

             </div>

      <div class="background-footer">
        <button type="button"class="carla"data-toggle="modal" data-target="#exampleModal" data-whatever="@ÚNITE!">ÚNITE!</button>
      </div>

</center>

<div class="abarcador">

<svg viewBox="0 0 800 300">

  <!-- Symbol with text -->
  <symbol id="s-text">
    <text text-anchor="middle"
          x="50%"
          y="50%"
          dy=".35em"
          class="text--line"
          >
      Text
    </text>
  </symbol>

  <!-- Clippath  with text -->
  <clippath id="cp-text">
    <text text-anchor="middle"
          x="50%"
          y="50%"
          dy=".35em"
          class="text--line"
          >
      CODEALO
    </text>
  </clippath>

  <!-- Group for shadow -->
  <g clip-path="url(#cp-text)" class="shadow">
    <rect
          width="100%"
          height="100%"
          class="anim-shape anim-shape--shadow"
          ></rect>
  </g>

  <!-- Group with clippath for text-->
  <g clip-path="url(#cp-text)" class="colortext">
    <!-- Animated shapes inside text -->
    <rect
          width="100%"
          height="100%"
          class="anim-shape"
          ></rect>
    <rect
          width="80%"
          height="100%"
          class="anim-shape"
          ></rect>
    <rect
          width="60%"
          height="100%"
          class="anim-shape"
          ></rect>
    <rect
          width="40%"
          height="100%"
          class="anim-shape"
          ></rect>
    <rect
          width="20%"
          height="100%"
          class="anim-shape"
          ></rect>
  </g>

  <!-- Transparent copy of text to keep
         patterned text selectable -->
  <use xlink:href="#s-text"
       class="text--transparent"></use>
</svg>
</div>


<h1 class="nombreCarru"> ¿Como funciona?</h1>

<div class="content-all">
  <div class="content-carrousel">
    <figure><img src="imgs/img1.jpg"></figure>
    <figure><img src="imgs/img2.jpg"></figure>
    <figure><img src="imgs/img3.jpg"></figure>
    <figure><img src="imgs/img4.jpg"></figure>
    <figure><img src="imgs/img5.jpg"></figure>
  </div>
</div>


<script  src="js/jquery.js"></script>
<script  src="js/bootstrap.min.js"></script>
<script  src="js/main.js"></script>
</body>

</html>
