<?php

class facturas_clientes_m extends CI_Model {

    public function getFacturasCliente($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select    b.fecha_reparto, b.fecha_valorizacion, c.razon_social proveedor,  
                            a.id id_viaje, a.numero_de_viaje, b.id id_reparto, b.id_cliente, d.razon_social cliente,
                            b.id_producto, e.descripcion producto, b.id_variable_logistica, f.peso
                            ,b.cantidad_bultos, b.precio_caja precio_bulto
                            ,(b.cantidad_bultos - b.cant_bultos_merma) * b.precio_caja valor_total
                            ,(	select ifnull(sum(monto_pagado),0) 
                                    from pagos_cliente_reparto pcv 
                                    where pcv.id_reparto = b.id 
                                    and pcv.id_producto = b.id_producto 
                                    and pcv.id_variable_logistica = b.id_variable_logistica
                             ) monto_pagado, b.cant_bultos_merma
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
                    left join modo_pago b on a.id_modo_pago = b.id
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
          $sql = "select 'Entrega' tipo, b.id id_linea, a.fecha_estimada_llegada , b.fecha_valorizacion, b.fecha_reparto fecha,
                  c.razon_social proveedor,  
                            a.id id_viaje, a.numero_de_viaje, b.id id_reparto, b.id_cliente, d.razon_social cliente,
                            b.id_producto, e.descripcion producto, b.id_variable_logistica, f.peso
                            ,b.cantidad_bultos, b.cant_bultos_merma, b.precio_caja precio_bulto
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
                    and b.precio_caja is not null
                    union
                    select 'Pago' tipo, a.id,
                    a.fecha_pago fecha, a.fecha_pago fecha_valorizacion,
                    null proveedor,  
                    null id_viaje, null numero_de_viaje, null id_reparto, null id_cliente, 
                    null cliente,
                    null id_producto, 
                    '-' producto, null id_variable_logistica, '-' peso
                    ,'-' cantidad_bultos
                    ,'-' cant_bultos_merma,
                    null precio_bulto
                    ,0 debe,
                    a.monto - ifnull(sum(monto_pagado),0)  haber
                    from pago_cliente a
                    left join pagos_cliente_reparto b on a.id = b.id_pago
                    where a.id_cliente = ?
                    group by a.id, a.fecha_pago, a.monto
                    having a.monto - ifnull(sum(monto_pagado),0) != 0
                    ORDER BY 4 ASC, 2 ASC";
            
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
   
    public function getLineasIndependientesCCC($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select 'Entrega' tipo, b.id id_linea, a.fecha_estimada_llegada, b.fecha_valorizacion, b.fecha_reparto fecha,
                  c.razon_social proveedor,  
                            a.id id_viaje, a.numero_de_viaje, b.id id_reparto, b.id_cliente, d.razon_social cliente,
                            b.id_producto, e.descripcion producto, b.id_variable_logistica, f.peso
                            ,b.cantidad_bultos, b.cant_bultos_merma, b.precio_caja precio_bulto
                            ,(b.cantidad_bultos - b.cant_bultos_merma )* b.precio_caja debe
                            ,0 haber
                    from viaje a
                    join reparto b ON a.id = b.id_viaje
                    join proveedor c on a.id_proveedor = c.id
                    join cliente d on b.id_cliente = d.id
					join producto e on b.id_producto = e.id
					join variable_logistica f on b.id_variable_logistica = f.id	
                    where b.id_cliente = ?    
                    and b.precio_caja is not null
                    union
                    select 'Pago' tipo, a.id, a.fecha_pago fecha_estimada_llegada, a.fecha_pago fecha, a.fecha_pago,
                    null proveedor,  
                    null id_viaje, null numero_de_viaje, null id_reparto, null id_cliente, 
                    null cliente,
                    null id_producto, 
                    '-' producto, null id_variable_logistica, '-' peso
                    ,'-' cantidad_bultos
                    ,'-' cant_bultos_merma,
                    null precio_bulto
                    ,0 debe,
                    a.monto  haber
                    from pago_cliente a
                    where a.id_cliente = ?
                    ORDER BY 4 ASC, 2 ASC";
            
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
    
    public function getLineasSinValorizar($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select b.id id_linea, a.fecha_estimada_llegada , b.fecha_reparto fecha,
			c.razon_social proveedor,  
                        a.id id_viaje, a.numero_de_viaje, b.id id_reparto, b.id_cliente, 
			d.razon_social cliente,
                        b.id_producto, e.descripcion producto, e.marca, e.calidad, b.id_variable_logistica, f.peso
                        ,b.cantidad_bultos                         
                    from viaje a
                    join reparto b ON a.id = b.id_viaje
                    join proveedor c on a.id_proveedor = c.id
                    join cliente d on b.id_cliente = d.id
                    join producto e on b.id_producto = e.id
                    join variable_logistica f on b.id_variable_logistica = f.id	
                    where b.id_cliente = ?
                    and b.precio_caja is null
                    and b.fecha_reparto is not null";
            
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
    
    public function getMontoTotal($idPago)
    {
         if($idPago != FALSE) {
            $sql = "select sum(importe) monto_total
                    from pagos_clientes_lineas 
                    where id_pago = ?";
            
            $query = $this->db->query($sql, array($idPago));
            
            $monto = $query->result_array();
            
            
             if ( is_array($monto) && count($monto) == 1 )  {
              
              if (empty($monto[0]["monto_total"])) {
                  return 0;
              }else{
                  return $monto[0]["monto_total"];
              }
              
            }
            else{
              return 0;
            }
        }else {
          return FALSE;
        }    
            
        
       
    }
    
    public function updateMontoTotalPago($montoTotal, $idPago)
    {    
        $data = array(
                'monto' => $montoTotal
             );

        $this->db->where('id', $idPago);
        
        $this->db->update("pago_cliente", $data); 

    }
    
    public function getClienteXId($idCliente)
    {
         if($idCliente != FALSE) {
          $sql = "select a.* 
                    from cliente a
                    where a.id = ?";
            
            $query = $this->db->query($sql, array($idCliente));
                   
            $cliente = $query->result_array();

            if( is_array($cliente) && count($cliente) > 0 ) {
              return $cliente;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
}
