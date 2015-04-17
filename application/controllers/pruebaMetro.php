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
            
            $lineasVentas = $this->reporte_ventas_m->getVentasCliente($this->session->userdata('empresa'),12);
            
            $mesActual = date("n");
            $anioActual = date("y");
            
            $anioACalcular = $anioActual -1;
            $mesACalcular = 12-(abs($mesActual - 13));
            
            $ventaMes[]=array();
            
            for ( $i=0; $i <13; $i++)
            {
                //$venta = $this->reporte_ventas_m->getVentasMes($this->session->userdata('empresa'),$anioACalcular,$mesACalcular);
                $venta = $this->reporte_ventas_m->getVentasMes($this->session->userdata('empresa'),$anioACalcular+2000,$mesACalcular);
                
                $ventaMes[$i] = $venta;

                $mesACalcular++;
                
                if ($mesACalcular == 12)
                {
                    $mesACalcular = 1;
                    $anioACalcular = $anioACalcular + 1;
                }
            }
            
            $data['lineasVentas'] = $lineasVentas;
            $data['ventaMes'] = $ventaMes;
            
            $this->load->view('metro.php',$data);
	}

	
        

}
