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
    
    
    
    /******** Proveedores *************/
    
        
    public function getVentasMensualesProveedor($idProveedor)
    {
         if($idProveedor != FALSE) {
             
            $sql = "select a.mes_a_evaluar numero, b.mes,
                    a.anio_a_evaluar anio, 
                    getBultosProveedorMes(?, a.mes_a_evaluar, a.anio_a_evaluar ) total_bultos ,
                    getPalletsProveedorMes(?, a.mes_a_evaluar, a.anio_a_evaluar ) total_pallets ,
                    getVentasProveedorMes(?, a.mes_a_evaluar, a.anio_a_evaluar ) total_facturado,
                    getCantViajesProveedorMes (?, a.mes_a_evaluar, a.anio_a_evaluar ) cant_viajes
                    from mesesParaReporteAnual a
                    join meses b on a.mes_a_evaluar = b.numero_mes
                    order by anio_a_evaluar, mes_a_evaluar";
            
            $query = $this->db->query($sql, array($idProveedor, $idProveedor, $idProveedor, $idProveedor));
                   
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
    
    public function getVentasMensualPorProd($idProveedor, $mes, $anio)
    {
         if($idProveedor != FALSE) {
             
            $sql = "select c.id_producto, d.descripcion, d.marca, d.calidad,
                    count(distinct a.id) cant_viajes,   
                    IFNULL(sum(cantidad_bultos),0) total_bultos	,
                    IFNULL(sum(cantidad_pallets),0) total_pallets,
                    IFNULL(sum((precio_caja * cantidad_bultos)),0) total_facturado	
                    from viaje a
                    join reparto c on c.id_viaje = a.id
                    join producto d on c.id_producto = d.id 
                    where a.id_proveedor = ?
                    and month (a.fecha_estimada_salida) = ?
                    and year (a.fecha_estimada_salida) = ?
                    group by id_producto";
            
            $query = $this->db->query($sql, array($idProveedor, $mes, $anio));
                   
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
    
    public function getViajesProveedor($idProveedor, $mes, $anio)
    {
        $sql = "select a.id id,
                    a.stamp stamp,
                    a.id_proveedor id_proveedor,
                    a.id_distribuidor id_distribuidor,
                    a.fecha_estimada_salida fecha_estimada_salida,
                    a.fecha_estimada_llegada fecha_estimada_llegada,
                    a.patente_semi patente_semi,
                    a.patente_camion patente_camion,
                    a.id_chofer id_chofer,
                    a.id_empresa_transportista id_empresa_transportista,
                    a.numero_de_viaje numero_de_viaje,
                    a.id_estado id_estado,
                    b.razon_social transportista,
                    c.descripcion estado,
                    getMontoViaje(a.id) - getMontoGastosProveedor(a.id) montoViaje
                    from viaje a
                    left join transportista b on a.id_empresa_transportista = b.id
                    join estado c on a.id_estado = c.id
                    where a.id_proveedor = ?
                    and MONTH(a.fecha_estimada_salida) = IFNULL(?,MONTH(a.fecha_estimada_salida))
                    and	YEAR(a.fecha_estimada_salida) = IFNULL(?,YEAR(a.fecha_estimada_salida))";
            
        $query = $this->db->query($sql, array($idProveedor,$mes,$anio));

        $viajes = $query->result_array();

        if( is_array($viajes) && count($viajes) > 0 ) {
          return $viajes;
        }

        return false;
    }
    
    public function getResumenViaje($idViaje)
    {
        $sql = "select a.id, a.numero_de_viaje, a.fecha_estimada_salida,
                getMontoViaje(a.id) valor_mercaderia, 
                getMontoGastosProveedor(a.id) valor_gastos_proveedor,
                getMontoGastosDistribuidor(a.id) valor_gastos_distribuidor
                from viaje a 
                where id = ?";
            
        $query = $this->db->query($sql, $idViaje);

        $viaje = $query->result_array();

        if( is_array($viaje) && count($viaje) > 0 ) {
          return $viaje;
        }

        return false;
    }
    
    public function getGastos($idViaje)
    {
        $sql = "select a.id, a.precio_unitario, a.cantidad, 
                a.a_cargo_del_proveedor, b.descripcion gasto, 
                a.id_modo_pago, c.descripcion modo_pago
                from viaje_gasto a
                join gastos_de_un_viaje b on a.id_gasto = b.id
                join modo_pago c on a.id_modo_pago = c.id
                where id_viaje = ?";
            
        $query = $this->db->query($sql, $idViaje);

        $gastos = $query->result_array();

        if( is_array($gastos) && count($gastos) > 0 ) {
          return $gastos;
        }

        return false;
    }
    
    
    
    
    
    
    
    
}
