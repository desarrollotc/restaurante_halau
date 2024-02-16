<?php
if ($peticionAjax) {
    require_once "../models/ClienteModel.php";
} else {
    require_once "./models/ClienteModel.php";
}

class ClienteController extends ClienteModel
{
        public function Traer_historial_cliente_Controller($inicio, $registros, $busqueda, $draw, $columnas, $orden){
            
            $registros = MainModel::clean_string($registros);
            $buscar_general = '';
            $buscar_general = $busqueda;
            $buscar_general = MainModel::clean_string($buscar_general);
            $tabla = "";
            $consulta_columnas = '';
            session_start(['name'=>'SPM']);
    
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
                nombre_menu LIKE "%' . $busqueda . '%"  
                 ) ';
                //
    
    
    
                //
                $consulta = 'SELECT SQL_CALC_FOUND_ROWS ordenes.id_orden, usuarios.nombre_usuario, menu.nombre_menu, ordenes.precio_menu_orden, ordenes.hora_pedido_orden, ordenes.hora_recogida_orden FROM ordenes JOIN menu ON ordenes.menu_orden = menu.id_menu JOIN usuarios ON ordenes.usuario_orden = usuarios.id_usuario WHERE ordenes.usuario_orden = ' . $_SESSION['id_spm']
                 . $sql_general . ' ' . $consulta_columnas . ' ' .$acumOrdenQuery. ' LIMIT ' . $inicio . ',' . $registros;   
    
                //
    
    
            } else {
                //
                $consulta = 'SELECT SQL_CALC_FOUND_ROWS ordenes.id_orden, usuarios.nombre_usuario, menu.nombre_menu,ordenes.precio_menu_orden, ordenes.hora_pedido_orden, ordenes.hora_recogida_orden FROM ordenes JOIN menu ON ordenes.menu_orden = menu.id_menu JOIN usuarios ON ordenes.usuario_orden = usuarios.id_usuario WHERE ordenes.usuario_orden = ' . $_SESSION['id_spm']
                     . $consulta_columnas . ' '.$acumOrdenQuery .' LIMIT ' . $inicio . ',' . $registros; 
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
                    'nombre_usuario' => $row['nombre_usuario'],
                    'nombre_menu'=> $row['nombre_menu'],
                    'precio_menu_orden'=> $row['precio_menu_orden'],
                    'hora_pedido_orden'=> $row['hora_pedido_orden'],
                    'hora_recogida_orden'=> $row['hora_recogida_orden']
                );
            }
    
    
            return $array_final;
        
        }
    }
