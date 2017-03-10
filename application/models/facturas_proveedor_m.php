<?php

class facturas_proveedor_m extends CI_Model {

    public function getProveedorXId($idProveedor)
    {
        $sql = "select * from proveedor where id = ?";
            
        $query = $this->db->query($sql, $idProveedor);

        $proveedor = $query->result_array();

        if( is_array($proveedor) && count($proveedor) > 0 ) {
          return $proveedor;
        }

        return false;
    }
    
    public function getDistribuidorXId($idDistribuidor)
    {
        $sql = "select * from distribuidor where id = ?";
            
        $query = $this->db->query($sql, $idDistribuidor);

        $Distribuidor = $query->result_array();

        if( is_array($Distribuidor) && count($Distribuidor) > 0 ) {
          return $Distribuidor;
        }

        return false;
    }
    
    public function getLineasCCP($idProveedor)
    {
         if($idProveedor != FALSE) {
            $sql = "    
                    SELECT @rownum:=@rownum + 1 as row_number, 
                    t.*
                    FROM ( 
                        select b.id id_linea, 'Deuda' tipo, a.fecha_estimada_llegada, a.stamp, a.id id_viaje, a.id_proveedor,
                            a.numero_de_viaje,
                            sum((b.cantidad_bultos - ifnull(b.cant_bultos_merma_prov,0)) * b.precio_sugerido_caja  ) - (getMontoGastosProveedor(a.id))debe,
                            0 haber,
                            DATE_FORMAT(a.fecha_estimada_llegada,'%Y%m%d') fecha_cc
                            from viaje a
                            join reparto b ON a.id = b.id_viaje                    
                            where a.id_proveedor = ?  
                            and b.precio_sugerido_caja is not null
                            group by a.fecha_estimada_llegada
                            ,a.id, a.id_proveedor, a.numero_de_viaje
                        union
                            select pp.id id_linea, 'Pago' tipo, pp.fecha_pago, pp.stamp, null id_viaje, pp.id_proveedor,
                                       null numero_de_viaje, 0 debe, pp.monto haber,
                                       DATE_FORMAT(pp.fecha_pago,'%Y%m%d') fecha_cc
                            from pago_proveedor pp
                            where pp.id_proveedor = ?
                        union
                            select a.id, c.descripcion tipo, b.fecha_estimada_llegada, a.stamp, b.id id_viaje, a.id_proveedor_de_servicios id_proveedor,
                            b.numero_de_viaje,
                            (precio_unitario * cantidad) debe,
                            0 haber,
                            DATE_FORMAT(b.fecha_estimada_llegada,'%Y%m%d') fecha_cc
                            from viaje_gasto a
                            join viaje b on a.id_viaje = b.id
                            join gastos_de_un_viaje c on a.id_gasto = c.id
                            where a.id_proveedor_de_servicios = ?
                        ORDER BY 3 ASC, 4 ASC
                    ) t,
                    (SELECT @rownum := 0) r;";
            
            $query = $this->db->query($sql, array($idProveedor, $idProveedor, $idProveedor));
                   
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
                    from pagos_proveedor_lineas 
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
    
    public function getMontoTotalCredito($idCredito)
    {
         if($idCredito != FALSE) {
            $sql = "select sum(importe) monto_total
                    from lineas_credito 
                    where id_credito = ?";
            
            $query = $this->db->query($sql, array($idCredito));
            
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
    
    
    
    public function updateMontoTotalCredito($montoTotal, $idCredito)
    {    
        $data = array(
                'monto' => $montoTotal
             );

        $this->db->where('id', $idCredito);
        
        $this->db->update("cabecera_credito", $data); 

    }
    
    public function getMontoTotalDebito($idDebito)
    {
         if($idDebito != FALSE) {
            $sql = "select sum(importe) monto_total
                    from lineas_debito 
                    where id_debito = ?";
            
            $query = $this->db->query($sql, array($idDebito));
            
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
    
    
    
    public function updateMontoTotalDebito($montoTotal, $idDebito)
    {    
        $data = array(
                'monto' => $montoTotal
             );

        $this->db->where('id', $idDebito);
        
        $this->db->update("cabecera_debito", $data); 

    }
    
    public function updateMontoTotalPago($montoTotal, $idPago)
    {    
        $data = array(
                'monto' => $montoTotal
             );

        $this->db->where('id', $idPago);
        
        $this->db->update("pago_proveedor", $data); 

    }
    
    public function getDatosCheque($idChequeCliente)
    {    
        $sql = "select * from pagos_clientes_lineas where id = ?";
            
        $query = $this->db->query($sql, $idChequeCliente);

        $cheque = $query->result_array();
        
        if( is_array($cheque) && count($cheque) > 0 ) {
          return $cheque;
        }

        return false;
    }
    
    public function getDatosChequeDistribuidor($idChequeCliente)
    {    
        $sql = "select * from cheque_distribuidor where id = ?";
            
        $query = $this->db->query($sql, $idChequeCliente);

        $cheque = $query->result_array();
        
        if( is_array($cheque) && count($cheque) > 0 ) {
          return $cheque;
        }

        return false;
    }
    
    public function getEstado($idEstado)
    {    
        $sql = "select * from estado where id = ?";
            
        $query = $this->db->query($sql, $idEstado);

        $estado = $query->result_array();
        
        if( is_array($estado) && count($estado) > 0 ) {
          return $estado;
        }

        return false;
    }
    
    public function getChequeProveedor($idCheque)
    {    
        $sql = "select * from pagos_proveedor_lineas where id = ?";
            
        $query = $this->db->query($sql, $idCheque);

        $cheque = $query->result_array();
        
        if( is_array($cheque) && count($cheque) > 0 ) {
          return $cheque;
        }

        return false;
    }
    
    public function getChequeCredito($idCheque)
    {    
        $sql = "select * from lineas_credito where id = ?";
            
        $query = $this->db->query($sql, $idCheque);

        $cheque = $query->result_array();
        
        if( is_array($cheque) && count($cheque) > 0 ) {
          return $cheque;
        }

        return false;
    }
    
    public function getChequeDebito($idCheque)
    {    
        $sql = "select * from lineas_debito where id = ?";
            
        $query = $this->db->query($sql, $idCheque);

        $cheque = $query->result_array();
        
        if( is_array($cheque) && count($cheque) > 0 ) {
          return $cheque;
        }

        return false;
    }
    
    public function getLineasSinValorizar($idProveedor)
    {
         if($idProveedor != FALSE) {
          $sql = "select  a.fecha_estimada_llegada, 
                a.id id_viaje, a.numero_de_viaje, a.numero_de_remito, b.id_producto, e.descripcion producto, 
		e.marca, e.calidad, b.id_variable_logistica, f.peso, sum(b.cantidad_bultos) cantidad_bultos,
                sum(b.cant_bultos_merma_prov) cantidad_bultos_merma
                    from viaje a
                    join reparto b ON a.id = b.id_viaje
                    join proveedor c on a.id_proveedor = c.id
                    join cliente d on b.id_cliente = d.id
                    join producto e on b.id_producto = e.id
                    join variable_logistica f on b.id_variable_logistica = f.id
                    where a.id_proveedor = ?
                    and b.precio_sugerido_caja is null
                    and b.fecha_reparto is not null
                group by a.fecha_estimada_llegada, 
                a.id, a.numero_de_viaje, b.id_producto, e.descripcion, 
		e.marca, e.calidad, b.id_variable_logistica, f.peso";
            
            $query = $this->db->query($sql, array($idProveedor));
                   
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
