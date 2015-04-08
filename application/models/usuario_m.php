<?php

define('DISTRIBUIDOR', 1);
define('CLIENTE', 2);
define('PROVEEDOR', 3);

class usuario_m extends CI_Model {

    public function getUsuario($idUsuario)
    {
        $this->db->from('usuario');
        $this->db->where( array('id'=>$idUsuario) );

        $Usuario = $this->db->get()->result_array();
        
        if ( is_array($Usuario) && count($Usuario) == 1 ) {
            return $Usuario;
        }

        return false;
    }
    
    public function getPerfiles($Usuario)
    {
        $id_tipo_empresa = $Usuario["id_tipo_empresa"];
        $idUsuario = $Usuario["id"];
        
        if ($id_tipo_empresa)
        {
            switch($id_tipo_empresa)/*Dependiendo del tipo de empresa voy a buscar un perfil determinado*/
            {
                case DISTRIBUIDOR: /*El usuario es un distribuidor*/
                    $perfiles = $this->getPerfilDistribuidor($idUsuario);
                    break;
                case CLIENTE: /*El usuario es un cliente*/
                    $perfiles = $this->getPerfilCliente($idUsuario);
                    break;
                case PROVEEDOR: /*El usuario es un proveedor*/
                    $perfiles = $this->getPerfilProveedor($idUsuario);
                    break;

            }

            if( is_array($perfiles) && count($perfiles) > 0 ) {
                  return $perfiles;
            }
        }
        
        return false;
    }
    
    
    public function getPerfilProveedor($idUsuario)
    {
        if($idUsuario != FALSE) {
          $sql = "select a.id id_linea, a.id_perfil_proveedor id_perfil, b.razon_social empresa, b.imagen_logo, c.descripcion perfil, a.id_proveedor id_empresa, a.id_usuario
                    from usuario_perfil_proveedor a
                    join proveedor b on a.id_proveedor = b.id
                    join perfil_proveedor c on a.id_perfil_proveedor = c.id
                    where a.id_usuario = ?";
            
            $query = $this->db->query($sql, array($idUsuario));
                   
            $perfiles = $query->result_array();

            if( is_array($perfiles) && count($perfiles) > 0 ) {
              return $perfiles;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
    }
    
    public function getPerfilDistribuidor($idUsuario)
    {
        if($idUsuario != FALSE) {
          $sql = "select a.id id_linea, a.id_perfil_distribuidor id_perfil, b.razon_social empresa, b.imagen_logo, c.descripcion perfil, a.id_distribuidor id_empresa, a.id_usuario
                    from usuario_perfil_distribuidor a
                    join distribuidor b on a.id_distribuidor = b.id
                    join perfil_distribuidor c on a.id_perfil_distribuidor = c.id
                    where a.id_usuario = ?";
            
            $query = $this->db->query($sql, array($idUsuario));
                   
            $perfiles = $query->result_array();

            if( is_array($perfiles) && count($perfiles) > 0 ) {
              return $perfiles;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
    }
    
    public function getPerfilCliente($idUsuario)
    {
        if($idUsuario != FALSE) {
          $sql = "select a.id id_linea, a.id_perfil_cliente id_perfil, b.razon_social empresa, b.imagen_logo, c.descripcion perfil, a.id_cliente id_empresa, a.id_usuario
                    from usuario_perfil_cliente a
                    join cliente b on a.id_cliente = b.id
                    join perfil_cliente c on a.id_perfil_cliente = c.id
                    where a.id_usuario = ?";
            
            $query = $this->db->query($sql, array($idUsuario));
                   
            $perfiles = $query->result_array();

            if( is_array($perfiles) && count($perfiles) > 0 ) {
              return $perfiles;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
    }
    
    public function getMenuPorPerfil($idPerfil, $idMenuPadre)
    {
        $Usr = $this->session->userdata('Usuario');
        
        $id_tipo_empresa = $Usr["id_tipo_empresa"];
        
        if ($idMenuPadre == 0)
            $idMenuPadre = "is null";
               
        switch($id_tipo_empresa)/*Dependiendo del tipo de empresa voy a buscar un perfil determinado*/
        {
            case DISTRIBUIDOR: /*El usuario es un distribuidor*/
                $menues = $this->getMenuDistribuidor($idPerfil, $idMenuPadre);
                break;
            case CLIENTE: /*El usuario es un cliente*/
                $menues = $this->getMenuCliente($idPerfil, $idMenuPadre);
                break;
            case PROVEEDOR: /*El usuario es un proveedor*/
                $menues = $this->getMenuProveedor($idPerfil, $idMenuPadre);
                break;
                    
        }
        
        if( is_array($menues) && count($menues) > 0 ) {
              return $menues;
        }
        
        return false;
        
    }
    
    public function getMenuDistribuidor($idPerfil, $idMenuPadre)
    {
        if($idPerfil != FALSE) 
        {
            if ($idMenuPadre == "is null")
            {
                $sql = "select b.id id_menu, b.descripcion , b.path_icono, b.controlador, (select count(*) from menu m where m.id_menu_padre = b.id) cant_hijos 
                        from menu_distribuidor a
                        join menu b on a.id_menu = b.id
                        where id_perfil_distribuidor = ?
                        and b.id_menu_padre is null
                        order by a.orden";
                
                $query = $this->db->query($sql, array($idPerfil));
            }
            else
            {
                $sql = "select b.id id_menu, b.descripcion , b.path_icono, b.controlador, (select count(*) from menu m where m.id_menu_padre = b.id) cant_hijos 
                        from menu_distribuidor a
                        join menu b on a.id_menu = b.id
                        where id_perfil_distribuidor = ?
                        and b.id_menu_padre = ?
                        order by a.orden";
                
                $query = $this->db->query($sql, array($idPerfil,$idMenuPadre));
            }
                   
            $menues = $query->result_array();

            if( is_array($menues) && count($menues) > 0 ) {
              return $menues;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
    }
    
    public function getMenuProveedor($idPerfil, $idMenuPadre)
    {
        if($idPerfil != FALSE) 
        {
          if ($idMenuPadre == "is null")
          {  
            $sql = "select b.id id_menu, b.descripcion , b.path_icono, b.controlador, (select count(*) from menu m where m.id_menu_padre = b.id) cant_hijos 
                      from menu_proveedor a
                      join menu b on a.id_menu = b.id
                      where id_perfil_proveedor = ?
                      and b.id_menu_padre is null
                      order by a.orden";
            
            $query = $this->db->query($sql, array($idPerfil));
          }
          else
          {
              $sql = "select b.id id_menu, b.descripcion , b.path_icono, b.controlador, (select count(*) from menu m where m.id_menu_padre = b.id) cant_hijos 
                      from menu_proveedor a
                      join menu b on a.id_menu = b.id
                      where id_perfil_proveedor = ?
                      and b.id_menu_padre = ?
                      order by a.orden";
              
              $query = $this->db->query($sql, array($idPerfil,$idMenuPadre));
          }
                   
            $menues = $query->result_array();

            if( is_array($menues) && count($menues) > 0 ) {
              return $menues;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
    }
    
    public function getMenuCliente($idPerfil, $idMenuPadre)
    {
         if ($idMenuPadre != "is null")
           $idMenuPadre = " = ".$idMenuPadre; 
        
        if($idPerfil != FALSE) 
        {
          if ($idMenuPadre == "is null")
          {    
            $sql = "select b.id id_menu, b.descripcion , b.path_icono, b.controlador, (select count(*) from menu m where m.id_menu_padre = b.id) cant_hijos 
                    from menu_cliente a
                    join menu b on a.id_menu = b.id
                    where id_perfil_cliente = ?
                    and b.id_menu_padre is null
                    order by a.orden";
            
            $query = $this->db->query($sql, array($idPerfil,$idMenuPadre));
          }
          else
          {
               $sql = "select b.id id_menu, b.descripcion , b.path_icono, b.controlador, (select count(*) from menu m where m.id_menu_padre = b.id) cant_hijos 
                    from menu_cliente a
                    join menu b on a.id_menu = b.id
                    where id_perfil_cliente = ?
                    and b.id_menu_padre = ?
                    order by a.orden";
            
               $query = $this->db->query($sql, array($idPerfil,$idMenuPadre));
          }
            $menues = $query->result_array();

            if( is_array($menues) && count($menues) > 0 ) {
              return $menues;
            }
            
            return false;
        }
        else {
          return FALSE;
        }   
    }

 
}
