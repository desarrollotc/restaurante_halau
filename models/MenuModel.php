<?php
require_once "MainModel.php";

class MenuModel extends MainModel
{
    protected static function Listar_menu_Model()
    {
        $sql = MainModel::conectar()->prepare("SELECT * FROM menu");
        $sql->execute();
        return $sql;
    }

    protected static function Listar_editar_menu_Model($datos){
        $sql = MainModel::conectar()->prepare("SELECT * FROM menu WHERE id_menu = :id_menu");
        $sql->bindParam(":id_menu",$datos);
        $sql->execute();
        return $sql;
    }

    protected static function Actualizar_menu_Model($datos,$precio){
        $sql = MainModel::conectar()->prepare("UPDATE menu SET nombre_menu = :nombre_menu, precio_menu = :precio_menu, cantidad_menu = :cantidad_menu WHERE id_menu = :id_menu");
        $sql->bindParam("nombre_menu", $datos['nombre_menu']);
        $sql->bindParam("precio_menu", $precio);
        $sql->bindParam("cantidad_menu", $datos['cantidad_menu']);
        $sql->bindParam("id_menu", $datos['id_menu']);
        return $sql;
    }

    protected static function Cambiar_estado_model($datos){
        $sql = MainModel::conectar()->prepare("UPDATE menu SET estado_menu = :estado_menu WHERE id_menu = :id_menu");
        $sql->bindParam(":estado_menu", $datos[2]);
        $sql->bindParam(":id_menu", $datos[1]);
        $sql->execute();
        return $sql;
    }
}