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
    echo $resultado = $insususarios->Actualizar_menu_Controller($_POST);

}