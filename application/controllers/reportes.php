<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

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
            $this->load->model('reporte_ventas_m');
            
            $lineasVentas = $this->reporte_ventas_m->getVentasMensualesProveedor($this->session->userdata('empresa'));
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('ventasMensualesProveedor.php',$data);
	}
        
        public function viajesProveedor()
	{   
            $this->load->model('reporte_ventas_m');
            
            $lineasVentas = $this->reporte_ventas_m->getViajesProveedor($this->session->userdata('empresa'));
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('viajesProveedor.php',$data);
	}

	
        

}
