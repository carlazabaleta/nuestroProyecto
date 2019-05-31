<!DOCTYPE html>

<?php
 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body class="img-login-register">
    <div class="container col-12">
      <nav class="navbar navbar-expand-lg navbar-dark backg-nav row">
        <button type="button" class="btn btn-outline-light rounded-pill" data-target="#menu" data-toggle="collapse">
          <span><h3>CO-DE-IT</h3></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <button type="button" class="btn btn-outline-light rounded-pill">Inicio</button>
              </a>
            </li>


          </ul>
          <form class="form-inline">
            <input class="form-control rounded-pill border-0" type="search" placeholder="Buscar">
            <button class="btn btn-outline-light rounded-pill" type="submit">Buscar</button>
          </form>
        </div>
      </nav>

      <div class="modal-dialog text-center">
        <div class="col-sm-10">
          <div class="modal-content login-form rounded">
            <form class="col-12 padding-form" action="#" method="post">
              <div class="form-group">
                <input class="form-control rounded-pill border-0" type="text" placeholder="Nombre" required>
              </div>
              <div class="form-group">
                <input class="form-control rounded-pill border-0" type="text" placeholder="Apellido" required>
              </div>
              <div class="form-group">
                <input class="form-control rounded-pill border-0" type="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input class="form-control rounded-pill border-0" type="password" placeholder="Contraseña" required>
              </div>
              <div class="form-group">
                <input class="form-control rounded-pill border-0" type="password" placeholder="Repetir contraseña" required>
              </div>
              <div class="form-group">
                <input class="form-control btn btn-outline-light rounded-pill"  type="submit" value="Crear cuenta">
              </div>
            </form>
            <div class="col-12">
              <a href="#">Ya tengo una cuenta</a>
            </div>
          </div>
        </div>
      </div>

      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/bootstrap.bundle.js"></script>
    </div>
  </body>
</html>
