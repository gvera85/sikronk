<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pruebaPDF extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		/* ------------------ */
		
		$this->load->helper('url'); //Just for the examples, this is not required thought for the library
		
		$this->load->library('image_CRUD');
                
	}
	
	function index()
	{
		$this->load->view('ejemploPDF.php');	
	}
        
}