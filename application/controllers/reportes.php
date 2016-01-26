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
    
            $resumenViaje = $this->reporte_ventas_m->getResumenViaje($idViaje);
            $lineasReparto = $this->viaje_m->getRepartoConfirmado($idViaje, null);
            $lineasGastos = $this->reporte_ventas_m->getGastos($idViaje);
            
            $data['lineasReparto'] = $lineasReparto;
            $data['resumenViaje'] = $resumenViaje;
            $data['lineasGastos'] = $lineasGastos;
                       
            $this->load->view('detalleViaje.php', $data);
	}
        
        public function mercaderiaSinRepartir()
	{   
            $this->session->set_userdata('ruta', "Mercaderia sin recibir");                
            
            $this->load->view('mercaderiaSinRepartir.php');
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
            
            $this->load->view('entregasPendientes.php');
	}
        
        public function viajesMensuales($mes, $anio)
	{   
            $this->session->set_userdata('ruta', "Resumen > Detalle último año > Viajes del Mes [".$mes."] - Año [".$anio."]");     
            
            $this->load->model('reporte_ventas_m');
    
            $lineasVentas = $this->reporte_ventas_m->getViajesProveedor($this->session->userdata('empresa'), $mes, $anio);
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('viajesProveedor.php',$data);
	}
        
        
        
        
        
        
        
        

	
        

}
