<?php

class Perfil_proveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Perfiles de proveedor');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('perfil_proveedor');
    $this->grocery_crud->edit_fields('descripcion');
    $this->grocery_crud->add_fields('descripcion');
   
    $this->grocery_crud->set_theme('datatables');
    
    $this->grocery_crud->set_subject('Perfil de proveedor');
    $this->grocery_crud->required_fields('descripcion');
  
        
    $this->grocery_crud->set_relation_n_n('PermisosDisponibles','permisos_proveedor','permiso','id_perfil_proveedor','id_permiso','descripcion','orden');
    
    /*$this->grocery_crud->columns('descripcion', 'PermisosDisponibles');
    $this->grocery_crud->fields('descripcion', 'PermisosDisponibles');*/
    
    $this->grocery_crud->set_relation_n_n('MenuesDisponibles','menu_proveedor','opcion_menu_proveedor','id_perfil_proveedor','id_menu','descripcion','orden',array('solo_administrador' => 0));
        
    $this->grocery_crud->columns('descripcion','MenuesDisponibles', 'PermisosDisponibles');
    $this->grocery_crud->fields('descripcion','MenuesDisponibles', 'PermisosDisponibles');
    
    
        
    
    
    
    
    
    $output = $this->grocery_crud->render();
    $this->perfil_proveedor_output($output);
  }
  
  function perfil_proveedor_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
