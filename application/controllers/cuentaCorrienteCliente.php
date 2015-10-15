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
    $this->load->model('cliente_m');
    
    
    $facturasClientes = $this->facturas_clientes_m->getLineasCCC($idCliente);
    
    $lineasSinValorizar = $this->facturas_clientes_m->getLineasSinValorizar($idCliente);
    
    $cliente = $this->cliente_m->getClienteXId($idCliente);    
    
    
    
    $data['facturasClientes'] = $facturasClientes;
    $data['cliente'] = $cliente;
    $data['lineasSinValorizar'] = $lineasSinValorizar;
    
    
    $this->load->view('cuentaCorrienteCliente',$data); 
      
  }
  
  function cargarLineasCC()
  {
    $imagen_eliminada=true;
    
    $idCliente = 17;
    
    $this->load->model('facturas_clientes_m');
    $this->load->model('cliente_m');
    
    $facturasClientes = $this->facturas_clientes_m->getLineasCCC($idCliente);
    
    $lineasSinValorizar = $this->facturas_clientes_m->getLineasSinValorizar($idCliente);
    
    $cliente = $this->cliente_m->getClienteXId($idCliente);    
    
    $data['facturasClientes'] = $facturasClientes;
    $data['cliente'] = $cliente;
    $data['lineasSinValorizar'] = $lineasSinValorizar;
    
    //$this->load->view('cuentaCorrienteCliente',$data); 

    echo json_encode(array('$facturasClientes'=>$facturasClientes));
  }



}
  
  
  
