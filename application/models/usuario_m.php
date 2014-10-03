<?php

class usuario_m extends CI_Model {
   var $id;
   var $stamp;
   var $nombre;
   var $apellido;
   var $mail;
   var $password;  
    

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

 
}
