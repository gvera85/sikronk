<?php

class notaDeCreditoDebito extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Nota de crédito/débito');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $this->grocery_crud->set_table('nota_credito_debito');
    $this->grocery_crud->edit_fields('tipo','importe', 'fecha','observaciones');
    $this->grocery_crud->add_fields('tipo','importe', 'fecha','observaciones');
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Nota de crédito/débito');
    $this->grocery_crud->required_fields('tipo','importe', 'fecha');
    $this->grocery_crud->columns('fecha', 'tipo','importe','observaciones');
    
   
    $this->grocery_crud->field_type('tipo','dropdown', array('0' => 'Débito', '1' => 'Crédito'));
    
    //$this->grocery_crud->callback_column('credito',array($this,'_callback_tipo_nota'));
    
    $output = $this->grocery_crud->render();
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
