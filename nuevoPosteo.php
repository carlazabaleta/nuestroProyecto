<!DOCTYPE html>
<?php
session_start();
require('conexion.php');
if($_POST){

  $rutaDeImagen='';
  $query = $conex->prepare('INSERT INTO posteos (titulo, texto, imagen, fecha, usuario_id) VALUES (:titulo, :texto, :imagen, :fecha, :usuario_id)');
  $query->bindValue(':titulo', $_POST['titulo']);
  $query->bindValue(':texto', $_POST['texto']);
  $query->bindValue(':imagen', $rutaDeImagen);
  $query->bindValue(':fecha', date('Y-m-d'));
  $query->bindValue(':usuario_id', $_SESSION['id']);
  $query->execute();

  $posteo_id = $conex->lastInsertId();

  if(isset($_POST['categorias'])){
    $query = $conex->prepare('INSERT INTO categoria_posteo (posteo_id, categoria_id) VALUES (:posteo_id, :categoria_id)');
    //var_dump($_POST['categorias']);
    foreach ($_POST['categorias'] as $categoria) {
      //echo ' MAnde la categoria : '. $categoria. '<br>';
      $query->bindValue(':posteo_id', $posteo_id );
      $query->bindValue(':categoria_id', $categoria);
      $query->execute();
    }
  }


}
  $query2=$conex->query("SELECT * FROM categorias");
  $categorias=$query2->fetchAll(PDO::FETCH_ASSOC);

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="" method="POST" enctype="multipart/form-data">
      <label>Titulo:</label>
      <input type="text" name="titulo" value="">
      <br>
      <label>Texto</label>
      <textarea name="texto" rows="8" cols="80"></textarea>
      <br>
      <label>Imagen</label>
      <input type="file" name="imagen" value="">
      <br>

      <?php
foreach ($categorias as $categoria) { ?>
          <input type="checkbox" name="categorias[]" value="<?php echo $categoria['id']?>">
          <label for="categoria"><?php echo $categoria['nombre']?></label>
<?php
}
      ?>
      <br>
      <input type="submit" value="Postear">

    </form>
    <a href="home.php">Volver al home</a>
  </body>
</html>
