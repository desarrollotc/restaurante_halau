<?php

class ViewModel{
    protected static function Get_views_model($vistas){
        $List=["home","facturacion","pedido","cliente","menu","gestionarorden","historialcliente","editarmenu","cambioestado","Excel"];
        if(in_array($vistas,$List)){
            if(is_file("./views/contents/".$vistas."-view.php")){
                $contenido = "./views/contents/".$vistas."-view.php";
            }else{
                $contenido="404";
            }
        }elseif($vistas=="login" || $vistas=="index"){
            $contenido="login";
        }else{
            $contenido = "404";
        }
        return $contenido;

    }
}
   