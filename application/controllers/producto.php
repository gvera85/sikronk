<?php

class producto extends CI_Controller{

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
    $this->grocery_crud->set_table('producto');
    $this->grocery_crud->edit_fields('descripcion','id_proveedor');
    $this->grocery_crud->add_fields('descripcion','id_proveedor');
    
    //$this->grocery_crud->callback_column('descripcion', array($this, '_callback_desc'));
    
    $this->grocery_crud->set_theme('datatables');
   
    $this->grocery_crud->set_subject('Producto');
    $this->grocery_crud->required_fields('descripcion','id_proveedor');
    $this->grocery_crud->columns('descripcion','id_proveedor');
    
    $this->grocery_crud->display_as('id_proveedor','Proveedor');
        
    $this->grocery_crud->set_relation('id_proveedor','proveedor','razon_social');
    
    $this->grocery_crud->add_action('VL', base_url().'/assets/img/vl.png', '','ui-icon-image',array($this,'link_hacia_vl'));
    
    $output = $this->grocery_crud->render();
    
    $this->perfil_output($output);
  }
  
  function perfil_output($output = null){
    $this->load->view('mostrarABM',$output);
  } 
  
  //FANCYBOX TEST
    public function _callback_desc($value, $row)
    {
      return "<a href='http://www.grocerycrud.com/assets/themes/default/images/logo.png' class='fancybox'>$value</a>";
    }
    
    function link_hacia_vl($primary_key , $row)
    {
        return base_url().'index.php/vl/popUp?id_producto='.$row->id;
    }

}
