<?php

class MenuOpcionesProveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Menues proveedor');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('opcion_menu_proveedor');
    $this->grocery_crud->edit_fields('descripcion','path_icono','controlador','id_menu_padre','solo_administrador');
    $this->grocery_crud->add_fields('descripcion','path_icono','controlador','id_menu_padre','solo_administrador');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Menu');
    $this->grocery_crud->required_fields('descripcion');
    $this->grocery_crud->columns('descripcion','path_icono','controlador','id_menu_padre','solo_administrador');
    
    $this->grocery_crud->display_as('id_menu_padre','Sub menu de');
    $this->grocery_crud->display_as('descripcion','Nombre');
        
    $this->grocery_crud->set_relation('id_menu_padre','opcion_menu_proveedor','descripcion');
    
    $this->grocery_crud->change_field_type('solo_administrador', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->menu_output($output);
  }
  
  function menu_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
