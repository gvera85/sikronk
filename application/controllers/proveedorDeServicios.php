<?php

class proveedorDeServicios extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Proveedor de servicios');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('proveedor_de_servicios');
    $this->grocery_crud->edit_fields('razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','id_tipo_iva','telefono1','telefono2','mail');
    $this->grocery_crud->add_fields('razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','id_tipo_iva','telefono1','telefono2','mail');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Proveedores de servicios');
    $this->grocery_crud->required_fields('razon_social');
    $this->grocery_crud->columns('razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal');
    
    $this->grocery_crud->display_as('id_provincia','Provincia');        
    $this->grocery_crud->set_relation('id_provincia','provincia','descripcion');
    
    $this->grocery_crud->display_as('id_tipo_iva','Tipo de IVA');        
    $this->grocery_crud->set_relation('id_tipo_iva','tipo_iva','descripcion');    
   
    $this->grocery_crud->set_rules('mail','mail','callback_validarMail');
    
    $output = $this->grocery_crud->render();
    $this->proveedor_servicio_output($output);
  }
  
  function proveedor_servicio_output($output = null){
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