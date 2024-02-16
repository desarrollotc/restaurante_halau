<?php
require_once "MainModel.php";

class OrdenesModel extends MainModel
{

    protected static function Listar_menu_orden_Model()
    {
        $sql = MainModel::conectar()->prepare("SELECT id_menu, nombre_menu, precio_menu FROM menu WHERE cantidad_menu != 0");
        $sql->execute();
        return $sql;
    }

    protected static function Agregar_orden_Model($datos,$codigo,$dto)
    {
        $sql = MainModel::conectar()->prepare("INSERT INTO ordenes(numero_cliente_orden,usuario_orden,area_usuario_orden,hora_plan_recogida_orden,menu_orden,precio_menu_orden,codigo_verificacion_orden) VALUES (:numero_cliente_orden,:usuario_orden, :area_usuario_orden, :hora_plan_recogida_orden, :menu_orden,:precio_menu_orden,:codigo_verificacion_orden)");
        $sql->bindParam(":numero_cliente_orden", $datos['numero_cliente_orden']);
        $sql->bindParam(":usuario_orden", $datos['id_usuario']);
        $sql->bindParam(":menu_orden", $datos['menu_orden']);
        $sql->bindParam(":precio_menu_orden", $dto);     
        $sql->bindParam(":hora_plan_recogida_orden", $datos['hora_recogida_orden']);
        $sql->bindParam(":area_usuario_orden", $datos['area_orden']);
        $sql->bindParam(":codigo_verificacion_orden", $codigo);
        return $sql;
    }

    protected static function Actualizar_cantidad_menu_Model($datos){
        $sql = MainModel::conectar()->prepare("UPDATE menu SET cantidad_menu = cantidad_menu - 1 WHERE id_menu = :menu_orden");
        $sql->bindParam(":menu_orden", $datos['menu_orden']);
        return $sql;
    }

    protected static function Listar_editar_orden_Model($datos){
        $sql = MainModel::conectar()->prepare("SELECT ordenes.id_orden as id_orden, ordenes.numero_cliente_orden, usuarios.nombre_usuario as cliente, menu.nombre_menu, ordenes.hora_pedido_orden, ordenes.estado_orden FROM `ordenes` JOIN `menu` ON ordenes.menu_orden = menu.id_menu JOIN `usuarios` ON ordenes.usuario_orden = usuarios.id_usuario  WHERE ordenes.id_orden = :id_orden");
        $sql->bindParam(":id_orden", $datos);
        $sql->execute();
        return $sql;
    }

    protected static function Validar_gestionar_orden_Model($datos){
        $sql = MainModel::conectar()->prepare("SELECT * FROM ordenes WHERE id_orden = :id_orden AND numero_cliente_orden = :numero_cliente_orden AND codigo_verificacion_orden = :codigo_verificacion_orden ");
        $sql->bindParam(":numero_cliente_orden", $datos['numero_cliente_orden']);
        $sql->bindParam(":codigo_verificacion_orden", $datos['codigo_orden']);
        $sql->bindParam(":id_orden", $datos['id_orden']);
        $sql->execute();
        return $sql;
    }

    protected static function Gestionar_orden_Model($datos){
        $hora_actual =  date('Y-m-d H:i:s');
        $sql = MainModel::conectar()->prepare("UPDATE ordenes SET estado_orden = 1, hora_recogida_orden = :hora_recogida_orden WHERE id_orden = :id_orden AND numero_cliente_orden = :numero_cliente_orden");
        $sql->bindParam(":hora_recogida_orden", $hora_actual);
        $sql->bindParam(":numero_cliente_orden", $datos['numero_cliente_orden']);
        $sql->bindParam(":id_orden", $datos['id_orden']);
        return $sql;
    }

    protected static function Validar_orden_repedita_Model($datos){
        $fecha_actual = date('Y-m-d') . "%";
        $sql = MainModel::conectar()->prepare("SELECT ordenes.id_orden, usuarios.nombre_usuario, menu.nombre_menu, ordenes.hora_pedido_orden FROM ordenes JOIN usuarios ON ordenes.usuario_orden = usuarios.id_usuario JOIN menu ON ordenes.menu_orden = menu.id_menu WHERE usuarios.id_usuario = :id_usuario AND ordenes.hora_pedido_orden LIKE :fecha_orden ");
        $sql->bindParam(":id_usuario", $datos['id_usuario']);
        $sql->bindParam(":fecha_orden", $fecha_actual);
         return $sql;

    }

    protected static function Buscar_menu_orden_Model($datos){
        $sql = MainModel::conectar()->prepare("SELECT menu.nombre_menu, menu.precio_menu, ordenes.hora_plan_recogida_orden FROM `ordenes` JOIN menu ON ordenes.menu_orden = menu.id_menu WHERE menu.id_menu = :id_menu LIMIT 1");
        $sql->bindParam(":id_menu",$datos['menu_orden']);
        $sql->execute();
        return $sql;
    }

    protected static function Listar_areas_Model(){
        $sql = MainModel::conectar()->prepare("SELECT * FROM area_menu");
        $sql->execute();
        return $sql;
    }

    protected static function Validar_cantidad_menu_Model($datos){
        $sql = MainModel::conectar()->prepare("SELECT precio_menu FROM `menu` WHERE id_menu = :id_menu AND cantidad_menu != 0");
        $sql->bindParam(":id_menu",$datos['menu_orden']);
        $sql->execute();
        return $sql;
    }

}
