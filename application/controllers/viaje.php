<?php

class Viaje extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Viajes');
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->where('id_distribuidor', $this->session->userdata('empresa'));  
     
    $this->grocery_crud->set_table('viaje');
    $this->grocery_crud->edit_fields('id_proveedor','numero_de_viaje', 'numero_de_remito','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista', 'observaciones');
    $this->grocery_crud->add_fields('id_proveedor','numero_de_viaje', 'numero_de_remito','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista',  'observaciones');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Viaje');
    $this->grocery_crud->required_fields('id_proveedor', 'numero_de_viaje', 'fecha_estimada_salida','fecha_estimada_llegada');
    $this->grocery_crud->columns('id','numero_de_viaje','id_proveedor','numero_de_remito','fecha_estimada_llegada','patente_semi','id_empresa_transportista','id_estado','cantidad_productos');
    
    $this->grocery_crud->callback_column('cantidad_productos',array($this,'_callback_cantidad_productos'));
    
    //$this->grocery_crud->callback_column('fecha_estimada_llegada',array($this,'_callback_ordenamiento_fecha'));
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social', array('activo' => 1));
    
    $this->grocery_crud->display_as('numero_de_remito','Remito');
    
    $this->grocery_crud->display_as('id_empresa_transportista','Transportista');
    $this->grocery_crud->set_relation('id_empresa_transportista','transportista','razon_social');
    
    $this->grocery_crud->display_as('numero_de_viaje','# Viaje');
    
    $this->grocery_crud->display_as('id_chofer','Chofer');
    $this->grocery_crud->set_relation('id_chofer','chofer','{dni} - {nombre} {apellido} - Tel: {telefono}', array('activo' => 1));
    
    $this->grocery_crud->display_as('id_estado','Estado');
    $this->grocery_crud->set_relation('id_estado','estado','descripcion');
        
    $this->grocery_crud->add_action('Prod', base_url().'/assets/img/iconoProducto.png', '','ui-icon-image',array($this,'link_hacia_productos'));
    $this->grocery_crud->add_action('Img', base_url().'/assets/img/iconoImagenes.png', '','ui-icon-image',array($this,'link_hacia_imagenes'));
    $this->grocery_crud->add_action('D', base_url().'/assets/img/iconoDetalle.png', '','ui-icon-image',array($this,'link_hacia_detalle'));
    
    $this->grocery_crud->set_rules('patente_semi','Patente semi','callback_validarPatente');
    $this->grocery_crud->set_rules('patente_camion','Patente del camion','callback_validarPatente');
    $this->grocery_crud->set_rules('numero_de_remito','Remito','callback_validarRemito');
    
    $this->grocery_crud->fields('id_distribuidor','id_proveedor','numero_de_viaje', 'numero_de_remito' , 'fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista',  'observaciones');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    //$this->grocery_crud->change_field_type('numero_de_viaje','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'distribuidor_insert_callback'));
    $this->grocery_crud->callback_before_update(array($this,'distribuidor_callback'));
    $this->grocery_crud->callback_after_insert(array($this, 'log_cambio_estado'));
    
    $this->grocery_crud->callback_before_delete(array($this,'validacion_delete'));
    
    $this->grocery_crud->callback_before_delete(array($this,'cek_before_delete'));
    $this->grocery_crud->set_lang_string('delete_error_message', 'No se pudo eliminar el viaje debido a que posee planificaciones o repartos activos.');
    
    $this->grocery_crud->order_by('id', 'desc'); 
    
    $output = $this->grocery_crud->render();
    $this->viaje_output($output);
  }
  
    public function _callback_cantidad_productos($value, $row)
    {
      
        $this->load->model('viaje_m');

        $cantProductos = $this->viaje_m->getCantidadProductos($row->id);
    
        
        return $cantProductos;
    }
    
  function viaje_output($output = null){
    $this->load->view('mostrarABM', $output);
  }
  
  function link_hacia_productos($primary_key , $row)
  {
        //return site_url('viajeVL/popUp/'.$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje);
        return "javascript:window.open('" . base_url('/index.php/viajeVL/popUp'). '/' .$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje. "')";
  }
  
  function link_hacia_imagenes($primary_key , $row)
  {
        return "javascript:window.open('" . base_url('/index.php/imagenes/viaje'). '/' .$row->id. "')";
  }
  
  function link_hacia_detalle($primary_key , $row)
  {
        if ($row->id_estado != ESTADO_VIAJE_CREADO && 
            $row->id_estado != ESTADO_VIAJE_PLANIFICANDO_REPARTO && 
            $row->id_estado != ESTADO_VIAJE_REPARTO_PLANIFICADO && 
            $row->id_estado != ESTADO_VIAJE_REVISANDO_STOCK &&
            $row->id_estado != ESTADO_VIAJE_STOCK_ARRIBADO_Y_CONFIRMADO
           )
        {
            return "javascript:window.open('" . base_url('/index.php/planificacion/verViaje'). '/' .$row->id. "')";
        }
        else 
        {
            return "javascript:alert('No se puede ver el detalle del viaje en este estado')";
        }
       
        
       /* define('ESTADO_VIAJE_CREADO','1');
define('ESTADO_VIAJE_PLANIFICANDO_REPARTO','2');
define('ESTADO_VIAJE_REPARTO_PLANIFICADO','3');
define('ESTADO_VIAJE_REVISANDO_STOCK','11');*/
        
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
  
  public function validarRemito($remitoIngresado) 
  {
    if ($remitoIngresado)
    {
        if (preg_match('/^[0-9]{12}$/', $remitoIngresado))
        {
          return TRUE;
        } else {
           $this->form_validation->set_message('validarRemito', $remitoIngresado.' no es un remito valido. Se debe ingresar un número de 12 dígitos');  
          return FALSE;
        } 
    }  else {
       return TRUE; 
    }
  }
  
  
  
  function viajeProveedor($idDistribuidor, $idProveedor){
    $this->grocery_crud->where('id_distribuidor', $idDistribuidor);  
    $this->grocery_crud->where('id_proveedor', $idProveedor);  
    
    $this->session->set_userdata('id_proveedor', $idProveedor); 
    $this->session->set_userdata('id_distribuidor', $idDistribuidor); 
     
    $this->grocery_crud->set_table('viaje');
    $this->grocery_crud->edit_fields('numero_de_remito','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista');
    $this->grocery_crud->add_fields('numero_de_remito','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Viaje');
    $this->grocery_crud->required_fields('fecha_estimada_salida','fecha_estimada_llegada');
    $this->grocery_crud->columns('id','numero_de_viaje','numero_de_remito','fecha_estimada_llegada','patente_semi','id_empresa_transportista','id_estado','cantidad_productos');
    
    $this->grocery_crud->callback_column('cantidad_productos',array($this,'_callback_cantidad_productos'));
     
    $this->grocery_crud->display_as('id_empresa_transportista','Transportista');
    $this->grocery_crud->set_relation('id_empresa_transportista','transportista','razon_social');
    
    $this->grocery_crud->display_as('numero_de_viaje','# Viaje');
    
    $this->grocery_crud->display_as('id_chofer','Chofer');
    $this->grocery_crud->set_relation('id_chofer','chofer','{dni} - {nombre} {apellido} - Tel: {telefono}');
    
    $this->grocery_crud->display_as('id_estado','Estado');
    $this->grocery_crud->set_relation('id_estado','estado','descripcion');
        
    $this->grocery_crud->add_action('Productos', base_url().'/assets/img/iconoProducto.png', '','ui-icon-image',array($this,'link_hacia_productos'));
    
    
    $this->grocery_crud->set_rules('patente_semi','Patente semi','callback_validarPatente');
    $this->grocery_crud->set_rules('patente_camion','Patente del camion','callback_validarPatente');
    
    $this->grocery_crud->fields('id_distribuidor','id_proveedor','numero_de_remito','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista','numero_de_viaje');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    $this->grocery_crud->change_field_type('numero_de_viaje','invisible');
    $this->grocery_crud->change_field_type('id_proveedor','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'creacion_viaje_prov_insert_callback'));
    $this->grocery_crud->callback_before_update(array($this,'creacion_viaje_prov_upd_callback'));
    $this->grocery_crud->callback_after_insert(array($this, 'log_cambio_estado'));
    
    $this->grocery_crud->callback_before_delete(array($this,'validacion_delete'));
    
    $this->grocery_crud->callback_before_delete(array($this,'cek_before_delete'));
    $this->grocery_crud->set_lang_string('delete_error_message', 'No se pudo eliminar el viaje debido a que posee planificaciones o repartos activos.');
    
    $output = $this->grocery_crud->render();
    $this->viaje_output($output);
  }
  
  
   function cek_before_delete($primary_key) {
        $this->db->db_debug = false;
        $this->db->trans_begin();
        $this->db->where('id', $primary_key);
        $this->db->delete('viaje');
        $num_rows = $this->db->affected_rows();
        $this->db->trans_rollback();
        if ($num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
   }
   
   function distribuidor_callback($post_array) {
    $post_array['id_distribuidor'] = $this->session->userdata('empresa');//$this->session->userdata('id_producto');//Fijo el Id de distribuidor
    
    return $post_array;
   }
   
   function distribuidor_insert_callback($post_array, $primary_key = null) {
    $this->load->model('viaje_m');

    //$nroViaje = $this->viaje_m->getNroViaje($post_array['id_proveedor']);
    
    //$post_array['numero_de_viaje'] = $nroViaje;
    
    $post_array['id_distribuidor'] = $this->session->userdata('empresa');//Fijo el Id del proveedor segun el perfil logueado
    
    return $post_array;
   }
   
   function creacion_viaje_prov_upd_callback($post_array) {
    $post_array['id_distribuidor'] = $this->session->userdata('id_distribuidor');//$this->session->userdata('id_producto');//Fijo el Id de distribuidor
    $post_array['id_proveedor'] = $this->session->userdata('id_proveedor');//$this->session->userdata('id_producto');//Fijo el Id de distribuidor
    return $post_array;
   }
   
   function creacion_viaje_prov_insert_callback($post_array, $primary_key = null) {
    $this->load->model('viaje_m');

    $nroViaje = $this->viaje_m->getNroViaje($this->session->userdata('id_proveedor'));
    
    $post_array['numero_de_viaje'] = $nroViaje;
    
    $post_array['id_distribuidor'] = $this->session->userdata('id_distribuidor');//$this->session->userdata('id_producto');//Fijo el Id de distribuidor
    $post_array['id_proveedor'] = $this->session->userdata('id_proveedor');//$this->session->userdata('id_producto');//Fijo el Id de distribuidor
    
    return $post_array;
   }
   
   function log_cambio_estado($post_array,$primary_key)
   {
        transicionSimple($primary_key, 1, "viaje");

        return true;
   }
   
   public function _callback_ordenamiento_fecha($value, $row) {
        $date = explode("-",$value);
        return $date[2]."/".$date[1]."/".$date[0];
    }
   
}