<!DOCTYPE html>
<?php
session_start();
$error = '';
if ($_POST) {
  require('conexion.php');
  $query = $conex->prepare('SELECT * FROM usuarios WHERE email = :email');
  $query->bindValue(':email', $_POST['name']);
  $query->execute();
  $usuario = $query->fetch(PDO::FETCH_ASSOC);
  if($usuario){
    $_SESSION['id']=$usuario['id'];
    $_SESSION['email']=$usuario['email'];
    $_SESSION['nombre']=$usuario['nombre'];
    header('location:home.php');
  }else{
    $error = 'el usuario no existe';
  }
}

 ?>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog</title>
  </head>
  <body>
    <div class="container" style="width:100%;height:100vh;display:flex;justify-content:center;align-items:center;">
      <form action="" method="POST">
        <label>Email:</label>
        <input type="text" name="name" value="">
        <?php echo $error; ?>
        <br>
        <input type="submit" value="Ingresar">
      </form>
    </div>
  </body>
</html>
