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
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function planificacionReparto($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $lineasReparto = $this->viaje_m->getRepartoViaje($idViaje);
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['lineasReparto'] = $lineasReparto;
   
    $this->load->view('reparto2',$data);
  }
  
  function confirmacionViaje($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $lineasReparto = $this->viaje_m->getRepartoViaje($idViaje);
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['lineasReparto'] = $lineasReparto;

    $this->load->view('confirmarViaje',$data);
  }
  
  function grabarReparto(){
    if(isset($_POST['idProducto']) && !empty($_POST['idProducto']))
    {
        $producto = $_POST['idProducto'];
        $viaje = $_POST['idViaje'];
        $cliente = $_POST['comboClientes'];
        $VL = $_POST['idVL'];
        $bultos = $_POST['bultos'];
        $pallets = $_POST['pallets'];

        //saco el numero de elementos
        $longitud = count($producto);

        $this->db->delete('planificacion_reparto', array('id_viaje' => $viaje[0]));
        
        //Recorro todos los elementos
        for($i=0; $i<$longitud; $i++)
        {
            $data = array(
                            'id_viaje' => $viaje[$i] ,
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
      $viaje = $_POST['idViaje'];  
      $this->db->delete('planificacion_reparto', array('id_viaje' => $viaje[0]));
    }
    
    $botonPresionado = $_POST['botonPresionado'];
    
    if ($botonPresionado == "botonPlanificacion") 
    {
        transicionAutomatica($viaje[0], 2);
        echo "Planificacion cerrada correctamente";
    }   
    else
    {
        transicionAutomatica($viaje[0], 1);
        echo "Planificacion guardada correctamente";
    }
    
    
  }
  
}
