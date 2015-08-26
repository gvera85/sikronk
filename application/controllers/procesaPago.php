<?php

class procesaPago extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');
   
  }
  
  function generarFactura($idCliente, $idPago){
      
    $this->load->model('facturas_clientes_m');
    
    $facturasClientes = $this->facturas_clientes_m->getFacturasCliente($idCliente);
    
    $pago = $this->facturas_clientes_m->getFacturaXId($idPago);
    
    $montoImputado = $this->facturas_clientes_m->getMontoFacturado($idPago);
    
    $data['facturasClientes'] = $facturasClientes;
    $data['pago'] = $pago;
    $data['montoImputado'] = $montoImputado;
  
    $this->load->view('facturasPendientesClientes',$data); 
  }
  
  function asignarPago(){
    $id_viaje = $_POST['idViaje'];
    $id_pago = $_POST['idPago']; 
    $monto_viaje = $_POST['totalViaje']; 
    $monto_pagado = $_POST['montoPagado']; 
    
    
    $data = array(
               'id_viaje' => $id_viaje,
               'id_pago' => $id_pago,
               'monto_viaje' => $monto_viaje,
               'monto_pagado' => $monto_pagado
            );

    $this->db->insert('pagos_clientes_viajes', $data);
   
    
    echo "insertado";
  }
  
}
