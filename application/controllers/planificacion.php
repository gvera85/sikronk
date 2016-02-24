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
    $data['modo'] = "edicion";
   
    $this->load->view('planificacionRepartoViaje',$data);
  }
  
  function confirmacionViaje($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    //$lineasReparto = $this->viaje_m->getRepartoViaje($idViaje);
    
    $lineasReparto = $this->viaje_m->getRepartoConfirmado($idViaje, null);
    
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['lineasReparto'] = $lineasReparto;
    $data['modo'] = "edicion";

    $this->load->view('confirmarViaje',$data);
  }
  
   function confirmacionStockArribado($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    //$lineasReparto = $this->viaje_m->getRepartoViaje($idViaje);
    
    
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['modo'] = "edicion";

    $this->load->view('confirmarStockArribado',$data);
  }
  
  
  
  function valorizarViaje($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $lineasReparto = $this->viaje_m->getRepartoConfirmado($idViaje, null);
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['lineasReparto'] = $lineasReparto;
    $data['modo'] = "edicion";
   
    $this->load->view('valorizarViaje',$data);
  }
  
  function verViaje($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');
    $this->load->model('reporte_ventas_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $lineasReparto = $this->viaje_m->getRepartoConfirmado($idViaje, null);
    $clientes = $this->cliente_m->getClientes();
    $resumenViaje = $this->reporte_ventas_m->getResumenViaje($idViaje);
    $lineasGastos = $this->reporte_ventas_m->getGastos($idViaje);
    
    $data['resumenViaje'] = $resumenViaje;    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['lineasReparto'] = $lineasReparto;
    $data['lineasGastos'] = $lineasGastos;
    $data['modo'] = "vista";
   
    $this->load->view('valorizarViaje',$data);
  }
  
  
  function valorizarViajeCliente($idViaje, $idCliente){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');

    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    $lineasReparto = $this->viaje_m->getRepartoConfirmado($idViaje, $idCliente);
    $clientes = $this->cliente_m->getClientes();
    
    $data['lineasViaje'] = $lineasViaje;
    $data['clientes'] = $clientes;
    $data['lineasReparto'] = $lineasReparto;
    $data['modo'] = "edicion";
   
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
        
        //start the transaction
        $this->db->trans_begin();
        //update user_account table      
       
        $this->db->delete('planificacion_reparto', array('id_viaje' => $viaje[0]));
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

            if (!$this->db->insert('planificacion_reparto', $data))
            {
            
              $this->output->set_status_header(500,'Error al grabar el cliente ['.$cliente[$i].'] en la planificacion');
              $this->db->trans_rollback(); 
              return false;
              //$this->output->set_status_header(500,$result);
            }
            
          
            
            $data = array(
                            'id_viaje' => $viaje[$i] ,
                            'id_cliente' => $cliente[$i] ,
                            'id_producto' => $producto[$i],
                            'id_variable_logistica' => $VL[$i],
                            'cantidad_bultos' => $bultos[$i],
                            'cantidad_pallets' => $pallets[$i]
                         );
            
            
            if (!$this->db->insert('reparto', $data))
            {
            
              $this->output->set_status_header(500,'Error al grabar el cliente ['.$cliente[$i].'] en el reparto');
              $this->db->trans_rollback(); 
              return false;
            }
        }
        
    }
    else
    {
      $viaje = $_POST['idViaje'];  
      $this->db->delete('planificacion_reparto', array('id_viaje' => $viaje[0]));
      
      $this->db->delete('reparto', array('id_viaje' => $viaje[0]));
    }
    
    
    //make transaction complete
    $this->db->trans_complete();
    //check if transaction status TRUE or FALSE
    if ($this->db->trans_status() === FALSE) {
        //if something went wrong, rollback everything
        $this->db->trans_rollback();    
    } else {
        //if everything went right, commit the data to the database
        $this->db->trans_commit();       
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
  
  
  function grabarConfirmacionStock(){
    $upd=""; //variable para debug
    
    if(isset($_POST['idViajeViaje']) && !empty($_POST['idViajeViaje']))
    {
        $cantPalletsViaje = $_POST['cantPalletsViaje'];
        $cantBultosViaje = $_POST['cantBultosViaje'];
        $idProductoViaje = $_POST['idProductoViaje'];
        $idViajeViaje = $_POST['idViajeViaje'];
        $IdVLViaje = $_POST['VL'];
        
        //start the transaction
        $this->db->trans_begin();
        
        //Recorro todos los elementos        
        $longitudItemsViaje = count($IdVLViaje);
        
        //Recorro todos los elementos
        for($i=0; $i<$longitudItemsViaje; $i++)
        {
            $this->load->model('viaje_m');
  
            $this->viaje_m->updateCantidadesViaje($cantBultosViaje[$i], $cantPalletsViaje[$i], $idViajeViaje[$i], $idProductoViaje[$i], $IdVLViaje[$i]);
            
            $upd = $upd.$cantBultosViaje[$i]."-".$cantPalletsViaje[$i]."-".$idViajeViaje[$i]."-".$idProductoViaje[$i]."-".$IdVLViaje[$i]."****";
        }
        
        //make transaction complete
        $this->db->trans_complete();
        //check if transaction status TRUE or FALSE
        if ($this->db->trans_status() === FALSE) {
            //if something went wrong, rollback everything
            $this->db->trans_rollback();    
        } else {
            //if everything went right, commit the data to the database
            $this->db->trans_commit();       
        }
        
    }
    
    
    
    $botonPresionado = $_POST['botonPresionado'];
    
    if ($botonPresionado == "botonCierreStock") 
    {
        transicionSimple($idViajeViaje[0], ESTADO_VIAJE_STOCK_ARRIBADO_Y_CONFIRMADO, "viaje");
        echo "Stock CONFIRMADO correctamente";
    }   
    else
    {
        transicionSimple($idViajeViaje[0], ESTADO_VIAJE_REVISANDO_STOCK, "viaje");
        echo "Stock guardado correctamente ";
    }
  }
  
  function grabarConfirmacionViaje(){
    $upd=""; //variable para debug
    
    if(isset($_POST['idProducto']) && !empty($_POST['idProducto']))
    {
        $producto = $_POST['idProducto'];
        $viaje = $_POST['idViaje'];
        $cliente = $_POST['comboClientes'];
        $VL = $_POST['idVL'];
        $bultos = $_POST['bultos'];
        $pallets = $_POST['pallets'];
        
        $fechaReparto = $_POST['fechaReparto'];
        
        //saco el numero de elementos
        $longitud = count($producto);
        
        //start the transaction
        $this->db->trans_begin();
        //update user_account table 
        
        $this->load->model('stock_m'); /*Antes de eliminar el reparto anterior, dejo el stock como estaba antes*/
        $this->stock_m->anularRepartoDeStock($viaje[0], $this->session->userdata('id'));  
        
        $this->db->delete('reparto', array('id_viaje' => $viaje[0]));
        
        //Recorro todos los elementos
        for($i=0; $i<$longitud; $i++)
        {   
            $f_reparto  = empty($fechaReparto[$i]) ? NULL : $fechaReparto[$i];
            
            $data = array(
                            'id_viaje' => $viaje[$i] ,
                            'id_cliente' => $cliente[$i] ,
                            'id_producto' => $producto[$i],
                            'id_variable_logistica' => $VL[$i],
                            'cantidad_bultos' => $bultos[$i],
                            'cantidad_pallets' => $pallets[$i],
                            'fecha_reparto' => $f_reparto
                         );

            if (!$this->db->insert('reparto', $data))
            {
            
              $this->output->set_status_header(500,'Error al grabar el cliente ['.$cliente[$i].'] en el reparto con fecha:'.$f_reparto);
              $this->db->trans_rollback(); 
              return false;
              //$this->output->set_status_header(500,$result);
            }
            
            
            $this->stock_m->entregarStockCliente($cliente[$i], $producto[$i], $VL[$i],$bultos[$i],$this->session->userdata('id'));   
            
        }
        
        //$longitudItemsViaje = count($IdVLViaje);
        
        //Recorro todos los elementos
        /*for($i=0; $i<$longitudItemsViaje; $i++)
        {
            $this->load->model('viaje_m');
  
            $this->viaje_m->updateCantidadesViaje($cantBultosViaje[$i], $cantPalletsViaje[$i], $idViajeViaje[$i], $idProductoViaje[$i], $IdVLViaje[$i]);
            
            $upd = $upd.$cantBultosViaje[$i]."-".$cantPalletsViaje[$i]."-".$idViajeViaje[$i]."-".$idProductoViaje[$i]."-".$IdVLViaje[$i]."****";
        }
        */
    }
    else
    {
      $viaje = $_POST['idViaje'];  
      $this->db->delete('reparto', array('id_viaje' => $viaje[0]));
      echo "Borrado";
    }
    
    //make transaction complete
    $this->db->trans_complete();
    //check if transaction status TRUE or FALSE
    if ($this->db->trans_status() === FALSE) {
        //if something went wrong, rollback everything
        $this->db->trans_rollback();    
    } else {
        //if everything went right, commit the data to the database
        $this->db->trans_commit();       
    }
    
    $botonPresionado = $_POST['botonPresionado'];
    
    if ($botonPresionado == "botonCierreViaje") 
    {
        transicionSimple($viaje[0], ESTADO_VIAJE_REPARTO_FINALIZADO, "viaje");
        echo "Reparto CONFIRMADO correctamente";
    }   
    else
    {
        transicionSimple($viaje[0], ESTADO_VIAJE_REPARTO_EN_PROCESO, "viaje");
        echo "Reparto guardado correctamente ";
    }
  }
  
  function grabarConfirmacionPrecio(){
    
        
      
      
    if(isset($_POST['idProducto']) && !empty($_POST['idProducto']))
    {
        $botonPresionado = $_POST['botonPresionado'];
        $idProducto = $_POST['idProducto'];
        $idReparto = $_POST['idReparto'];
        $viaje = $_POST['idViaje'];
        $precioBulto = $_POST['precioBulto'];
        $cantMerma = $_POST['cantMerma'];
        $fechaValorizacion = $_POST['fechaValorizacion'];
        
        if ($botonPresionado == "botonLlamarSP")   
        {
            $this->load->model('stock_m');
            $this->stock_m->recibirStockProveedor(1, 3, 1,159,8);        

            echo "SP llamado correctamente";
        }    
        else 
        {
            if ($botonPresionado == "btnVolverAConfirmarViaje") 
            {
                transicionSimple($viaje[0], ESTADO_VIAJE_CONFIRMANDO_STOCK, "viaje");
                echo "El viaje puede ser confirmado nuevamente";
            }
            else
            {
                //saco el numero de elementos
                $longitud = count($idReparto);

                //Recorro todos los elementos
                $this->load->model('viaje_m');
                $this->load->model('caja_distribuidor_m');

                for($i=0; $i<$longitud; $i++)
                {
                    $this->viaje_m->updateReparto($precioBulto[$i], $cantMerma[$i], $idReparto[$i], $fechaValorizacion[$i]);
                }

                if ($botonPresionado == "botonConfirmarPrecio") 
                {
                    transicionSimple($viaje[0], ESTADO_VIAJE_PRECIO_ACORDADO, "viaje");

                    $retorno = $this->caja_distribuidor_m->registrarGanancias($viaje[0]);

                    if ($retorno != true)
                        echo "Error ".$retorno;
                    else
                        echo "Viaje con el precio acordado correctamente";
                }   
                else
                {
                    transicionSimple($viaje[0], ESTADO_VIAJE_DETERMINANDO_PRECIO, "viaje");
                    echo "Precios guardados";
                }
            }
        }    
    }
    
    
    
    
  }
  
  
}
