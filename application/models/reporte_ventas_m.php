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
    
    
    
    /******** Distribuidores *************/
    
    public function getVentasMensualesProveedor($idProveedor)
    {
         if($idProveedor != FALSE) {
            $sql ="SET lc_time_names = 'es_AR'"; 
            
            $this->db->query($sql);
             
            $sql = "select MONTH(b.fecha_estimada_salida) mes, 
                    DATE_FORMAT(b.fecha_estimada_salida,'%M') mes_letras,
                    sum(cantidad_bultos) total_bultos, sum(cantidad_pallets) total_pallets, 
                    sum((precio_caja * cantidad_bultos)) total_facturado
                    from reparto a
                    join viaje b on a.id_viaje = b.id
                    where id_proveedor = ?
                    and b.id_estado >= 7
                    group by MONTH(b.fecha_estimada_salida)
                    order by 1";
            
            $query = $this->db->query($sql, array($idProveedor));
                   
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
    
    public function getVentasMesProveedor($idProveedor, $anio, $mes)
    {
         if($idProveedor != FALSE) {
            $sql = "select IFNULL(sum(cantidad_bultos),0) total_bultos, IFNULL(sum(cantidad_pallets),0) total_pallets, 
                    IFNULL(sum((precio_caja * cantidad_bultos)),0) total_facturado
                    from reparto a
                    join viaje b on a.id_viaje = b.id
                    where b.id_proveedor = ?
                    and MONTH(b.fecha_estimada_salida) = ?
                    and	YEAR(b.fecha_estimada_salida) = ?
                    and b.id_estado >= 7
                    group by MONTH(b.fecha_estimada_salida)
                    order by 1";
            
            $query = $this->db->query($sql, array($idProveedor,$mes,$anio));
                   
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
    
    public function getViajesProveedor($idProveedor)
    {
         if($idProveedor != FALSE) {
            $sql = "select a.id,
                    a.stamp,
                    a.id_proveedor,
                    a.id_distribuidor,
                    a.fecha_estimada_salida,
                    a.fecha_estimada_llegada,
                    a.patente_semi,
                    a.patente_camion,
                    a.id_chofer,
                    a.id_empresa_transportista,
                    a.numero_de_viaje,
                    a.id_estado,
                    b.razon_social transportista,
                    c.descripcion estado
                    from viaje a
                    join transportista b on a.id_empresa_transportista = b.id
                    join estado c on a.id_estado = c.id
                    where a.id_proveedor = ?
                    order by a.fecha_estimada_salida";
            
            $query = $this->db->query($sql, array($idProveedor));
                   
            $viajes = $query->row_array();

            if( is_array($viajes) && count($viajes) > 0 ) {
              return $viajes;
            }
            
            return false;
        }
        else {
          return FALSE;
        }  
    }
    
    
    
    
    
    
    
    
}
