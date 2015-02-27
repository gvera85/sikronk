<?php

class Reparto extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Repartos');
             
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
    $this->grocery_crud->columns('numero_de_viaje','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_empresa_transportista','id_estado','cantidad_productos');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
    $this->grocery_crud->display_as('numero_de_viaje','# Viaje');
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $this->grocery_crud->display_as('id_estado','Estado');
    $this->grocery_crud->set_relation('id_estado','estado','descripcion');
    
    $this->grocery_crud->display_as('id_empresa_transportista','Transportista');
    $this->grocery_crud->set_relation('id_empresa_transportista','transportista','razon_social');
    
    $this->grocery_crud->display_as('id_chofer','Chofer');
    $this->grocery_crud->set_relation('id_chofer','chofer','{dni} - {nombre} {apellido} - Tel: {telefono}');
        
    $this->grocery_crud->add_action('Plan', base_url().'/assets/img/planificacion.png', '','ui-icon-image',array($this,'link_hacia_planificacion'));
    
    $this->grocery_crud->set_rules('patente_semi','Patente semi','callback_validarPatente');
    $this->grocery_crud->set_rules('patente_camion','Patente del camion','callback_validarPatente');
    
    $this->grocery_crud->fields('id_distribuidor','id_proveedor','fecha_estimada_salida','fecha_estimada_llegada','patente_semi','patente_camion','id_chofer','id_empresa_transportista');
    
    $this->grocery_crud->change_field_type('id_distribuidor','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'distribuidor_callback'));
    $this->grocery_crud->callback_before_update(array($this,'distribuidor_callback'));
    
    
    $where = "id_estado IN ('".ESTADO_VIAJE_REPARTO_PLANIFICADO."','".ESTADO_VIAJE_CONFIRMANDO_STOCK."')";
    
    $this->grocery_crud->where($where);
  
    $this->grocery_crud->unset_add();
    $this->grocery_crud->unset_edit();
    $this->grocery_crud->unset_delete();
    
    $output = $this->grocery_crud->render();
    $this->viaje_output($output);
  }
    
  function viaje_output($output = null){
    $this->load->view('mostrarABM', $output);
  }
  
  function link_hacia_planificacion($primary_key , $row)
  {
        //return site_url('planificacion/planificacionReparto/'.$row->id);
        return "javascript:window.open('" . base_url('/index.php/planificacion/planificacionReparto'). '/' .$row->id. "')";
  }
  
  
   function distribuidor_callback($post_array) {
    $post_array['id_distribuidor'] = $this->session->userdata('empresa');//$this->session->userdata('id_producto');//Fijo el Id de producto recibido por parametro

    return $post_array;
   }
}
