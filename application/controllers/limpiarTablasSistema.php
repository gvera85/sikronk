<?php

class limpiarTablasSistema extends CI_Controller{

  public function __construct()
  {
    parent::__construct();                
   
    $this->load->database();
    $this->load->helper('url');   
    
    $this->session->set_userdata('titulo', 'Eliminar tablas sistema');    
   
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
      
      $this->load->model('admin_m');

      $resultado = $this->admin_m->eliminarDatosViajesSistema();
      
      if ($resultado)
          $this->load->view('operacionExitosa');
    
  } 
    
   
}