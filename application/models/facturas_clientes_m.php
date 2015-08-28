<?php

class facturas_clientes_m extends CI_Model {

    public function getFacturasCliente($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select    B.STAMP FECHA_REPARTO, B.FECHA_VALORIZACION, c.razon_social proveedor,  
                            a.id id_viaje, a.numero_de_viaje, b.id id_reparto, b.id_cliente, d.razon_social cliente,
                            b.id_producto, e.descripcion producto, b.id_variable_logistica, f.peso
                            ,b.cantidad_bultos, b.precio_caja precio_bulto
                            ,b.cantidad_bultos * b.precio_caja valor_total
                            ,(	select ifnull(sum(monto_pagado),0) 
                                    from pagos_cliente_REPARTO pcv 
                                    where pcv.id_REPARTO = b.id 
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
   
}
