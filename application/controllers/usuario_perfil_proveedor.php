<?php

class Usuario_perfil_proveedor extends CI_Controller{

  var $id_usuario;
  
  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Usuario/perfil/proveedor');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('usuario_perfil_proveedor');
    $this->grocery_crud->edit_fields('id_usuario','id_perfil_proveedor','id_proveedor');
    $this->grocery_crud->add_fields('id_usuario','id_perfil_proveedor','id_proveedor');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario/Perfil/Proveedor');
    $this->grocery_crud->required_fields('id_usuario','id_perfil_proveedor','id_proveedor');
    $this->grocery_crud->columns('id_usuario','id_perfil_proveedor','id_proveedor');
    
    $this->grocery_crud->display_as('id_usuario','Usuario');
    $this->grocery_crud->display_as('id_perfil_proveedor','Perfil');
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
        
    $this->grocery_crud->set_relation('id_usuario','usuario','{nombre} {apellido} - {mail}');
    $this->grocery_crud->set_relation('id_perfil_proveedor','perfil_proveedor','descripcion');
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $output = $this->grocery_crud->render();
    $this->usuario_proveedor_output($output);
  }
  
  function popUp($primary_key, $nombre, $apellido){
    $this->id_usuario = $primary_key;
    
    if ($this->id_usuario) {
            $this->session->set_userdata('id_usuario', $this->id_usuario);
        }
    $this->grocery_crud->set_table('usuario_perfil_proveedor');
    $this->grocery_crud->edit_fields('id_perfil_proveedor','id_proveedor');
    $this->grocery_crud->add_fields('id_perfil_proveedor','id_proveedor');
    
    $this->grocery_crud->where('id_usuario', $this->session->userdata('id_usuario'));
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario/Perfil/Proveedor');
    $this->grocery_crud->required_fields('id_perfil_proveedor','id_proveedor');
    $this->grocery_crud->columns('id_perfil_proveedor','id_proveedor');
    
    //$this->grocery_crud->display_as('id_usuario','Usuario');
    $this->grocery_crud->display_as('id_perfil_proveedor','Perfil');
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
        
    //$this->grocery_crud->set_relation('id_usuario','usuario','mail');
    $this->grocery_crud->set_relation('id_perfil_proveedor','perfil_proveedor','descripcion');
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $this->grocery_crud->fields('id_usuario','id_perfil_proveedor','id_proveedor');
    
    $this->grocery_crud->change_field_type('id_usuario','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'usuario_callback'));
    $this->grocery_crud->callback_before_update(array($this,'usuario_callback'));
    
    $output = $this->grocery_crud->render();
    
    $this->session->set_userdata('titulo', "Usuario: ".urldecode($nombre)." ".urldecode($apellido)); 
    $this->usuario_proveedor_output($output);
  }
  
  function usuario_callback($post_array) {
   $post_array['id_usuario'] = $this->session->userdata('id_usuario');//Fijo el Id de usuario recibido por parametro
 
   return $post_array;
}
  
  function usuario_proveedor_output($output = null){
    $this->load->view('mostrarPopUp', $output);
  } 
}
