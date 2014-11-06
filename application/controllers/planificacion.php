<?php

class Planificacion extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function planificacionReparto($idViaje){
    $this->load->model('viaje_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    
    $data['lineasViaje'] = $lineasViaje;
   
    $this->load->view('planificacionReparto',$data);
  }
  
  function confirmacionViaje($idViaje){
    $this->load->model('viaje_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    
    $data['lineasViaje'] = $lineasViaje;  

    $this->load->view('reparto2',$data);
  }
  
  function grabarReparto(){
    if(isset($_POST['prod']) && !empty($_POST['prod'])){
        echo join(",",$_POST['prod']);
    }else{
      echo 'failed';
    }
  }
  
}
