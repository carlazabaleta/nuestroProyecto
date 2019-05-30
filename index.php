<?php  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale-1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>INDEX</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
  </head>

  <body class="background-index">

<h1 class="nombreproyecto"></h1>

<center>
<br><br><br>
<button class="popup" onclick="mostrarMensaje()">ENTRÁ!
  <span class="popuptext" id="myPopup">
      <div class="container-form">
      <div class="toggle">
        <span>Crear Cuenta</span>
      </div>

    <div class="formulario">
      <h2>Iniciar Sesion</h2>
      <form class="" action="#" method="post">
        <input type="text" placeholder="Usuario" required>
        <input type="password" placeholder="password" required>
        <input type="submit" value="Iniciar Sesion">
      </form>
      </div>

      <div class="formulario">
        <h2>Crea Tu Cuenta</h2>
        <form class="" action="#" method="post">
          <input type="text" placeholder="Usuario" required>
          <input type="password" placeholder="password" required>
          <input type="email" placeholder="Your Email" required>
          <input type="text" placeholder="Telefono" required>
          <input type="submit" value="Regístrate">
        </form>
        </div>

        <div class="reset-password">
          <a href="#">Olvide mi contraseña </a>
        </div>
  </span>
</button>
</center>


<div class="wrapper">
  <div class="letters">
    <span class="letter">A</span>
    <span class="letter">C</span>
    <span class="letter">E</span>
    <span class="letter">R</span>
    <span class="letter">C </span><?= " "?>
    <span class="letter">A</span>
    <span class="letter">D</span>
    <span class="letter">E</span>
    <span class="letter">N</span>
    <span class="letter">O</span>
    <span class="letter">S</span>
    <span class="letter">O </span>
    <span class="letter">T</span>
    <span class="letter">R</span>
    <span class="letter">O</span>
    <span class="letter">S</span>
    <span class="letter">;)</span>
  </div>
</div>

    <script  src="js/jquery.js"></script>
    <script  src="js/bootstrap.min.js"></script>
    <script  src="js/main.js"></script>
  </body>
</html>
