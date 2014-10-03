<?php

class UsuarioPerfil extends CI_Controller{

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
    $this->grocery_crud->set_table('usuario_perfil_empresa');
    $this->grocery_crud->edit_fields('id_usuario','id_perfil','id_distribuidor','id_cliente','id_proveedor');
    $this->grocery_crud->add_fields('id_usuario','id_perfil','id_distribuidor','id_cliente','id_proveedor');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario/Perfil');
    $this->grocery_crud->required_fields('id_usuario','id_perfil');
    $this->grocery_crud->columns('id_usuario','id_perfil','id_distribuidor','id_cliente','id_proveedor');
    
    $this->grocery_crud->display_as('id_usuario','Usuario');
    $this->grocery_crud->display_as('id_perfil','Perfil');
    $this->grocery_crud->display_as('id_distribuidor','Es Distribuidor?');
    $this->grocery_crud->display_as('id_cliente','Es Cliente?');
    $this->grocery_crud->display_as('id_proveedor','Es Proveedor?');
    
    $this->grocery_crud->set_relation('id_usuario','usuario','nombre');
    $this->grocery_crud->set_relation('id_perfil','perfil','descripcion');
    $this->grocery_crud->set_relation('id_distribuidor','distribuidor','razon_social');
    $this->grocery_crud->set_relation('id_cliente','cliente','razon_social');
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $output = $this->grocery_crud->render();
    $this->usuario_output($output);
  }
  
  function usuario_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
}
