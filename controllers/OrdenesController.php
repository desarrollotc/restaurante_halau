<?php
if ($peticionAjax) {
    require_once "../models/OrdenesModel.php";
    require_once '../views/vendor/autoload.php';
} else {
    require_once "./models/OrdenesModel.php";
    require_once './views/vendor/autoload.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class OrdenesController extends OrdenesModel
{   


    public function Listar_menu_Controller(){   
        $sqli = new OrdenesModel();
        $sql = $sqli::Listar_menu_orden_Model()->fetchAll();
        return $sql;
    }


    public function Orden_final_Controller($datos,$codigo){
        $cons = OrdenesModel::Validar_cantidad_menu_Model($datos);
        if($cons->rowCount() > 0){
            $cons2 = $cons->fetch();
            $precio = $cons2['precio_menu'];
            if($datos['menu_orden'] == 1){
             $ptotal = $precio - 6.000;
            }else{
                $ptotal = $precio - 3.000;
            }
            $conexion = mysqli_connect("localhost", "root", "", "drestaurante");
            mysqli_begin_transaction($conexion);
    
            try{
                $query_insertar = OrdenesController::Agregar_orden_Model($datos,$codigo,$ptotal);
                $query_insertar->execute();
                
                
                $query_actualizar = OrdenesController::Actualizar_cantidad_menu_Model($datos);
                $query_actualizar->execute();
    
                mysqli_commit($conexion);
            }catch(Exception $e){
                mysqli_rollback($conexion);
                echo "Error " . $e->getMessage();
            }  
              mysqli_close($conexion); 
              if($conexion){
                $result = true;
              }else{
                $result = false;
              } 
        }else{

            $result = false;
        }


    return $result;
    
        
    }

    public function Listar_ordenes_Controller($inicio, $registros, $busqueda, $draw, $columnas, $orden){

        

        $registros = MainModel::clean_string($registros);
        $buscar_general = '';
        $buscar_general = $busqueda;
        $buscar_general = MainModel::clean_string($buscar_general);
        $tabla = "";
        $consulta_columnas = '';


        $total = 0;
        $buscarGlobal = $busqueda;
        $buscarColumnas = '';
        $columnasOrdenadas = [];
        $columnasDireccion = [];
        $banderaOrden = false;
        $acumOrdenQuery = '';
        $contTotal = count($orden);
        $cont = 1;
        // $inicio = $inicio == 0 ? $inicio = 1 : $inicio;
        // $inicio = $inicio > 1 ? ($inicio / $registros) + 1 : $inicio;




        
        
        if (count($orden) > 0) {
            $banderaOrden = true;
            $acumOrdenQuery = '  ORDER BY ';
            foreach ($orden as $elementoOrden) {
                $columnasOrdenadas[] =  (int) $elementoOrden['column'];
                $columnasDireccion[] = $elementoOrden['dir'];
            }
        }



        
      

        


        









        if (count($columnas) > 0) {
            foreach ($columnas as $index => $columna) {

                if ($columna['search']['value'] != null) {
                   
                    switch ($columna['data']) {
                        case 'id_orden':

                            
                            $buscarColumnas .= "AND id_orden= '".$columna['search']['value']."'";
                            
                            
                            break;
                            case 'hora_pedido_orden':
                            
                                $betweenDates = explode(' ', $columna['search']['value']);
                                $dateIni = '';
                                $dateFin = '';
                                if (array_key_exists(1, $betweenDates)) {
    
                                    $dateIni = $betweenDates[0];
                                    $dateFin = $betweenDates[1];
    
                                    $consulta_columnas .= " AND  " . "hora_pedido_orden" . " BETWEEN '" . $dateIni . " 00:00:00'  AND '" . $dateFin . " 23:59:59'";
                                    break;
                                }
    
                                $consulta_columnas .= " AND  " . $columna['data'] . " LIKE '%" . $columna['search']['value'] . "%'";
                                
    
                                break;
                            
                            /*case 'PACIENTE':

                            
                            $buscarColumnas .= " AND  abpac.pacnom LIKE '%" . $columna['search']['value'] . "%' 
                            OR abpac.pacap1 LIKE '%" . $columna['search']['value'] . "%'
                            OR abpac.pacap2 LIKE '%" . $columna['search']['value'] . "%'
                            
                            ";

                            break;*/
                            
                             
                

                        default:
                            # code...
                            //$consulta_columnas .= " AND  " . $columna['data'] . " LIKE '%" . $columna['search']['value'] . "%'";
                            break;
                    }


                    // Filtros personalizados dependiendo de la columna 

                }



                if ($banderaOrden) {
                    if (in_array($index, $columnasOrdenadas)) {

                        $indexIndicador = array_search($index, $columnasOrdenadas);
                        $tempDireccion = $columnasDireccion[$indexIndicador];


                        $columnasdatos = $columna['data'] ;
                        if ($cont === intval($contTotal)) {
                            $acumOrdenQuery .= '  ' . $columnasdatos . ' ' . $tempDireccion . '  ';
                            $cont++;
                        } else {
                            $acumOrdenQuery .= '  ' . $columnasdatos . ' ' . $tempDireccion . ' , ';
                            $cont++;
                        }
                    }
                }




            }
        }

        $sql_general = '';
        if (isset($buscar_general) && $buscar_general != "") {

            //
            $sql_general = ' AND 
            (
                usuarios.nombre_usuario LIKE "%' . $busqueda . '%"  OR
            nombre_menu LIKE "%' . $busqueda . '%"   OR 
            numero_cliente_orden LIKE "%' . $busqueda . '%" 
             ) ';
            //



            //
            $consulta = 'SELECT SQL_CALC_FOUND_ROWS ordenes.id_orden as id_orden, ordenes.numero_cliente_orden, usuarios.nombre_usuario as cliente, ordenes.area_usuario_orden, menu.nombre_menu, ordenes.hora_pedido_orden,ordenes.hora_plan_recogida_orden, ordenes.estado_orden, ordenes.hora_recogida_orden FROM `ordenes` JOIN `menu` ON ordenes.menu_orden = menu.id_menu JOIN usuarios ON ordenes.usuario_orden = usuarios.id_usuario WHERE ordenes.id_orden != 0
            ' . $sql_general . ' ' . $consulta_columnas . ' ' .$acumOrdenQuery. ' LIMIT ' . $inicio . ',' . $registros;   

            //


        } else {
            //
            $consulta = 'SELECT SQL_CALC_FOUND_ROWS ordenes.id_orden as id_orden, ordenes.numero_cliente_orden, usuarios.nombre_usuario as cliente, ordenes.area_usuario_orden, menu.nombre_menu, ordenes.hora_pedido_orden,ordenes.hora_plan_recogida_orden, ordenes.estado_orden, ordenes.hora_recogida_orden FROM `ordenes` JOIN `menu` ON ordenes.menu_orden = menu.id_menu JOIN usuarios ON ordenes.usuario_orden = usuarios.id_usuario WHERE ordenes.id_orden != 0
                ' . $consulta_columnas . ' '.$acumOrdenQuery .' LIMIT ' . $inicio . ',' . $registros; 
            //
            
        }

        
        //  echo $consulta;
        $conect = MainModel::conectar();
        $datos = $conect->query($consulta);
        $datos = $datos->fetchAll();
        //
        //
        $total = $conect->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        //

        // echo $total;
        
        $array_final = [];
        $array_final = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'search' => $consulta_columnas,
            'recordsFiltered' => $total,
            'data' => []
        ];

        foreach ($datos as $row) {

            $array_final['data'][] = array(
                'id_orden' => $row['id_orden'],
                'numero_cliente_orden' => $row['numero_cliente_orden'],
                'cliente' => $row['cliente'],
                'area_usuario_orden' => $row['area_usuario_orden'],
                'nombre_menu'=> $row['nombre_menu'],
                'hora_pedido_orden'=> $row['hora_pedido_orden'],
                'hora_plan_recogida_orden' => $row['hora_plan_recogida_orden'],
                'estado_orden'=> $row['estado_orden'],
                'hora_recogida_orden'=> $row['hora_recogida_orden']
            );
        }


        return $array_final;
    
    }

    public function Codigo_orden_Controller(){
        $result = MainModel::generate_cod_random();
        return $result;
    }

    public function Enviar_correo_orden_Controller($destinatario, $asunto, $mensaje){
            $mail = new PHPMailer (true);
            try{
        $mail->isSMTP();
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
         $mail->Username = "enviadodecorreos@gmail.com"; 
        $mail->Password = "wbsw zmfj wkge qjuf";


        
               $mail->setFrom('enviadodecorreos@gmail.com','Medio de envio de correos');
               $mail->addAddress($destinatario);
               $mail->Subject = $asunto;
               $mail->isHTML(true);
               $mail->Body    = $mensaje;
               $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';

               $mail->send();
            }catch(Exception $e){
                echo 'Error al enviar el correo: ', $mail->ErrorInfo;
            }

    }


    public function Listar_editar_orden_Controller($datos){
        $asd = [];
        $sqli = new OrdenesModel();
        $sql = $sqli::Listar_editar_orden_Model($datos)->fetchAll();
        foreach ($sql as $row){
            $asd=[
                'id_orden' => $row['id_orden'],
                'numero_cliente_orden' => $row['numero_cliente_orden'],
                'cliente' => $row['cliente'],
                'nombre_menu'=> $row['nombre_menu'],
                'hora_pedido_orden'=> $row['hora_pedido_orden']
            ]; 
        }
        return $asd;
    }

    public function Validar_gestionar_orden_Controller($datos){
        $sqli = new OrdenesModel();
        $sql = $sqli::Validar_gestionar_orden_Model($datos)->fetchAll();    
        if(!empty($sql)){
            $sql3 = $sqli::Gestionar_orden_Model($datos);
            $sql3->execute();
             if($sql3->rowCount() ==  1){
                $alerta=[
                    "Alerta"=>'limpiar',
                    "Titulo"=>'Gestionado',
                    "Texto"=>"Orden gestionada.",
                    "Icono"=>'success' ,
                    "URL"=>SERVERURL.'pedido/'
    
                  ];
             }else{
                $alerta=[
                    "Alerta"=>'limpiar',
                    "Titulo"=>'Error!',
                    "Texto"=>"No se ha podido gestionar la orden.",
                    "Icono"=>'error' ,
                    "URL"=>SERVERURL.'gestionarorden/' . $datos['id_orden']
    
                  ];
             }
        }else{
            $alerta=[
                "Alerta"=>'limpiar',
                "Titulo"=>'Error!',
                "Texto"=>"El código es incorrecto.",
                "Icono"=>'error' ,
                "URL"=>SERVERURL.'gestionarorden/' . $datos['id_orden']

              ];
        }
         echo  json_encode($alerta);
    }

    public function Validar_orden_repedita_Controller($datos){
        $result = OrdenesModel::Validar_orden_repedita_Model($datos);  
        $result->execute();
        $resultado = $result->fetchAll();
        return $resultado;
    }

    public function Enviar_correo_prueba_orden_Controller($destinatario, $asunto, $mensaje){
        $mail = new PHPMailer (true);
        try{
    $mail->isSMTP();
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
     $mail->Username = "enviadodecorreos@gmail.com"; 
    $mail->Password = "wbsw zmfj wkge qjuf";


    
           $mail->setFrom('enviadodecorreos@gmail.com','Medio de envio de correos');
           $mail->addAddress($destinatario);
           $mail->Subject = $asunto;
           $mail->isHTML(true);
           $mail->Body    = $mensaje;
           $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

           $mail->send();
        }catch(Exception $e){
            echo 'Error al enviar el correo: ', $mail->ErrorInfo;
        }
}

        public function Listar_areas_Controller(){
            $sql = OrdenesModel::Listar_areas_Model()->fetchAll();
            return $sql;
        }

        public function buscar_menu_orden_Controller($datos){
            $sql = OrdenesModel::Buscar_menu_orden_Model($datos)->fetchAll();
            return $sql;
        }

}
