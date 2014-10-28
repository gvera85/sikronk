<?php


class login extends CI_Controller {
    
    var $Usuario;

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
                //echo "antes de llamar a show_perfiles";
                $this->show_perfiles($perfiles);//Tiene varios perfiles, hago que el usuario seleccione uno
            }else if (is_array($perfiles) && count($perfiles) == 1){
                $perfil = $perfiles[0];
                $this->asignarPerfil($perfil['id_perfil']);
            }else{
                if ($email == 'admin')
                {
                    $this->session->set_userdata('perfil', 1);
                    $this->session->set_userdata('isLoggedIn', true);
                    
                    $menus = $this->usuario_m->getMenuDistribuidor(3);
        
                    $this->session->set_userdata('menu', $menus);
                    
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
        
        $this->Usuario = $this->usuario_m->getUsuario($idUsuario);
                
        chrome_log("Usuario:".$this->Usuario[0]["id"],"log");
        
        $Perfiles = $this->usuario_m->getPerfiles($this->Usuario[0]);
        
        chrome_log("Perfil:".$Perfiles[0]["perfil"],"log");
        
        return $Perfiles;
    }
    
    function show_perfiles($perfiles) {
        
        $data['perfiles'] = $perfiles;

        $this->load->helper('form');
        $this->load->view('mostrarPerfiles',$data);
    }
    
    function asignarPerfilSeleccionado()
    {
        //("Antes de obtener el perfil elegido","log");
        $EmpresayPerfil = $this->input->post('selectPerfil');
        
        $vector = explode('-', $EmpresayPerfil);

        $perfil = $vector[0];
        $empresa = $vector[1];
        $DescEmpresa = $vector[2];
        
        $this->session->set_userdata('empresa', $empresa);
        $this->session->set_userdata('DescEmpresa', $DescEmpresa);
        
        $this->asignarPerfil($perfil);
        
    }
    
    
    function asignarPerfil($perfil) {
       
        //chrome_log("Antes de obtener el perfil elegido","log");
        /*$EmpresayPerfil = $this->input->post('selectPerfil');
        
        $vector = explode('-', $EmpresayPerfil);

        $perfil = $vector[0];
        $empresa = $vector[1];
        $DescEmpresa = $vector[2];*/
        
        $this->session->set_userdata('perfil', $perfil);
                
        $this->session->set_userdata('isLoggedIn', true);
        
        $this->load->model('usuario_m');
        
        $this->Usuario = $this->usuario_m->getUsuario($this->session->userdata('id'));
        
        //echo "Antes de llamar al metodo getMenuPorPerfil [".$this->Usuario[0]["id"]. "]";
        $menus = $this->usuario_m->getMenuPorPerfil($this->Usuario[0],$perfil);
        chrome_log("Despues de llamar al metodo getMenuPorPerfil","log");
                
        //echo "Menus:".$this->Usuario[0]["id"]."-".$menus[0]["descripcion"];
        $this->session->set_userdata('menu', $menus);
        
        redirect('/main/show_main');
    }
     
    
    

}
