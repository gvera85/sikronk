<?php

class cajaDistribuidor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');    
    $this->load->helper('cambio_estados');
    
    $this->load->model('facturas_proveedor_m');
    $this->load->model('caja_distribuidor_m');
    
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
    
    if (!verificarPermisoControlador($this->uri->segment(1), $this->session->userdata('idLineaPerfil'))) {
        redirect('/sinPermisos');
    }
   
  }
  
  function index(){
    
    $idDistribuidor = $this->session->userdata('empresa');
      
    /*
    
    $pagos = $this->caja_distribuidor_m->getLineasCaja($idDistribuidor);    
      
    $distribuidor = $this->caja_distribuidor_m->getDistribuidorXId($idDistribuidor);    
    
    $data['pagos'] = $pagos;
    $data['distribuidor'] = $distribuidor;
      
    $this->load->view('cajaDistribuidor',$data);

    */
      
    $this->getCCDistribuidorPorFiltro($idDistribuidor, 'cajaDistribuidor');  
      
  }
  
  function getCCDistribuidorPorFiltro($idDistribuidor, $paginaHtml){
    putenv("TZ=America/Argentina/Buenos_Aires");
    ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
    $fechaHastaFiltro = date("Y-m-d"); //Por default la fecha hasta es el dia de hoy
    $fechaEjecucion = date("Y-m-d H:i:s"); //La fecha y hora de ejecuccion del "reporte"
    
    $fechaDesdeFiltro = strtotime ( '-90 day' , strtotime ( $fechaHastaFiltro ) ) ;
    $fechaDesdeFiltro = date ( 'Y-m-d' , $fechaDesdeFiltro );  //Por default la fecha desde es el dia de (hoy - 90 DIAS)
    
    if(isset($_POST['fecha_desde']) && !empty($_POST['fecha_desde']))
    {
        $fechaDesdeFiltro = $_POST['fecha_desde'];
    }
    
    if(isset($_POST['fecha_hasta']) && !empty($_POST['fecha_hasta']))
    {
        $fechaHastaFiltro = $_POST['fecha_hasta'];
    }
    
    $distribuidor = $this->caja_distribuidor_m->getDistribuidorXId($idDistribuidor);    
    
    $saldoFinal = 0;
    
    $arrayCC = $this->getLineasCC2($idDistribuidor, $fechaDesdeFiltro, $fechaHastaFiltro, $saldoFinal);    
    
    $filtros = array(
                        "fecha_desde" => $fechaDesdeFiltro,
                        "fecha_hasta" => $fechaHastaFiltro,
                        "id_distribuidor" =>   $idDistribuidor,    
                        "fecha_ejecucion" => $fechaEjecucion    
                    );
    
    $saldoTotal = array(
                        "saldo_total" => $saldoFinal,                        
                    );
    
    $data['pagos'] = $arrayCC;
    $data['distribuidor'] = $distribuidor;
    $data['filtros'] = $filtros;
    $data['saldo'] = $saldoTotal;
      
    $this->load->view($paginaHtml,$data); 
  }
  
  
  function getLineasCC2($idDistribuidor, $fechaDesdeFiltro, $fechaHastaFiltro, &$saldoFinal)
  {
    $vectorLineasCC = $this->caja_distribuidor_m->getLineasCaja($idDistribuidor);    
    $arrayCC= array();
    $contador = 0;
    $saldo = 0;

    if (!empty($vectorLineasCC[0]['haber'])) {
        foreach( $vectorLineasCC as $lineasCC ) :  

            $saldo = $saldo + ($lineasCC['haber'] - $lineasCC['debe']);

            //if ($lineasCC['fecha_cc'] >= $fechaDesde && $lineasCC['fecha_cc'] <= $fechaHasta)    
            if ($lineasCC['fecha_pago'] >= $fechaDesdeFiltro && $lineasCC['fecha_pago'] <= $fechaHastaFiltro)    
            {
                $arrayCC[$contador]= $lineasCC; //Copio el array que viene desde la BD            

                $arrayCC[$contador]['saldo_parcial'] = $saldo; //Le agrego un componente que es el saldo parcial
                $contador++;
            }

        endforeach;
    }
    
    $saldoFinal = $saldo;
    return $arrayCC;
      
  }

}
  
  
  
