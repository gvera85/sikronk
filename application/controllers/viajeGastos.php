<?php

class viajeGastos extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Gastos de un viaje');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('viaje_gasto');
    
    $this->grocery_crud->edit_fields('id_viaje','id_gasto','precio_unitario','cantidad','observaciones');
    $this->grocery_crud->add_fields('id_viaje','id_gasto','precio_unitario','cantidad','observaciones');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Gastos de un viaje');
    $this->grocery_crud->required_fields('id_viaje','id_gasto','precio_unitario','cantidad','observaciones');
    $this->grocery_crud->columns('id_viaje','id_gasto','precio_unitario','cantidad','observaciones');
    
    $this->grocery_crud->display_as('id_viaje','Viaje - Proveedor');
    $this->grocery_crud->display_as('id_gasto','Gasto');
    
    $this->grocery_crud->callback_column('id_viaje',array($this,'item_description_callback'));
    
    //$this->grocery_crud->set_relation('id_viaje','viaje','id');
    $this->grocery_crud->set_relation('id_gasto','gastos_de_un_viaje','{descripcion}');
    
    $output = $this->grocery_crud->render();
    $this->usuario_output($output);
  }
    
  function popUp($primary_key, $id_proveedor, $nro_viaje){
    $id_viaje = $primary_key;    
    if ($id_viaje) {
            $this->session->set_userdata('id_viaje', $id_viaje);        
    }          
    
    $this->load->library('grocery_CRUD');
    $this->load->library('ajax_grocery_CRUD');
    
    //create ajax_grocery_CRUD instead of grocery_CRUD. This extends the functionality with the set_relation_dependency method keeping all original functionality as well
    $crud = new ajax_grocery_CRUD();
    
    $crud->set_language("spanish");
            
    $crud->where('id_viaje', $id_viaje);      
    
    $crud->set_theme('datatables');
    
    $crud->set_table('viaje_gasto');
    $crud->edit_fields('id_viaje','id_gasto','precio_unitario','cantidad','observaciones');
    $crud->add_fields('id_viaje','id_gasto','precio_unitario','cantidad','observaciones');
    
    //$crud->set_theme('datatables');
   
    $crud->set_subject('Gastos del viaje');
    $crud->required_fields('id_gasto','precio_unitario','cantidad');
    $crud->columns('id_gasto','precio_unitario','cantidad','observaciones');
    
    $crud->fields('id_viaje','id_gasto','precio_unitario','cantidad','observaciones');
    $crud->change_field_type('id_viaje','invisible');
    
    $crud->callback_before_insert(array($this,'viaje_callback'));
    $crud->callback_before_update(array($this,'viaje_callback'));
  
    $crud->display_as('id_gasto','Gasto');
    $crud->set_relation('id_gasto','gastos_de_un_viaje','{descripcion}');
  
    $output = $crud->render();
    
    $this->load->model('proveedor_m');

    $Proveedor = $this->proveedor_m->getProveedorXViaje($id_viaje);

    $this->session->set_userdata('titulo', "Viaje ".$nro_viaje." - ".$Proveedor[0]["razon_social"]); 
        
    $this->viaje_gastos_output($output);
  }
  
  function viaje_gastos_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
  
  function viaje_callback($post_array) {
   $post_array['id_viaje'] = $this->session->userdata('id_viaje');//Fijo el Id de viaje recibido por parametro
   
   $this->load->model('vl_m');

   $cantidadPallets = $this->vl_m->getCantidadPallets($post_array['id_variable_logistica'], $post_array['cantidad_bultos']);
   
   
   
   $post_array['cantidad_pallets'] = $cantidadPallets;
 
   return $post_array;
}
  
   function item_description_callback($value, $row) { 
       
       $this->load->model('proveedor_m');

       $Proveedor = $this->proveedor_m->getProveedorXViaje($row->id_viaje);

       return $row->id_viaje." - ".$Proveedor[0]["razon_social"]; 
       //return substr($value,0,40); 
   }
   
}
