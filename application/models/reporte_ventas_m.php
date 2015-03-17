<?php

class reporte_ventas_m extends CI_Model {

    public function getVentasCliente($idCliente, $meses)
    {
         if($idCliente != FALSE) {
            $sql = "select MONTH(stamp) mes, sum(cantidad_bultos) total_bultos, sum(cantidad_pallets) total_pallets, 
                    sum((precio_caja * cantidad_bultos)) total_facturado
                    from reparto
                    where 1 = ?
                    group by MONTH(stamp)
                    order by 1";
            
            $query = $this->db->query($sql, array($idCliente));
                   
            $lineasVentas = $query->result_array();

            if( is_array($lineasVentas) && count($lineasVentas) > 0 ) {
              return $lineasVentas;
            }
            
            return false;
        }
        else {
          return FALSE;
        }  
    }
    
}
