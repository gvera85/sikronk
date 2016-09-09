<?php

class entidad_bancaria_m extends CI_Model {    
            
    public function getBancoXId($idBanco)
    {
        $sql = "select * from entidad_bancaria where id = ?";
            
        $query = $this->db->query($sql, $idBanco);

        $banco = $query->result_array();

        if( is_array($banco) && count($banco) > 0 ) {
          return $banco;
        }

        return false;
    } 
    
    public function getSucursalXId($idSucursl)
    {
        $sql = "select * from sucursales_bancarias where id = ?";
            
        $query = $this->db->query($sql, $idSucursl);

        $sucursal = $query->result_array();

        if( is_array($sucursal) && count($sucursal) > 0 ) {
          return $sucursal;
        }

        return false;
    } 
   
}
