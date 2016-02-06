<?php

class cuentaCorrienteProveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');   
    
    $this->load->model('facturas_proveedor_m');
    
   
  }
  
  function index(){
      
    $this->load->model('facturas_proveedor_m');
  }
  
  function getCuentaCorriente($idProveedor){
      
    $this->load->model('facturas_proveedor_m');
    
    $facturasProveedor = $this->facturas_proveedor_m->getLineasCCP($idProveedor);    
      
    $proveedor = $this->facturas_proveedor_m->getProveedorXId($idProveedor);    
    
    $data['facturasProveedor'] = $facturasProveedor;
    $data['proveedor'] = $proveedor;
      
    $this->load->view('cuentaCorrienteProveedor',$data); 
      
  } 
  
  function getCCProveedorPorFiltro($idProveedor, $paginaHtml){
    putenv("TZ=America/Argentina/Buenos_Aires");
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
    
    $proveedor = $this->facturas_proveedor_m->getProveedorXId($idProveedor);    
    
    $saldoFinal = 0;
    $arrayCC = $this->getLineasCC($idProveedor, $fechaDesdeFiltro, $fechaHastaFiltro, $saldoFinal);
    
    $filtros = array(
                        "fecha_desde" => $fechaDesdeFiltro,
                        "fecha_hasta" => $fechaHastaFiltro,
                        "id_proveedor" =>   $idProveedor,    
                        "fecha_ejecucion" => $fechaEjecucion    
                    );
    
    $saldoTotal = array(
                        "saldo_total" => $saldoFinal,                        
                    );
    
    $data['facturasProveedor'] = $arrayCC;
    $data['proveedor'] = $proveedor;
    $data['filtros'] = $filtros;
    $data['saldo'] = $saldoTotal;
      
    $this->load->view($paginaHtml,$data); 
  } 
  
  function getLineasCC($idProveedor, $fechaDesdeFiltro, $fechaHastaFiltro, &$saldoFinal)
  {
    $vectorLineasCC = $this->facturas_proveedor_m->getLineasCCP($idProveedor);    
    $arrayCC= array();
    $contador = 0;
    $saldo = 0;

    if (!empty($vectorLineasCC[0]['haber'])) {
        foreach( $vectorLineasCC as $lineasCC ) :  

            $saldo = $saldo + ($lineasCC['haber'] - $lineasCC['debe']);

            //if ($lineasCC['fecha_cc'] >= $fechaDesde && $lineasCC['fecha_cc'] <= $fechaHasta)    
            if ($lineasCC['fecha_estimada_llegada'] >= $fechaDesdeFiltro && $lineasCC['fecha_estimada_llegada'] <= $fechaHastaFiltro)    
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
  
  
  
