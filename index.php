<?php

require_once './config/APP.php';
require_once './controllers/ViewController.php';

$template= new ViewController();
$template->Get_template_controller();