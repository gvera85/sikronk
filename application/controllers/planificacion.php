<?php

class Planificacion extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Planificaciones');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function planificacionReparto($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
   
    $this->load->view('planificacionReparto',$data);
  }
  
  function confirmacionViaje($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;

    $this->load->view('reparto2',$data);
  }
  
  function grabarReparto(){
    if(isset($_POST['bultos']) && !empty($_POST['bultos'])){
        echo 'Producto: '.join(",",$_POST['idProducto']).'-'; /*Recorrer los productos*/
        /*Por cada producto recorrer sus clientes*/        
            echo 'Cliente: '.join(",",$_POST['comboClientes']).'-';
            echo 'Viaje: '.join(",",$_POST['idViaje']).'-';
            echo 'VL: '.join(",",$_POST['idVL']).'-';
            echo 'Bultos: '.join(",",$_POST['bultos']).'-';
            echo 'Pallets: '.join(",",$_POST['pallets']).'-';
        
      /*  $data = array(
   'id_viaje' => 'My title' ,
   'name' => 'My Name' ,
   'date' => 'My date'
);
        
        insert into planificacion_reparto (id_viaje, id_cliente, id_producto, id_vl, cant_bultos, cant_pallets)

$this->db->insert('planificacion_reparto', $data); */
        
    }else{
      echo 'failed';
    }
  }
  
}
