<?php
require_once "MainModel.php";

class ClienteModel extends MainModel
{
    protected static function Traer_historial_cliente_Model($id){
        $sql = MainModel::conectar()->prepare("SELECT * FROM ordenes WHERE usuario_orden = :usuario_orden");
        $sql->bindParam(":usuario_orden", $id);
        return $sql;
    }
}