<?php

class pagoProveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Pago de proveedores - Primero se ingresa el encabezado del pago y luego se agregan los distintos tipos de ingresos (cheques, efectivo) con el boton "Items"');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){      
       
    $this->load->library('grocery_CRUD');
  
    $crud = new grocery_CRUD();
    
    $crud->set_language("spanish");
    
    $crud->set_table('pago_proveedor');
    $crud->edit_fields('fecha_pago', 'id_proveedor','observaciones');
    $crud->add_fields('fecha_pago','id_proveedor', 'observaciones');
    
    $crud->set_theme('datatables');
   
    $crud->set_subject('Pago de proveedores (luego agregar los items con importes y tipos de pagos)');
    $crud->required_fields('fecha_pago','id_proveedor');
    $crud->columns('id','fecha_pago','id_proveedor', 'monto', 'observaciones');
  
    $crud->display_as('id_proveedor','Proveedor');
    $crud->display_as('id','Nro de factura');
       
    $crud->set_relation('id_proveedor','proveedor','razon_social', array('activo' => 1));
    
    $crud->order_by('fecha_pago','desc');
    
    $crud->add_action('Items', base_url().'/assets/img/iconoGanancia.png', '','ui-icon-image',array($this,'link_hacia_lineas'));
    $crud->add_action('Img', base_url().'/assets/img/iconoImagenes.png', '','ui-icon-image',array($this,'link_hacia_imagenes'));
    
    $output = $crud->render();
    $this->pago_output($output);
  }
  
  function pago_output($output = null){
    $this->load->view('mostrarABM',$output);
  }
  
  
  function link_hacia_lineas($primary_key , $row)
  {
      return "javascript:window.open('" . base_url('/index.php/pagoProveedoresLineas/popUp'). '/' . $row->id_proveedor . '/' . $row->id . "')"; 
      //return site_url('planificacion/confirmacionViaje/'.$row->id);
  }
  
  function link_hacia_imagenes($primary_key , $row)
  {
      return "javascript:window.open('" . base_url('/index.php/imagenes/pagoProveedor'). '/' . $row->id . '/' . $row->monto . "')"; 
      //return site_url('planificacion/confirmacionViaje/'.$row->id);
  }
  
  
 
}
