<?php

class emisionCheque extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Emisión de cheques');
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->load->library('grocery_CRUD');
    $this->load->library('ajax_grocery_CRUD');
    
    //create ajax_grocery_CRUD instead of grocery_CRUD. This extends the functionality with the set_relation_dependency method keeping all original functionality as well
    $crud = new ajax_grocery_CRUD();
    
    $crud->set_language("spanish");
            
    $crud->where('cheque_distribuidor.id_estado', ESTADO_CHEQUE_DIST_SIN_USAR);    
    $crud->where('id_distribuidor', $this->session->userdata('empresa'));  
    
    $crud->set_theme('datatables');
    
    $crud->set_table('cheque_distribuidor');
    $crud->edit_fields( 'id_estado','fecha_emision' ,'importe', 'numero_de_cheque', 'fecha_de_acreditacion','id_cuenta_bancaria', 'cuit', 'observaciones');
    $crud->add_fields( 'id_estado','fecha_emision', 'importe', 'numero_de_cheque', 'fecha_de_acreditacion','id_cuenta_bancaria', 'cuit', 'observaciones');
    
    //$crud->set_theme('datatables');
   
    $crud->set_subject('Cheque');
    $crud->required_fields( 'fecha_emision', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_cuenta_bancaria');
    $crud->columns( 'fecha_emision', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_cuenta_bancaria');
    
    $crud->fields('id_estado', 'id_distribuidor', 'fecha_emision', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_cuenta_bancaria','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones');
    
    $crud->field_type('id_distribuidor','invisible');
    $crud->field_type('id_estado','invisible');
    
    $crud->change_field_type('id_entidad_bancaria','invisible');
    $crud->change_field_type('id_sucursal_bancaria','invisible');
    
    $crud->callback_before_insert(array($this,'lineas_callback'));
    $crud->callback_before_update(array($this,'lineas_callback'));
    
    
    
    $crud->set_primary_key('id_cuenta_bancaria','vw_cuentas_bancarias');
    
    $crud->display_as('id_cuenta_bancaria','Cuenta bancaria');    
    $crud->set_relation('id_cuenta_bancaria','vw_cuentas_bancarias','{razon_social}-{numero_cuenta}', array('activo' => 1, 'id_distribuidor_cuenta_bancaria'=> $this->session->userdata('empresa') ));
    
    $crud->set_primary_key('id','vw_sucursales_bancarias');
    //$crud->callback_column('id_viaje',array($this,'item_description_callback'));
    
    $crud->set_relation_dependency('id_sucursal_bancaria','id_entidad_bancaria','id_entidad_bancaria');
    
    $output = $crud->render();
        
    $this->pago_output($output);
  }
  
  function lineas_callback($post_array) {
    $post_array['id_estado'] = ESTADO_CHEQUE_DIST_SIN_USAR;
    $post_array['id_distribuidor'] = $this->session->userdata('empresa');  

    $id_cuenta_bancaria = $post_array['id_cuenta_bancaria'];    

    $this->load->model('caja_distribuidor_m');

    $cuentaBancaria = $this->caja_distribuidor_m->getCuentaBancariaXId($id_cuenta_bancaria);

    $post_array['id_entidad_bancaria'] = $cuentaBancaria[0]["id_entidad_bancaria"];     
    $post_array['id_sucursal_bancaria'] = $cuentaBancaria[0]["id_sucursal_bancaria"];   

    return $post_array;
  }
  

    
  function pago_output($output = null){
    $this->load->view('mostrarABM',$output);
  }
   
}