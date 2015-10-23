<?php

class cierreViajes extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Cierre de viajes');
    
    $this->load->helper('cambio_estados');
             
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
    $this->grocery_crud->columns('id','numero_de_viaje','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_empresa_transportista','id_estado','cantidad_productos', 'monto_gastos');
    
    $this->grocery_crud->callback_column('cantidad_productos',array($this,'_callback_cantidad_productos'));
    $this->grocery_crud->callback_column('monto_gastos',array($this,'_callback_monto_gastos'));
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $this->grocery_crud->display_as('id_empresa_transportista','Transportista');
    $this->grocery_crud->set_relation('id_empresa_transportista','transportista','razon_social');
    
    $this->grocery_crud->display_as('numero_de_viaje','# Viaje');
    
    $this->grocery_crud->display_as('id_chofer','Chofer');
    $this->grocery_crud->set_relation('id_chofer','chofer','{dni} - {nombre} {apellido} - Tel: {telefono}');
    
    $this->grocery_crud->display_as('id_estado','Estado');
    $this->grocery_crud->set_relation('id_estado','estado','descripcion');
        
    $this->grocery_crud->add_action('Gastos', base_url().'/assets/img/iconoGastosViaje.png', '','ui-icon-image',array($this,'link_hacia_gastos'));
    
    $this->grocery_crud->set_rules('patente_semi','Patente semi','callback_validarPatente');
    $this->grocery_crud->set_rules('patente_camion','Patente del camion','callback_validarPatente');
    
    $this->grocery_crud->fields('id_distribuidor','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista','numero_de_viaje');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    $this->grocery_crud->change_field_type('numero_de_viaje','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'distribuidor_insert_callback'));
    $this->grocery_crud->callback_before_update(array($this,'distribuidor_callback'));
    $this->grocery_crud->callback_after_insert(array($this, 'log_cambio_estado'));
    
    $where = "id_estado IN ('".ESTADO_VIAJE_PRECIO_ACORDADO."','".ESTADO_VIAJE_PRECIO_ACORDADO."')";
    
    $this->grocery_crud->where($where);
    
    $this->grocery_crud->unset_add();
    $this->grocery_crud->unset_edit();
    $this->grocery_crud->unset_delete();
    
    $output = $this->grocery_crud->render();
    $this->viaje_output($output);
  }
  
    public function _callback_cantidad_productos($value, $row)
    {
      
        $this->load->model('viaje_m');

        $cantProductos = $this->viaje_m->getCantidadProductos($row->id);
    
        
        return $cantProductos;
    }
    
    public function _callback_monto_gastos($value, $row)
    {
      
        $this->load->model('viaje_m');

        $gastos = $this->viaje_m->getMontoGastos($row->id);
    
        
        return $gastos;
    }
    
  function viaje_output($output = null){
    $this->load->view('mostrarABM', $output);
  }
  
  function link_hacia_gastos($primary_key , $row)
  {
        //return site_url('viajeVL/popUp/'.$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje);
        return "javascript:window.open('" . base_url('/index.php/viajeGastos/popUp'). '/' .$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje. "')";
  }
  
  function uno($nombre)
  {
      echo "Uno";
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
   
   function distribuidor_insert_callback($post_array, $primary_key = null) {
    $this->load->model('viaje_m');

    $nroViaje = $this->viaje_m->getNroViaje($post_array['id_proveedor']);
    
    $post_array['numero_de_viaje'] = $nroViaje;
    
    $post_array['id_distribuidor'] = $this->session->userdata('empresa');//Fijo el Id del proveedor segun el perfil logueado
    
    return $post_array;
   }
   
   function log_cambio_estado($post_array,$primary_key)
   {
        transicionSimple($primary_key, 1, "viaje");

        return true;
   }
   
}