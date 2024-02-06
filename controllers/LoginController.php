<?php
if($peticionAjax){
    require_once "../models/LoginModel.php";
}else{
    require_once "./models/LoginModel.php";
}

class LoginController extends LoginModel{

    public function iniciar_sesion_controller(){

        $usuario = MainModel::clean_string($_POST['usuario_log']);
        $clave = MainModel::clean_string($_POST['clave_log']);



        

        $datos_login=[
            "usuario"=>$usuario,
            "clave"=>$clave
        ];

         $validaroracle = LoginModel::Validar_oracle_Model($usuario);
        $valsql = [];
         if($validaroracle != [ ]){
            $validarmysql = LoginModel::Validar_usuario_Model($validaroracle);
            $valsql= $validarmysql->fetch();
        if($valsql != [ ]){
                   $datos_cuenta = LoginModel::iniciar_sesion_model($datos_login);
    $row = $datos_cuenta->fetch();
         if($datos_cuenta->rowCount()==1){
             $_SESSION['id_spm']=$row['id_usuario'];
             $_SESSION['nombre_spm']=$row['nombre_usuario'];
             $_SESSION['numero_spm']=$row['numero_usuario'];
             $_SESSION['correo_spm']=$row['correo_usuario'];
             $_SESSION['rol_spm']=$row['rol_usuario'];
             $_SESSION['area_spm']=$row['area_usuario'];
             $_SESSION['token_spm']=md5(uniqid(mt_rand(),true));
             //return json_encode($_SESSION);
             return "<script>  window.location.href='".SERVERURL.$row['area_usuario']."' </script>";
        }else{
            echo '
            <script>
            Swal.fire({
                icon: "error",
                title: "Numero o contraseña incorrectos",
                text: "Error",
                confirmButtonText: "Aceptar",
                cancelButtonText:"Cancelar"
              })
                

            </script>
            
            ';
            exit();
        }
        }else{
            $fnls = [];
            $inserusu = LoginModel::Agregar_usuario_Model($datos_login,$validaroracle);
           $fnls = $inserusu->fetch();
            if(!$fnls){
                $datos_cuenta = LoginModel::iniciar_sesion_model($datos_login);
                $row = $datos_cuenta->fetchAll();
          $_SESSION['id_spm']=$row[0][0];
          $_SESSION['numero_spm']=$row[0][1];
             $_SESSION['nombre_spm']=$row[0][2];
             $_SESSION['correo_spm']=$row[0][3];
             $_SESSION['area_spm']=$row[0][5];
             $_SESSION['rol_spm']=$row[0][6];
             $_SESSION['token_spm']=md5(uniqid(mt_rand(),true));
             //return json_encode($_SESSION);
             return "<script>  window.location.href='".SERVERURL.$_SESSION['area_spm']."' </script>";              
            }else{
  echo '
            <script>
            Swal.fire({
                icon: "error",
                title: "No se ha podido registrar",
                text: "Error",
                confirmButtonText: "Aceptar",
                cancelButtonText:"Cancelar"
              })
                

            </script>
            
            ';
            exit();
            }

        }
            

    }
    else{
        
        echo '
            <script>
            Swal.fire({
                icon: "error",
                title: "Usuario no encontrado",
                text: "Error",
                confirmButtonText: "Aceptar",
                cancelButtonText:"Cancelar"
              })
                

            </script>
            
            ';
            exit();
    }
    }



    public function Forzar_cierre_controller(){
        session_unset();
        session_destroy();
        if(headers_sent()){
            return "<script> window.location.href='".SERVERURL."login/';</script>";
        }else{
            return header("Location:".SERVERURL."login/");
        }
    }

    public function cerrar_sesion_controller(){
        session_start(['name'=>'SPM']);
        $token = MainModel::decryption($_POST['token']);
        $usuario = MainModel::decryption($_POST['numero']);

        if($token == $_SESSION['token_spm'] && $usuario == $_SESSION['numero_spm']){
            session_unset();
            session_destroy();
            $alerta=[
                "Alerta"=>"redireccionar",
                "URL" => SERVERURL."login/"
            ];
        }else{
            $alerta=[
                "Alerta"=>"simple",
                "Titulo" =>"Error",
                "Texto" => "ivjdifjv",
                "Tipo"=>"error"
            ];
        }
        echo json_encode($alerta);
    }

    public function Forzar_cierre_sesion_controller(){
        session_start(['name'=>'SPM']);
         $token=MainModel::decryption($_POST['token']);
         $usuario=$_POST['numero'];
         if($usuario == $_SESSION['numero_spm']){
             session_unset();
             session_destroy();
             $alerta=[
                 "Alerta"=>'redireccionar',
                 "URL"=>SERVERURL.'login'
 
               ]; 
               echo json_encode($alerta);
          
 
         }else{
             $alerta=[
                 "Alerta"=>'simple',
                 "Titulo"=>'Ocurrio un error inesperado'.$usuario,
                 "Texto"=>"No has iniciado",
                 "Icono"=>'error'
 
               ]; 
               echo json_encode($alerta);
             
         }
     }
}