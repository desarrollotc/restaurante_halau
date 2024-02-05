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
}