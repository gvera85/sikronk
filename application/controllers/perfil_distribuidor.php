<?php

class Perfil_distribuidor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Perfiles de distribuidor');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('perfil_distribuidor');
    $this->grocery_crud->edit_fields('descripcion');
    $this->grocery_crud->add_fields('descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Perfil de distribuidor');
    $this->grocery_crud->required_fields('descripcion');
    
    $this->grocery_crud->set_relation_n_n('MenuesDisponibles','menu_distribuidor','menu','id_perfil_distribuidor','id_menu','descripcion','orden',array('solo_administrador' => 0));
        
    $this->grocery_crud->columns('descripcion','MenuesDisponibles');
    $this->grocery_crud->fields('descripcion','MenuesDisponibles');
    
    $output = $this->grocery_crud->render();
    $this->perfil_distribuidor_output($output);
  }
  
  function perfil_distribuidor_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
