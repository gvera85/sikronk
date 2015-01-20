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
                    d.numero_de_viaje, e.razon_social proveedor, c.id id_vl,e.id id_proveedor,
                    c.descripcion vl, c.peso, c.base_pallet, c.altura_pallet, c.codigo_vl
                    from productos_viaje a
                    join producto b on a.id_producto = b.id
                    join variable_logistica c on a.id_variable_logistica = c.id
                    join viaje d on a.id_viaje = d.id
                    join proveedor e on d.id_proveedor = e.id
                    where a.id_viaje = ?
                    order by id_producto, cantidad_bultos ";
            
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
    
    public function getEstadoActual($idEntidad)
    {    
          if($idEntidad != FALSE) {
          $sql = "SELECT ID_ESTADO
                    FROM VIAJE
                    WHERE ID = ? ";
            
            $query = $this->db->query($sql, array($idEntidad));
                   
            $idEstadoActual = $query->result_array();

            if( is_array($idEstadoActual) && count($idEstadoActual) > 0 ) {
              return $idEstadoActual[0]["ID_ESTADO"];
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
          $sql = "SELECT ID_ESTADO_FUTURO
                  FROM TRANSICIONES_POSIBLES
                  WHERE ID_ESTADO_ACTUAL = ? ";
            
            $query = $this->db->query($sql, array($idEstadoActual));
                   
            $idEstadoFuturo = $query->result_array();

            if( is_array($idEstadoFuturo) && count($idEstadoFuturo) > 0 ) {
              return $idEstadoFuturo[0]["ID_ESTADO_FUTURO"];
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
          $sql = "SELECT ID_ESTADO_FUTURO as id_estado_futuro, NOMBRE_TABLA as nombre_tabla
                    FROM TRANSICIONES_POSIBLES A
                    JOIN tipo_estado B ON A.id_tipo_estado = B.ID
                    WHERE ID_ESTADO_ACTUAL = ?  ";
            
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
                    'ID_ESTADO' => $idEstado
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
   

   
}
