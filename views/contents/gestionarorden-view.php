<?php 
require_once './config/APP.php';
require_once './controllers/OrdenesController.php';
$cons = new OrdenesController();
$Id_usuario = explode('/', $_GET['views']);
$cons2 = $cons->Listar_editar_orden_Controller($Id_usuario);
?>

<div class="container-fluid py-4 ">
  <div class="row mt-5">
    <div class="col-md-12 mt-4">
    <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
<form class="FormularioAjax" method="POST" action="<?php echo SERVERURL ?>ajax/GestionarOrdenAjax.php">
  <div class="form-group">
    <label for="numero_cliente_orden">Número Identificación</label>
    <input type="text" class="form-control" id="numero_cliente_orden" name="numero_cliente_orden" aria-describedby="emailHelp" value = "<?php print $cons2['numero_cliente_orden']; ?>" placeholder="Enter email" readonly>
    <label for="cliente">Nombre Cliente</label>
    <input type="text" class="form-control" id="cliente" name="cliente" aria-describedby="emailHelp" value = "<?php print $cons2['cliente']; ?>" placeholder="Enter email" readonly>
    <label for="nombre_menu">Pedido Cliente</label>
    <input type="text" class="form-control" id="nombre_menu" name="nombre_menu" aria-describedby="emailHelp" value = "<?php print $cons2['nombre_menu']; ?>" placeholder="Enter email" readonly>
    <label for="hora_pedido_orden">Hora Pedido</label>
    <input type="datetime-local" class="form-control" id="hora_pedido_orden" name="hora_pedido_orden" aria-describedby="emailHelp" value = "<?php print $cons2['hora_pedido_orden']; ?>" placeholder="Enter email" readonly>
    <input type="hidden" class="form-control" id="id_orden" name="id_orden"
                        value="<?php print $cons2['id_orden']; ?>">
                        <input type="hidden" class="form-control" id="numero_cliente_orden" name="numero_cliente_orden"
                        value="<?php print $cons2['numero_cliente_orden']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Código reclamo</label>
    <input type="password" class="form-control" name="codigo_orden" id="codigo_orden" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>