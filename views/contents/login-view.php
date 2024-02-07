<form action="" method="POST" autocomplete="off">
  <div class="container">
    <div class="containerForm">
      <i class="iconForm"></i>
      <h2>Restaurante Halau</h2>
      <div class="inputContainer">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input type="text" class="form-control" id="usuario_log" name="usuario_log" placeholder="name@example.com">
      </div>
      <div class="inputContainer">
        <label for="exampleFormControlTextarea1" class="form-label">Password</label>
        <input type="password" class="form-control" id="clave_log" name="clave_log" placeholder="*********">
      </div><!-- Submit button -->
      <button type="button" class="btn btn-primary" id="mostrarContraseña">Mostrar contraseña</button>
      <button type="submit " class="btn btn-primary btnWidth">
        Iniciar sesion
      </button>
    </div>
  </div>
</form>

<?php

if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
  require_once "./controllers/LoginController.php";
  $ins_login = new LoginController();

  echo $ins_login->iniciar_sesion_controller();
}

?>

<script>
  document.getElementById('mostrarContraseña').addEventListener('click', function() {
    var contrasenaInput = document.getElementById('clave_log');
    if (contrasenaInput.type === 'password') {
      contrasenaInput.type = 'text';
      this.textContent = 'Ocultar';
    } else {
      contrasenaInput.type = 'password';
      this.textContent = 'Mostrar contraseña';
    }
  });
</script>