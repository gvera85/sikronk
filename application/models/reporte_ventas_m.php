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
    
    public function getLineasVentasCliente($idCliente, $idEstado)
    {
         if($idCliente != FALSE) {
            $sql = "select b.descripcion desc_producto, b.marca, b.calidad, 
                    c.descripcion desc_vl, c.peso, d.numero_de_viaje, d.fecha_estimada_llegada,  
                    e.razon_social,
                    a.id id_reparto,
                    a.stamp,
                    a.id_viaje,
                    a.id_cliente,
                    a.fecha_reparto,
                    a.nro_remito,
                    a.cantidad_bultos,
                    a.cantidad_pallets,
                    a.id_producto,
                    a.id_variable_logistica,
                    a.precio_caja,
                    a.porcentaje_ganancia
                    from reparto a
                    join producto b on a.id_producto = b.id
                    join variable_logistica c on a.id_variable_logistica = c.id
                    join viaje d on a.id_viaje = d.id
                    join proveedor e on d.id_proveedor = e.id
                    where d.id_estado = ?
                    and 1=?";
            
            $query = $this->db->query($sql, array($idEstado, $idCliente ));
                   
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
