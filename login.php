<?php
if(isset($loginError) && $loginError != ""){
  echo("<p style='font-size: 0.8em;font-weight: bolder;color:red;'>$loginError</p>");
}
?>

      <form class="col-12" action="index.php" method="post">
        <div class="form-group">
          <input class="form-control badge-pill border-0 text-center" name="loginUserEmail" type="text" placeholder="Usuario o correo" required>
        </div>

        <div class="form-group">
          <input class="form-control badge-pill border-0 text-center" name="loginPassword" type="password" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
          <button class="form-control btn btn-outline-dark badge-pill text-center" type="submit">Login</button>
        </div>
        <div class="form-group">
          <input type="checkbox" name="rememberMe" checked value="1"> Recordarme</input>
        </div>
      </form>

      <div class="col-12">
        <form class="" action="index.php" method="post">
          <div class="col-12">
            <input type="hidden" name="switchForm" value="1">
            <button type="submit" class="btn btn-link badge-pill text-center">No tengo cuenta</button>
          </div>
        </form>
      </div>
