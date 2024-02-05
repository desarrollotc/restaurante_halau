<?php

require_once "MainModel.php";

class LoginModel extends MainModel{
   protected static function iniciar_sesion_model($datos){
    $sql = MainModel::conectar()->prepare("SELECT * FROM usuarios WHERE usuario_usuario = :usuario_usuario AND clave_usuario = :clave_usuario");
    $sql->bindParam(":usuario_usuario", $datos['usuario']);
    $sql->bindParam(":clave_usuario", $datos['clave']);
    $sql->execute();
    return $sql;
 }
 

}