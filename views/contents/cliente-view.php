<?php 
   require_once './config/APP.php'; 
   require_once './controllers/OrdenesController.php';
   $cons = new OrdenesController();
   $cons2 = $cons->Listar_menu_Controller();
 print_r($cons2);
 print_r($_SESSION);

?>

Vista cliente

<form class="FormularioAjax" method="post" action="<?php echo SERVERURL ?>ajax/OrdenAjax.php">
  <div class="form-group">
    <label for="campo1">Email address</label>
    <input type="text" name="usuario_orden" class="form-control" value="<?= $_SESSION['nombre_spm']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" readonly>
  </div>
  <div class="form-group">
    <label for="campo2">Password</label>
    <input type="password" name="campo2" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
   
  <select name="menu_orden" class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <?php foreach ($cons2 as $value) { ?>
  <option value="<?php print $value['id_menu'];?>"><?php print $value['nombre_menu'];?></option> 
  <?php } ?>
</select>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

