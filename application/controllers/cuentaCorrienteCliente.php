<?php

class cuentaCorrienteCliente extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');    
    
   
  }
  
  function index(){
      
    $this->load->model('cliente_m');
    
    $clientes = $this->cliente_m->getClientes();    
    
    $data['clientes'] = $clientes;
     
    $this->load->view('clientes',$data); 
  }
  
  function getCuentaCorriente($idCliente){
      
    $this->load->model('facturas_clientes_m');
    $this->load->model('cliente_m');    
    
    //$facturasClientes = $this->facturas_clientes_m->getLineasCCC($idCliente);
    $facturasClientes = $this->facturas_clientes_m->getLineasIndependientesCCC($idCliente);
    
    $lineasSinValorizar = $this->facturas_clientes_m->getLineasSinValorizar($idCliente);
    
    $cliente = $this->cliente_m->getClienteXId($idCliente);    
    
    
    
    $data['facturasClientes'] = $facturasClientes;
    $data['cliente'] = $cliente;
    $data['lineasSinValorizar'] = $lineasSinValorizar;
    
    
    $this->load->view('cuentaCorrienteCliente',$data); 
      
  }
  
  function cargarLineasCC()
  {
    $imagen_eliminada=true;
    
    $idCliente = 17;
    
    $this->load->model('facturas_clientes_m');
    $this->load->model('cliente_m');
    
    $facturasClientes = $this->facturas_clientes_m->getLineasCCC($idCliente);
    
    $lineasSinValorizar = $this->facturas_clientes_m->getLineasSinValorizar($idCliente);
    
    $cliente = $this->cliente_m->getClienteXId($idCliente);    
    
    $data['facturasClientes'] = $facturasClientes;
    $data['cliente'] = $cliente;
    $data['lineasSinValorizar'] = $lineasSinValorizar;
    
    //$this->load->view('cuentaCorrienteCliente',$data); 

    echo json_encode(array('$facturasClientes'=>$facturasClientes));
  }
  
  function getCCClientePorFiltro($idCliente){
      
    $this->load->model('facturas_clientes_m');
    $this->load->model('cliente_m');    
    
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
    
    //$facturasClientes = $this->facturas_clientes_m->getLineasCCC($idCliente);
    $vectorLineasCC = $this->facturas_clientes_m->getLineasIndependientesCCC($idCliente);
    
    $arrayCC= array();
    $contador = 0;
    $saldo = 0;
    
    if (!empty($vectorLineasCC[0]['haber'])) {
        foreach( $vectorLineasCC as $lineasCC ) :  

            $saldo = $saldo + ($lineasCC['haber'] - $lineasCC['debe']);
        
            $saldo = round($saldo, 2);

            //if ($lineasCC['fecha_cc'] >= $fechaDesde && $lineasCC['fecha_cc'] <= $fechaHasta)    
            if ($lineasCC['fecha_valorizacion'] >= $fechaDesdeFiltro && $lineasCC['fecha_valorizacion'] <= $fechaHastaFiltro)    
            {
                $arrayCC[$contador]= $lineasCC; //Copio el array que viene desde la BD            

                $arrayCC[$contador]['saldo_parcial'] = $saldo; //Le agrego un componente que es el saldo parcial
                $contador++;
            }

        endforeach;
    }
    
    
    $lineasSinValorizar = $this->facturas_clientes_m->getLineasSinValorizar($idCliente);
    
    $cliente = $this->cliente_m->getClienteXId($idCliente);    
    
    $filtros = array(
                        "fecha_desde" => $fechaDesdeFiltro,
                        "fecha_hasta" => $fechaHastaFiltro,
                        "id_cliente" =>   $idCliente,   
                        "fecha_ejecucion" => $fechaEjecucion
                    );
    
    $saldoTotal = array(
                        "saldo_total" => $saldo,                        
                    );
    
    $data['facturasClientes'] = $arrayCC;
    $data['cliente'] = $cliente;
    $data['lineasSinValorizar'] = $lineasSinValorizar;
    $data['filtros'] = $filtros;
    $data['saldo'] = $saldoTotal;
    
    $this->load->view('cuentaCorrienteCliente',$data); 
      
  }



}
  
  
  
