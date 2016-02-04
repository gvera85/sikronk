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
    
    public function getLineasCCP($idProveedor)
    {
         if($idProveedor != FALSE) {
            $sql = "    select 'Deuda' tipo, a.fecha_estimada_llegada, a.stamp, a.id id_viaje, a.id_proveedor,
                        a.numero_de_viaje,
                        sum((b.cantidad_bultos - b.cant_bultos_merma) * b.precio_caja  ) - (getMontoGastosProveedor(a.id))debe,
                        0 haber,
                        DATE_FORMAT(a.fecha_estimada_llegada,'%Y%m%d') fecha_cc
                        from viaje a
                        join reparto b ON a.id = b.id_viaje                    
                        where a.id_proveedor = ?  
                        and b.precio_caja is not null
                        group by a.fecha_estimada_llegada
                        ,a.id, a.id_proveedor, a.numero_de_viaje
                    union
                        select 'Pago' tipo, pp.fecha_pago, pp.stamp, null id_viaje, pp.id_proveedor,
                                   null numero_de_viaje, 0 debe, pp.monto haber,
                                   DATE_FORMAT(pp.fecha_pago,'%Y%m%d') fecha_cc
                        from pago_proveedor pp
                        where pp.id_proveedor = ?
                    ORDER BY 2 ASC, 3 ASC";
            
            $query = $this->db->query($sql, array($idProveedor, $idProveedor));
                   
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
    
    
   

}
