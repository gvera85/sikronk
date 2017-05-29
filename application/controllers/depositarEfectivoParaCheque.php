<?php

class depositarEfectivoParaCheque extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');    
    
    $this->load->model('facturas_proveedor_m');
    $this->load->model('caja_distribuidor_m');
    
    $this->load->helper('cambio_estados');
    
   
  }
  
  function index(){
      
    $idDistribuidor = $this->session->userdata('empresa');
    
    $cheques = $this->caja_distribuidor_m->getChequesSinCubrir($idDistribuidor);    
      
    $distribuidor = $this->caja_distribuidor_m->getDistribuidorXId($idDistribuidor);    
    
    $data['cheques'] = $cheques;
    $data['distribuidor'] = $distribuidor;
      
    $this->load->view('chequesSinEfectivo',$data);
  }
  
  function generarDepositoEfectivo($idCheque)
  {
      putenv("TZ=America/Argentina/Buenos_Aires");
      ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
      
      $fechaMovimiento = date("Y-m-d H:i:s"); //La fecha y hora actual
      
      $this->load->model('facturas_proveedor_m');

      $cheque = $this->caja_distribuidor_m->getChequeDistribuidorXId($idCheque);

      $this->caja_distribuidor_m->insertMovimientoCuentaBancaria($cheque[0]["id_cuenta_bancaria"], 1, $cheque[0]["importe"], $fechaMovimiento, "Movimiento generado por debito de cheque", 3);
      
      $resultado = $this->caja_distribuidor_m->updateFechaDeposito($idCheque);    
      
      transicionSimple($idCheque, ESTADO_CHEQUE_DIST_DESCONTADO_CUENTA, "cheque_distribuidor");
  }
}
  
  
  
