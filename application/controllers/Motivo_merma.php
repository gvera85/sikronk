<?php

class Motivo_merma extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Motivos de mermas');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('motivos_merma');
    $this->grocery_crud->edit_fields('descripcion');
    $this->grocery_crud->add_fields('descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Motivos de merma');
    $this->grocery_crud->required_fields('descripcion');
    
    $this->grocery_crud->columns('id','descripcion');
    $this->grocery_crud->fields('descripcion');
    
    $output = $this->grocery_crud->render();
    $this->banco_output($output);
  }
  
  function banco_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
