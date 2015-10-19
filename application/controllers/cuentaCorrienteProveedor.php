<?php

class cuentaCorrienteProveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');    
    
   
  }
  
  function index(){
      
    $this->load->model('facturas_proveedor_m');
  }
  
  function getCuentaCorriente($idProveedor){
      
    $this->load->model('facturas_proveedor_m');
    
    $facturasProveedor = $this->facturas_proveedor_m->getLineasCCP($idProveedor);    
      
    $proveedor = $this->facturas_proveedor_m->getProveedorXId($idProveedor);    
    
    $data['facturasProveedor'] = $facturasProveedor;
    $data['proveedor'] = $proveedor;
      
    $this->load->view('cuentaCorrienteProveedor',$data); 
      
  } 

}
  
  
  
