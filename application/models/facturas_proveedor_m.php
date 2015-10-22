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
          $sql = "select 'Deuda' tipo, a.fecha_estimada_salida, a.stamp, a.id id_viaje, a.id_proveedor,
                    a.numero_de_viaje,
                    sum((b.cantidad_bultos - b.cant_bultos_merma) * b.precio_caja  ) debe,
                    0 haber
                    from viaje a
                    join reparto b ON a.id = b.id_viaje                    
                    where a.id_proveedor = ?  
                    and b.precio_caja is not null
                    group by a.fecha_estimada_salida
                    ,a.id, a.id_proveedor, a.numero_de_viaje
                    union
                    select 'Pago' tipo, pp.fecha_pago, pp.stamp, pp.id, pp.id_proveedor,
                               null numero_de_viaje, 0 debe, pp.monto haber
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
   

}
