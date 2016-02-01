<?php

class viaje_m extends CI_Model {

    public function getNroViaje($idProveedor)
    {
         if($idProveedor != FALSE) {
            $sql = "select MAX(IFNULL(numero_de_viaje,0))+1 nro_viaje
                    from viaje
                    where id_proveedor = ?";
            
            $query = $this->db->query($sql, array($idProveedor));
                   
            
            $nroViaje = $query->result_array();
            
             if ( is_array($nroViaje) && count($nroViaje) == 1 )  {
              
              if (empty($nroViaje[0]["nro_viaje"])) {
                  return 1;
              }else{
                  return $nroViaje[0]["nro_viaje"];
              }
              
            }
            else{
              return 0;
            }
        }else {
          return FALSE;
        }    
            
        
       
    }
    
    public function getLineasViaje($idViaje)
    {
         if($idViaje != FALSE) {
          $sql = "select a.id id_linea, d.id id_viaje,  b.id id_producto,  b.descripcion producto, 
                    a.cantidad_bultos, a.cantidad_pallets,
                    a.cant_real_bultos, a.cant_real_pallets,
                    d.numero_de_viaje, e.razon_social proveedor, c.id id_vl,e.id id_proveedor,
                    c.descripcion vl, c.peso, c.base_pallet, c.altura_pallet, c.codigo_vl,
                    getCantBultosPlanificados(d.id, b.id, c.id) cant_bultos_plani,
                    getCantBultosRepartidos(d.id, b.id, c.id) cant_repartida,
                    d.id_estado
                    from productos_viaje a
                    join producto b on a.id_producto = b.id
                    join variable_logistica c on a.id_variable_logistica = c.id
                    join viaje d on a.id_viaje = d.id
                    join proveedor e on d.id_proveedor = e.id
                    where a.id_viaje = ?
                    order by a.id_producto, a.cantidad_bultos ";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            $lineasViaje = $query->result_array();

            if( is_array($lineasViaje) && count($lineasViaje) > 0 ) {
              return $lineasViaje;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function getRepartoViaje($idViaje)
    {
         if($idViaje != FALSE) {
          $sql = "select * 
                    from planificacion_reparto  a
                    join cliente b on a.id_cliente = b.id
                    where id_viaje= ? ";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            $lineasReparto = $query->result_array();

            if( is_array($lineasReparto) && count($lineasReparto) > 0 ) {
              return $lineasReparto;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    
    public function getRepartoConfirmado($idViaje, $idCliente)
    {
         if($idViaje != FALSE) {
          $sql = "select    a.id,
                            a.stamp,
                            id_viaje,
                            id_cliente,
                            fecha_reparto,
                            nro_remito,
                            cantidad_bultos,
                            cantidad_pallets,
                            id_producto,
                            id_variable_logistica,
                            precio_caja,
                            porcentaje_ganancia,
                            b.id id_cliente,
                            b.stamp,
                            razon_social,
                            cuit,
                            direccion_comercial,
                            direccion_descarga,
                            localidad,
                            mercado,
                            id_tipo_iva,
                            id_provincia,
                            codigo_postal,
                            telefono1,
                            telefono2,
                            cant_bultos_merma,
                            id_motivo_merma,
                            fecha_valorizacion, 
                            c.descripcion descripcion_producto,
                            getCantBultosRepartidos(a.id_viaje, a.id_producto, a.id_variable_logistica) cant_repartida
                    from reparto a
                    join cliente b on a.id_cliente = b.id
                    join producto c on a.id_producto = c.id
                    where id_viaje= ? 
                    and a.id_cliente = ifnull(?,a.id_cliente)
                    order by a.fecha_reparto";
            
            $query = $this->db->query($sql, array($idViaje, $idCliente));
                   
            $lineasReparto = $query->result_array();

            if( is_array($lineasReparto) && count($lineasReparto) > 0 ) {
              return $lineasReparto;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function getEstadoActual($idEntidad)
    {    
          if($idEntidad != FALSE) {
          $sql = "SELECT id_estado
                    FROM viaje
                    WHERE id = ? ";
            
            $query = $this->db->query($sql, array($idEntidad));
                   
            $idEstadoActual = $query->result_array();

            if( is_array($idEstadoActual) && count($idEstadoActual) > 0 ) {
              return $idEstadoActual[0]["id_estado"];
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function getEstadoFuturo($idEstadoActual)
    {    
          if($idEstadoActual != FALSE) {
          $sql = "select id_estado_futuro
                  from transiciones_posibles
                  wher id_estado_actual = ? ";
            
            $query = $this->db->query($sql, array($idEstadoActual));
                   
            $idEstadoFuturo = $query->result_array();

            if( is_array($idEstadoFuturo) && count($idEstadoFuturo) > 0 ) {
              return $idEstadoFuturo[0]["id_estado_futuro"];
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    

  
        
    public function getTablayEstadoFuturo($idEstadoActual)
    {    
          if($idEstadoActual != FALSE) {
          $sql = "select id_estado_futuro as id_estado_futuro, nombre_tabla as nombre_tabla
                    from transiciones_posibles a
                    join tipo_estado b on a.id_tipo_estado = b.id
                    where id_estado_actual = ?  ";
            
            $query = $this->db->query($sql, array($idEstadoActual));
                   
            $registro = $query->result_array();

            if( is_array($registro) && count($registro) > 0 ) {
              return $registro[0];
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    

    public function updateEstado($idEntidad, $nombreTabla, $idEstado)
    {    
          if($idEntidad != FALSE) {
            
            $data = array(
                    'id_estado' => $idEstado
                 );

            $this->db->where('id', $idEntidad);
            $this->db->update($nombreTabla, $data); 
            
            return true;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function insertMovimiento($idEntidad, $idEstado, $idUsuario)
    {    
          if($idEntidad != FALSE) {
            
             $data = array(
                'id_cabecera' => $idEntidad ,
                'id_estado' => $idEstado ,
                'id_usuario' => $idUsuario
             );

             $this->db->insert('movimientos', $data); 
            return true;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function updateCantidadesViaje($cantBultos, $cantPallets, $idViaje, $idProducto, $idVL)
    {    
        $data = array(
                'cant_real_bultos' => $cantBultos,
                'cant_real_pallets' => $cantPallets
             );

        $this->db->where('id_viaje', $idViaje);
        $this->db->where('id_producto', $idProducto);
        $this->db->where('id_variable_logistica', $idVL);        
        
        $this->db->update("productos_viaje", $data); 

    }
    
    public function updateReparto($precioCaja, $cantMerma, $idReparto, $fechaValorizacion)
    {    
        $this->load->helper('date');
        
        $data = array(
                'precio_caja' => $precioCaja,
                'cant_bultos_merma' => $cantMerma,
                'fecha_valorizacion' => $fechaValorizacion
             );

        //$this->db->set('fecha_valorizacion', 'NOW()', FALSE);
        
        $this->db->where('id', $idReparto);
        
        $this->db->update("reparto", $data); 

    }
    
    public function getViajeXId($idViaje)
    {
        $sql = "select * from viaje where id = ?";
            
        $query = $this->db->query($sql, $idViaje);

        $viaje = $query->result_array();

        if( is_array($viaje) && count($viaje) > 0 ) {
          return $viaje;
        }

        return false;
    }
            
    public function getCantidadProductos($idViaje)
    {
         if($idViaje != FALSE) {
            $sql = "select count(distinct id_producto) cant
                   from productos_viaje 
                   where id_viaje = ?";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            
            $cantidadProductos = $query->result_array();
            
             if ( is_array($cantidadProductos) && count($cantidadProductos) == 1 )  {
              
              if (empty($cantidadProductos[0]["cant"])) {
                  return 0;
              }else{
                  return $cantidadProductos[0]["cant"];
              }
              
            }
            else{
              return 0;
            }
        }else {
          return FALSE;
        }    
    }   
    
    
    public function getMontoTotalViaje($idViaje)
    {
        if($idViaje != FALSE) {
            $sql = " select 
                        sum((b.cantidad_bultos - b.cant_bultos_merma) * b.precio_caja  ) monto_viaje
                        from viaje a
                        join reparto b ON a.id = b.id_viaje                    
                        where a.id = ?  
                        and b.precio_caja is not null";
            
            $query = $this->db->query($sql, array($idViaje));                   
            
            $monto = $query->result_array();
            
             if ( is_array($monto) && count($monto) == 1 )  {
              
              if (empty($monto[0]["monto_viaje"])) {
                  return 0;
              }else{
                  return $monto[0]["monto_viaje"];
              }
              
            }
            else{
              return 0;
            }
        }else {
          return FALSE;
        }    
        
       
    }
    
    public function getMontoGastos($idViaje)
    {
         if($idViaje != FALSE) {
            $sql = "SELECT sum(precio_unitario * cantidad ) monto
                    FROM viaje_gasto
                    where id_viaje=?";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            
            $montoViaje = $query->result_array();
            
             if ( is_array($montoViaje) && count($montoViaje) == 1 )  {
              
              if (empty($montoViaje[0]["monto"])) {
                  return 0;
              }else{
                  return $montoViaje[0]["monto"];
              }
              
            }
            else{
              return 0;
            }
        }else {
          return FALSE;
        }    
    }   
    
    public function getMontoGanancias($idViaje)
    {
         if($idViaje != FALSE) {
            $sql = "SELECT sum(importe ) monto
                    FROM viaje_ganancia
                    where id_viaje=?";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            
            $montoViaje = $query->result_array();
            
             if ( is_array($montoViaje) && count($montoViaje) == 1 )  {
              
              if (empty($montoViaje[0]["monto"])) {
                  return 0;
              }else{
                  return $montoViaje[0]["monto"];
              }
              
            }
            else{
              return 0;
            }
        }else {
          return FALSE;
        }    
    }   
   
    public function getLineasRepartoViaje($idViaje)
    {
         if($idViaje != FALSE) {
          $sql = "select a.id id_linea, a.id_cliente, f.razon_social, d.id id_viaje,  b.id id_producto,  b.descripcion producto, 
                    a.cantidad_bultos, a.cantidad_pallets,
                    d.numero_de_viaje, e.razon_social proveedor, c.id id_vl,e.id id_proveedor,
                    c.descripcion vl, c.peso, c.base_pallet, c.altura_pallet, c.codigo_vl
                    from reparto a
                    join producto b on a.id_producto = b.id
                    join variable_logistica c on a.id_variable_logistica = c.id
                    join viaje d on a.id_viaje = d.id
                    join proveedor e on d.id_proveedor = e.id
                    join cliente f on a.id_cliente = f.id	
                    where a.id_viaje = ?
                    order by id_producto, cantidad_bultos  ";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            $lineasViaje = $query->result_array();

            if( is_array($lineasViaje) && count($lineasViaje) > 0 ) {
              return $lineasViaje;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    
    public function verificarLineasViaje($idViaje)
    {
         if($idViaje != FALSE) {
          $sql = "select 1
                    from planificacion_reparto a
                    where a.id_viaje = ?";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            $lineasViaje = $query->result_array();

            if( is_array($lineasViaje) && count($lineasViaje) > 0 ) {
              return true;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    

   
}
