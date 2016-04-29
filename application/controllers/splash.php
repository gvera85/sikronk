<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   define('DISTRIBUIDOR', 1);
                define('CLIENTE', 2);
                define('PROVEEDOR', 3);

class splash extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                
             

	}

	function index() {
            if( $this->session->userdata('isLoggedIn') ) {
                
                
                $Usr = $this->session->userdata('Usuario');
        
                $id_tipo_empresa = $Usr["id_tipo_empresa"];
                
                switch($id_tipo_empresa)/*Dependiendo del tipo de empresa voy a buscar un perfil determinado*/
                {
                    case DISTRIBUIDOR: /*El usuario es un distribuidor*/
                        redirect('/main/show_main');
                        break;
                    case CLIENTE: /*El usuario es un cliente*/
                        redirect('/homeCliente/index');
                        break;
                    case PROVEEDOR: /*El usuario es un proveedor*/
                        redirect('/reportes/homeProveedor');
                        break;

                }
                
            } else {
                $this->show_splash();
            }
        }
    
        function show_splash() {

            $this->load->view('splash');
        }
        
        

}



