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
        
    $producto = $_POST['idProducto'];
    $cliente = $_POST['comboClientes'];
    $VL = $_POST['idVL'];
    $bultos = $_POST['bultos'];
    $pallets = $_POST['pallets'];

    //saco el numero de elementos
    $longitud = count($producto);

    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        $data = array(
                        'id_viaje' => $producto[$i] ,
                        'id_cliente' => $cliente[$i] ,
                        'id_producto' => $producto[$i],
                        'id_vl' => $VL[$i],
                        'cant_bultos' => $bultos[$i],
                        'cant_pallets' => $pallets[$i]
                     );

        $this->db->insert('planificacion_reparto', $data);

    }
     
    }
    else
    {
      echo 'failed';
    }
  }
  
}
