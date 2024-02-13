<?php
require_once './config/APP.php';
require_once './controllers/OrdenesController.php';
$cons = new OrdenesController();
$cons2 = $cons->Listar_menu_Controller();
//  print_r($cons2);
// echo date('Y-m-d');
?>

<form class="FormularioAjax" method="post" action="<?php echo SERVERURL ?>ajax/OrdenAjax.php">
  <div class="container height75">
    <div class="containerForm containerGap30">
      <div class="inputContainer">
        <label for="campo1">Cliente</label>
        <input type="text" name="usuario_orden" class="form-control" value="<?= $_SESSION['nombre_spm']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" readonly>
      </div>
      <!-- <div class="inputContainer">
        <label for="campo2">Código de verificación</label>
        <input type="password" name="campo2" class="form-control" id="exampleInputPassword1" placeholder="*******">
      </div> -->
      <input type="hidden" class="form-control" id="numero_cliente_orden" name="numero_cliente_orden" value="<?php print $_SESSION['numero_spm']; ?>">
      <input type="hidden" class="form-control" id="correo_cliente" name="correo_cliente" value="<?php print $_SESSION['correo_spm']; ?>">
      <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php print $_SESSION['id_spm']; ?>">
      <div class="inputContainer">
        <label for="">Menú deseado</label>
        <select name="menu_orden" class="form-select" aria-label="Default select example" required>
          <option value="" selected>Seleccione menú deseado</option>
          <?php foreach ($cons2 as $value) { ?>
            <option value="<?php print $value['id_menu']; ?>"><?php print $value['nombre_menu']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="inputContainer">
        <label for="">Área</label>
        <select name="menu_orden" class="form-select selectSearch" aria-label="Default select example" required>
          <option value="" selected>Seleccione área perteneciente</option>
          <option value=""> Tecnología</option>
          <option value=""> Cirugía</option>
          <option value=""> Contabilidad</option>
          <option value=""> Recursos humanos</option>
        </select>
      </div>
      <!-- Submit button -->
      <button type="submit " class="btn btn-primary btnWidth">
        Enviar solicitud
      </button>
    </div>
  </div>
</form>
