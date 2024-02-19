<?php

$peticionAjax=true;

require_once '../config/APP.php';
include "../controllers/MenuController.php";
        $insususarios = new MenuController();
if(isset($_POST['draw'])){
    if(array_key_exists('draw',$_POST)){
         

        $inicio=$_POST['start'];
        $registros=$_POST['length'];
        $busqueda='';
        $busqueda=$_POST['search']['value'];
        $dibujos=$_POST['draw'];
        $columnas=[];
        if(array_key_exists('columns',$_POST)){
          $columnas=$_POST['columns'];
        } 
        $order=[];
        if(array_key_exists('order',$_POST)){
          $orden=$_POST['order'];
        }
        
        //$obtenercita = $insususarios->Listarusuarios2();
        $obtenercita = $insususarios->Listar_menu_Controller($inicio, $registros, $busqueda, $dibujos, $columnas, $orden);

       echo json_encode($obtenercita);

    }
}else{
  $precio_str = $_POST['precio_menu'];
  $num = strpos($precio_str,'.');
  if($num){
    $num_final = explode(".",$precio_str);
    if(strlen($num_final[1]) == 3){
      echo $resultado = $insususarios->Actualizar_menu_Controller($_POST,$precio_str);
    }else{
      $alerta=[
        "Alerta"=>'dialogob',
        "Titulo"=>'Ingrese un valor valido',
        "Icono"=>'error',
        "Posicion"=>'center',
        "Boton"=> false,
        "Tempo"=> 2500,
        "Progress"=> true
      ];
      echo json_encode($alerta);
      exit();
    }
  }else{
    $conv_int  = intval($precio_str,10);
  if(is_int($conv_int)){
    $precio_final = number_format($conv_int,0,",",".");
    echo $resultado = $insususarios->Actualizar_menu_Controller($_POST,$precio_final);
  }else{
    echo "error";
  }
}
}