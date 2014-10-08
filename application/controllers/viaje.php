<?php

class Viaje extends CI_Controller{

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
  
  function index(){
    $this->grocery_crud->set_table('viaje');
    $this->grocery_crud->edit_fields('id_distribuidor','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada');
    $this->grocery_crud->add_fields('id_distribuidor','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Viaje');
    $this->grocery_crud->required_fields('id_proveedor','id_distribuidor');
    $this->grocery_crud->columns('id_distribuidor','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada');
    
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
    $this->grocery_crud->display_as('id_distribuidor','Distribuidor');
    
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    $this->grocery_crud->set_relation('id_distribuidor','distribuidor','razon_social');
    
    $output = $this->grocery_crud->render();
    $this->viaje_output($output);
  }
  
  function viaje_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
}
