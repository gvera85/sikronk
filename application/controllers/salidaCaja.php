<?php

class salidaCaja extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Salida de caja - Primero se ingresa el encabezado del débito y luego se agregan los distintos tipos de egresos (cheques, efectivo) con el boton "Items"');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){      
       
    $this->load->library('grocery_CRUD');
  
    $crud = new grocery_CRUD();
    
    $crud->set_language("spanish");
    
    $crud->where('id_distribuidor', $this->session->userdata('empresa'));  
    
    $crud->set_table('cabecera_debito');
    $crud->set_theme('datatables');
   
    $crud->set_subject('Egreso de caja (luego agregar los items con importes y tipos de pagos)');
    $crud->required_fields('fecha', 'id_tipo_debito');
    $crud->columns('id','fecha', 'id_tipo_debito', 'monto', 'observaciones');
    $crud->fields('fecha','id_distribuidor', 'id_tipo_debito','observaciones');
    
    $crud->display_as('id_tipo_debito','Tipo débito');       
    $crud->set_relation('id_tipo_debito','tipo_debito_credito','descripcion',  array('activo' => 1, 'id_tipo' => 1));
    
    $crud->field_type('id_distribuidor','invisible');
    
    $crud->callback_before_insert(array($this,'distribuidor_callback'));
    $crud->callback_before_update(array($this,'distribuidor_callback'));
    
    $crud->order_by('fecha','desc');
    
    $crud->add_action('Items', base_url().'/assets/img/iconoGanancia.png', '','ui-icon-image',array($this,'link_hacia_lineas'));
    
    $output = $crud->render();
    $this->pago_output($output);
  }
  
  function pago_output($output = null){
    $this->load->view('mostrarABM',$output);
  }
  
  function distribuidor_callback($post_array) {
    $post_array['id_distribuidor'] = $this->session->userdata('empresa');//$this->session->userdata('id_producto');//Fijo el Id de distribuidor
    
    return $post_array;
   }
  
  
  function link_hacia_lineas($primary_key , $row)
  {
      return "javascript:window.open('" . base_url('/index.php/salidaCajaLineas/popUp'). '/' . $row->id_distribuidor . '/' . $row->id . "')"; 
      //return site_url('planificacion/confirmacionViaje/'.$row->id);
  }
  
    
  
 
}
