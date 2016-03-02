<?php

class detallesEntidades extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Planificaciones');
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  
  function verPagoCliente($idPago){
    $this->load->model('pagos_m');

    $cabeceraPago = $this->pagos_m->getCabeceraPagoCliente($idPago);
    $lineasPago = $this->pagos_m->getLineasPagoCliente($idPago);
    
    $data['cabeceraPago'] = $cabeceraPago;    
    $data['lineasPago'] = $lineasPago;
   
    $this->load->view('detallePagoCliente',$data);
  }
  
  
  
  
}



  

