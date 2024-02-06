<?php

require_once "MainModel.php";

class LoginModel extends MainModel{
   protected static function iniciar_sesion_model($datos){
    $sql = MainModel::conectar()->prepare("SELECT * FROM usuarios WHERE numero_usuario = :usuario_usuario AND clave_usuario = :clave_usuario");
    $sql->bindParam(":usuario_usuario", $datos['usuario']);
    $sql->bindParam(":clave_usuario", $datos['clave']);
    $sql->execute();
    return $sql;
 }

 protected static function Validar_usuario_Model($validaroracle){
   $sql = MainModel::conectar()->prepare("SELECT * FROM usuarios WHERE numero_usuario = :numero_usuario");
   $sql->bindParam(":numero_usuario",$validaroracle[0]['NITNIT']);
   $sql->execute();
   return $sql;
}

   protected static function Validar_oracle_Model($usuario){
      $arrayFinal = [];
      $con_ora = MainModel::conectar_oracle();
        $alter = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY/MM/DD HH24:MI:SS'";
        $stid = oci_parse($con_ora, $alter);
        oci_execute($stid);


        $queryOracle = "select nitnit,nitnom,nitmai
        from conit
        where nitact = 'S'
        and nitnit = " . "'".$usuario."'";
        
        $consulta = oci_parse($con_ora, $queryOracle);
        oci_execute($consulta);

        while (($fila = oci_fetch_assoc($consulta)) != false ) {
               $arrayFinal[] = array(
                  'NITNIT' => $fila['NITNIT'],
                  'NITNOM' => $fila['NITNOM'],
                  'NITMAI' => $fila['NITMAI']
               );}
         
           
            return $arrayFinal;
        
   }
 
   protected static function Agregar_usuario_Model($datos,$validaroracle){
      $sql = MainModel::conectar()->prepare("INSERT INTO usuarios(numero_usuario,nombre_usuario,correo_usuario,clave_usuario) VALUES (:numero_usuario, :nombre_usuario, :correo_usuario, :clave_usuario)");
      $sql->bindParam(":numero_usuario", $datos['usuario']);
      $sql->bindParam(":clave_usuario", $datos['clave']);
      $sql->bindParam(":nombre_usuario", $validaroracle[0]['NITNOM']);
      $sql->bindParam(":correo_usuario", $validaroracle[0]['NITMAI']);
      $sql->execute();
      return $sql;
   }

}