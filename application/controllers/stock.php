<?php

class stock extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');
    
    $this->session->set_userdata('titulo', 'Stock');
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->load->model('stock_m');

    $lineasStock = $this->stock_m->getStockProductos();
    
    $data['lineasStock'] = $lineasStock;
    $data['modo'] = "edicion";
   
    $this->load->view('verStock',$data);
  }
  
  
   function verViajesProducto($idProducto, $idVL){
    $this->load->model('stock_m');

    $lineasViajes = $this->stock_m->getViajeProductoSinRepartir($idProducto, $idVL);
    
    $data['lineasViajes'] = $lineasViajes;
    $data['modo'] = "edicion";
   
    $this->load->view('verViajesSinRepartir',$data);
  }
  
  
}
