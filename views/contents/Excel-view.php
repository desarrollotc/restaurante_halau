<style>
    th {
  background-color: #6786B8 !important;
  color: white;
  border: 2px solid black;
}
td{
    border: 1px solid black;
}
.text-gradient.text-danger {
    background-image: linear-gradient(310deg,#6786B8,#ff6690) !important;
}
</style>
<?php 
require_once './config/APP.php';
require_once './controllers/FacturacionController.php';
$cons = new FacturacionController();
$info = explode("/",$_GET['views']);


if(count($info) == 4){
    $numero_ide = $info[1];
    $fecha_inicio = $info[2];
    $fecha_fin = $info[3];
    $consulta = $cons->Excel_documento_facturacion_Controller($numero_ide,$fecha_inicio,$fecha_fin);

if(!empty($consulta)){ 
    header("Content-Disposition: attachment; filename=Pedidos_restaurante" .        date('Y:m:d').".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    ?>
    <table>
    <tr>
        <th>Numero Documento</th>
        <th>Nombre Cliente</th>
        <th>Area Cliente</th>
        <th>Menú Pedido</th>
        <th>Precio Menú</th>
        <th>Fecha Pedido</th>
    </tr>


    <?php
    foreach($consulta as $row){ ?>
        <tr>
        <td><?php print $row['numero_cliente_orden'];?></td>
        <td><?php print $row['nombre_usuario'];?></td>
        <td><?php print $row['area_usuario_orden'];?></td>
        <td><?php print $row['nombre_menu'];?></td>
        <td><?php print $row['precio_menu_orden'];?></td>
        <td><?php print $row['hora_pedido_orden'];?></td>
        </tr>

<?php } 
}else{
    include "./views/inc/Scripts.php";
    
    echo '<script> Swal.fire({
        title: "No se encontraron registros.",
        icon: "error",
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: "Aceptar",
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href=`' . SERVERURL .'facturacion`;
        }
      });</script>';
}

}elseif(count($info) == 3){
    $fecha_inicio = $info[1];
    $fecha_fin = $info[2];
    $consulta = $cons->Excel_general_facturacion_Controller($fecha_inicio,$fecha_fin);
    header("Content-Disposition: attachment; filename=Pedidos_restaurante" .        date('Y:m:d').".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");  ?>
<table>
    <tr>
        <th>Numero Documento</th>
        <th>Nombre Cliente</th>
        <th>Area Cliente</th>
        <th>Menú Pedido</th>
        <th>Precio Menú</th>
        <th>Fecha Pedido</th>
    </tr>
    <?php
    foreach($consulta as $row){ ?>
        <tr>
        <td><?php print $row['numero_cliente_orden'];?></td>
        <td><?php print $row['nombre_usuario'];?></td>
        <td><?php print $row['area_usuario_orden'];?></td>
        <td><?php print $row['nombre_menu'];?></td>
        <td><?php print $row['precio_menu_orden'];?></td>
        <td><?php print $row['hora_pedido_orden'];?></td>
        </tr>
<?php
    }
            }else{
        echo "Datos invalidos";
}
?>