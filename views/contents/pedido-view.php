<?php
require_once './config/APP.php';
require_once './controllers/OrdenesController.php';
$destinatario = 'alejandrohenaoo2007.ah@gmail.com';
$asunto = 'PruebaCorreo';
$mensaje = 'Correo con la prueba';
$cons = new OrdenesController();
$cons2 = $cons->Codigo_orden_Controller();
// echo $cons2;
// $cons3 = $cons->Enviar_correo_orden_Controller($destinatario,$asunto,$mensaje);
// echo $cons3;
// $cons3 = $cons->Listar_citas_Controller2();
// print_r($cons3);
?>
<div class="containerPedido">
    <div class="containerTable">
        <table class="table table-striped wdhMax" style="width:100%" id="tabla_inc">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Número identificación</th>
                    <th>Usuario</th>
                    <th>Menú Pedido</th>
                    <th>Hora Del Pedido</th>
                    <th>Estado</th>
                    <th>Hora De Recogida</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
</div>