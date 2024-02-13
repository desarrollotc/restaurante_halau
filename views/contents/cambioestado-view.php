<?php
require_once './config/APP.php';
require_once  './controllers/MenuController.php'; 
$id_menu = explode("/", $_GET['views']);
$cons = new MenuController();
$cons->Actualizar_estado_menu_Controller($id_menu);
header('Location: ' . SERVERURL."menu");
