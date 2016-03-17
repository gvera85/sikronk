<?php

class Sucursal_bancaria extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Sucursales bancarias');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('sucursales_bancarias');
    $this->grocery_crud->edit_fields('activo','id_entidad_bancaria', 'numero_sucursal', 'direccion');
    $this->grocery_crud->add_fields('activo','id_entidad_bancaria', 'numero_sucursal', 'direccion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Sucursales bancarias');
    $this->grocery_crud->required_fields('activo','id_entidad_bancaria','numero_sucursal');
    
    $this->grocery_crud->columns('activo','id_entidad_bancaria', 'numero_sucursal', 'direccion');
    $this->grocery_crud->fields('activo','id_entidad_bancaria', 'numero_sucursal', 'direccion');
    
    $this->grocery_crud->display_as('id_entidad_bancaria','Banco');        
    $this->grocery_crud->set_relation('id_entidad_bancaria','entidad_bancaria','razon_social');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->sucursal_output($output);
  }
  
  function sucursal_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
