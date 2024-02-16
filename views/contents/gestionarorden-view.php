<?php
require_once './config/APP.php';
require_once './controllers/OrdenesController.php';
$cons = new OrdenesController();
$Id_usuario = explode('/', $_GET['views']);
$datos1 = base64_decode($Id_usuario[1]);
$datos2 = json_decode($datos1);
$cons2 = $cons->Listar_editar_orden_Controller($datos2);
if(!empty($cons2)){ ?>
<div class="containerFormsGeneral">
  <div class="containerGestionOrden">
    <form class="FormularioAjax GestionOrden" method="POST" action="<?php echo SERVERURL ?>ajax/GestionarOrdenAjax.php">
      <label for="numero_cliente_orden">Número Identificación</label>
      <input type="text" class="form-control" id="numero_cliente_orden" name="numero_cliente_orden" aria-describedby="emailHelp" value="<?php print $cons2['numero_cliente_orden']; ?>" placeholder="Enter email" readonly>
      <label for="cliente">Nombre Cliente</label>
      <input type="text" class="form-control" id="cliente" name="cliente" aria-describedby="emailHelp" value="<?php print $cons2['cliente']; ?>" placeholder="Enter email" readonly>
      <label for="nombre_menu">Pedido Cliente</label>
      <input type="text" class="form-control" id="nombre_menu" name="nombre_menu" aria-describedby="emailHelp" value="<?php print $cons2['nombre_menu']; ?>" placeholder="Enter email" readonly>
      <label for="hora_pedido_orden">Hora Pedido</label>
      <input type="date" class="form-control" id="hora_pedido_orden" name="hora_pedido_orden" aria-describedby="emailHelp" value="<?php print $cons2['hora_pedido_orden']; ?>" placeholder="Enter email" readonly>
      <input type="hidden" class="form-control" id="id_orden" name="id_orden" value="<?php print $cons2['id_orden']; ?>">
      <input type="hidden" class="form-control" id="numero_cliente_orden" name="numero_cliente_orden" value="<?php print $cons2['numero_cliente_orden']; ?>">
      <label for="exampleInputPassword1">Código de la orden</label>
      <input type="password" class="form-control" name="codigo_orden" id="codigo_orden" placeholder="******">
      <button type="submit" class="btn btn-primary btnClose">Gestionar orden</button>
    </form>
  </div>
</div>

<?php 
}else{
    echo "<script>  window.location.href='".SERVERURL."pedido/'; </script>";    
}
?>