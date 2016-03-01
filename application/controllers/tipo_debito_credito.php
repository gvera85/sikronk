<?php

class tipo_debito_credito extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Tipos de debito o credito');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('tipo_debito_credito');
    $this->grocery_crud->edit_fields('activo','descripcion','es_debito');
    $this->grocery_crud->add_fields('activo','descripcion','es_debito');
    
    $this->grocery_crud->set_theme('datatables');
    
    $this->grocery_crud->required_fields('activo','descripcion','es_debito');
    $this->grocery_crud->columns('activo','descripcion','es_debito');
    
    $this->grocery_crud->change_field_type('es_debito', 'true_false');
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->debito_credito_output($output);
  }
  
  function debito_credito_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
