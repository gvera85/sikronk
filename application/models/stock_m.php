<?php

class stock_m extends CI_Model {

    
    public function entregarStockCliente($idCliente, $idProducto, $idVL, $cantidadBultos, $idUsuario)
    {
        
        $sql = "CALL entregar_stock_cliente(?,?,?,?,?)";
         
        if ($this->db->query($sql, array($idCliente, $idProducto, $idVL, $cantidadBultos, $idUsuario)))
        {
            return true;
        }else{
            show_error('Error!');
            return false;
        }
    }
    
    public function recibirStockProveedor($idViaje, $idProducto, $idVL, $cantidadBultos, $idUsuario)
    {
        
        $sql = "CALL ingresar_producto_a_stock(?,?,?,?,?)";
         
        if ($this->db->query($sql, array($idViaje, $idProducto, $idVL, $cantidadBultos, $idUsuario)))
        {
           return true;
        }else{
            show_error('Error!');
            return false;
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
            return true;
        }else{
            show_error('Error!');
            return false;
        }
    }
    
    public function actualizarCantidadReparto ($idViaje)
    {
        
        $sql = "CALL actualizar_cantidad_repartida(?)";
         
        if ($this->db->query($sql, array($idViaje)))
        {
            return true;
        }else{
            show_error('Error!');
            return false;
        }
    }
    
    
    public function getStockProductos()
    {
         
        $sql = "select * from vw_stock
                where 1 = ?
                order by stock_en_pallets";

          $query = $this->db->query($sql, array(1));

          $lineasStock = $query->result_array();

          if( is_array($lineasStock) && count($lineasStock) > 0 ) {
            return $lineasStock;
          }

          return false;
        
       
    }
    
    public function getViajeProductoSinRepartir($idProducto, $idVL )
    {    
        $sql = "select * 
                from vw_productos_sin_repartir
                where id_producto = ?
                and id_variable_logistica = ?";

          $query = $this->db->query($sql, array($idProducto, $idVL));

          $lineasViajes = $query->result_array();

          if( is_array($lineasViajes) && count($lineasViajes) > 0 ) {
            return $lineasViajes;
          }

          return false;
       
    }
    
    public function getProductosSinRepartir($idProveedor)
    {    
        $sql = "select * 
                from vw_productos_sin_repartir
                where id_proveedor = ?";

          $query = $this->db->query($sql, array($idProveedor));

          $lineasViajes = $query->result_array();

          if( is_array($lineasViajes) && count($lineasViajes) > 0 ) {
            return $lineasViajes;
          }

          return false;
       
    }
   
}
