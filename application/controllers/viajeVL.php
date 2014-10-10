<?php

class ViajeVL extends CI_Controller{

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
    $this->grocery_crud->set_table('productos_viaje');
    $this->grocery_crud->edit_fields('id_viaje','id_variable_logistica','cantidad');
    $this->grocery_crud->add_fields('id_viaje','id_variable_logistica','cantidad');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Productos del viaje');
    $this->grocery_crud->required_fields('id_viaje','id_variable_logistica','cantidad');;
    $this->grocery_crud->columns('id_viaje','id_variable_logistica','cantidad');;
    
    $this->grocery_crud->display_as('id_viaje','Viaje');
    $this->grocery_crud->display_as('id_variable_logistica','Producto');
    
    $this->grocery_crud->set_relation('id_viaje','viaje','id');
    $this->grocery_crud->set_relation('id_variable_logistica','producto','{descripcion}');
    
    $output = $this->grocery_crud->render();
    $this->usuario_output($output);
  }
  
  function usuario_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
}
