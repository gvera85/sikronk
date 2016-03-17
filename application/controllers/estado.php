<?php

class estado extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('estado');
    $this->grocery_crud->edit_fields('descripcion');
    $this->grocery_crud->add_fields('id_tipo_estado','descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Estado');
    $this->grocery_crud->required_fields('id_tipo_estado','descripcion');
    $this->grocery_crud->columns('id','id_tipo_estado','descripcion');
    
    $this->grocery_crud->display_as('id_tipo_estado','Tabla');
        
    $this->grocery_crud->set_relation('id_tipo_estado','tipo_estado','nombre_tabla', array('activo' => 1));
    
    $output = $this->grocery_crud->render();
    $this->estado_output($output);
  }
  
  function estado_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
