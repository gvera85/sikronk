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
      $resultado = $this->caja_distribuidor_m->updateFechaDeposito($idCheque);    
      
      transicionSimple($idCheque, ESTADO_CHEQUE_DIST_SALDADO, "cheque_distribuidor");
  }
}
  
  
  
