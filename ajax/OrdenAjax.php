<?php

$peticionAjax=true;

require_once '../config/APP.php';
require_once '../controllers/OrdenesController.php';
$cons = new OrdenesController();


// print_r($_POST);

$fecha = getdate();
if($fecha['hours'] <= 23 && $fecha['hours'] >= 7){
    $validado = $cons->Validar_orden_repedita_Controller($_POST);
if(!empty($validado)){
    $alerta=[
        "Alerta"=>'limpiar',
        "Titulo"=>'Error al agregar pedido',
        "Texto"=>"No se puede solicitar mas de una comida al día. ",
        "Icono"=>'error',
        "URL"=>SERVERURL.'cliente/'
      
      ];
      echo json_encode($alerta);
         exit();
}else{
    $codigo = $cons->Codigo_orden_Controller();
echo $cons->Orden_final_Controller($_POST,$codigo);

}
}else{
    $alerta=[
                "Alerta"=>'limpiar',
                "Titulo"=>'Error al enviar pedido',
                "Texto"=>"Solo se podrán hacer pedidos entre las 07:00 a.m y las 10:00 a.m",
                "Icono"=>'error',
                "URL"=>SERVERURL.'cliente/'
                
              ];
              echo json_encode($alerta);
                 exit();
}


