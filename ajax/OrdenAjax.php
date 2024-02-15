<?php

$peticionAjax=true;

require_once '../config/APP.php';
require_once '../controllers/OrdenesController.php';
$cons = new OrdenesController();


// print_r($_POST);
$fecha = getdate();
if($fecha['hours'] < 23 && $fecha['hours'] >= 7 && $fecha['wday'] != 0 && $fecha['wday'] != 6){
    $validado = $cons->Validar_orden_repedita_Controller($_POST);
if(!empty($validado)){
    $alerta=[
        "Alerta"=>'dialogo',
        "Titulo"=>'Solo se puede realizar el pedido una vez al dia',
        "Icono"=>'error',
        "Posicion"=>'center',
        "Boton"=> false,
        "Tempo"=> 2500  
      ];
      echo json_encode($alerta);
         exit();
}else{
    $codigo = $cons->Codigo_orden_Controller();
echo $cons->Orden_final_Controller($_POST,$codigo);

}
}else{
    $alerta=[
                "Alerta"=>'dialogo',
                "Titulo"=>'Solo se podrán hacer pedidos entre las 07:00 a.m y las 10:00 a.m',
                "Icono"=>'error',
                "Posicion"=>'center',
                "Boton"=> false,
                "Tempo"=> 2500  
              ];
              echo json_encode($alerta);
                 exit();
}


