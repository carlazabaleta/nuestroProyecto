<!DOCTYPE html>

<?php
require_once 'funciones.php';

$jsonArray = [];
$userInfo="";
if(isset($_POST['logout'])){
  setcookie('Remember',"",time()-1);
}else{
  if (isset($_COOKIE['Remember'])) {
    $userCookie=getRememberUser();
    if($userCookie!=""){
      $userData=json_decode(base64_decode($userCookie),true);
      login($userData['usuario'],$userData['password']);
      $userInfo=$userData['usuario'];
      $switchForm = 'welcome.php';
    }
  }
}

$passwordError="";
$imgError="";
$userError="";
$loginError="";
$existError= false;
if (isset($switchForm)==false){
  //primera vez que ingresa
  $switchForm = 'login.php';
}

if(isset($_POST['switchForm'])){
  //no tengo/ya tengo cuenta
  if($_POST['switchForm']==1){
    $switchForm = 'registro.php';
  }else{
    $switchForm = 'login.php';
  }
}

if(isset($_POST['userPassword'])){
  //llega informacion del Post del formulario de registro
  if ($_POST['userPassword'] != $_POST['userRepeatPassword']){
    $switchForm = 'registro.php';
    $passwordError="Las contraseñas no coinciden";
    $errorColorIn=1;
    $existError=true;
  }else{
    $valid = validarPassword($_POST['userPassword']);
    if($valid === true){
      if(!exploited()){
        if(!duplicatedUser()){
          if(strpos(userImg(),"-img.")){
            addUser();
            $userInfo=$_POST['Usuario'];
            $switchForm = 'welcome.php';
          }else{
            $switchForm = 'registro.php';
            $imgError = userImg();
            $errorColorIn=3;
            $existError=true;
          }
        }else{
          $switchForm = 'registro.php';
          $userError = "Usuario o email ya existente";
          $errorColorIn=4;
          $existError=true;
        }
      }else{
        $switchForm = 'registro.php';
        $userError = "Error desconocido";
        $existError=false;
      }
    }else{
      $switchForm = 'registro.php';
      $passwordError=$valid;
      $errorColorIn=2;
      $existError=true;
    }
  }
}

if (isset($_POST['loginUserEmail'])) {
  if (!loginExploited()) {
    if (login($_POST['loginUserEmail'],$_POST['loginPassword'])) {
          //VER SWITCH Y SESSION
      $userInfo=$_POST['loginUserEmail'];
      if (isset($_POST['rememberMe'])) {
        addRememberUser();
        $switchForm = 'welcome.php';
      }
      $switchForm = 'welcome.php';
    }else{
      $loginError = "Datos incorrectos o inexistentes";
    }
  }else{
    $loginError = "Error desconocido";
  }
}

if ($existError===true) {
  $userData = [
  "nombre" => $_POST['Nombre'],
  "apellido" => $_POST['Apellido'],
  "email" => $_POST['Email'],
  "usuario" => $_POST['Usuario'],
  ];
}

?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale-1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Code-IT</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
  </head>

  <body>
    <div class="container-fluid text-center">
      <div class="container col-12">

        <div class="col-12 letters text-center">
          <span class="letter">C</span>
          <span class="letter">o</span>
          <span class="letter">d</span>
          <span class="letter">e</span>
          <span class="letter">-</span>
          <span class="letter">I</span>
          <span class="letter">T</span>
        </div>
        <div class="modal-content modal-dialog">

          <?php include $switchForm ?>

        </div>


      <div class="col-12 text-center">
        <div class="col-12 letters">
          <span class="letter">Nuestros colaboradores utilizan</span>
        </div>

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">

            <div class="carousel-item active">
              <div class="row justify-content-around">
                <div class="card text-white bg-primary mb-3 col-lg-3 col-sm-12">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>

                <div class="card text-white bg-primary mb-3 col-lg-3 col-sm-12">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>

                <div class="card text-white bg-primary mb-3 col-lg-3 col-sm-12">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>


            <div class="carousel-item">
              <div class="row justify-content-around">
                <div class="card text-white bg-primary mb-3 col-lg-3 col-sm-12">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>

                <div class="card text-white bg-primary mb-3 col-lg-3 col-sm-12">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>

                <div class="card text-white bg-secondary mb-3 col-lg-3 col-sm-12">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>


          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>


      <div class=" col-12 text-center">

        <div class="col-12 letters">
          <span class="letter">Nosotros</span>
        </div>

        <div id="ownersCarousel" class="carousel slide" data-ride="carousel" data-interval="1000">

          <div class="carousel-inner">

            <div class="carousel-item active">
              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="imgs/woman_default_profile.jpg" class="col-12">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Carla</h5>
                      <p class="card-custom-text">Se desempeña como FrontEnd Developer en Code-IT</p>
                      <p class="card-text"><small class="text-muted">Alguna otra info</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="imgs/man_default_profile.jpg" class="col-12">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Axel Converti</h5>
                      <p class="card-custom-text">Se desempeña como FullStack Developer en Code-IT</p>
                      <p class="card-text"><small class="text-muted">trainee</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <script  src="js/jquery.js"></script>
    <script  src="js/bootstrap.min.js"></script>
    <script  src="js/main.js"></script>
  </body>
</html>
