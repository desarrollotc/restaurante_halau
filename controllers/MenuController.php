<?php
if ($peticionAjax) {
    require_once "../models/MenuModel.php";
} else {
    require_once "./models/MenuModel.php";
}

class MenuController extends MenuModel
{
    public function Listar_menu_Controller(){   
        $sqli = new MenuModel();
        $sql = $sqli::Listar_menu_Model()->fetchAll();
        return $sql;
    }
}