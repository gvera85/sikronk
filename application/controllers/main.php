<?php

class main extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }

  /**
   * This is the controller method that drives the application.
   * After a user logs in, show_main() is called and the main
   * application screen is set up.
   */
  function show_main() {
    
    $menues = $this->session->userdata('menu');
    
    //foreach( $menues as $menu ) : 
      //          echo $menu['descripcion'] .' - ' .$menu['path_icono']; 
    //endforeach; 
    
    $data['menues'] = $menues;

    $this->load->helper('form');
    $this->load->view('main',$data);
  }
  

}
