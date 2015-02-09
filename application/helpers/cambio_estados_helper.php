<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function transicionAutomatica($idEntidad, $idEstado)
  {
        // Get a reference to the controller object
        $CI = get_instance();

        // You may need to load the model if it hasn't been pre-loaded
        $CI->load->model('viaje_m');
        
        $registro = $CI->viaje_m->getTablayEstadoFuturo($idEstado);
        
        $resultado = $CI->viaje_m->updateEstado($idEntidad, $registro['nombre_tabla'], $registro['id_estado_futuro']);
        
        $resultado = $CI->viaje_m->insertMovimiento($idEntidad, $registro['id_estado_futuro'], $CI->session->userdata('id') );
        
  }
  
  function transicionSimple($idEntidad, $idEstado, $nombreTabla)
  {
      // Get a reference to the controller object
        $CI = get_instance();

        // You may need to load the model if it hasn't been pre-loaded
        $CI->load->model('viaje_m');

        // Call a function of the model
        $resultado = $CI->viaje_m->updateEstado($idEntidad, $nombreTabla, $idEstado);
        
        $resultado = $CI->viaje_m->insertMovimiento($idEntidad, $idEstado, $CI->session->userdata('id') );
        
        //redirect($nombrePagina);
      
      //echo "Gonza";
        
  }
  
?>
