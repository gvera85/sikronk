<?php

class cliente_m extends CI_Model {

    public function getClientes()
    {
        $sql = "select * from cliente where 1 = ?";
            
        $query = $this->db->query($sql, 1);

        $clientes = $query->result_array();

        if( is_array($clientes) && count($clientes) > 0 ) {
          return $clientes;
        }

        return false;
    }
    
    public function getLineasViaje($idViaje)
    {
         if($idViaje != FALSE) {
          $sql = "select a.id id_linea, b.id id_producto, c.id id_vl, e.id id_proveedor, b.descripcion producto, 
                c.descripcion vl, c.peso, c.base_pallet, c.altura_pallet, a.cantidad_bultos, 
                a.cantidad_pallets, d.numero_de_viaje, e.razon_social proveedor
                from productos_viaje a
                join producto b on a.id_producto = b.id
                join variable_logistica c on a.id_variable_logistica = c.id
                join viaje d on a.id_viaje = d.id
                join proveedor e on d.id_proveedor = e.id
                where id_viaje = ?";
            
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
    

   
}
