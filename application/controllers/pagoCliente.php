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
    $crud->columns('id','fecha_pago','id_cliente', 'monto', 'monto_asignado' ,'observaciones');
  
    $crud->display_as('id_cliente','Cliente');
    $crud->display_as('monto','Monto total');
    $crud->display_as('monto_asignado','Monto asignado');
    
    $crud->callback_column('monto_asignado',array($this,'_callback_monto_asignado'));
    
    $crud->display_as('id','Nro Factura');
  
    $crud->set_relation('id_cliente','cliente','razon_social', array('activo' => 1));
        
    $crud->order_by('fecha_pago','desc');
    
    $crud->add_action('Items', base_url().'/assets/img/iconoGanancia.png', '','ui-icon-image',array($this,'link_hacia_lineas'));
    $crud->add_action('Asignar', base_url().'/assets/img/iconoFactura.png', '','ui-icon-image',array($this,'link_hacia_factura'));
    $crud->add_action('Img', base_url().'/assets/img/iconoImagenes.png', '','ui-icon-image',array($this,'link_hacia_imagenes'));
    
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
  
  function link_hacia_imagenes($primary_key , $row)
  {
      return "javascript:window.open('" . base_url('/index.php/imagenes/pagoCliente'). '/' . $row->id . '/' . $row->monto . "')"; 
      //return site_url('planificacion/confirmacionViaje/'.$row->id);
  }
  
  public function _callback_monto_asignado($value, $row)
    {
       $this->load->model('facturas_clientes_m');

       $montoImputado = $this->facturas_clientes_m->getMontoFacturado($row->id);
       
       if ($montoImputado[0]['montoImputado'] >= $row->monto)
       {           
           return $montoImputado[0]['montoImputado']; 
       }
       else 
       {
           //Muestro el numero en rojo si el pago todavía no fue imputado en su totalidad
           return '<span class="bad-wait" style="color:#CD0A0A;"><i class="fa fa-exclamation-triangle"></i> ' . $montoImputado[0]['montoImputado'] . '</span>';
       }

       
       
       //return $montoImputado[0]['montoImputado']; 
    }
 
}
