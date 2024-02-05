<?php

$peticionAjax=true;

require_once '../config/APP.php';

if(isset($_POST['token']) && isset($_POST['numero'])){
    require_once "../controllers/LoginController.php";
    $ins_login=new LoginController();

    echo $ins_login->Forzar_cierre_sesion_controller();
   
    
    
    
    //


    //
}else{
    session_start(['name'=>'SPM']);
    session_unset();
    session_destroy();
    header('Location: '.SERVERURL."login/");
    exit();

}