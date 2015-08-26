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
    
    if ($menues) {
        $data['menues'] = $menues;
        $data['hayMenu'] = true;
    }else{
        $data['hayMenu'] = false;
    }

    $this->load->helper('form');
    $this->load->view('main',$data);
  }
  
  function recargarMenu($idMenu) {
    
    $menus = $this->usuario_m->getMenuPorPerfil($this->session->userdata('perfil'), $idMenu);
    
    //echo "Menus:".$this->Usuario[0]["id"]."-".$menus[0]["descripcion"];
   /* $this->session->set_userdata('menu', $menus);
      
    $menues = $this->session->userdata('menu');*/
    
    if ($menus) {
        $data['menues'] = $menus;
        $data['hayMenu'] = true;
    }else{
        $data['hayMenu'] = false;
    }


    $this->load->helper('form');
    $this->load->view('main',$data);
  }
  
  function redireccionarControlador($nombreControlador) {
      redirect('/'.$nombreControlador);
  }
  
  function atras() {
      redirect($this->session->last_page());
  }
  
  

}
