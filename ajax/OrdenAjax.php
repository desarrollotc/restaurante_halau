<?php

$peticionAjax=true;

require_once '../config/APP.php';
require_once '../controllers/OrdenesController.php';
$cons = new OrdenesController();



echo $cons->Orden_final_Controller($_POST);


