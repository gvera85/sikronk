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
    $this->grocery_crud->where('id_distribuidor', $this->session->userdata('empresa'));    
      
    $this->grocery_crud->set_table('cuenta_bancaria');
    $this->grocery_crud->edit_fields('activo','id_entidad_bancaria','numero_cuenta','cbu', 'descripcion');
    $this->grocery_crud->add_fields('activo','id_entidad_bancaria','numero_cuenta','cbu', 'descripcion');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Cuentas bancarias');
    $this->grocery_crud->required_fields('activo','id_entidad_bancaria','numero_cuenta');
    $this->grocery_crud->columns('activo','id_entidad_bancaria','numero_cuenta','cbu', 'descripcion', 'saldo');
    
    $this->grocery_crud->display_as('id_entidad_bancaria','Banco'); 
    
    $this->grocery_crud->display_as('cbu','CBU'); 
        
    $this->grocery_crud->set_relation('id_entidad_bancaria','entidad_bancaria','razon_social');
    
    $this->grocery_crud->fields('id_distribuidor','activo','id_entidad_bancaria','numero_cuenta','cbu', 'descripcion');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    
    $this->grocery_crud->change_field_type('activo', 'true_false');
    
    $this->grocery_crud->callback_before_insert(array($this,'distribuidor_callback'));
    $this->grocery_crud->callback_before_update(array($this,'distribuidor_callback'));
    
    $this->grocery_crud->add_action('Movimientos', base_url().'/assets/img/iconoMovimientoBancario.png', '','ui-icon-image',array($this,'link_hacia_movimientos'));
    
    $this->grocery_crud->set_rules('cbu','CBU','callback_validarCBU');
    
    $output = $this->grocery_crud->render();
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
