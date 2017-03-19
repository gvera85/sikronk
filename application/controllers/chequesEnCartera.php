<?php

class chequesEnCartera extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Cheques en cartera');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
    
    if (!verificarPermisoControlador($this->uri->segment(1), $this->session->userdata('idLineaPerfil'))) {
        redirect('/sinPermisos');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('pagos_clientes_lineas');
    $this->grocery_crud->edit_fields('id_estado', 'observaciones');

    $where = "id_estado IN ('".ESTADO_CHEQUE_SIN_USAR."')";
    $this->grocery_crud->where($where);
    
    $this->grocery_crud->where('id_modo_pago', 2);  
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Cheques en cartera');
    $this->grocery_crud->required_fields('descripcion');
    
    $this->grocery_crud->columns('stamp','importe', 'numero_de_cheque', 'fecha_de_acreditacion', 'id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones', 'id_estado');
    $this->grocery_crud->fields('id_estado','observaciones');
    
    $this->grocery_crud->display_as('stamp','Fecha creación');
    
    $this->grocery_crud->display_as('id_entidad_bancaria','Banco');
    $this->grocery_crud->set_relation('id_entidad_bancaria','entidad_bancaria','razon_social');
    
    $this->grocery_crud->display_as('id_sucursal_bancaria','Sucursal');
    $this->grocery_crud->set_relation('id_sucursal_bancaria','sucursales_bancarias','{numero_sucursal}-{direccion}');
    
    $this->grocery_crud->display_as('id_estado','Estado');
    
    $this->grocery_crud->set_relation('id_estado','estado','Descripcion');
    
    $this->grocery_crud->unset_add();
    $this->grocery_crud->unset_edit();
    $this->grocery_crud->unset_delete();
       
    $output = $this->grocery_crud->render();
    $this->gastos_output($output);
  }
  
  function gastos_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 

}
