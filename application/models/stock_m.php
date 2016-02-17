<?php

class stock_m extends CI_Model {

    
    public function entregarStockCliente($idCliente, $idProducto, $idVL, $cantidadBultos, $idUsuario)
    {
        
        $sql = "CALL entregar_stock_cliente(?,?,?,?,?)";
         
        if ($this->db->query($sql, array($idCliente, $idProducto, $idVL, $cantidadBultos, $idUsuario)))
        {
            echo 'listo';
        }else{
            show_error('Error!');
        }
    }
    
    public function recibirStockProveedor($idViaje, $idProducto, $idVL, $cantidadBultos, $idUsuario)
    {
        
        $sql = "CALL ingresar_producto_a_stock(?,?,?,?,?)";
         
        if ($this->db->query($sql, array($idViaje, $idProducto, $idVL, $cantidadBultos, $idUsuario)))
        {
            echo 'listo';
        }else{
            show_error('Error!');
        }
    }

   
}
