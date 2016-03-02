<?php

class admin_m extends CI_Model {
    
    public function eliminarDatosViajesSistema()
    {
        
        $sql = "CALL limpiarTablasSistema()";
         
        if ($this->db->query($sql))
        {
            return true;
        }else{
            show_error('Error!');
            return false;
        }
    }    
   
}
