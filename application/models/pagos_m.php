<?php

class pagos_m extends CI_Model {
    
    public function getCabeceraPagoCliente($idPago)
    {    
        $sql = "select * from pago_cliente where id = ?";

        $query = $this->db->query($sql, array($idPago));

        $pago = $query->result_array();

        if( is_array($pago) && count($pago) > 0 ) {
          return $pago;
        }

        return false;
       
    }
    
    public function getLineasPagoCliente($idPago)
    {    
        
        $sql = "select a.importe, b.descripcion modo_pago, c.descripcion estado 
                from pagos_clientes_lineas a
                join modo_pago b on a.id_modo_pago = b.id
                left join estado c on a.id_estado = c.id
                where id_pago = ?";

        $query = $this->db->query($sql, array($idPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
   
}



