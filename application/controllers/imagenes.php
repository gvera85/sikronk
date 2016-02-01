<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imagenes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		/* ------------------ */
		
		$this->load->helper('url'); //Just for the examples, this is not required thought for the library
		
		$this->load->library('image_CRUD');
                
	}
	
	function distribuidor_output($output = null)
	{
		$this->load->view('galeriaDeImagenes.php',$output);	
	}
        
        function proveedor_output($output = null)
	{
		$this->load->view('galeriaImagenesProveedor.php',$output);	
	}
	
	function index()
	{
		$this->distribuidor_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}		
	
	function viaje($idViaje)
	{
              	$image_crud = new image_CRUD();	
                
                $this->load->model('proveedor_m');

                $Proveedor = $this->proveedor_m->getProveedorXViaje($idViaje);
                
                
                $this->load->model('viaje_m');
                
                $viaje = $this->viaje_m->getViajeXId($idViaje);
                
                $this->session->set_userdata('titulo', "Viaje ".$viaje[0]["numero_de_viaje"]." - ".$Proveedor[0]["razon_social"]); 
                
                $image_crud->set_language('spanish');
		
		$image_crud->set_table('imagenes_viaje')
		->set_relation_field('id_viaje')
		->set_ordering_field('orden')
		->set_image_path('assets/uploads');
                
                $image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('path');
			
		$output = $image_crud->render();
	
		$this->distribuidor_output($output);
	}
        
        function verImagenesViaje($idViaje)
	{
		$image_crud = new image_CRUD();	
                
                $this->load->model('proveedor_m');

                $Proveedor = $this->proveedor_m->getProveedorXViaje($idViaje);
                
                $this->load->model('viaje_m');
                
                $viaje = $this->viaje_m->getViajeXId($idViaje);
                
                $this->session->set_userdata('titulo', "Viaje ".$viaje[0]["numero_de_viaje"]." - ".$Proveedor[0]["razon_social"]); 
                
                $image_crud->set_language('spanish');
		
		$image_crud->set_table('imagenes_viaje')
		->set_relation_field('id_viaje')
		->set_image_path('assets/uploads');
                
                $image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('path');
                $image_crud->set_title_field('titulo');
                
                $image_crud->unset_delete();
                $image_crud->unset_upload();
			
		$output = $image_crud->render();
	
		$this->proveedor_output($output);
	}
        
       
       

	
}