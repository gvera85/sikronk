<?php

class pagos_m extends CI_Model {
    
    public function getCabeceraPagoCliente($idPago)
    {    
        $sql = "select * 
                from pago_cliente a
                join cliente b on a.id_cliente = b.id
                where a.id= ?";

        $query = $this->db->query($sql, array($idPago));

        $pago = $query->result_array();

        if( is_array($pago) && count($pago) > 0 ) {
          return $pago;
        }

        return false;
       
    }
    
    public function getLineasPagoCliente($idPago)
    {    
        
        $sql = "select a.*, b.descripcion modo_pago, c.descripcion estado 
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
    
    public function getDetalleCheque($idLineaPago)
    {    
        
        $sql = "select a.importe, a.numero_de_cheque, a.fecha_de_acreditacion, a.cuit, a.observaciones,
                b.razon_social, b.cuit, b.direccion direccion_banco, 
                c.descripcion estado_del_cheque,
                d.numero_sucursal, d.direccion direccion_sucursal
                from pagos_clientes_lineas a
                join entidad_bancaria b on a.id_entidad_bancaria = b.id
                left join estado c on a.id_estado = c.id
                join sucursales_bancarias d on a.id_sucursal_bancaria = d.id
                where a.id = ?";

        $query = $this->db->query($sql, array($idLineaPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
    
    
}



