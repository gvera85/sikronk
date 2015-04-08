<?php

class reporte_ventas_m extends CI_Model {

    public function getVentasCliente($idCliente, $meses)
    {
         if($idCliente != FALSE) {
            $sql = "select MONTH(stamp) mes, sum(cantidad_bultos) total_bultos, sum(cantidad_pallets) total_pallets, 
                    sum((precio_caja * cantidad_bultos)) total_facturado
                    from reparto
                    where id_cliente = ?
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
    
    public function getVentasMes($idCliente, $anio, $mes)
    {
         if($idCliente != FALSE) {
            $sql = "select  IFNULL(sum(cantidad_bultos),0) total_bultos, IFNULL(sum(cantidad_pallets),0) total_pallets, 
                    IFNULL(sum((precio_caja * cantidad_bultos)),0) total_facturado
                    from reparto
                    where id_cliente = ?
                    and MONTH(stamp) = ?
                    and	YEAR(stamp) = ?
                    order by 1";
            
            $query = $this->db->query($sql, array($idCliente,$mes,$anio));
                   
            $lineasVentas = $query->row_array();

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
                    a.porcentaje_ganancia,
                    d.numero_de_viaje,
                    date_format(d.fecha_estimada_llegada, '%d-%m-%Y') fecha_estimada_llegada
                    from reparto a
                    join producto b on a.id_producto = b.id
                    join variable_logistica c on a.id_variable_logistica = c.id
                    join viaje d on a.id_viaje = d.id
                    join proveedor e on d.id_proveedor = e.id
                    where d.id_estado = ?
                    and a.id_cliente = ?";
            
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
