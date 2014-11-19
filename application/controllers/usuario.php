<?php

class usuario extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Usuarios');
    
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('usuario');
    $this->grocery_crud->edit_fields('nombre','apellido','mail','foto','password','id_tipo_empresa');
    $this->grocery_crud->add_fields('nombre','apellido','mail','foto','password','id_tipo_empresa');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Usuario');
    $this->grocery_crud->required_fields('nombre','apellido','mail','password','id_tipo_empresa');
    $this->grocery_crud->columns('nombre','apellido','mail','foto','id_tipo_empresa');
    
    $this->grocery_crud->set_field_upload('foto','assets/uploads/files');
    
    $this->grocery_crud->display_as('id_tipo_empresa','Tipo Usuario');
        
    $this->grocery_crud->set_relation('id_tipo_empresa','tipo_empresa','descripcion');
    
    
    $this->grocery_crud->callback_before_insert(array($this,'encrypt_password_callback'));
    $this->grocery_crud->callback_before_update(array($this,'encrypt_password_callback'));
    $this->grocery_crud->callback_edit_field('password',array($this,'decrypt_password_callback'));
      
    $this->grocery_crud->add_action('Perfiles', base_url().'/assets/img/perfilmini.png', '','ui-icon-image',array($this,'link_hacia_perfiles'));
    
    $this->grocery_crud->set_rules('mail','mail','callback_validarMail');
    
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
                return site_url('usuario_perfil_distribuidor/popUp/'.$row->id.'/'.$row->nombre.'/'.$row->apellido);
            case 2:
                return site_url('usuario_perfil_cliente/popUp/'.$row->id.'/'.$row->nombre.'/'.$row->apellido);
            case 3:
                return site_url('usuario_perfil_proveedor/popUp/'.$row->id.'/'.$row->nombre.'/'.$row->apellido);
                
            default:
                return base_url().'index.php';
                
        }
        
    }
    
    public function validarMail($mailIngresado) 
    {
        if ($mailIngresado) {
              if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $mailIngresado)) {
                  return TRUE;
              } else {
                  $this->form_validation->set_message('validarMail', $mailIngresado . ' no es un mail valido');
                  return FALSE;
              }
          } else {
              return TRUE;
          }
    }
    
    
    

}
