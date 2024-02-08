<?php
$peticionAjax=true;

require_once '../config/APP.php';
require_once '../controllers/OrdenesController.php';
$cons = new OrdenesController();
echo $cons->Validar_gestionar_orden_Controller($_POST);