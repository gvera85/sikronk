<?php

class gananciasViaje extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Ganancias de un viaje');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('ganancias_de_un_viaje');
    $this->grocery_crud->edit_fields('activo','descripcion', 'ganancia_automatica','porcentaje_ganancia_auto');
    $this->grocery_crud->add_fields('activo','descripcion', 'ganancia_automatica','porcentaje_ganancia_auto');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Ganancias de un viaje');
    $this->grocery_crud->required_fields('activo','descripcion', 'ganancia_automatica','porcentaje_ganancia_auto');
    
    $this->grocery_crud->columns('activo','descripcion', 'ganancia_automatica','porcentaje_ganancia_auto');
    $this->grocery_crud->fields('activo','descripcion', 'ganancia_automatica','porcentaje_ganancia_auto');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    $this->grocery_crud->change_field_type('ganancia_automatica', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->ganancias_output($output);
  }
  
  function ganancias_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
