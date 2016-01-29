<?php

class ViajeVL extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Productos de los viajes');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('productos_viaje');
    $this->grocery_crud->edit_fields('id_viaje','id_variable_logistica','cantidad');
    $this->grocery_crud->add_fields('id_viaje','id_variable_logistica','cantidad');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Productos del viaje');
    $this->grocery_crud->required_fields('id_viaje','id_variable_logistica','cantidad');;
    $this->grocery_crud->columns('id_viaje','id_variable_logistica','cantidad');;
    
    $this->grocery_crud->display_as('id_viaje','Viaje - Proveedor');
    $this->grocery_crud->display_as('id_variable_logistica','Producto');
    
    $this->grocery_crud->callback_column('id_viaje',array($this,'item_description_callback'));
    
    //$this->grocery_crud->set_relation('id_viaje','viaje','id');
    $this->grocery_crud->set_relation('id_variable_logistica','producto','{descripcion}');
    
    $output = $this->grocery_crud->render();
    $this->usuario_output($output);
  }
  
    function test()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('productos_viaje');
        $crud->set_relation('id_producto', 'producto', 'descripcion');
        $crud->set_relation('id_variable_logistica', 'variable_logistica', 'descripcion');
        
        $this->load->library('gc_dependent_select');

        $fields = array(
        'id_producto' => array(// first dropdown name
        'table_name' => 'producto', // table of country
        'title' => 'descripcion', // country title
        'relate' => null // the first dropdown hasn't a relation
        ),
        'id_variable_logistica' => array(// second dropdown name
        'table_name' => 'variable_logistica', // table of state
        'title' => 'descripcion', // state title
        'id_field' => 'id', // table of state: primary key
        'relate' => 'id_producto', // table of state:
        'data-placeholder' => 'Select VL' //dropdown's data-placeholder:
        )
        );
        
        $config = array(
        'main_table' => 'productos_viaje',
        'main_table_primary' => 'id',
        //"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/',
        'url'=>base_url().'/index.php/viajeVL/test'
        );
        $categories = new gc_dependent_select($crud, $fields, $config);
        $js = $categories->get_js();

       
        $output = $crud->render();
        $output->output.= $js;

        $this->usuario_output($output);
    }
  
  
  function test2()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('productos_viaje');
        $crud->set_relation('id_producto', 'producto', 'descripcion');
        $crud->set_relation('id_variable_logistica', 'variable_logistica', 'descripcion');
        
     
       
        $output = $crud->render();
     
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
    
    $crud->set_table('productos_viaje');
    $crud->edit_fields('id_producto', 'id_variable_logistica', 'cantidad_bultos', 'cantidad_pallets');
    $crud->add_fields('id_producto', 'id_variable_logistica','cantidad_bultos', 'cantidad_pallets');
    
    //$crud->set_theme('datatables');
   
    $crud->set_subject('Productos del viaje');
    $crud->required_fields('id_producto', 'id_variable_logistica','cantidad_bultos');
    $crud->columns('id_producto', 'id_variable_logistica','cantidad_bultos', 'cantidad_pallets');
    
    $crud->fields('id_viaje','id_producto', 'id_variable_logistica','cantidad_bultos', 'cantidad_pallets');
    $crud->change_field_type('id_viaje','invisible');
    
    $crud->callback_before_insert(array($this,'viaje_callback'));
    $crud->callback_before_update(array($this,'viaje_callback'));
    
    //$crud->display_as('id_viaje','Viaje - Proveedor');
    
    $crud->display_as('id_producto','Producto');
    $crud->set_relation('id_producto','producto','{descripcion} - {marca} - {calidad}',array('id_proveedor' => $id_proveedor));
    
    $crud->display_as('id_variable_logistica','Presentación');
    $crud->set_relation('id_variable_logistica','variable_logistica','{codigo_vl}-{descripcion}-{peso}[KG]-Pallet:{base_pallet}x{altura_pallet}');
   
    $crud->set_relation_dependency('id_variable_logistica','id_producto','id_producto');
   
    $crud->callback_before_delete(array($this,'cek_before_delete'));
    $crud->set_lang_string('delete_error_message', 'No se pudo eliminar el viaje debido a que posee planificaciones o repartos activos.');
    
    $crud->set_rules('id_variable_logistica','variable_logistica','callback_validarVL');

    $output = $crud->render();
    
    $this->load->model('proveedor_m');

    $Proveedor = $this->proveedor_m->getProveedorXViaje($id_viaje);

    $this->session->set_userdata('titulo', "Viaje ".$nro_viaje." - ".$Proveedor[0]["razon_social"]); 
    
    $this->usuario_output($output);
  }
  
  function usuario_output($output = null){
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
   
   function cek_before_delete($primary_key) {
       
        $this->db->where('id',$primary_key);
        $prod_viaje = $this->db->get('productos_viaje')->row();

        $sql = " select * from reparto where id_viaje = ? and id_producto  = ? and id_variable_logistica = ?"; 
        $query = $this->db->query($sql, array($prod_viaje->id_viaje, $prod_viaje->id_producto, $prod_viaje->id_variable_logistica));

        if ($query->num_rows() > 0)
        {
           return FALSE;
        } else {
            return TRUE;
        }       
        
   }
   
   
  public function validarVL($id_variable_logistica) 
  {
    $id_viaje = $this->session->userdata('id_viaje');  
    
    $sql = " select id_variable_logistica from productos_viaje where id_viaje=? and id_variable_logistica=?"; 
    $query = $this->db->query($sql, array($id_viaje, $id_variable_logistica));

    if ($query->num_rows() > 0)
    {
      $this->form_validation->set_message('validarVL', 'Este Producto/Peso ya fue elegido en este viaje');  
      return false;
    } 
    
    if ($id_variable_logistica == "")
    {
        $this->form_validation->set_message('validarVL', 'Debe seleccionar la presentación del producto');  
        return false;
    }       
    
    return true; 
      
      
     
  }
  
  public function validarEstadoNoNulo($idEstado) 
  {
      
    $id_estado = $this->input->post('id_estado');  
    
    if (  $id_estado == "" )/*ERROR!!! El importe no puede ser vacio enpago en cheques o efectivo*/
    {
        $this->form_validation->set_message('validarEstadoNoNulo', 'Si desea dejar el cheque *sin usar* presione el botón cancelar');  
        return FALSE;
    } 
    
    return TRUE; 
    
  }
    
   
}
