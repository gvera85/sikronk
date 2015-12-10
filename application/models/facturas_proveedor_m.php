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
                        sum((b.cantidad_bultos - b.cant_bultos_merma) * b.precio_caja  ) debe,
                        0 haber
                        from viaje a
                        join reparto b ON a.id = b.id_viaje                    
                        where a.id_proveedor = ?  
                        and b.precio_caja is not null
                        group by a.fecha_estimada_llegada
                        ,a.id, a.id_proveedor, a.numero_de_viaje
                    union
                        select 'Pago' tipo, pp.fecha_pago, pp.stamp, null id_viaje, pp.id_proveedor,
                                   null numero_de_viaje, 0 debe, pp.monto haber
                        from pago_proveedor pp
                        where pp.id_proveedor = ?
                    union
                        select 'Gasto' Tipo, b.fecha_estimada_llegada fecha_pago, a.stamp, b.id, b.id_proveedor, 
                        b.numero_de_viaje, 0 debe, precio_unitario * cantidad haber
                        from viaje_gasto a
                        join viaje b on a.id_viaje = b.id
                        where a_cargo_del_proveedor = 1
                        and b.id_proveedor = ?
                    ORDER BY 2 ASC, 3 ASC";
            
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
    
    public function updateMontoTotalPago($montoTotal, $idPago)
    {    
        $data = array(
                'monto' => $montoTotal
             );

        $this->db->where('id', $idPago);
        
        $this->db->update("pago_proveedor", $data); 

    }
   

}