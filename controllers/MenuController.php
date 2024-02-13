<?php
if ($peticionAjax) {
    require_once "../models/MenuModel.php";
} else {
    require_once "./models/MenuModel.php";
}

class MenuController extends MenuModel
{

    public function Listar_menu_Controller($inicio, $registros, $busqueda, $draw, $columnas, $orden){
        $registros = MainModel::clean_string($registros);
        
        $consulta="SELECT * FROM menu";
        $conect = MainModel::conectar();
        $datos = $conect->query($consulta);
        $datos = $datos->fetchAll();

        foreach ($datos as $row) {

            $array_final[] = array(
                'id_menu' => $row['id_menu'],
                'nombre_menu' => $row['nombre_menu'],
                'precio_menu' => $row['precio_menu'],
                'cantidad_menu'=> $row['cantidad_menu'],
                'estado_menu'=> $row['estado_menu']
            );
        }


        return $array_final;
    
    }

   public function Listar_editar_menu_Controller($datos){
    $asd = [];
    $sql = MenuModel::Listar_editar_menu_Model($datos);
    $sql2 = $sql->fetchAll();
    foreach($sql2 as $row){
        $asd = [
            'id_menu' => $row['id_menu'],
            'nombre_menu' => $row['nombre_menu'],
            'precio_menu' => $row['precio_menu'],
            'cantidad_menu'=> $row['cantidad_menu'],
            'estado_menu'=> $row['estado_menu']
        ];
    }
    return $asd;

   }

   public function Actualizar_menu_Controller($datos){
    $sql = MenuModel::Actualizar_menu_Model($datos);
    $sql->execute();
    if($sql->rowCount() == 1){
        $alerta=[
            "Alerta"=>'limpiar',
            "Titulo"=>'Actualizado!',
            "Texto"=>"Se ha editado la información correctamente.",
            "Icono"=>'success' ,
            "URL"=>SERVERURL.'menu/'

          ];
    }else{
        $alerta=[
            "Alerta"=>'limpiar',
            "Titulo"=>'Error!',
            "Texto"=>"No se ha podido actualizar la información.",
            "Icono"=>'error' ,
            "URL"=>SERVERURL.'menu/'

          ];
    }
    return json_encode($alerta);
   }

   public function Actualizar_estado_menu_Controller($datos) : void{
          MenuModel::Cambiar_estado_model($datos);
   }

}