<?php

require_once "./models/ViewModel.php";

class ViewController extends ViewModel{
    //*********************Controlador obtener plantilla************************** */
    public function Get_template_controller(){
        return require_once "./views/template.php";

    }
    //*********************Controlador obtener vistas************************** */

    public function Get_views_controller(){
        if(isset($_GET['views'])){
            $ruta=explode("/",$_GET['views']);
            $respuesta=ViewModel::Get_views_model($ruta[0]);
        }else{
            $respuesta='login';

        }
        return $respuesta;
        
    }
}