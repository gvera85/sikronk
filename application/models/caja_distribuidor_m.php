<?php

class caja_distribuidor_m extends CI_Model {

    public function getDistribuidorXId($idDistribuidor)
    {
        $sql = "select * from distribuidor where id = ?";
            
        $query = $this->db->query($sql, $idDistribuidor);

        $distribuidor = $query->result_array();

        if( is_array($distribuidor) && count($distribuidor) > 0 ) {
          return $distribuidor;
        }

        return false;
    }
    
    public function getLineasCaja($idDistribuidor)
    {
        $idDistribuidor = 1; 
        
        if($idDistribuidor != FALSE) {
          $sql = "select 'Ingreso' tipo, a.fecha_pago, a.stamp, b.razon_social, c.descripcion, 0 debe, a.monto haber, a.id
                    from pago_cliente a
                    join cliente b on a.id_cliente = b.id
                    join modo_pago c on a.id_modo_pago = c.id
                    and 1=?
                    union
                    select 'Egreso' tipo, a.fecha_pago, a.stamp, b.razon_social, c.descripcion, a.monto debe, 0 haber, a.id
                    from pago_proveedor a
                    join proveedor b on a.id_proveedor = b.id
                    join modo_pago c on a.id_modo_pago = c.id
                    and 1=1
                    order by 2 asc, 3 asc";
            
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




