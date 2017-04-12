<?php

class cuentaBancariaMovimientos extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Movimientos');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function popUp($primary_key, $id_entidad_bancaria, $numeroCuenta){
    $id_cuenta_bancaria = $primary_key;    
    if ($id_cuenta_bancaria) {
            $this->session->set_userdata('id_cuenta_bancaria', $id_cuenta_bancaria);        
    }          
    
    $this->load->library('grocery_CRUD');
    $this->load->library('ajax_grocery_CRUD');
    
    //create ajax_grocery_CRUD instead of grocery_CRUD. This extends the functionality with the set_relation_dependency method keeping all original functionality as well
    $crud = new ajax_grocery_CRUD();
    
    $crud->set_language("spanish");
            
    $crud->where('movimientos_cuenta_bancaria.id_cuenta_bancaria', $id_cuenta_bancaria);      
    
    $crud->set_theme('datatables');
    
    $crud->set_table('movimientos_cuenta_bancaria');
    $crud->edit_fields('id_cuenta_bancaria','fecha_movimiento','importe','observaciones');
    $crud->add_fields('id_cuenta_bancaria','id_tipo_mov','fecha_movimiento','importe','observaciones');
        

    
    //$crud->set_theme('datatables');
   
    $crud->set_subject('Movimientos de la cuenta');
    $crud->required_fields('id_tipo_mov','importe','fecha_movimiento');
    $crud->columns('id_movimiento_cuenta_bancaria','id_tipo_mov','fecha_movimiento','importe','observaciones');
        
    $crud->fields('id_cuenta_bancaria','id_tipo_mov','fecha_movimiento','importe','observaciones');
    
    $crud->change_field_type('id_cuenta_bancaria','invisible');
     
    $crud->callback_before_insert(array($this,'movimiento_callback'));
    $crud->callback_before_update(array($this,'movimiento_callback'));
  
    $crud->display_as('id_tipo_mov','Movimiento');
    $crud->display_as('id_movimiento_cuenta_bancaria','Id');
    $crud->set_relation('id_tipo_mov', 'tipo_mov', '{descripcion}');
    
    $output = $crud->render();
    
    $this->load->model('proveedor_m');

    $Banco = $this->proveedor_m->getBancoXId($id_entidad_bancaria);

    $this->session->set_userdata('titulo', "Movimientos - ".$Banco[0]["razon_social"]. " | Cuenta ".$numeroCuenta); 
        
    $this->movs_gastos_output($output);
  }
  
  function movs_gastos_output($output = null){
    $this->load->view('mostrarABM', $output);
  } 
  
  function movimiento_callback($post_array) {
   $post_array['id_cuenta_bancaria'] = $this->session->userdata('id_cuenta_bancaria');//Fijo el Id de cuenta bancaria recibido por parametro
   
   /*if ($post_array['id_tipo_mov'] == 1) 
       $post_array['importe'] = (-1)*$post_array['importe'];
   */
   return $post_array;
  }
  
   
   
}
