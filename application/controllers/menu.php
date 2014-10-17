<?php

class Menu extends CI_Controller{

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
    $this->grocery_crud->set_table('menu');
    $this->grocery_crud->edit_fields('descripcion','path_icono','controlador','orden','id_menu_padre');
    $this->grocery_crud->add_fields('descripcion','path_icono','controlador','orden','id_menu_padre');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Menu');
    $this->grocery_crud->required_fields('descripcion');
    $this->grocery_crud->columns('descripcion','path_icono','controlador','orden','id_menu_padre');
    
    $this->grocery_crud->display_as('id_menu_padre','Sub menu de');
    $this->grocery_crud->display_as('descripcion','Nombre');
        
    $this->grocery_crud->set_relation('id_menu_padre','menu','descripcion');
    
    $output = $this->grocery_crud->render();
    $this->menu_output($output);
  }
  
  function menu_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
