<?php

class clienteListado extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Listado de clientes');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('cliente');
    $this->grocery_crud->edit_fields('razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','direccion_descarga','mercado','id_tipo_iva','telefono1','telefono2','mail');
    $this->grocery_crud->add_fields('razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','direccion_descarga','mercado','id_tipo_iva','telefono1','telefono2','mail');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Clientes');
    $this->grocery_crud->required_fields('razon_social');
    $this->grocery_crud->columns('razon_social', 'cuit','id_provincia','localidad','direccion_comercial','codigo_postal','direccion_descarga');
    
    $this->grocery_crud->display_as('id_provincia','Provincia');        
    $this->grocery_crud->set_relation('id_provincia','provincia','descripcion');
    
    $this->grocery_crud->display_as('id_tipo_iva','Tipo de IVA');        
    $this->grocery_crud->set_relation('id_tipo_iva','tipo_iva','descripcion');
   
    
    $this->grocery_crud->add_action('CC', base_url().'/assets/img/planificacion.png', '','ui-icon-image',array($this,'link_hacia_cuenta_corriente'));
    
    $this->grocery_crud->unset_add();
    $this->grocery_crud->unset_edit();
    $this->grocery_crud->unset_delete();
    
    $output = $this->grocery_crud->render();
    $this->cliente_output($output);
  }
  
  function cliente_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 
  
  function link_hacia_cuenta_corriente($primary_key , $row)
  {
        //return site_url('planificacion/planificacionReparto/'.$row->id);
        return "javascript:window.open('" . base_url('/index.php/cuentaCorrienteCliente/getCuentaCorriente'). '/' .$row->id. "')";
  }

}
