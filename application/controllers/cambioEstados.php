<?php

class cambioEstados extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->database();
    $this->load->helper('url');

    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  
  function transicionAutomatica($idEntidad, $idEstado, $nombrePagina)
  {
        $this->load->model('viaje_m');
        
        $registro = $this->viaje_m->getTablayEstadoFuturo($idEstado);
        
        $resultado = $this->viaje_m->updateEstado($idEntidad, $registro['nombre_tabla'], $registro['id_estado_futuro']);
        
        $resultado = $this->viaje_m->insertMovimiento($idEntidad, $registro['id_estado_futuro'], $this->session->userdata('id') );
        
        redirect($nombrePagina);
        
  }
  
  function transicionSimple($idEntidad, $idEstado, $nombreTabla, $nombrePagina)
  {
        $this->load->model('viaje_m');
        
        $resultado = $this->viaje_m->updateEstado($idEntidad, $nombreTabla, $idEstado);
        
        $resultado = $this->viaje_m->insertMovimiento($idEntidad, $idEstado, $this->session->userdata('id') );
        
        redirect($nombrePagina);
        
  }
    
  
  function transicionSimple($idEntidad)
  {
        $this->load->model('viaje_m');
        
        $idEstadoActual = $this->viaje_m->getEstadoActual($idEntidad);
        
        echo "EA: ".$idEstadoActual;
        
        $idEstadoFuturo = $this->viaje_m->getEstadoFuturo($idEstadoActual);
        
        echo "EF: ".$idEstadoFuturo;
        
        $resultado = $this->viaje_m->updateEstado($idEntidad, $idEstadoFuturo);
        
        echo "RES: ".$resultado;
        
        //echo "El viaje ".$row->id." va a cambiar de estado";
        
       // $var = 'Viaje';
        
        //call_user_func(array($var,'uno'), 'pepe');
    
  
        
  }
  
  
  
  
}
