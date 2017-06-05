<?php

class cuentaBancaria extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Cuentas bancarias');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->load->library('ajax_grocery_CRUD');  
    //create ajax_grocery_CRUD instead of grocery_CRUD. This extends the functionality with the set_relation_dependency method keeping all original functionality as well
    $crud = new ajax_grocery_CRUD();  
      
    $crud->where('id_distribuidor', $this->session->userdata('empresa'));    
      
    $crud->set_table('cuenta_bancaria');
    $crud->edit_fields('activo','id_entidad_bancaria','id_sucursal_bancaria','numero_cuenta','cbu', 'descripcion');
    $crud->add_fields('activo','id_entidad_bancaria','id_sucursal_bancaria','numero_cuenta','cbu', 'descripcion');
    
    $crud->set_theme('datatables');
   
    $crud->set_subject('Cuentas bancarias');
    $crud->required_fields('activo','id_entidad_bancaria','id_sucursal_bancaria','numero_cuenta');
    $crud->columns('activo','id_entidad_bancaria','id_sucursal_bancaria','numero_cuenta','cbu', 'descripcion', 'saldo');
    
    $crud->display_as('id_entidad_bancaria','Banco'); 
    
    $crud->display_as('cbu','CBU'); 
        
    $crud->set_relation('id_entidad_bancaria','entidad_bancaria','razon_social');
    
    $crud->set_primary_key('id','vw_sucursales_bancarias');
    
    $crud->display_as('id_sucursal_bancaria','Sucursal bancaria');
    $crud->set_relation('id_sucursal_bancaria','vw_sucursales_bancarias','{numero_sucursal}-{direccion}');
    
    //$crud->callback_column('id_viaje',array($this,'item_description_callback'));
    
    $crud->set_relation_dependency('id_sucursal_bancaria','id_entidad_bancaria','id_entidad_bancaria');
    
    $crud->fields('id_distribuidor','activo','id_entidad_bancaria','id_sucursal_bancaria','numero_cuenta','cbu', 'descripcion');
    
    $crud->change_field_type('id_distribuidor','invisible');
    
    $crud->change_field_type('activo', 'true_false');
    
    $crud->callback_before_insert(array($this,'distribuidor_callback'));
    $crud->callback_before_update(array($this,'distribuidor_callback'));
    
    $crud->add_action('Movimientos', base_url().'/assets/img/iconoMovimientoBancario.png', '','ui-icon-image',array($this,'link_hacia_movimientos'));
    
    $crud->set_rules('cbu','CBU','callback_validarCBU');
    
    $output = $crud->render();
    $this->cuenta_output($output);
  }
  
  function cuenta_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 
  
  function distribuidor_callback($post_array) {
    $post_array['id_distribuidor'] = $this->session->userdata('empresa');//$this->session->userdata('id_producto');//Fijo el Id de distribuidor
    
    return $post_array;
   }
   
  public function validarCBU($cbuIngresado) 
  {
    if ($cbuIngresado)
    {
        if (preg_match('/^[0-9]{22}/', $cbuIngresado))
        {
          return TRUE;
        } else {
           $this->form_validation->set_message('validarCBU', $cbuIngresado.' no es un CBU válido. Debe ser de 22 números');  
          return FALSE;
        } 
    }  else {
       return TRUE; 
    }
  }
  
  function link_hacia_movimientos($primary_key , $row)
  {
        //return site_url('viajeVL/popUp/'.$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje);
        return "javascript:window.open('" . base_url('/index.php/abm/cuentaBancariaMovimientos/popUp'). '/' .$row->id_cuenta_bancaria.'/'.$row->id_entidad_bancaria.'/'.$row->numero_cuenta. "')";
  }
  
}
