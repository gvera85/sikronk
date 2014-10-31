<?php

class distribuidor extends CI_Controller{

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
    $this->grocery_crud->set_table('distribuidor');
    $this->grocery_crud->edit_fields('razon_social', 'cuit');
    $this->grocery_crud->add_fields('razon_social', 'cuit');
    
    $this->grocery_crud->set_theme('twitter-bootstrap');
   
    $this->grocery_crud->set_subject('Distribuidores');
    $this->grocery_crud->required_fields('razon_social');
    $this->grocery_crud->columns('razon_social', 'cuit');
    
    $output = $this->grocery_crud->render();
    $this->perfil_output($output);
  }
  
  function perfil_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
