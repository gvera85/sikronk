<?php

class vl extends CI_Controller{

  var $id_producto;
    
  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Variables logisticas');    
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index($primary_key){
    $this->grocery_crud->set_table('variable_logistica');
    $this->grocery_crud->edit_fields('id_producto','codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    $this->grocery_crud->add_fields('id_producto','codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    
    $this->id_producto = $this->input->get('id_producto');
    
    if ($this->id_producto) {
            $this->grocery_crud->where('id_producto', $this->id_producto);
    }

    $this->grocery_crud->set_theme('datatables');
    
    $this->grocery_crud->display_as('id_producto','Producto');
    
    $this->grocery_crud->display_as('peso','Peso del bulto [KG]');
        
    $this->grocery_crud->set_relation('id_producto','producto','descripcion');
    
    
    $this->grocery_crud->set_subject('Variable Logistica');
    $this->grocery_crud->required_fields('id_producto','codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    $this->grocery_crud->columns('id_producto','codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    
    $this->grocery_crud->change_field_type('activa', 'true_false');
    
    $output = $this->grocery_crud->render();
    $this->vl_output($output);
  }
  
  
  function vl_output($output = null){
    $this->load->view('mostrarPopUp',$output);
  } 
  
  function popUp($primary_key,$DescProducto){
    $this->id_producto = $primary_key;
    
    if ($this->id_producto) {
            $this->session->set_userdata('id_producto', $this->id_producto);
        }

    $this->grocery_crud->where('id_producto', $primary_key);  
      
    $this->grocery_crud->set_table('variable_logistica');
    $this->grocery_crud->edit_fields('descripcion','peso','base_pallet','altura_pallet','activa');
    $this->grocery_crud->add_fields('descripcion','peso','base_pallet','altura_pallet','activa');
    
    $this->grocery_crud->display_as('peso','Peso del bulto [KG]');
   
    $this->grocery_crud->set_theme('datatables');
    
    $this->grocery_crud->set_subject('Variable Logistica');
    $this->grocery_crud->required_fields('id_tipo_envase','descripcion','peso','base_pallet','altura_pallet','activa');
    $this->grocery_crud->columns('codigo_vl','id_tipo_envase','descripcion','peso','base_pallet','altura_pallet','activa');
    
    $this->grocery_crud->fields('id_producto','id_tipo_envase','descripcion','peso','base_pallet','altura_pallet','activa','codigo_vl');
    
    $this->grocery_crud->display_as('id_tipo_envase','Tipo de envase');
    $this->grocery_crud->set_relation('id_tipo_envase','tipo_envase','descripcion');
    
    $this->grocery_crud->change_field_type('id_producto','invisible');
    $this->grocery_crud->change_field_type('codigo_vl','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'insert_producto_callback'));
    //$this->grocery_crud->callback_before_update(array($this,'producto_callback'));
    
    $this->grocery_crud->change_field_type('activa', 'true_false');
    
    $output = $this->grocery_crud->render();
    
    $this->session->set_userdata('titulo', "Producto: ".urldecode($DescProducto));    
    $this->vl_output($output);
  }
  
  function insert_producto_callback($post_array, $primary_key = null) {
         
    $this->load->model('vl_m');

    $codigoVL = $this->vl_m->getCodigoVL($this->session->userdata('id_producto'));

    $post_array['codigo_vl'] = $codigoVL;

    $post_array['id_producto'] = $this->session->userdata('id_producto');//Fijo el Id de producto recibido por parametro

    return $post_array;
}
  
}
