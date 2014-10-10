<?php

class Usuario_perfil_cliente extends CI_Controller{

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
    $this->grocery_crud->set_table('usuario_perfil_cliente');
    $this->grocery_crud->edit_fields('id_usuario','id_perfil_cliente','id_cliente');
    $this->grocery_crud->add_fields('id_usuario','id_perfil_cliente','id_cliente');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario/Perfil/Cliente');
    $this->grocery_crud->required_fields('id_usuario','id_perfil_cliente','id_cliente');
    $this->grocery_crud->columns('id_usuario','id_perfil_cliente','id_cliente');
    
    $this->grocery_crud->display_as('id_usuario','Usuario');
    $this->grocery_crud->display_as('id_perfil_cliente','Perfil');
    $this->grocery_crud->display_as('id_cliente','Cliente');
        
    $this->grocery_crud->set_relation('id_usuario','usuario','mail');
    $this->grocery_crud->set_relation('id_perfil_cliente','perfil_cliente','descripcion');
    $this->grocery_crud->set_relation('id_cliente','cliente','razon_social');
    
    $output = $this->grocery_crud->render();
    $this->usuario_cliente_output($output);
  }
  
  function popUp($primary_key){
    $this->id_usuario = $primary_key;
    
    if ($this->id_usuario) {
            $this->session->set_userdata('id_usuario', $this->id_usuario);
        }
    $this->grocery_crud->set_table('usuario_perfil_cliente');
    $this->grocery_crud->edit_fields('id_perfil_cliente','id_cliente');
    $this->grocery_crud->add_fields('id_perfil_cliente','id_cliente');
    
    $this->grocery_crud->where('id_usuario', $this->session->userdata('id_usuario'));
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario/Perfil/Cliente');
    $this->grocery_crud->required_fields('id_perfil_cliente','id_cliente');
    $this->grocery_crud->columns('id_perfil_cliente','id_cliente');
    
    //$this->grocery_crud->display_as('id_usuario','Usuario');
    $this->grocery_crud->display_as('id_perfil_cliente','Perfil');
    $this->grocery_crud->display_as('id_cliente','Cliente');
        
    //$this->grocery_crud->set_relation('id_usuario','usuario','mail');
    $this->grocery_crud->set_relation('id_perfil_cliente','perfil_cliente','descripcion');
    $this->grocery_crud->set_relation('id_cliente','cliente','razon_social');
    
    $this->grocery_crud->fields('id_usuario','id_perfil_cliente','id_cliente');
    
    $this->grocery_crud->change_field_type('id_usuario','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'usuario_callback'));
    $this->grocery_crud->callback_before_update(array($this,'usuario_callback'));
    
    $output = $this->grocery_crud->render();
    $this->usuario_cliente_output($output);
  }
  
  function usuario_callback($post_array) {
   $post_array['id_usuario'] = $this->session->userdata('id_usuario');//Fijo el Id de usuario recibido por parametro
 
   return $post_array;
}
  
  function usuario_cliente_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
}
