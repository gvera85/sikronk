<?php

class proveedor_m extends CI_Model {

    public function getProductoVL($idProveedor)
    {
       if($idPerfil != FALSE) {
          $sql = "    select a.id, b.descripcion producto, a.descripcion presentacion, peso 
from variable_logistica a
join producto b on a.id_producto = b.id";
            
            $query = $this->db->query($sql, array($idPerfil));
                   
            $menues = $query->result_array();

            if( is_array($menues) && count($menues) > 0 ) {
              return $menues;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
    }
    
    

            
            
            
    

   
}
