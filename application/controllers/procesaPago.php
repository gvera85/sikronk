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
    $idReparto = $_POST['idReparto'];
    $id_pago = $_POST['idPago']; 
    $monto_total = $_POST['montoTotal']; 
    $monto_pagado = $_POST['montoPagado']; 
    $id_producto = $_POST['idProducto']; 
    $id_variable_logistica = $_POST['idVL'];              
    
    
    $data = array(
               'id_reparto' => $idReparto,
               'id_pago' => $id_pago,
               'monto_total' => $monto_total,
               'monto_pagado' => $monto_pagado,
               'id_producto' => $id_producto,
               'id_variable_logistica' => $id_variable_logistica   
            );

    $this->db->insert('pagos_cliente_reparto', $data);
   
    
    echo "insertado";
  }
  
}
