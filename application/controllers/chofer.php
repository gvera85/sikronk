<?php

class chofer extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Choferes');
    
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('chofer');
    $this->grocery_crud->edit_fields('activo','nombre','apellido','dni','telefono');
    $this->grocery_crud->add_fields('activo','nombre','apellido','dni','telefono');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Chofer');
    $this->grocery_crud->required_fields('activo','nombre','apellido','dni','telefono');
    $this->grocery_crud->columns('activo','nombre','apellido','dni','telefono');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
       
    $output = $this->grocery_crud->render();
    $this->usuario_output($output);

  }
  
  function usuario_output($output = null){
    //$this->load->view('template', $output);
    $this->load->view('mostrarABM', $output);
  } 
 
}
