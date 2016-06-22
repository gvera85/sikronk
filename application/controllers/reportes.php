<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
                
                if( !$this->session->userdata('isLoggedIn') ) {
                   redirect('/login/show_login');
                }

	}

	public function index()
	{   
            $this->load->model('reporte_ventas_m');
            
            $lineasVentas = $this->reporte_ventas_m->getLineasVentasCliente($this->session->userdata('empresa'), 7);
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('viajes.php',$data);
	}
        
        public function ventasMensualesProveedor()
	{   
            $this->session->set_userdata('ruta', "Resumen > Detalle último año");    
            
            $this->load->model('reporte_ventas_m');
            
            $lineasVentas = $this->reporte_ventas_m->getVentasMensualesProveedor($this->session->userdata('empresa'));
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('ventasMensualesProveedor.php',$data);
	}
        
        public function ventasMensualesProdProveedor($mes, $anio)
	{   
            $this->session->set_userdata('ruta', "Resumen > Detalle último año > Mes [".$mes."] - Año [".$anio."]");     
            
            $this->load->model('reporte_ventas_m');
    
            $lineasVentas = $this->reporte_ventas_m->getVentasMensualPorProd($this->session->userdata('empresa'), $mes, $anio);
            
            $data['lineasVentas'] = $lineasVentas;
                       
            $this->load->view('ventasMensualesProdProveedor.php', $data);
	}
        
        
        public function homeProveedor()
	{   
            $this->session->set_userdata('ruta', "Resumen");                
            
            $this->load->model('reporte_ventas_m');
            
            $lineasVentas = $this->reporte_ventas_m->getVentasMensualesProveedor($this->session->userdata('empresa'));
           
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('homeProveedor.php',$data);
	}
        
        public function viajesProveedor()
	{   
            $this->session->set_userdata('ruta', "Viajes");                
            
            $this->load->model('reporte_ventas_m');
            
            $lineasVentas = $this->reporte_ventas_m->getViajesProveedor($this->session->userdata('empresa'), null, null);
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('viajesProveedor.php',$data);
	}
        
        public function detalleViaje($idViaje)
	{   
            $this->session->set_userdata('ruta', "Viajes > Detalle viaje con Id [".$idViaje."]");                
            
            $this->load->model('viaje_m');
            $this->load->model('reporte_ventas_m');
            $this->load->model('usuario_m');
    
            $resumenViaje = $this->reporte_ventas_m->getResumenViaje($idViaje);
            $lineasReparto = $this->viaje_m->getRepartoConfirmado($idViaje, null);
            $lineasGastos = $this->reporte_ventas_m->getGastos($idViaje);
            $permisos["precio"] =  $this->usuario_m->tieneEstePermiso( $this->session->userdata('idLineaPerfil'), 1);            
            $permisos["detalleReparto"] = $this->usuario_m->tieneEstePermiso( $this->session->userdata('idLineaPerfil'), 2);            
            
            $data['lineasReparto'] = $lineasReparto;
            $data['resumenViaje'] = $resumenViaje;
            $data['lineasGastos'] = $lineasGastos;
            $data['permisos'] = $permisos;
                       
            $this->load->view('detalleViaje.php', $data);
	}
        
        public function mercaderiaSinRepartir()
	{   
            $this->load->model('stock_m');
            
            $this->session->set_userdata('ruta', "Mercaderia sin recibir");                            
            
            $lineasSinRepartir = $this->stock_m->getProductosSinRepartir($this->session->userdata('empresa'));
            
            $data['lineasSinRepartir'] = $lineasSinRepartir;
            
            $this->load->view('mercaderiaSinRepartir.php',$data);
	}
        
        public function pagosPendientesDeRecibir()
	{   
            $this->session->set_userdata('ruta', "Resumen > Pagos pendientes de recibir");     
            
            $this->load->view('pagosPendientesDeRecibir.php');
	}
        
        public function pagosRecibidos()
	{   
            $this->session->set_userdata('ruta', "Resumen > Pagos recibidos");                
            
            $this->load->view('pagosRecibidos.php');
	}
        
        public function verCCProveedor()
	{   
            $this->session->set_userdata('ruta', "Resumen > Cuenta corriente");                
            
            $this->load->view('verCCProveedor.php');
	}
        
        public function verProductos()
	{   
            $this->session->set_userdata('ruta', "Resumen > Productos");                
            
            $this->load->view('verProductos.php');
	}
        
        public function entregasPendientes()
	{   
            $this->session->set_userdata('ruta', "Resumen > Entregas pendientes");  
            
            $this->load->model('reporte_ventas_m');  
            
            $viajes = $this->reporte_ventas_m->getEntregasPendientes($this->session->userdata('empresa'));
            
            $data['viajesPendientesDeRecibir'] = $viajes;
            
            $this->load->view('entregasPendientes.php', $data);
	}
        
        public function viajesMensuales($mes, $anio)
	{   
            $this->session->set_userdata('ruta', "Resumen > Detalle último año > Viajes del Mes [".$mes."] - Año [".$anio."]");     
            
            $this->load->model('reporte_ventas_m');
    
            $lineasVentas = $this->reporte_ventas_m->getViajesProveedor($this->session->userdata('empresa'), $mes, $anio);
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('viajesProveedor.php',$data);
	}
        
        public function rankingClientes($tipoConsulta)
	{   
            $this->session->set_userdata('ruta', "Ranking de clientes");                
            
            $this->load->model('reporte_ventas_m');
            
            $lineasRanking = $this->reporte_ventas_m->getRankingClientes($this->session->userdata('empresa'));
            
            $data['lineasRanking'] = $lineasRanking;
            $data['tipoConsulta'] = $tipoConsulta;            
            
            $this->load->view('rankingClientes.php',$data);
	}
        
        public function rankingProductos($tipoConsulta)
	{   
            $this->session->set_userdata('ruta', "Ranking de productos");                
            
            $this->load->model('reporte_ventas_m');
            
            $lineasRanking = $this->reporte_ventas_m->getRankingProductos($this->session->userdata('empresa'));
            
            $data['lineasRanking'] = $lineasRanking;
            $data['tipoConsulta'] = $tipoConsulta;            
            
            $this->load->view('rankingProductos.php',$data);
	}
        
        
        
        
        
        
        
        

	
        

}
