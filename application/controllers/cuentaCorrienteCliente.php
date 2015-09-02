<?php

class cuentaCorrienteCliente extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');
    
    
   
  }
  
  function index(){
      
    $this->load->model('cliente_m');
    
    $clientes = $this->cliente_m->getClientes();    
    
    $data['clientes'] = $clientes;
     
    $this->load->view('clientes',$data); 
  }
  
  function getCuentaCorriente($idCliente){
      
    $this->load->model('facturas_clientes_m');
    
    $facturasClientes = $this->facturas_clientes_m->getFacturasCliente($idCliente);
    
    $data['facturasClientes'] = $facturasClientes;
    
    $this->load->view('cuentaCorrienteCliente',$data); 
      
  }
  
  
  
}
