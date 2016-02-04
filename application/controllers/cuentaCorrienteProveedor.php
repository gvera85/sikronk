<?php

class cuentaCorrienteProveedor extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');    
    
   
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
  
  function getCuentaCorrientePorRango($idProveedor, $fechaDesde, $fechaHasta){
      
    $this->load->model('facturas_proveedor_m');
    
    $vectorLineasCC = $this->facturas_proveedor_m->getLineasCCP($idProveedor);    
    $arrayCC= array();
    $contador = 0;
    $saldoInicio = "";
    $saldoFinal = "";
    $saldo = 0;
    
    
    foreach( $vectorLineasCC as $lineasCC ) :  
        
        if ($lineasCC['fecha_cc'] > $fechaDesde && $saldoInicio == "")
            $saldoInicio = $saldo;
        
        if ($lineasCC['fecha_cc'] > $fechaDesde && $saldoInicio == "")
            $saldoFinal = $saldo;
        
        if ($saldoInicio != "" && $saldoFinal == "")
        {
            $arrayCC[$contador]= $lineasCC;
            $contador++;
        }
        
        $saldo = $saldo + ($lineasCC['haber'] - $lineasCC['debe']);
        
    endforeach;
    
    $proveedor = $this->facturas_proveedor_m->getProveedorXId($idProveedor);    
    
    $data['facturasProveedor'] = $arrayCC;
    $data['proveedor'] = $proveedor;
      
    $this->load->view('cuentaCorrienteProveedor',$data); 
    
    /*
     * $arrayCC[$contador]['tipo'] = $lineasCC['tipo'];
        $arrayCC[$contador]['fecha_estimada_llegada'] = $lineasCC['fecha_estimada_llegada'];
        $arrayCC[$contador]['stamp'] = $lineasCC['stamp'];
        $arrayCC[$contador]['id_viaje'] = $lineasCC['id_viaje'];
        $arrayCC[$contador]['id_proveedor'] = $lineasCC['id_proveedor'];
        $arrayCC[$contador]['numero_de_viaje'] = $lineasCC['numero_de_viaje'];
        $arrayCC[$contador]['debe'] = $lineasCC['debe'];
        $arrayCC[$contador]['haber'] = $lineasCC['haber'];
     */
      
  } 
  
  
  function getCuentaCorrienteProveedorPorFiltro($idProveedor){
    $this->load->model('facturas_proveedor_m');
    
    $fechaHastaFiltro = date("Y-m-d"); //Por default la fecha hasta es el dia de hoy
    
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
    
    $proveedor = $this->facturas_proveedor_m->getProveedorXId($idProveedor);    
    
    $filtros = array(
                        "fecha_desde" => $fechaDesdeFiltro,
                        "fecha_hasta" => $fechaHastaFiltro,
                        "id_proveedor" =>   $idProveedor,    
                    );
    
    $saldoTotal = array(
                        "saldo_total" => $saldo,                        
                    );
    
    $data['facturasProveedor'] = $arrayCC;
    $data['proveedor'] = $proveedor;
    $data['filtros'] = $filtros;
    $data['saldo'] = $saldoTotal;
      
    $this->load->view('cuentaCorrienteProveedor',$data); 
  } 
}
  
  
  
