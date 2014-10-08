<?php

class usuario extends CI_Controller{

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
    $this->grocery_crud->set_table('usuario');
    $this->grocery_crud->edit_fields('nombre','apellido','mail','password','id_tipo_empresa');
    $this->grocery_crud->add_fields('nombre','apellido','mail','password','id_tipo_empresa');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario');
    $this->grocery_crud->required_fields('nombre','apellido','mail','password','id_tipo_empresa');
    $this->grocery_crud->columns('nombre','apellido','mail','id_tipo_empresa');
    
    $this->grocery_crud->display_as('id_tipo_empresa','Tipo Usuario');
        
    $this->grocery_crud->set_relation('id_tipo_empresa','tipo_empresa','descripcion');
    
    
    $this->grocery_crud->callback_before_insert(array($this,'encrypt_password_callback'));
    $this->grocery_crud->callback_before_update(array($this,'encrypt_password_callback'));
    $this->grocery_crud->callback_edit_field('password',array($this,'decrypt_password_callback'));
    
    $this->grocery_crud->add_action('Perfiles', base_url().'/assets/img/vl.png', '','ui-icon-image',array($this,'link_hacia_perfiles'));
    
    $output = $this->grocery_crud->render();
    $this->usuario_output($output);

  }
  
  function usuario_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
  
  function encrypt_password_callback($post_array, $primary_key = null)
    {
        $this->load->library('encrypt');

        $key = 'super-secret-key';
        $post_array['password'] = $this->encrypt->encode($post_array['password'], $key);
        return $post_array;
    }
 
    function decrypt_password_callback($value)
    {
        $this->load->library('encrypt');

        $key = 'super-secret-key';
        $decrypted_password = $this->encrypt->decode($value, $key);
        return "<input type='password' name='password' value='$decrypted_password' />";
    }
    
    function link_hacia_perfiles($primary_key , $row)
    {
        switch ($row->id_tipo_empresa)
        {
            case 1:
                return base_url().'index.php/usuario_perfil_distribuidor/popUp?id_usuario='.$row->id;                
            case 2:
                return base_url().'index.php/usuario_perfil_cliente/popUp?id_usuario='.$row->id;
            case 3:
                return base_url().'index.php/usuario_perfil_proveedor/popUp?id_usuario='.$row->id;
            default:
                return base_url().'index.php';
                
        }
        
    }
    

}
