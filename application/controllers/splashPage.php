<?php


class splashPage extends CI_Controller {
   
    function index() {
        if( $this->session->userdata('isLoggedIn') ) {
            redirect('/main/show_main');
        } else {
            $this->show_splash();
        }
    }
    
    function show_splash() {
        
        $this->load->view('splash');
    }

}
