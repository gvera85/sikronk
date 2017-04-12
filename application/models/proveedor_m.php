<?php

class proveedor_m extends CI_Model {

    public function getProveedorXViaje($idViaje)
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
    
    public function getBancoXId($idBanco)
    {
         if($idBanco != FALSE) {
          $sql = "select a.* 
                    from entidad_bancaria a
                    where a.id = ?";
            
            $query = $this->db->query($sql, array($idBanco));
                   
            $banco = $query->result_array();

            if( is_array($banco) && count($banco) > 0 ) {
              return $banco;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
    

   
}
