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
    $this->grocery_crud->columns('id','numero_de_viaje','id_proveedor','numero_de_remito','fecha_estimada_llegada','id_estado','cantidad_productos');
    
    $this->grocery_crud->callback_column('cantidad_productos',array($this,'_callback_cantidad_productos'));
    $this->grocery_crud->callback_column('monto_gastos',array($this,'_callback_monto_gastos'));
    $this->grocery_crud->callback_column('monto_ganancias',array($this,'_callback_monto_ganancias'));
    
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
        
    $this->grocery_crud->add_action('PDF', base_url().'/assets/img/iconoPDF.png', '','ui-icon-image',array($this,'link_hacia_pdf'));
    $this->grocery_crud->add_action('Gastos', base_url().'/assets/img/iconoGastosViaje.png', '','ui-icon-image',array($this,'link_hacia_gastos'));
    //$this->grocery_crud->add_action('Gan.', base_url().'/assets/img/iconoGanancia.png', '','ui-icon-image',array($this,'link_hacia_ganancias'));
    $this->grocery_crud->add_action('D', base_url().'/assets/img/iconoDetalle.png', '','ui-icon-image',array($this,'link_hacia_detalle'));
    $this->grocery_crud->add_action('Img', base_url().'/assets/img/iconoImagenes.png', '','ui-icon-image',array($this,'link_hacia_imagenes'));
    
    $this->grocery_crud->set_rules('patente_semi','Patente semi','callback_validarPatente');
    $this->grocery_crud->set_rules('patente_camion','Patente del camion','callback_validarPatente');
    
    $this->grocery_crud->fields('id_distribuidor','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista','numero_de_viaje');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    $this->grocery_crud->change_field_type('numero_de_viaje','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'distribuidor_insert_callback'));
    $this->grocery_crud->callback_before_update(array($this,'distribuidor_callback'));
    $this->grocery_crud->callback_after_insert(array($this, 'log_cambio_estado'));
    
    $where = "id_estado IN ('".ESTADO_VIAJE_PRECIO_ACORDADO."','".ESTADO_VIAJE_PRECIO_ACORDADO_PROVEEDOR."')";
    
    $this->grocery_crud->where($where);
    
    $this->grocery_crud->unset_add();
    $this->grocery_crud->unset_edit();
    $this->grocery_crud->unset_delete();
    
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
    
    public function _callback_monto_gastos($value, $row)
    {
      
        $this->load->model('viaje_m');

        $gastos = $this->viaje_m->getMontoGastos($row->id);
    
        
        return $gastos;
    }
    
    public function _callback_monto_ganancias($value, $row)
    {
      
        $this->load->model('viaje_m');

        $ganancias = $this->viaje_m->getMontoGanancias($row->id);
        
        return $ganancias;
    }
    
  function viaje_output($output = null){
    $this->load->view('mostrarABM', $output);
  }
  
  function link_hacia_gastos($primary_key , $row)
  {
        //return site_url('viajeVL/popUp/'.$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje);
        return "javascript:window.open('" . base_url('/index.php/viajeGastos/popUp'). '/' .$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje. "')";
  }
  
  function link_hacia_ganancias($primary_key , $row)
  {
        //return site_url('viajeVL/popUp/'.$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje);
        return "javascript:window.open('" . base_url('/index.php/viajeGanancias/popUp'). '/' .$row->id.'/'.$row->id_proveedor.'/'.$row->numero_de_viaje. "')";
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
   
    function link_hacia_imagenes($primary_key , $row)
    {
          return "javascript:window.open('" . base_url('/index.php/imagenes/viaje'). '/' .$row->id. "')";
    }
    
    function link_hacia_PDF($primary_key , $row)
    {
          return "javascript:window.open('" . base_url('/index.php/generarPDFConf/comprobanteViaje'). '/' .$row->id. "/1')";
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
       
    }
   
}