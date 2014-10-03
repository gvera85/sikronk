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
    
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
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
    $this->load->view('mostrarABM',$output);
  } 
  
  function popUp(){
    $this->grocery_crud->set_table('variable_logistica');
    $this->grocery_crud->edit_fields('codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    $this->grocery_crud->add_fields('codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    
    $this->grocery_crud->display_as('peso','Peso del bulto [KG]');
    
    $this->id_producto = $this->input->get('id_producto');
    
    if($this->id_producto)
        $this->session->set_userdata('id_producto', $this->id_producto);
    
    $this->grocery_crud->where('id_producto', $this->session->userdata('id_producto'));

    $this->grocery_crud->set_theme('datatables');
    
    $this->grocery_crud->set_subject('Variable Logistica');
    $this->grocery_crud->required_fields('codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    $this->grocery_crud->columns('codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    
    $this->grocery_crud->fields('id_producto','codigo_vl','descripcion','peso','base_pallet','altura_pallet','activa');
    
    $this->grocery_crud->change_field_type('id_producto','invisible');
    
    $this->grocery_crud->callback_before_insert(array($this,'producto_callback'));
    
    $this->grocery_crud->change_field_type('activa', 'true_false');
    
    
    $this->grocery_crud->set_rules('codigo_vl','Codigo VL','callback_validar_codigo_vl');
    
    
    $output = $this->grocery_crud->render();
    $this->vl_output($output);
  }
  
  function producto_callback($post_array) {
   $post_array['id_producto'] = $this->session->userdata('id_producto');//Fijo el Id de producto recibido por parametro
 
   return $post_array;
}
  
function validar_codigo_vl($str)
{
    if( $str== 9999999999)
    {
            $this->form_validation->set_message('validar_codigo_vl', $str.' no es un codigo valido');
            return FALSE;
    }
    else
    {
            return TRUE;
    }
    return $str;
}  
  
}
