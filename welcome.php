<?php

 ?>

<div class="">
  <div class="col-12 text-center padding-img-user-welcome">
    <img src="<?php echo getImg($userInfo); ?>" alt="img-profile" class="welcome-user-img">
  </div>
  <div class="col-12">
   <h6>Bienvenido</h6>
  </div>
  <div class="col-12">
   <h3><?php echo getName($userInfo); ?></h3>
  </div>

  <form class="col-12" action="home.php" method="post">
    <div class="col-12">
      <button class="btn btn-link badge-pill"  type="submit">ENTRAR</button>
    </div>
  </form>
  <form class="col-12" action="index.php" method="post">
    <div class="col-12">
      <input type="hidden" name="logout" value="1">
      <button class="btn btn-link badge-pill"  type="submit">Logout</button>
    </div>
  </form>
</div>
