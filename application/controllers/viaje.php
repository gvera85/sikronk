<?php

class Viaje extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->where('id_distribuidor', $this->session->userdata('empresa'));  
     
    $this->grocery_crud->set_table('viaje');
    $this->grocery_crud->edit_fields('id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista');
    $this->grocery_crud->add_fields('id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Viaje');
    $this->grocery_crud->required_fields('id_proveedor');
    $this->grocery_crud->columns('id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $this->grocery_crud->display_as('id_empresa_transportista','Transportista');
    $this->grocery_crud->set_relation('id_empresa_transportista','transportista','razon_social');
        
    $this->grocery_crud->add_action('Productos', base_url().'/assets/img/iconoProducto.png', '','ui-icon-image',array($this,'link_hacia_productos'));
    
    $this->grocery_crud->set_rules('patente_semi','Patente semi','callback_validarPatente');
    $this->grocery_crud->set_rules('patente_camion','Patente del camion','callback_validarPatente');
    
    
    $this->grocery_crud->fields('id_distribuidor','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'distribuidor_callback'));
    $this->grocery_crud->callback_before_update(array($this,'distribuidor_callback'));
    
    $output = $this->grocery_crud->render();
    $this->viaje_output($output);
  }
  
  function viaje_output($output = null){
    $this->load->view('mostrarABM', $output);
  }
  
  function link_hacia_productos($primary_key , $row)
  {
        return site_url('viajeVL/index/'.$row->id);
  }
  
  public function validarPatente($patenteIngresada) 
  {
    if ($patenteIngresada)
    {
        if (preg_match('/^[A-Z]{3}\d{3}$/', $patenteIngresada))
        {
          return TRUE;
        } else {
           $this->form_validation->set_message('validarPatente', $patenteIngresada.' no es una patente valida. Formato correcto [ZZZ999]');  
          return FALSE;
        } 
    }  else {
       return TRUE; 
    }
  }
  
  
   function distribuidor_callback($post_array) {
   $post_array['id_distribuidor'] = $this->session->userdata('empresa');//$this->session->userdata('id_producto');//Fijo el Id de producto recibido por parametro
 
   return $post_array;
}
}
