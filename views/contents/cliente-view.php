<?php
require_once './config/APP.php';
require_once './controllers/OrdenesController.php';
$cons = new OrdenesController();
$cons2 = $cons->Listar_menu_Controller();
$cons3 = $cons->Listar_areas_Controller();
  
?>

<form class="FormularioAjax" method="post" action="<?php echo SERVERURL ?>ajax/OrdenAjax.php">
  <div class="container height75">
    <div class="containerForm containerGap30">
      <div class="inputContainer">
        <label for="campo1">Cliente</label>
        <input type="text" name="usuario_orden" class="form-control" value="<?= $_SESSION['nombre_spm']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" readonly>
      </div>
      <input type="hidden" class="form-control" id="numero_cliente_orden" name="numero_cliente_orden" value="<?php print $_SESSION['numero_spm']; ?>">
      <input type="hidden" class="form-control" id="correo_cliente" name="correo_cliente" value="<?php print $_SESSION['correo_spm']; ?>">
      <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php print $_SESSION['id_spm']; ?>">
      <div class="inputContainer">
        <label for="">Menú deseado</label>
        <select name="menu_orden" class="form-select" aria-label="Default select example" required>
          <option value="" selected>Seleccione menú deseado</option>
          <?php 
          foreach ($cons2 as $value) { ?>
            <option value="<?php print $value['id_menu']; ?>"><?php print $value['nombre_menu']; ?></option>
          <?php 
        } ?>
        </select>
      </div>
      <div class="inputContainer">
        <label for="">Área</label>
        <select name="area_orden" class="form-select selectSearch" aria-label="Default select example" required>
          <option value="" selected>Seleccione área perteneciente</option>
          <?php 
          foreach ($cons3 as $value2) { ?>
          <option value="<?php print $value2['nombre_area']; ?>"><?php print $value2['nombre_area']; ?></option>
          <?php 
        } ?>
        </select>
      </div>
      <div class="inputContainer">
        <label for="">Hora de recogida</label>
        <select name="hora_recogida_orden" class="form-select" aria-label="Default select example" required>
          <option value="" selected>Seleccione área perteneciente</option>
          <option value="12:00 p.m - 12:30 p.m"> 12:00 p.m - 12:30 p.m</option>
          <option value="12:30 p.m - 13:00 p.m"> 12:30 p.m - 13:00 p.m</option>
          <option value="13:00 p.m - 13:30 p.m"> 13:00 p.m - 13:30 p.m</option>
        </select>
      </div>
   
      <button type="submit " class="btn btn-primary btnWidth">
        Enviar solicitud
      </button>
    </div>
  </div>
</form>
