<?php


class login extends CI_Controller {

    function index() {
        if( $this->session->userdata('isLoggedIn') ) {
            redirect('/main/show_main');
        } else {
            $this->show_login('',false);
        }
    }

    function login_user() {
        // Create an instance of the user model
        $this->load->model('user_m');

        // Grab the email and password from the form POST
        $email = $this->input->post('email');
        $pass  = $this->input->post('password');

        //Ensure values exist for email and pass, and validate the user's credentials
        if( $email && $pass && $this->user_m->validate_user($email,$pass)) {
            // If the user is valid, redirect to the main view
            $perfiles = $this->getPerfiles($this->session->userdata('id'));
            
            if( is_array($perfiles) && count($perfiles) > 1 ) {
                $this->show_perfiles($perfiles);//Tiene varios perfiles, hago que el usuario seleccione uno
            }else if (is_array($perfiles) && count($perfiles) == 1){
                $perfil = $perfiles[0];
                $this->session->set_userdata('perfil', $perfil['id_perfil']);
                $this->session->set_userdata('isLoggedIn', true);
                redirect('/main/show_main');//Tiene un solo perfil
            }else{
                if ($email == 'admin')
                {
                    $this->session->set_userdata('perfil', 1);
                    $this->session->set_userdata('isLoggedIn', true);
                    redirect('/main/show_main');//Usuario comodin
                }
                else
                {
                    $this->show_login('Usted no tiene asignado ningun perfil en el sistema. Contacte a su administrador y solicite estos permisos',true);
                }
            }
                
        } else {
            // Otherwise show the login screen with an error message.
            $this->show_login('Usuario o contraseña incorrecta!',true);
        }
    }

    function show_login($mensaje = '', $show_error = false) {
        $data['error'] = $show_error;
        $data['mensaje'] = $mensaje;
        
        $this->load->helper('form');
        $this->load->view('login',$data);
    }

    function logout_user() {
      $this->session->sess_destroy();
      $this->index();
    }

    function showphpinfo() {
        echo phpinfo();
    }
    
    function getPerfiles($idUsuario){
        $this->load->model('usuario_m');
        
        $Usuario = $this->usuario_m->getUsuario($idUsuario);
                
        chrome_log("Usuario:".$Usuario[0]["id"],"log");
        
        $Perfiles = $this->usuario_m->getPerfiles($Usuario[0]["id"]);
        
        chrome_log("Perfil:".$Perfiles[0]["perfil"],"log");
        
        return $Perfiles;
    }
    
    function show_perfiles($perfiles) {
        
        $data['perfiles'] = $perfiles;

        $this->load->helper('form');
        $this->load->view('mostrarPerfiles',$data);
    }
    
    
    function asignarPerfil() {
       
        //chrome_log("Antes de obtener el perfil elegido","log");
        $EmpresayPerfil = $this->input->post('selectPerfil');
        
        $vector = explode('-', $EmpresayPerfil);

        $perfil = $vector[0];
        $empresa = $vector[1];
        $DescEmpresa = $vector[2];
        
        $this->session->set_userdata('perfil', $perfil);
        $this->session->set_userdata('empresa', $empresa);
        $this->session->set_userdata('DescEmpresa', $DescEmpresa);
                
        $this->session->set_userdata('isLoggedIn', true);
        
        $this->load->model('usuario_m');
        
        chrome_log("Antes de llamar al metodo getMenuPorPerfil","log");
        $menus = $this->usuario_m->getMenuPorPerfil($perfil);
        chrome_log("Despues de llamar al metodo getMenuPorPerfil","log");
                
        chrome_log("Menus:".$menus[0]["descripcion"],"log");
        $this->session->set_userdata('menu', $menus);
        
        redirect('/main/show_main');
    }
    
    


}
