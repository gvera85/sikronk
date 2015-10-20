<?php

class facturas_proveedor_m extends CI_Model {

    public function getProveedorXId($idProveedor)
    {
        $sql = "select * from proveedor where id = ?";
            
        $query = $this->db->query($sql, $idProveedor);

        $proveedor = $query->result_array();

        if( is_array($proveedor) && count($proveedor) > 0 ) {
          return $proveedor;
        }

        return false;
    }
    
    public function getPagosCliente($idDistribuidor)
    {
        $idDistribuidor = 1; 
        
        if($idDistribuidor != FALSE) {
          $sql = "select b.razon_social, c.descripcion, a.* 
                    from pago_cliente a
                    join cliente b on a.id_cliente = b.id
                    join modo_pago c on a.id_modo_pago = c.id
                    and 1=?";
            
            $query = $this->db->query($sql, array($idDistribuidor));
                   
            $lineasFacturas = $query->result_array();

            if( is_array($lineasFacturas) && count($lineasFacturas) > 0 ) {
              return $lineasFacturas;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
       
    }
   

}




