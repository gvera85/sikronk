<?php

class gastos extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Gastos de un viaje');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('gastos_de_un_viaje');
    $this->grocery_crud->edit_fields('activo','descripcion');
    $this->grocery_crud->add_fields('activo','descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Gastos de un viaje');
    $this->grocery_crud->required_fields('descripcion');
    
    $this->grocery_crud->columns('id','activo','descripcion');
    $this->grocery_crud->fields('id','activo','descripcion');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->gastos_output($output);
  }
  
  function gastos_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
