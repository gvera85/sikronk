<?php

class notaDeCreditoDebito extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->library('ajax_grocery_CRUD');
    
    $this->load->database();
    $this->load->helper('url');
    
    $this->session->set_userdata('titulo', 'Nota de crédito/débito');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $crud = new ajax_grocery_CRUD();  
    $crud->set_language("spanish");      
      
    $crud->set_table('nota_credito_debito');
    $crud->edit_fields('id_tipo', 'id_tipo_credito_debito','importe', 'fecha','observaciones');
    $crud->add_fields('id_tipo', 'id_tipo_credito_debito','importe', 'fecha','observaciones');
    
    $crud->set_theme('datatables');
   
    $crud->set_subject('Nota de crédito/débito');
    $crud->required_fields('id_tipo', 'id_tipo_credito_debito','importe', 'fecha');
    $crud->columns('fecha', 'id_tipo', 'id_tipo_credito_debito','importe','observaciones');
    
    $crud->display_as('id_tipo','Tipo');        
    $crud->set_relation('id_tipo','tipo_mov','descripcion');
    
    $crud->display_as('id_tipo_credito_debito','Concepto');        
    $crud->set_relation('id_tipo_credito_debito','tipo_debito_credito','descripcion');
    
    $crud->set_relation_dependency('id_tipo_credito_debito','id_tipo','id_tipo');
    
    //$crud->callback_column('credito',array($this,'_callback_tipo_nota'));
    
    $output = $crud->render();
    $this->notaCredito($output);
  }
  
  function notaCredito($output = null){
    $this->load->view('mostrarABM',$output);
  } 
  
    public function _callback_tipo_nota($value, $row)
    {
        if ( $row->credito == 1)
            return "Credito";
        else
            return "Debito";
    }

}
