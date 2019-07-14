          <?php
          if(isset($passwordError) && $passwordError != ""){
            echo("<p style='font-size: 0.8em;font-weight: bolder;color:red;'>$passwordError</p>");
          }
          if(isset($imgError) && $imgError != ""){
            echo("<p style='font-size: 0.8em;font-weight: bolder;color:red;'>$imgError</p>");
          }
          if(isset($userError) && $userError != ""){
            echo("<p style='font-size: 0.8em;font-weight: bolder;color:red;'>$userError</p>");
          }
          $bgRed = "style=background-color:red;";
          ?>

          <form class="col-12" enctype="multipart/form-data" action="index.php" method="post">
            <div class="form-group">
              <input class="form-control badge-pill border-0 text-center" name="Nombre" type="text" placeholder="Nombre" required

              <?php if (isset($userData['nombre']) && $userData['nombre'] != ""){
                $temp=$userData['nombre'];echo "value=$temp";}
              ?>>
            </div>

            <div class="form-group">
              <input class="form-control badge-pill border-0 text-center" name="Apellido" type="text" placeholder="Apellido" required

              <?php if (isset($userData['apellido']) && $userData['apellido'] != ""){
                $temp=$userData['apellido'];echo "value=$temp";}
              ?>>
            </div>

            <div class="form-group">
              <input class="form-control badge-pill border-0 text-center" name="Email" type="email" placeholder="Email" required

              <?php if (isset($userData['email']) && $userData['email'] != ""){
                $temp=$userData['email'];echo "value=$temp ";}
                if (isset($errorColorIn) && $errorColorIn == 4){
                  echo $bgRed;}
              ?>>
            </div>

            <div class="form-group">
              <input class="form-control badge-pill border-0 text-center" name="Usuario" type="text" placeholder="Usuario" required

              <?php if (isset($userData['usuario']) && $userData['usuario'] != ""){
                $temp=$userData['usuario'];echo "value=$temp ";}
                if (isset($errorColorIn) && $errorColorIn == 4){
                  echo $bgRed;}
              ?>>
            </div>

            <div class="form-group">
              <input class="form-control badge-pill border-0 text-center" name = "userPassword" type="password" placeholder="Contraseña" required
              <?php if (isset($errorColorIn) && $errorColorIn <= 2){
                echo $bgRed;} ?>>
            </div>

            <div class="form-group">
              <input class="form-control badge-pill border-0 text-center" name = "userRepeatPassword" type="password" placeholder="Repetir contraseña" required
              <?php if (isset($errorColorIn) && $errorColorIn == 1){
                echo $bgRed;} ?>>
            </div>

            <div class="form-group">
              <label class=" badge-pill border-0 text-center" for="pais">Nacionalidad</label>
              <select class="btn badge-pill border-0 text-center" name="pais" id="pais">
                <option value="Arg">Argentina</option>
              </select>
            </div>

            <div class="form-group">
              <label class="badge-pill border-0 text-center" for="img-file">Imagen de perfil</label>
              <input class="badge-pill border-0 text-center" name="img-file" id="img-file" type="file" required
              <?php if (isset($errorColorIn) && $errorColorIn == 3){
                echo $bgRed;} ?>>
            </div>

            <div class="form-group">
              <button class="form-control badge-pill border-0 text-center"  type="submit">Crear cuenta</button>
            </div>
          </form>

          <form class="" action="index.php" method="post">
            <div class="col-12">
              <input type="hidden" name="switchForm" value="0">
              <button class="btn btn-link badge-pill"  type="submit">Ya tengo una cuenta</button>
            </div>
          </form>
        </div>
      </div>
