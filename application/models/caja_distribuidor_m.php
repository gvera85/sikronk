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
                $sql = "select 'Ingreso' tipo, a.fecha_pago, a.stamp, b.razon_social, '-' descripcion, 0 debe, a.monto haber, a.id
                        from pago_cliente a
                        join cliente b on a.id_cliente = b.id
                        and 1=?
                    union
                        select 'Egreso' tipo, a.fecha_pago, a.stamp, b.razon_social, c.descripcion, a.monto debe, 0 haber, a.id
                        from pago_proveedor a
                        join proveedor b on a.id_proveedor = b.id
                        left join modo_pago c on a.id_modo_pago = c.id
                        and 1=1                   
                    union
                        SELECT 'Ajuste' Tipo, fecha, stamp, '-' razon_social,
                        observaciones descripcion,
                          CASE id_tipo 
                            WHEN 1 THEN importe  
                                ELSE 0 
                          END debe,
                         CASE id_tipo 
                            WHEN 2 THEN importe    
                                ELSE 0 
                          END haber,  
                        id
                        FROM nota_credito_debito 
                    order by 2 asc, 3 asc";
            
            $query = $this->db->query($sql, array($idDistribuidor, $idDistribuidor));
                   
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
   

}




