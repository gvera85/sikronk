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
                $sql = "select 'Ingreso de cliente' tipo, a.fecha_pago, a.stamp, b.razon_social, '-' descripcion, 0 debe, a.monto haber, a.id
                        from pago_cliente a
                        join cliente b on a.id_cliente = b.id
                        and 1=?
                    union
                        select 'Pago a proveedor' tipo, a.fecha_pago, a.stamp, b.razon_social, c.descripcion, a.monto debe, 0 haber, a.id
                        from pago_proveedor a
                        join proveedor b on a.id_proveedor = b.id
                        left join modo_pago c on a.id_modo_pago = c.id
                        and 1=1                                       
                    union    
                        select 
                        'Crédito' AS Tipo,
                        a.fecha AS fecha,
                        a.stamp AS stamp,
                        '-' AS razon_social,
                        a.observaciones AS descripcion,
                        0 AS debe,
                        a.monto AS haber,
                        a.id AS id
                       from
                           cabecera_credito a   
                       where a.id_distribuidor = ?    
                    union    
                        select 
                        'Débito' AS Tipo,
                        a.fecha AS fecha,
                        a.stamp AS stamp,
                        '-' AS razon_social,
                        a.observaciones AS descripcion,
                        a.monto AS debe,
                        0 AS haber,
                        a.id AS id
                       from
                           cabecera_debito a 
                       where a.id_distribuidor = ?    
                    union
                        select 'Emisión cheque' tipo, a.fecha_emision, a.stamp, b.razon_social, '-' descripcion,
                            0 debe, a.importe haber, a.id
                           from cheque_distribuidor a
                           join distribuidor b on a.id_distribuidor = b.id
                           where b.id=?
                    union
                        select 'Deposito para cheque' tipo, a.fecha_deposito_efectivo, a.stamp, b.razon_social, '-' descripcion,
                           a.importe debe, 0 haber, a.id
                           from cheque_distribuidor a
                           join distribuidor b on a.id_distribuidor = b.id
                           where b.id=?
                           and a.id_estado = 18
                    union
                        select 'Débito banco' tipo, a.fecha_movimiento, a.stamp, a.razon_social, '-' descripcion, a.importe debe, 0 haber, a.id_movimiento_cuenta_bancaria
                        from vw_movimientos_bancos a
                        where a.id_tipo_mov = 1
                    union
                        select 'Crédito banco' tipo, a.fecha_movimiento, a.stamp, a.razon_social, '-' descripcion, 0 debe, a.importe haber, a.id_movimiento_cuenta_bancaria
                        from vw_movimientos_bancos a
                        where a.id_tipo_mov = 2
                    order by 2 asc, 3 asc";
            
            $query = $this->db->query($sql, array($idDistribuidor, $idDistribuidor, $idDistribuidor, $idDistribuidor, $idDistribuidor));
                   
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
    
    public function getGananciasAutomaticas()
    {   
            $sql = "SELECT *
                    FROM ganancias_de_un_viaje 
                    WHERE activo = 1
                    AND ganancia_automatica = 1;";
            
            $query = $this->db->query($sql);
                   
            $ganancias = $query->result_array();

            if( is_array($ganancias) && count($ganancias) > 0 ) {
              return $ganancias;
            }
            
            return false;
    }
    
    public function insertGananciaViaje($id_viaje, $id_ganancia, $porcentaje_ganancia, $importe, $observaciones)
    {    
            
             $data = array(               
                'id_viaje' => $id_viaje ,
                'id_ganancia' => $id_ganancia,
                 'porcentaje_ganancia'  => $porcentaje_ganancia,
                 'importe' => $importe,
                 'observaciones' => $observaciones
             );

             $this->db->insert('viaje_ganancia', $data); 
             
             if($data['error'] = $this->db->_error_message());
                    return $data;
             
             return true;
    }
    
    public function registrarGanancias($id_viaje)
    {
        $ganancias = $this->getGananciasAutomaticas();
        
        $valorGanancia = 0;
        
        $this->load->model('viaje_m');
        
        $valorViaje = $this->viaje_m->getMontoTotalViaje($id_viaje);
        
        if ($valorViaje == false)
            return $false;
        
        if (!empty($ganancias[0]['id']))
        {
            foreach( $ganancias as $i_ganancias ) :

                    $valorGanancia = $valorViaje * $i_ganancias['porcentaje_ganancia_auto'] / 100;

                    $retorno = $this->insertGananciaViaje( $id_viaje, $i_ganancias['id'], $i_ganancias['porcentaje_ganancia_auto'], $valorGanancia, 'Auto');

                    if ($retorno != true)
                        return $retorno;

            endforeach; 
        }
        
        return true;
    }
    
    public function getSaldoPorTipoDePago()
    {   
            $sql = "select sum(haber)-sum(debe) importe, id_modo_pago, modo_pago 
                    from vw_cc_distribuidor_detalle
                    group by  id_modo_pago, modo_pago
                    order by importe desc";
            
            $query = $this->db->query($sql);
                   
            $ganancias = $query->result_array();

            if( is_array($ganancias) && count($ganancias) > 0 ) {
              return $ganancias;
            }
            
            return false;
    }
    
    public function getChequesSinCubrir($idDistribuidor)
    {   
            $sql = "SELECT *
                    FROM vw_cheques_sin_cubrir_distribuidor 
                    WHERE id_distribuidor = ?;";
            
            $query = $this->db->query($sql, $idDistribuidor);
                   
            $cheques = $query->result_array();

            if( is_array($cheques) && count($cheques) > 0 ) {
              return $cheques;
            }
            
            return false;
    }
    
    public function updateFechaDeposito($idCheque)
    {    
        putenv("TZ=America/Argentina/Buenos_Aires");
        ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
        
        $data = array(
                'fecha_deposito_efectivo' => date("Y-m-d")
             );

        $this->db->where('id', $idCheque);
        
        $this->db->update("cheque_distribuidor", $data); 

    }
   

}




