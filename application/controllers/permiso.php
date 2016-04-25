<?php

class permiso extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Permisos');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('permiso');
    $this->grocery_crud->edit_fields('activo','descripcion');
    $this->grocery_crud->add_fields('activo','descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Permisos');
    $this->grocery_crud->required_fields('descripcion','activo');
    $this->grocery_crud->columns('activo','descripcion');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->perfil_output($output);
  }
  
  function perfil_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
