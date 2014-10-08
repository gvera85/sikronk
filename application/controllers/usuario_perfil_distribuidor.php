<?php

class Usuario_perfil_distribuidor extends CI_Controller{

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
    $this->grocery_crud->set_table('usuario_perfil_distribuidor');
    $this->grocery_crud->edit_fields('id_usuario','id_perfil_distribuidor','id_distribuidor');
    $this->grocery_crud->add_fields('id_usuario','id_perfil_distribuidor','id_distribuidor');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario/Perfil/Distribuidor');
    $this->grocery_crud->required_fields('id_usuario','id_perfil_distribuidor','id_distribuidor');
    $this->grocery_crud->columns('id_usuario','id_perfil_distribuidor','id_distribuidor');
    
    $this->grocery_crud->display_as('id_usuario','Usuario');
    $this->grocery_crud->display_as('id_perfil_distribuidor','Perfil');
    $this->grocery_crud->display_as('id_distribuidor','Distribuidor');
        
    $this->grocery_crud->set_relation('id_usuario','usuario','mail');
    $this->grocery_crud->set_relation('id_perfil_distribuidor','perfil_distribuidor','descripcion');
    $this->grocery_crud->set_relation('id_distribuidor','distribuidor','razon_social');
    
    $output = $this->grocery_crud->render();
    $this->usuario_distribuidor_output($output);
  }
  
  function usuario_distribuidor_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
}
