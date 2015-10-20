<?php

class cajaDistribuidor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');    
    
   
  }
  
  function index(){
      
    $this->load->model('facturas_proveedor_m');
    
    $idDistribuidor = 6;
      
    $this->load->model('facturas_proveedor_m');
    
    $facturasProveedor = $this->facturas_proveedor_m->getLineasCCP($idDistribuidor);    
      
    $proveedor = $this->facturas_proveedor_m->getProveedorXId($idDistribuidor);    
    
    $data['facturasProveedor'] = $facturasProveedor;
    $data['proveedor'] = $proveedor;
      
    $this->load->view('cajaDistribuidor',$data); 
  }
  
  function getCuentaCorriente($idDistribuidor){
      
    $idDistribuidor = 6;
      
    $this->load->model('facturas_proveedor_m');
    
    $facturasProveedor = $this->facturas_proveedor_m->getLineasCCP($idDistribuidor);    
      
    $proveedor = $this->facturas_proveedor_m->getProveedorXId($idDistribuidor);    
    
    $data['facturasProveedor'] = $facturasProveedor;
    $data['proveedor'] = $proveedor;
      
    $this->load->view('cajaDistribuidor',$data); 
      
  } 

}
  
  
  
