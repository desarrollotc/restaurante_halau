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
     $cons2 = $cons->Orden_final_Controller($_POST,$codigo);
     if($cons2){
        $alerta=[
            "Alerta"=>'limpiar',
            "Titulo"=>'Se ha enviado el pedido correctamente',
            "Texto"=>"Su codigo de verificacion es: " . $codigo,
            "Icono"=>'success' ,
            "URL"=>SERVERURL.'cliente/'

          ]; 
          $nom_menu = $cons->buscar_menu_orden_Controller($_POST);
          $destinatario = $_POST['correo_cliente'];
          $asunto = "Código De Verificación";
          $mensaje = "<p style='color : #6786B8; font-size : 15px;'>Gracias por usar este medio, su orden fue recibida. <br> 
          Su pedido el dia de hoy fue: ".$nom_menu[0]['nombre_menu']." con un costo de ".$nom_menu[0]['precio_menu'].". <br>
          Su código es : <b style='color : #25346D; font-size : 20px; text-decoration : underline;'> ".$codigo." </b> , con este podrá reclamar su comida.<br>
          La hora para recoger la comida fue seleccionada para : ".$nom_menu[0]['hora_plan_recogida_orden']."<br>
          Si hay algún error con respecto a su orden comuniquese al numero xxxxxxxxx o al correo xxxxxxxxx<br>
          Este correo es unicamente de envio y no se le podrá brindar ayuda por este medio si lo requiere.</p>";
                     $cons->Enviar_correo_orden_Controller($destinatario,$asunto,$mensaje);
        echo json_encode($alerta);
        exit();
     }else{
        $alerta=[
            "Alerta"=>'limpiar',
            "Titulo"=>'No se ha podido recibir su orden',
            "Texto"=>"Ocurrio un error al solicitar el pedido.",
            "Icono"=>'error',
            "URL"=>SERVERURL.'cliente/'

          ];
          echo json_encode($alerta);
          exit();
     }

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


