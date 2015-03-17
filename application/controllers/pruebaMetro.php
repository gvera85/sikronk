<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PruebaMetro extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

	}

	public function index()
	{
            $this->load->model('reporte_ventas_m');
            
            $lineasVentas = $this->reporte_ventas_m->getVentasCliente(1,12);
            
            $data['lineasVentas'] = $lineasVentas;
            
            $this->load->view('metro.php',$data);
	}

	
        

}
