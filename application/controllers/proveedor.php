<?php

class proveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Proveedores');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('proveedor');
    $this->grocery_crud->edit_fields('activo','razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','direccion_carga','mercado','id_tipo_iva','telefono1','telefono2','mail','imagen_logo');
    $this->grocery_crud->add_fields('activo','razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','direccion_carga','mercado','id_tipo_iva','telefono1','telefono2','mail','imagen_logo');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Proveedores');
    $this->grocery_crud->required_fields('activo','razon_social');
    $this->grocery_crud->columns('activo','razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','direccion_carga','imagen_logo');
    
    $this->grocery_crud->display_as('id_provincia','Provincia');        
    $this->grocery_crud->set_relation('id_provincia','provincia','descripcion');
    
    $this->grocery_crud->display_as('id_tipo_iva','Tipo de IVA');        
    $this->grocery_crud->set_relation('id_tipo_iva','tipo_iva','descripcion', array('activo' => 1));
    
    $this->grocery_crud->set_field_upload('imagen_logo','assets/uploads/logos_clientes');
    
    $this->grocery_crud->set_rules('mail','mail','callback_validarMail');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->proveedor_output($output);
  }
  
  function proveedor_output($output = null){
    $this->load->view('mostrarABM',$output);
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
