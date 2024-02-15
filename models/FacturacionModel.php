<?php
require_once "MainModel.php";

    class FacturacionModel extends MainModel{

        protected static function Excel_documento_facturacion_Model($documento,$fecha_inicio,$fecha_fin){
            $sql = MainModel::conectar()->prepare("SELECT ordenes.id_orden,ordenes.numero_cliente_orden, usuarios.nombre_usuario, ordenes.area_usuario_orden, menu.nombre_menu, menu.precio_menu, ordenes.hora_pedido_orden, ordenes.hora_recogida_orden FROM ordenes JOIN menu ON ordenes.menu_orden = menu.id_menu JOIN usuarios ON ordenes.usuario_orden = usuarios.id_usuario WHERE numero_cliente_orden = :numero_cliente_orden AND hora_pedido_orden BETWEEN :fecha_inicio AND :fecha_fin");
            $sql->bindParam(":numero_cliente_orden",$documento);
            $sql->bindParam(":fecha_inicio",$fecha_inicio);
            $sql->bindParam(":fecha_fin",$fecha_fin);
            $sql->execute();
            return $sql;
        }
    }