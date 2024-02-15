<?php
if ($peticionAjax) {
    require_once "../models/FacturacionModel.php";
} else {
    require_once "./models/FacturacionModel.php";
}

class facturacionController extends FacturacionModel{

    public function Excel_documento_facturacion_Controller($documento,$fecha_inicio,$fecha_fin){
        $sql = FacturacionModel::Excel_documento_facturacion_Model($documento,$fecha_inicio,$fecha_fin)->fetchAll();
        return $sql;
    }
}