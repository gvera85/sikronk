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
    $crud->edit_fields('id_viaje','id_gasto','id_proveedor' ,'precio_unitario','cantidad','a_cargo_del_proveedor', 'id_modo_pago','observaciones');
    $crud->add_fields('id_viaje','id_gasto','id_proveedor' ,'precio_unitario','cantidad','a_cargo_del_proveedor', 'id_modo_pago','observaciones');
        

    
    //$crud->set_theme('datatables');
   
    $crud->set_subject('Gastos del viaje');
    $crud->required_fields('id_gasto','precio_unitario','cantidad');
    $crud->columns('id_gasto','id_proveedor_de_servicios' ,'precio_unitario','cantidad','total','a_cargo_del_proveedor','observaciones');
    
    $crud->callback_column('total',array($this,'_callback_monto_total'));
    
    $crud->display_as('total','Total [$]');
    $crud->display_as('precio_unitario','Precio unitario [$]');
    $crud->display_as('id_proveedor_de_servicios','Prov. de servicios');
    
    $crud->fields('id_viaje','id_gasto','id_proveedor_de_servicios','precio_unitario','cantidad','a_cargo_del_proveedor','id_modo_pago','observaciones');
    
    $crud->change_field_type('id_viaje','invisible');
    $crud->change_field_type('a_cargo_del_proveedor', 'true_false');
    
    $crud->callback_before_insert(array($this,'viaje_callback'));
    $crud->callback_before_update(array($this,'viaje_callback'));
  
    $crud->display_as('id_gasto','Gasto');
    $crud->set_relation('id_gasto', 'gastos_de_un_viaje', '{descripcion}', array('activo' => 1));
    $crud->set_relation('id_proveedor_de_servicios','proveedor_de_servicios','{razon_social}', array('activo' => 1));
    
    $crud->display_as('id_modo_pago','Tipo de pago');
    $crud->set_relation('id_modo_pago','modo_pago','{descripcion}', array('visto_por_clientes' => 1, 'activo' => 1));
    
    $crud->change_field_type('a_cargo_del_proveedor', 'true_false');
    
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
   
   public function _callback_monto_total($value, $row)
    {
      
        $this->load->model('viaje_m');

        $gastos = $row->cantidad * $row->precio_unitario;
    
        
        return $gastos;
    }
   
}
