<?php

class Tipo_iva extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Tipos de IVA');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('tipo_iva');
    $this->grocery_crud->edit_fields('descripcion');
    $this->grocery_crud->add_fields('descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Tipos de IVA');
    $this->grocery_crud->required_fields('descripcion');
    $this->grocery_crud->columns('descripcion');
    
    $output = $this->grocery_crud->render();
    $this->tipo_iva_output($output);
  }
  
  function tipo_iva_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
