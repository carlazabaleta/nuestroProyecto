<!DOCTYPE html>
<?php
session_start();
require('conexion.php');
$query = $conex->query('SELECT * FROM posteos ORDER BY fecha DESC');
$posteos = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Posteos</title>
  </head>
  <body>
    <div class="container">
      <a href="nuevoPosteo.php" align="center">Nuevo Posteo</a>
      <section style="width:100%;display:flex;flex-wrap:wrap;justify-content:flex-start;align-items:flex-start;">

        <?php foreach ($posteos as $posteo) {
            $sql = 'SELECT * FROM categoria_posteo
                      INNER JOIN categorias ON categorias.id = categoria_posteo.categoria_id
                      WHERE posteo_id = :posteo_id';
            $query = $conex->prepare($sql);
            $query->bindValue(':posteo_id', $posteo['id']);
            $query->execute();
            $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

          ?>
        <article class="" style="width:30%;margin-right:1px;border:2px solid black;display:inline-block;">
          <h3><?php echo $posteo['titulo'] ?></h3>
          <p><?php echo $posteo['texto'] ?></p>
          <p>Categorias: <?php
              for($i = 0;$i < count($categorias); $i++){
                echo "<span style='padding:3px;color:white;background:red;border-radius:20px;'>
                ".$categorias[$i]['nombre']."
                </span>";
              }
           ?></p>
          <img src="images/foto.jpg" alt="">
          <h5>Fecha de publicacion: <?php echo $posteo['fecha'] ?></h5>
        </article>
      <?php } ?>
      </section>
    </div>
  </body>
</html>
