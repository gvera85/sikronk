<?php

class viaje_m extends CI_Model {

    public function getNroViaje($idProveedor)
    {
         if($idViaje != FALSE) {
          $sql = "select b.* 
                    from viaje a
                    join proveedor b on a.id_proveedor = b.id
                    where a.id = ?";
            
            $query = $this->db->query($sql, array($idViaje));
                   
            $proveedor = $query->result_array();

            if( is_array($proveedor) && count($proveedor) > 0 ) {
              return $proveedor;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    

   
}
