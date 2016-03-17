<?php

class tipoEstado extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Tipos de estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('tipo_estado');
    $this->grocery_crud->edit_fields('activo','nombre_tabla');
    $this->grocery_crud->add_fields('activo','nombre_tabla');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Estado');
    $this->grocery_crud->required_fields('activo','nombre_tabla');
    $this->grocery_crud->columns('activo','nombre_tabla');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->estado_output($output);
  }
  
  function estado_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
