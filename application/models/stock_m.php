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
        $sql = "select a.id_viaje, 
                b.fecha_estimada_llegada, 
                b.fecha_estimada_salida, 
                b.numero_de_viaje, c.razon_social proveedor,
                b.patente_semi patente_semi,
                b.patente_camion patente_camion,
                b.id_chofer id_chofer,
                b.id_empresa_transportista,                    
                b.id_estado id_estado,
                d.razon_social transportista,
                e.descripcion estado,                
                a.cant_real_bultos, a.cant_repartida_bultos,
                a.cant_real_bultos - a.cant_repartida_bultos restan_repartir,
                f.descripcion producto,
                f.marca,
                f.calidad
                from productos_viaje a
                join viaje b on a.id_viaje = b.id
                join proveedor c on b.id_proveedor = c.id
                left join transportista d on b.id_empresa_transportista = d.id
                join estado e on b.id_estado = e.id
                join producto f on a.id_producto = f.id
                where id_producto = ?
                and id_variable_logistica = ?
                and a.cant_repartida_bultos < a.cant_real_bultos";

          $query = $this->db->query($sql, array($idProducto, $idVL));

          $lineasViajes = $query->result_array();

          if( is_array($lineasViajes) && count($lineasViajes) > 0 ) {
            return $lineasViajes;
          }

          return false;
       
    }
    
    

    
    
    
    
    

   
}
