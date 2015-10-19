<?php

class pagoProveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Pago de proveedores');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){      
       
    $this->load->library('grocery_CRUD');
  
    $crud = new grocery_CRUD();
    
    $crud->set_language("spanish");
    
    $crud->set_table('pago_proveedor');
    $crud->edit_fields('fecha_pago', 'id_proveedor','id_modo_pago','monto');
    $crud->add_fields('fecha_pago','id_proveedor', 'id_modo_pago','monto');
    
    $crud->set_theme('datatables');
   
    $crud->set_subject('Pago de proveedores');
    $crud->required_fields('fecha_pago','id_proveedor', 'id_modo_pago','monto');
    $crud->columns('id','fecha_pago','id_proveedor', 'id_modo_pago','monto');
  
    $crud->display_as('id_modo_pago','Modo de pago');
    $crud->display_as('id_proveedor','Proveedor');
       
    $crud->set_relation('id_modo_pago','modo_pago','descripcion');
    $crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $crud->order_by('fecha_pago','desc');
    
    $crud->add_action('Facturas', base_url().'/assets/img/iconoFactura.png', '','ui-icon-image',array($this,'link_hacia_factura'));
    
    $output = $crud->render();
    $this->pago_output($output);
  }
  
  function pago_output($output = null){
    $this->load->view('mostrarABM',$output);
  }
  
  
  function link_hacia_factura($primary_key , $row)
  {
      return "javascript:window.open('" . base_url('index.php/procesaPago/generarFactura') . '/' . $row->id_proveedor . '/' . $row->id . "')";  
      //return site_url('planificacion/confirmacionViaje/'.$row->id);
  }
 
}
