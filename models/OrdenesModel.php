<?php
require_once "MainModel.php";

class OrdenesModel extends MainModel
{

    protected static function Listar_menu_orden_Model()
    {
        $sql = MainModel::conectar()->prepare("SELECT id_menu, nombre_menu, precio_menu FROM menu WHERE cantidad_menu != 0");
        $sql->execute();
        return $sql;
    }

    protected static function Agregar_orden_Model($datos)
    {
        $sql = MainModel::conectar()->prepare("INSERT INTO ordenes(usuario_orden, menu_orden,codigo_verificacion_orden) VALUES (:usuario_orden, :menu_orden,:codigo_verificacion_orden)");
        $sql->bindParam(":usuario_orden", $datos['usuario_orden']);
        $sql->bindParam(":menu_orden", $datos['menu_orden']);
        $sql->bindParam(":codigo_verificacion_orden", $numeroidentificacion);
        return $sql;
    }

    protected static function Actualizar_cantidad_menu_Model($datos){
        $sql = MainModel::conectar()->prepare("UPDATE menu SET cantidad_menu = cantidad_menu - 1 WHERE id_menu = :menu_orden");
        $sql->bindParam(":menu_orden", $datos['menu_orden']);
        return $sql;
    }

}
