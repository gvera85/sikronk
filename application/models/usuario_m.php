<?php

class usuario_m extends CI_Model {

    public function getPerfiles($user_id) {
        if($user_id != FALSE) {
          $sql = "select a.id_perfil, b.descripcion perfil, ifnull(c.razon_social,ifnull(e.razon_social,d.razon_social)) empresa
                from usuario_perfil_empresa a
                join perfil b on a.id_perfil = b.id
                left join proveedor c on a.id_proveedor = c.id
                left join distribuidor d on a.id_distribuidor = d.id
                left join cliente e on a.id_cliente = e.id
                where a.id_usuario = ?";
            
          $query = $this->db->query($sql, array($user_id));
                   
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
    
    public function getPerfilesPorUsuario($Usuario) {
        
        switch ($Usuario->id_tipo_empresa)
        {
            case 1:
                return site_url('usuario_perfil_distribuidor/popUp/'.$row->id);
            case 2:
                return site_url('usuario_perfil_cliente/popUp/'.$row->id);
            case 3:
                return site_url('usuario_perfil_proveedor/popUp/'.$row->id);
                
            default:
                return base_url().'index.php';
                
        }
        
    }
    
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
    
    public function getPerfilProveedor($idUsuario)
    {
        $this->db->from('usuario_perfil_distribuidor');
        $this->db->where( array('id_usuario'=>$idUsuario) );

        $perfiles = $this->db->get()->result_array();

        if( is_array($perfiles) && count($perfiles) > 0 ) {
              return $perfiles;
        }

        return false;
    }

 
}
