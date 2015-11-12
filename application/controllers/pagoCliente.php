<?php

class pagoCliente extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Pago de clientes - Primero se ingresa el encabezado del pago y luego se agregan los distintos tipos de ingresos (cheques, efectivo) con el boton "Items"');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
      
       
    $this->load->library('grocery_CRUD');
  
    $crud = new grocery_CRUD();
    
    $crud->set_language("spanish");
    
    $crud->set_table('pago_cliente');
    $crud->edit_fields('fecha_pago', 'id_cliente', 'observaciones');
    $crud->add_fields('fecha_pago','id_cliente', 'observaciones');
    
    $crud->set_theme('datatables');
   
    $crud->set_subject('Pago de clientes (luego agregar los items con importes y tipos de pagos)');
    $crud->required_fields('fecha_pago','id_cliente');
    $crud->columns('id','fecha_pago','id_cliente', 'monto', 'observaciones');
  
    $crud->display_as('id_cliente','Cliente');
    $crud->display_as('monto','Monto total');
    
    $crud->display_as('id','Nro Factura');
  
    $crud->set_relation('id_cliente','cliente','razon_social');
    
    $crud->order_by('fecha_pago','desc');
    
    $crud->add_action('Items', base_url().'/assets/img/iconoGanancia.png', '','ui-icon-image',array($this,'link_hacia_lineas'));
    $crud->add_action('Asignar pago', base_url().'/assets/img/iconoFactura.png', '','ui-icon-image',array($this,'link_hacia_factura'));
    
    $output = $crud->render();
    $this->pago_output($output);
  }
  
  function pago_output($output = null){
    $this->load->view('mostrarABM',$output);
  }
  
  
  function link_hacia_factura($primary_key , $row)
  {
      return "javascript:window.open('" . base_url('index.php/procesaPago/generarFactura') . '/' . $row->id_cliente . '/' . $row->id . "')";  
      //return site_url('planificacion/confirmacionViaje/'.$row->id);
  }
  
  function link_hacia_lineas($primary_key , $row)
  {
      return "javascript:window.open('" . base_url('/index.php/pagoClienteLineas/popUp'). '/' . $row->id_cliente . '/' . $row->id . "')"; 
      //return site_url('planificacion/confirmacionViaje/'.$row->id);
  }
 
}
