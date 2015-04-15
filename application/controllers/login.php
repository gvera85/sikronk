<?php


class login extends CI_Controller {
    
    var $Usuario;
    var $perfiles = array();

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
            $this->perfiles = $this->getPerfiles($this->session->userdata('id'));
            
            chrome_log("lalala:".$this->session->userdata('id'),"log");
            
            foreach ($this->perfiles as $perf): 
            chrome_log("idLinea:".$perf['id_linea'],"log");
            if ($perf['id_linea'] == 1) {
                $this->session->set_userdata('imagen_razonsocial', $perf['imagen_logo'] . '***' . $perf['razon_social']);
            }
            endforeach;
            
            if( is_array($this->perfiles) && count($this->perfiles) > 1 ) {
                //echo "antes de llamar a show_perfiles";
                $this->show_perfiles($this->perfiles);//Tiene varios perfiles, hago que el usuario seleccione uno
                
                
                foreach ($this->perfiles as $perf): 
                chrome_log("idLinea2:".$perf['id_linea'],"log");
                if ($perf['id_linea'] == 1) {
                    $this->session->set_userdata('imagen_razonsocial', $perf['imagen_logo'] . '***' . $perf['razon_social']);
                }
                endforeach;
                
            }else if (is_array($this->perfiles) && count($this->perfiles) == 1){
                $perfil = $this->perfiles[0];
                
                        
                $this->session->set_userdata('empresa', $perfil['id_empresa']);                
                $this->session->set_userdata('DescEmpresa', $perfil['empresa']);
                $this->session->set_userdata('imagen_logo', $perfil['imagen_logo']);
                
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
        
        $a = 0;
        
        foreach ($Perfiles as $perf): 
           
                $a = $a + 1;
        
                chrome_log("Imagen:".$perf['imagen_logo'],"log");
                //chrome_log("numero:".$a,"log");
           
        endforeach;
        
        for ($i=0; $i < 3; $i++)
        {
            chrome_log("i:".$i,"log");
        }
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

        $idLineaPerfil = $vector[0];
        $perfil = $vector[1];
        $empresa = $vector[2];
        $DescEmpresa = $vector[3];
        
        $this->session->set_userdata('empresa', $empresa);
        $this->session->set_userdata('DescEmpresa', $DescEmpresa);
        $this->session->set_userdata('idLineaPerfil', $idLineaPerfil);
        
        chrome_log("Gonzalo","log");

        
        $this->asignarPerfil($perfil);
        
    }
    
    
    function asignarPerfil($perfil) {
       
        chrome_log("Antes de obtener el perfil elegido","log");
        /*$EmpresayPerfil = $this->input->post('selectPerfil');
       
        $vector = explode('-', $EmpresayPerfil);
        
        $perfil = $vector[0];
        $empresa = $vector[1];
        $DescEmpresa = $vector[2];*/
        
        $this->session->set_userdata('perfil', $perfil);
                
        $this->session->set_userdata('isLoggedIn', true);
        
        $this->load->model('usuario_m');
        
        $this->Usuario = $this->usuario_m->getUsuario($this->session->userdata('id'));
        
        $this->session->set_userdata('Usuario', $this->Usuario[0]);
        
        //echo "Antes de llamar al metodo getMenuPorPerfil [".$this->Usuario[0]["id"]. "]";
        chrome_log("Antes menu:","log");
        $menus = $this->usuario_m->getMenuPorPerfil($perfil,0);
        chrome_log("Despues de llamar al metodo getMenuPorPerfil","log");
        
        $this->session->set_userdata('imagen_razonsocial', '1****1');
        
        foreach ($this->perfiles as $perf): 
            $this->session->set_userdata('imagen_razonsocial', '****');
            if ($perf['id_linea'] == $this->session->userdata('idLineaPerfil')) {
                $this->session->set_userdata('imagen_razonsocial', $perf['imagen_logo'] . '***' . $perf['razon_social']);
            }
        endforeach;

                
        //echo "Menus:".$this->Usuario[0]["id"]."-".$menus[0]["descripcion"];
        $this->session->set_userdata('menu', $menus);
        
        $id_tipo_empresa = $this->Usuario[0]["id_tipo_empresa"];
        
        switch($id_tipo_empresa)/*Dependiendo del tipo de empresa voy a buscar un perfil determinado*/
        {
            case DISTRIBUIDOR: /*El usuario es un distribuidor*/
                redirect('/main/show_main');
                break;
            case CLIENTE: /*El usuario es un cliente*/
                redirect('/pruebametro/index');
                break;
            case PROVEEDOR: /*El usuario es un proveedor*/
                redirect('/pruebametro/index');
                break;
                    
        }
        
        
    }
     
    
    

}
