Vista login

<form action="" method="POST" autocomplete="off">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="text" class="form-control" id="usuario_log" name="usuario_log" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <input type="password" class="form-control" id="clave_log" name="clave_log" placeholder="name@example.com">
</div><!-- Submit button -->
            <button type="submit " class="btn btn-primary btn-block mb-4 btnLogin ">
              Iniciar sesion
            </button>

        </div>
        </form>

        <?php

  if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
    require_once "./controllers/LoginController.php";
    $ins_login = new LoginController();

    echo $ins_login->iniciar_sesion_controller();
  }

  ?>
