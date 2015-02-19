<?php

class main extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');
    
    $this->load->model('usuario_m');

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
    
    $menues = $this->usuario_m->getMenuPorPerfil($this->session->userdata('perfil'), 0);
    
    //foreach( $menues as $menu ) : 
      //          echo $menu['descripcion'] .' - ' .$menu['path_icono']; 
    //endforeach; 
    
    $data['menues'] = $menues;

    $this->load->helper('form');
    $this->load->view('main',$data);
  }
  
  function recargarMenu($idMenu) {
    
    $menus = $this->usuario_m->getMenuPorPerfil($this->session->userdata('perfil'), $idMenu);
    
    $this->session->set_userdata('urlAnterior', base_url().'index.php/main/recargarMenu/'.$idMenu);                

    //echo "Menus:".$this->Usuario[0]["id"]."-".$menus[0]["descripcion"];
   /* $this->session->set_userdata('menu', $menus);
      
    $menues = $this->session->userdata('menu');*/
    
    $data['menues'] = $menus;

    $this->load->helper('form');
    $this->load->view('main',$data);
  }
  
  function redireccionarControlador($nombreControlador) {
      $this->session->set_userdata('urlAnterior', base_url().'index.php/'.$nombreControlador);                
    
      redirect('/'.$nombreControlador);
  }
  
  function atras() {
      $this->load->library('funciones'); //you can put it in the autoloader config
      $this->funciones->generateRedirectURL(); 
      
      redirect($this->session->userdata['redirectUrl']);
  }
  
  

}
