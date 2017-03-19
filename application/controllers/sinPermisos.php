<?php

class sinPermisos extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');    
  }
  
  function index(){
    
    $this->load->view('sinPermisos'); 
      
  }
  
  
}
  
  
  
