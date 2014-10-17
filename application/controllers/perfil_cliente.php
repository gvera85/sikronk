<?php

class Perfil_cliente extends CI_Controller{

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
    $this->grocery_crud->set_table('perfil_cliente');
    $this->grocery_crud->edit_fields('descripcion');
    $this->grocery_crud->add_fields('descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Perfil de cliente');
    $this->grocery_crud->required_fields('descripcion');
    
    $this->grocery_crud->set_relation_n_n('MenuesDisponibles','menu_cliente','menu','id_perfil_cliente','id_menu','descripcion','orden');
        
    $this->grocery_crud->columns('descripcion','MenuesDisponibles');
    $this->grocery_crud->fields('descripcion','MenuesDisponibles');
    
    $output = $this->grocery_crud->render();
    $this->perfil_cliente_output($output);
  }
  
  function perfil_cliente_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
