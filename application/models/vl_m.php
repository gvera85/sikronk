<?php

class vl_m extends CI_Model {

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
    
    public function getCodigoVL($idProducto)
    {
         if($idProducto != FALSE) {
            $sql = "select MAX(IFNULL(codigo_vl,0))+1 codigo_vl
                    from variable_logistica
                    where id_producto = ?";
            
            $query = $this->db->query($sql, array($idProducto));
            
            $codigo_vl = $query->result_array();
            
             if ( is_array($codigo_vl) && count($codigo_vl) == 1 )  {
                if (empty($codigo_vl[0]["codigo_vl"])) {
                    return 1;
                }else{
                    return $codigo_vl[0]["codigo_vl"];
                }              
            }
            else{
              return 1;
            }
        }else {
          return FALSE;
        }   
    }
    
    public function getCantidadPallets($idVL, $cantidadBultos)
    {
         if($idVL != FALSE) {
            $sql = "select ceil( ? / (base_pallet * altura_pallet)) cantidad_pallets
                    from variable_logistica 
                    where id = ?";
            
            $query = $this->db->query($sql, array($cantidadBultos, $idVL));
            
            $cantidadPallets = $query->result_array();
            
             if ( is_array($cantidadPallets) && count($cantidadPallets) == 1 )  {
                if (empty($cantidadPallets[0]["cantidad_pallets"])) {
                    return 1;
                }else{
                    return $cantidadPallets[0]["cantidad_pallets"];
                }              
            }
            else{
              return 1;
            }
        }else {
          return FALSE;
        }  
    }
    
    
    
    

            
            
            
    

   
}
