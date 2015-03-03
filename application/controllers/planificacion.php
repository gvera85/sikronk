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
  
  function valorizarViaje($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $lineasReparto = $this->viaje_m->getRepartoConfirmado($idViaje);
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['lineasReparto'] = $lineasReparto;
   
    $this->load->view('valorizarViaje',$data);
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
  
  function grabarConfirmacionViaje(){
    if(isset($_POST['idProducto']) && !empty($_POST['idProducto']))
    {
        $producto = $_POST['idProducto'];
        $viaje = $_POST['idViaje'];
        $cliente = $_POST['comboClientes'];
        $VL = $_POST['idVL'];
        $bultos = $_POST['bultos'];
        $pallets = $_POST['pallets'];
        
        $cantPalletsViaje = $_POST['cantPalletsViaje'];
        $cantBultosViaje = $_POST['cantBultosViaje'];
        $idProductoViaje = $_POST['idProductoViaje'];
        $idViajeViaje = $_POST['idViajeViaje'];
        
        //saco el numero de elementos
        $longitud = count($producto);

        $this->db->delete('reparto', array('id_viaje' => $viaje[0]));
        
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

            $this->db->insert('reparto', $data);
            
            
        }
        
        $longitudItemsViaje = count($idProductoViaje);
        
        //Recorro todos los elementos
        for($i=0; $i<$longitudItemsViaje; $i++)
        {
            $this->load->model('viaje_m');
  
            $this->viaje_m->updateCantidadesViaje($cantBultosViaje[$i], $cantPalletsViaje[$i], $idViajeViaje[$i], $idProductoViaje[$i]);
        }
        
    }
    else
    {
      $viaje = $_POST['idViaje'];  
      $this->db->delete('planificacion_reparto', array('id_viaje' => $viaje[0]));
    }
    
    $botonPresionado = $_POST['botonPresionado'];
    
    if ($botonPresionado == "botonCierreViaje") 
    {
        transicionSimple($viaje[0], ESTADO_VIAJE_STOCK_CONFIRMADO, "viaje");
        echo "Planificacion cerrada correctamente";
    }   
    else
    {
        transicionSimple($viaje[0], ESTADO_VIAJE_CONFIRMANDO_STOCK, "viaje");
        echo "Planificacion guardada correctamente";
    }
  }
  
  function grabarConfirmacionPrecio(){
    if(isset($_POST['idProducto']) && !empty($_POST['idProducto']))
    {
        $idProducto = $_POST['idProducto'];
        $idReparto = $_POST['idReparto'];
        $viaje = $_POST['idViaje'];
        $precioBulto = $_POST['precioBulto'];
        
        //saco el numero de elementos
        $longitud = count($idReparto);
        
        //Recorro todos los elementos
        for($i=0; $i<$longitud; $i++)
        {
            $this->load->model('viaje_m');
  
            $this->viaje_m->updateReparto($precioBulto[$i], $idReparto[$i]);
        }
        
        $botonPresionado = $_POST['botonPresionado'];
    
        if ($botonPresionado == "botonCierreViaje") 
        {
            transicionSimple($viaje[0], ESTADO_VIAJE_PRECIO_ACORDADO, "viaje");
            echo "Precios guardados";
        }   
        else
        {
            transicionSimple($viaje[0], ESTADO_VIAJE_DETERMINANDO_PRECIO, "viaje");
            echo "Viaje con el precio acordado correctamente";
        }
        
    }
    
    
  }
  
  
}
