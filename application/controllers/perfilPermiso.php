<?php

class perfilPermiso extends CI_Controller{

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
    $this->grocery_crud->set_table('permiso_perfil');
    $this->grocery_crud->edit_fields('id_perfil','id_permiso');
    $this->grocery_crud->add_fields('id_perfil','id_permiso');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Perfil/Permiso');
    $this->grocery_crud->required_fields('id_perfil','id_permiso');
    $this->grocery_crud->columns('id_perfil','id_permiso');
    
    $this->grocery_crud->display_as('id_permiso','Permiso');
    $this->grocery_crud->display_as('id_perfil','Perfil');
        
    $this->grocery_crud->set_relation('id_permiso','permiso','descripcion');
    $this->grocery_crud->set_relation('id_perfil','perfil','descripcion');
    
    $output = $this->grocery_crud->render();
    $this->usuario_output($output);
  }
  
  function usuario_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
}
