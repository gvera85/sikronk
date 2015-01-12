<?php

class transicionesPosibles extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Transiciones posibles');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->load->library('ajax_grocery_CRUD');
    
    $crud = new ajax_grocery_CRUD();
      
    $crud->set_language("spanish");
    
    $crud->set_table('transiciones_posibles');
    $crud->edit_fields('id_tipo_estado', 'id_estado_actual','id_estado_futuro','funcion_transicion');
    $crud->add_fields('id_tipo_estado','id_estado_actual','id_estado_futuro','funcion_transicion');
    
    $crud->set_theme('datatables');
   
    $crud->set_subject('Transiciones posibles');
    $crud->required_fields('id_tipo_estado','id_estado_actual','id_estado_futuro','funcion_transicion');
    $crud->columns('id_tipo_estado','id_estado_actual','id_estado_futuro','funcion_transicion');
    
    $crud->display_as('id_estado_actual','Estado actual');
    $crud->set_relation('id_estado_actual','estado','descripcion');
    
    $crud->display_as('id_estado_futuro','Estado futuro');
    $crud->set_relation('id_estado_futuro','estado','descripcion');
    
    $crud->display_as('id_tipo_estado','Tabla');
    $crud->set_relation('id_tipo_estado','tipo_estado','nombre_tabla');
    
    $crud->set_relation_dependency('id_estado_actual','id_tipo_estado','id_tipo_estado');
    $crud->set_relation_dependency('id_estado_futuro','id_tipo_estado','id_tipo_estado');
    
    
    $output = $crud->render();
    $this->transiciones_posibles_output($output);
  }
  
  function transiciones_posibles_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
