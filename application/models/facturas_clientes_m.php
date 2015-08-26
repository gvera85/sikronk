<?php

class facturas_clientes_m extends CI_Model {

    public function getFacturasCliente($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select c.razon_social proveedor,  a.id id_viaje, a.numero_de_viaje, b.id_cliente, d.razon_social cliente, 
                    sum(b.cantidad_bultos * b.precio_caja) valor_total,	
                    (select ifnull(sum(monto_pagado),0) from pagos_clientes_viajes pcv where pcv.id_viaje = a.id) monto_pagado
                    from viaje a
                    JOIN reparto b ON a.id = b.id_viaje
                    join proveedor c on a.id_proveedor = c.id
                    join cliente d on b.id_cliente = d.id
                    where b.id_cliente = ?
                    group by c.razon_social,  a.id, a.numero_de_viaje, b.id_cliente, d.razon_social
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
                    FROM pagos_clientes_viajes
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
