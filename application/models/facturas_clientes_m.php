<?php

class facturas_clientes_m extends CI_Model {

    public function getFacturasCliente($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select    B.stamp fecha_reparto, b.fecha_valorizacion, c.razon_social proveedor,  
                            a.id id_viaje, a.numero_de_viaje, b.id id_reparto, b.id_cliente, d.razon_social cliente,
                            b.id_producto, e.descripcion producto, b.id_variable_logistica, f.peso
                            ,b.cantidad_bultos, b.precio_caja precio_bulto
                            ,b.cantidad_bultos * b.precio_caja valor_total
                            ,(	select ifnull(sum(monto_pagado),0) 
                                    from pagos_cliente_reparto pcv 
                                    where pcv.id_reparto = b.id 
                                    and pcv.id_producto = b.id_producto 
                                    and pcv.id_variable_logistica = b.id_variable_logistica
                             ) monto_pagado
                    from viaje a
                    join reparto b ON a.id = b.id_viaje
                    join proveedor c on a.id_proveedor = c.id
                    join cliente d on b.id_cliente = d.id
					join producto e on b.id_producto = e.id
					join variable_logistica f on b.id_variable_logistica = f.id	
                    where b.id_cliente = ?                    
                    order by a.stamp";
            
            $query = $this->db->query($sql, array($idCliente));
                   
            $lineasFacturas = $query->result_array();

            if( is_array($lineasFacturas) && count($lineasFacturas) > 0 ) {
              return $lineasFacturas;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function getFacturaXId($idPago)
    {
         if($idPago != FALSE) {
          $sql = "select a.*, b.descripcion modo_pago, c.razon_social cliente
                    from pago_cliente a
                    join modo_pago b on a.id_modo_pago = b.id
                    join cliente c on a.id_cliente = c.id
                    where a.id = ?";
            
            $query = $this->db->query($sql, array($idPago));
                   
            $pago = $query->result_array();

            if( is_array($pago) && count($pago) > 0 ) {
              return $pago;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function getMontoFacturado($idPago)
    {
         if($idPago != FALSE) {
          $sql = "SELECT ifnull(sum(monto_pagado),0) montoImputado
                    FROM pagos_cliente_reparto
                    where id_pago = ?";
            
            $query = $this->db->query($sql, array($idPago));
                   
            $pago = $query->result_array();

            if( is_array($pago) && count($pago) > 0 ) {
              return $pago;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function getLineasCCC($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select 'PRODUCTOS' tipo, b.id id_linea, b.stamp fecha, B.fecha_valorizacion, 
                  c.razon_social proveedor,  
                            a.id id_viaje, a.numero_de_viaje, b.id id_reparto, b.id_cliente, d.razon_social cliente,
                            b.id_producto, e.descripcion producto, b.id_variable_logistica, f.peso
                            ,b.cantidad_bultos, b.precio_caja precio_bulto
                            ,b.cantidad_bultos * b.precio_caja debe
                            ,(	select ifnull(sum(monto_pagado),0) 
                                    from pagos_cliente_reparto pcv 
                                    where pcv.id_reparto = b.id 
                                    and pcv.id_producto = b.id_producto 
                                    and pcv.id_variable_logistica = b.id_variable_logistica
                             ) haber
                    from viaje a
                    join reparto b ON a.id = b.id_viaje
                    join proveedor c on a.id_proveedor = c.id
                    join cliente d on b.id_cliente = d.id
					join producto e on b.id_producto = e.id
					join variable_logistica f on b.id_variable_logistica = f.id	
                    where b.id_cliente = ?                    
                    union
                    select 'PAGOS' tipo, a.id,
                    a.fecha_pago fecha, a.fecha_pago fecha_valorizacion,
                    null proveedor,  
                                                null id_viaje, null numero_de_viaje, null id_reparto, null id_cliente, 
                                                                            null cliente,
                                                null id_producto, 
                                                                            null producto, null id_variable_logistica, null peso
                                                ,null cantidad_bultos, null precio_bulto
                                                ,0 debe,
                    a.monto - ifnull(sum(monto_pagado),0)  haber
                    from pago_cliente a
                    left join pagos_cliente_REPARTO b on a.id = b.id_pago
                    where a.id_cliente = ?
                    group by a.id, a.fecha_pago, a.monto
                    having a.monto - ifnull(sum(monto_pagado),0) != 0
                    ORDER BY 4 ASC";
            
            $query = $this->db->query($sql, array($idCliente, $idCliente));
                   
            $lineasFacturas = $query->result_array();

            if( is_array($lineasFacturas) && count($lineasFacturas) > 0 ) {
              return $lineasFacturas;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
   
}
