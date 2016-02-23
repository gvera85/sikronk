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
    
    public function getCantRepartidaDeUnPLUViaje($idViaje, $idProducto, $idVL)
    {
        
        $sql = "select sum(cantidad_bultos) cantidad_bultos
                from reparto 
                where id_viaje = ?
                and id_variable_logistica = ?
                and id_producto = ?";
        
        $query = $this->db->query($sql, array($idViaje, $idProducto, $idVL));
        
        $cantidadBultos = $query->result_array();
            
        if ( is_array($cantidadBultos) && count($cantidadBultos) == 1 )  
        {
            if (empty($cantidadBultos[0]["cantidad_bultos"])) {
                return 0;
            }else{
                return $cantidadBultos[0]["cantidad_bultos"];
            }      
        }
        
        return false;
    }
    
    public function anularRepartoDeStock($idViaje, $idUsuario)
    {
        
        $sql = "CALL anular_reparto_de_stock(?,?)";
         
        if ($this->db->query($sql, array($idViaje, $idUsuario)))
        {
            echo 'listo';
        }else{
            show_error('Error!');
        }
    }
    
    
    
    

   
}
