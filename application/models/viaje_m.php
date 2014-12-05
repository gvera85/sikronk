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
    

   
}
