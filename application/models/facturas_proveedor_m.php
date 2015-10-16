<?php

class facturas_proveedor_m extends CI_Model {

    public function getLineasCCP($idProveedor)
    {
         if($idCliente != FALSE) {
          $sql = "select a.fecha_estimada_salida, a.id id_viaje, a.id_proveedor,
                  c.razon_social proveedor,  a.numero_de_viaje,
                    sum((b.cantidad_bultos - b.cant_bultos_merma) * b.precio_caja  ) debe
                    from viaje a
                    join reparto b ON a.id = b.id_viaje
                    join proveedor c on a.id_proveedor = c.id
                    where a.id_proveedor = ?  
                    and b.precio_caja is not null
                    group by a.fecha_estimada_salida
                    ,a.id, a.id_proveedor, c.razon_social,  a.numero_de_viaje
                    ORDER BY 1 ASC, 2 ASC";
            
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
