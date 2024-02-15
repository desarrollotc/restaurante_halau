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

    header("Content-Disposition: attachment; filename=Pedidos_restaurante" .        date('Y:m:d').".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    $numero_ide = $info[1];
    $fecha_inicio = $info[2];
    $fecha_fin = $info[3];
    $consulta = $cons->Excel_documento_facturacion_Controller($numero_ide,$fecha_inicio,$fecha_fin);


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
            <td><?php print $row['precio_menu'];?></td>
            <td><?php print $row['hora_pedido_orden'];?></td>
            </tr>

<?php } ?>


<?php
}elseif(count($info) == 3){
    echo "Hizo busqueda sin documento";
}else{
        echo "Datos invalidos";
}
?>