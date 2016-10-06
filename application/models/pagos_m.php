<?php

class pagos_m extends CI_Model {
    
    public function getCabeceraPagoCliente($idPago)
    {    
        $sql = "select a.id, monto, id_modo_pago,  fecha_pago,
                id_cliente,  observaciones,
                b.id id_cliente,    b.razon_social,
                b.cuit,    b.direccion_comercial,    
                b.localidad,    b.mercado,    b.id_tipo_iva,    b.id_provincia,    b.codigo_postal,
                b.telefono1,    b.telefono2,    b.mail 
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
    
    public function getDetalleAjuste($idAjuste)
    {    
        $sql = "select a.id, fecha, b.id id_tipo_mov, b.descripcion tipo_mov, a.importe, 
                c.id id_motivo, c.descripcion motivo, 
                d.id id_modo_pago, d.descripcion modo_pago,
                a.observaciones
                from nota_credito_debito a
                join tipo_mov b on a.id_tipo = b.id
                join tipo_debito_credito c on a.id_tipo_credito_debito = c.id 
                join modo_pago d on a.id_modo_pago = d.id
                where a.id= ?";

        $query = $this->db->query($sql, array($idAjuste));

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
    
    
    public function getCabeceraCredito($idPago)
    {    
        $sql = "select a.*
                from cabecera_credito a
                where a.id= ?";

        $query = $this->db->query($sql, array($idPago));

        $pago = $query->result_array();

        if( is_array($pago) && count($pago) > 0 ) {
          return $pago;
        }

        return false;
       
    }
    
    public function getLineasCredito($idPago)
    {    
        
        $sql = "select a.*, b.descripcion modo_pago 
                from lineas_credito a
                join modo_pago b on a.id_modo_pago = b.id
                where a.id_credito = ?";

        $query = $this->db->query($sql, array($idPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
     public function getChequeEmitido($idCheque)
    {    
        $sql = "select a.importe, a.numero_de_cheque, a.fecha_de_acreditacion, a.cuit, a.observaciones, 
                b.razon_social, b.cuit, b.direccion direccion_banco,                 
                                d.numero_sucursal, d.direccion direccion_sucursal,
                                g.razon_social distribuidor
                from cheque_distribuidor a
                join entidad_bancaria b on a.id_entidad_bancaria = b.id                
                join sucursales_bancarias d on a.id_sucursal_bancaria = d.id
                join distribuidor g on a.id_distribuidor = g.id
                where a.id = ?";

        $query = $this->db->query($sql, array($idCheque));

        $pago = $query->result_array();

        if( is_array($pago) && count($pago) > 0 ) {
          return $pago;
        }

        return false;
       
    }
    
    public function getCabeceraDebito($idPago)
    {    
        $sql = "select a.*
                from cabecera_debito a
                where a.id= ?";

        $query = $this->db->query($sql, array($idPago));

        $pago = $query->result_array();

        if( is_array($pago) && count($pago) > 0 ) {
          return $pago;
        }

        return false;
       
    }
    
    public function getLineasDebito($idPago)
    {    
        
        $sql = "select a.*, b.descripcion modo_pago 
                from lineas_debito a
                join modo_pago b on a.id_modo_pago = b.id
                where a.id_debito = ?";

        $query = $this->db->query($sql, array($idPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
    
    public function getCabeceraPagoProveedor($idPago)
    {    
        $sql = "select a.id, monto, id_modo_pago,  fecha_pago,
                id_proveedor,  observaciones,
                b.id id_proveedor,    b.razon_social,
                b.cuit,    b.direccion_comercial,    b.direccion_carga,
                b.localidad,    b.mercado,    b.id_tipo_iva,    b.id_provincia,    b.codigo_postal,
                b.telefono1,    b.telefono2,    b.mail,    b.imagen_logo
                from pago_proveedor a
                join proveedor b on a.id_proveedor = b.id
                where a.id= ?";

        $query = $this->db->query($sql, array($idPago));

        $pago = $query->result_array();

        if( is_array($pago) && count($pago) > 0 ) {
          return $pago;
        }

        return false;
       
    }
    
    public function getLineasPagoProveedor($idPago)
    {    
        
        $sql = "select a.*, b.descripcion modo_pago
                from pagos_proveedor_lineas a
                join modo_pago b on a.id_modo_pago = b.id
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
                d.numero_sucursal, d.direccion direccion_sucursal,
                f.razon_social cliente
                from pagos_clientes_lineas a
                join entidad_bancaria b on a.id_entidad_bancaria = b.id
                left join estado c on a.id_estado = c.id
                join sucursales_bancarias d on a.id_sucursal_bancaria = d.id 
                join pago_cliente e on a.id_pago = e.id
                join cliente f on e.id_cliente = f.id
                where a.id = ?";

        $query = $this->db->query($sql, array($idLineaPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
    public function getDetalleChequeAjuste($idLineaPago)
    {    
        
        $sql = "select a.importe, a.numero_de_cheque, a.fecha_de_acreditacion, a.cuit, a.observaciones,
                b.razon_social, b.cuit, b.direccion direccion_banco,
                d.numero_sucursal, d.direccion direccion_sucursal, a.id_cheque_cliente,
                g.razon_social cliente
                from nota_credito_debito a
                join entidad_bancaria b on a.id_entidad_bancaria = b.id
                join sucursales_bancarias d on a.id_sucursal_bancaria = d.id
                join pagos_clientes_lineas e on a.id_cheque_cliente = e.id
                join pago_cliente f on e.id_pago = f.id	
                join cliente g on f.id_cliente = g.id
                where a.id =  ?";

        $query = $this->db->query($sql, array($idLineaPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
    public function getDetalleChequeCredito($idLineaPago)
    {    
        
        $sql = "select a.importe, a.numero_de_cheque, a.fecha_de_acreditacion, a.cuit, a.observaciones,
                b.razon_social, b.cuit, b.direccion direccion_banco,                 
                d.numero_sucursal, d.direccion direccion_sucursal,
                g.razon_social cliente
                from lineas_credito a
                join entidad_bancaria b on a.id_entidad_bancaria = b.id                
                join sucursales_bancarias d on a.id_sucursal_bancaria = d.id
                join pagos_clientes_lineas e on a.id_cheque_cliente = e.id
                join pago_cliente f on e.id_pago = f.id	
                join cliente g on f.id_cliente = g.id
                where a.id = ?";

        $query = $this->db->query($sql, array($idLineaPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
    
    public function getDetalleChequeDebito($idLineaPago)
    {    
        
        $sql = "select a.importe, a.numero_de_cheque, a.fecha_de_acreditacion, a.cuit, a.observaciones,
                b.razon_social, b.cuit, b.direccion direccion_banco,                 
                d.numero_sucursal, d.direccion direccion_sucursal,
                ifnull(g.razon_social,j.razon_social)  cliente
                from lineas_debito a
                join entidad_bancaria b on a.id_entidad_bancaria = b.id                
                join sucursales_bancarias d on a.id_sucursal_bancaria = d.id
                left join cheque_distribuidor e on a.id_cheque_distribuidor = e.id
                left join distribuidor g on e.id_distribuidor = g.id
                left join pagos_clientes_lineas h on a.id_cheque_cliente = h.id
                left join pago_cliente i on h.id_pago = i.id	
                left join cliente j on i.id_cliente = j.id
                where a.id = ?";

        $query = $this->db->query($sql, array($idLineaPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
    public function getDetalleChequeProveedor($idLineaPago)
    {    
        
        $sql = "select a.importe, a.numero_de_cheque, a.fecha_de_acreditacion, a.cuit, a.observaciones,
                b.razon_social, b.cuit, b.direccion direccion_banco,                 
                d.numero_sucursal, d.direccion direccion_sucursal,
                ifnull(g.razon_social,j.razon_social)  cliente
                from pagos_proveedor_lineas a
                join entidad_bancaria b on a.id_entidad_bancaria = b.id                
                join sucursales_bancarias d on a.id_sucursal_bancaria = d.id
                left join cheque_distribuidor e on a.id_cheque_distribuidor = e.id
                left join distribuidor g on e.id_distribuidor = g.id
                left join pagos_clientes_lineas h on a.id_cheque_cliente = h.id
                left join pago_cliente i on h.id_pago = i.id	
                left join cliente j on i.id_cliente = j.id
                where a.id = ?";

        $query = $this->db->query($sql, array($idLineaPago));

        $lineasPago = $query->result_array();

        if( is_array($lineasPago) && count($lineasPago) > 0 ) {
          return $lineasPago;
        }

        return false;
       
    }
    
}



