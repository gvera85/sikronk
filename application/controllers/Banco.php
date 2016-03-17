<?php

class Banco extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Entidades bancarias');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('entidad_bancaria');
    $this->grocery_crud->edit_fields('activo','razon_social', 'cuit', 'direccion');
    $this->grocery_crud->add_fields('activo','razon_social', 'cuit', 'direccion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Entidades bancarias');
    $this->grocery_crud->required_fields('razon_social');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $this->grocery_crud->columns('activo','razon_social', 'cuit', 'direccion');
    $this->grocery_crud->fields('activo','razon_social', 'cuit', 'direccion');
    
    $output = $this->grocery_crud->render();
    $this->banco_output($output);
  }
  
  function banco_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
