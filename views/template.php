<?php session_start(['name'=>'SPM']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?php echo COMPANY ?></title>

    <link rel="icon" type="image/x-icon" href="<?php echo SERVERURL ?>views/assets/general.png" />
    <?php
   include  './views/inc/Links.php'; 
    ?>
</head>

<body>
    <?php
        $peticionAjax = false;
        require_once './controllers/ViewController.php';
        $IV = new ViewController();
        $View = $IV->Get_views_controller();
        if($View == 'login' || $View == '404'){
            include './views/inc/Scripts.php';
            require_once './views/contents/'. $View . '-view.php';
        }else{
            require_once "./controllers/LoginController.php";
            $lc = new LoginController();
            if(!isset($_SESSION['token_spm']) && !isset($_SESSION['usuario_spm']) && !isset($_SESSION['id_spm'])){
                echo $lc->Forzar_cierre_controller();
                exit();
            }
            $elem_ultimo_vista=explode('/',$View);
      if(end($elem_ultimo_vista)=='home-view.php'){
        include_once "./views/inc/Navbar.php";
        require_once $View;
        include './views/inc/Scripts.php';
}elseif(end($elem_ultimo_vista)=='facturacion-view.php'){
    include "./views/inc/Navbar.php";
    require_once $View;
    include "./views/inc/Scripts.php";
    //include "./views/inc/Citaerrores_op.php";
}elseif(end($elem_ultimo_vista)=='pedido-view.php'){
    include "./views/inc/Navbar.php";
    require_once $View;
    include "./views/inc/Scripts.php";
    include "./views/inc/Pedidos_op.php";
}elseif(end($elem_ultimo_vista)=='cliente-view.php'){
    include "./views/inc/Navbar.php";
    require_once $View;
    include "./views/inc/Scripts.php";
    //include "./views/inc/Citaerrores_op.php";
}elseif(end($elem_ultimo_vista)=='menu-view.php'){
    include "./views/inc/Navbar.php";
    require_once $View;
    include "./views/inc/Scripts.php";
    //include "./views/inc/Citaerrores_op.php";
}elseif(end($elem_ultimo_vista)=='gestionarorden-view.php'){
    include "./views/inc/Navbar.php";
    require_once $View;
    include "./views/inc/Scripts.php";
    //include "./views/inc/Citaerrores_op.php";
}
    include  './views/inc/LogOut.php';
        }


    ?>
</body>