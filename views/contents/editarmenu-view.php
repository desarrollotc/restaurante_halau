<?php
require_once './config/APP.php';
require_once './controllers/MenuController.php';
$url = explode("/", $_GET['views']);
$datos1 = base64_decode($url[1]);
$datos2 = json_decode($datos1);
$cons = new MenuController();
$cons2 = $cons->Listar_editar_menu_Controller($datos2);
if(!empty($cons2)){ ?>
<div class="containerFormsGeneral">
  <div class="containerGestionOrden">
    <form class="FormularioAjax GestionOrden" method="POST" action="<?php echo SERVERURL ?>ajax/ListarmenuAjax.php">
      <label for="cliente">Nombre Menú</label>
      <input type="text" class="form-control" id="nombre_menu" name="nombre_menu" aria-describedby="emailHelp" value="<?php print $cons2['nombre_menu']; ?>" placeholder="Enter email">
      <label for="nombre_menu">Precio Menú</label>
    <input type="text" pattern="[0-9]*\.?[0-9]*" class="form-control" id="precio_menu" name="precio_menu" aria-describedby="emailHelp" value="<?php print $cons2['precio_menu']; ?>" placeholder="Enter email">
      <label for="hora_pedido_orden">Cantidad</label>
      <input type="number" class="form-control" id="cantidad_menu" name="cantidad_menu" aria-describedby="emailHelp" value="<?php print $cons2['cantidad_menu']; ?>" placeholder="Enter email">
      <input type="hidden" class="form-control" id="estado_menu" name="estado_menu" value="<?php print $cons2['estado_menu']; ?>">
      <input type="hidden" class="form-control" id="id_menu" name="id_menu" value="<?php print $cons2['id_menu']; ?>">
      <button type="submit" class="btn btn-primary btnClose">Editar Menú</button>
    </form>
  </div>
</div>

<?php 
}else{
    echo "<script>  window.location.href='".SERVERURL."menu/'; </script>";    
}
?>

