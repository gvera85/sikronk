<?php

class pagoClienteLineas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Agregar item a pagos de clientes');
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function popUp($id_cliente, $primary_key){
    $id_pago = $primary_key;    
    if ($id_pago) {
            $this->session->set_userdata('id_pago', $id_pago);        
    }          
    
    $this->load->library('grocery_CRUD');
    $this->load->library('ajax_grocery_CRUD');
    
    //create ajax_grocery_CRUD instead of grocery_CRUD. This extends the functionality with the set_relation_dependency method keeping all original functionality as well
    $crud = new ajax_grocery_CRUD();
    
    $crud->set_language("spanish");
            
    $crud->where('id_pago', $id_pago);      
    
    $crud->set_theme('datatables');
    
    $crud->set_table('pagos_clientes_lineas');
    $crud->edit_fields( 'id_modo_pago', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones');
    $crud->add_fields( 'id_modo_pago', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones');
    
    //$crud->set_theme('datatables');
   
    $crud->set_subject('Item a la factura');
    $crud->required_fields('id_modo_pago', 'importe');
    $crud->columns( 'id_modo_pago', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit','estado','id_cuenta_bancaria', 'observaciones');
    
    $crud->fields('id_pago', 'id_movimiento_cuenta_bancaria','id_modo_pago', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'id_estado', 'id_cuenta_bancaria', 'observaciones');
    $crud->change_field_type('id_pago','invisible');
    $crud->change_field_type('id_movimiento_cuenta_bancaria','invisible');
    
    $crud->callback_before_insert(array($this,'lineas_callback'));
    $crud->callback_before_update(array($this,'lineas_callback'));
    $crud->callback_before_delete(array($this,'lineas_delete_callback'));
    
    $crud->callback_after_delete(array($this,'monto_total_callback'));
    $crud->callback_after_update(array($this,'monto_total_callback'));
    $crud->callback_after_insert(array($this,'monto_total_callback'));
    
    $crud->display_as('fecha_de_acreditacion','Fecha acreditación (para pagos en cheque)');
    
    $crud->display_as('id_entidad_bancaria','Banco (para pagos en cheque)');    
    $crud->set_relation('id_entidad_bancaria','entidad_bancaria','{razon_social}',array('activo' => 1));
    
    $crud->display_as('id_modo_pago','Tipo de pago');
    $crud->set_relation('id_modo_pago','modo_pago','{descripcion}',array('visto_por_clientes' => 1, 'activo' => 1));
    
    
    
    $crud->display_as('id_cuenta_bancaria','Cuenta bancaria (para pagos por transferencia)');
    $crud->set_primary_key('id_cuenta_bancaria','vw_cuentas_bancarias');
    $crud->set_relation('id_cuenta_bancaria','vw_cuentas_bancarias','{razon_social}-Nro. Cuenta: {numero_cuenta}',array( 'id_distribuidor_cuenta_bancaria' => $this->session->userdata('empresa')), 'razon_social ASC');
    
    $crud->change_field_type('id_estado','invisible');
    
    $crud->callback_column('estado',array($this,'_callback_estado'));
    
    $crud->set_primary_key('id','vw_sucursales_bancarias');
    
    $crud->display_as('id_sucursal_bancaria','Sucursal bancaria', array('activo' => 1));
    $crud->set_relation('id_sucursal_bancaria','vw_sucursales_bancarias','{numero_sucursal}-{direccion}', null, 'numero_sucursal ASC');
    
    //$crud->callback_column('id_viaje',array($this,'item_description_callback'));
    
    $crud->set_relation_dependency('id_sucursal_bancaria','id_entidad_bancaria','id_entidad_bancaria');
    
    $crud->set_rules('id_entidad_bancaria','Banco','callback_validarPagoEnCheque');

    $output = $crud->render();
    
    $this->load->model('facturas_clientes_m');

    $cliente = $this->facturas_clientes_m->getClienteXId($id_cliente);

    $this->session->set_userdata('titulo', "Cliente ".$cliente[0]["razon_social"]." - Factura ".$id_pago." - Agregar items a la factura"); 
        
    $this->pago_output($output);
  }
  
  function lineas_callback($post_array) {
   $post_array['id_pago'] = $this->session->userdata('id_pago');//Fijo el Id de pago recibido por parametro
   
   if ($post_array['id_modo_pago'] == 2)
   {
        $post_array['id_estado'] = 8;
   }
   
   chrome_log("idmodopago insert:".$post_array['id_modo_pago'],"log"); 
   
   if ($post_array['id_modo_pago'] == 5)
   {
       $cuenta_bancaria = $this->input->post('id_cuenta_bancaria'); 
       $importe = $this->input->post('importe'); 
       $insert_id = $this->generarMovimientoEnCuentaBancaria($cuenta_bancaria, $importe);
       
       chrome_log("id insert:".$insert_id,"log"); 
       
       $post_array['id_movimiento_cuenta_bancaria'] = $insert_id;
   }
   
   return $post_array;
}

    function lineas_delete_callback($post_array) {
     
       chrome_log("idmodopago delete:".$post_array['id_modo_pago'],"log"); 
        
       if ($post_array['id_modo_pago'] == 5)
       {
           $id_movimiento_cuenta_bancaria = $this->input->post('id_movimiento_cuenta_bancaria'); 
           chrome_log("id_movimiento_cuenta_bancaria:".$id_movimiento_cuenta_bancaria,"log");
           $retorno = $this->eliminarMovimientoEnCuentaBancaria($id_movimiento_cuenta_bancaria);
       }

       return $retorno;
    }

  function monto_total_callback($post_array) {
   
   return $this->actualizarMontoTotal(); /*Hace un update de la tabla pago_cliente para actualizar el monto total que suman las lineas de pagos */
   
}
  
  function pago_output($output = null){
    $this->load->view('mostrarABM',$output);
  }
  
  /*Hace un update de la tabla pago_cliente para actualizar el monto total que suman las lineas de pagos */
  function actualizarMontoTotal() {
   
    $this->load->model('facturas_clientes_m');

    $montoTotal = $this->facturas_clientes_m->getMontoTotal($this->session->userdata('id_pago'));/*Obtengo el monto actual en la BD*/
    
    $this->facturas_clientes_m->updateMontoTotalPago($montoTotal, $this->session->userdata('id_pago'));
   
}

    function generarMovimientoEnCuentaBancaria($cuenta_bancaria, $importe) {
   
        $this->load->model('caja_distribuidor_m');
        
        $fechaPago = $this->caja_distribuidor_m->getFechaPago($this->session->userdata('id_pago'));/*Obtengo el monto actual en la BD*/

        $id_insert = $this->caja_distribuidor_m->insertMovimientoCuentaBancaria($cuenta_bancaria, 2, $importe, $fechaPago, "Movimiento generado por transferencia bancaria de un cliente", 2);
        
        return $id_insert;
   
    }
    
    function eliminarMovimientoEnCuentaBancaria($idMovimiento) {
   
        $this->load->model('caja_distribuidor_m');
        
        $this->caja_distribuidor_m->deleteMovimientoCuentaBancaria($idMovimiento);
    }
  
  public function validarPagoEnCheque($idBanco) 
  {
      
    $id_modo_pago = $this->input->post('id_modo_pago');  
    $fecha_de_acreditacion = $this->input->post('fecha_de_acreditacion'); 
    $id_sucursal_bancaria = $this->input->post('id_sucursal_bancaria'); 
    $cuit = $this->input->post('cuit'); 
    $numero_de_cheque = $this->input->post('numero_de_cheque'); 
    $cuenta_bancaria = $this->input->post('id_cuenta_bancaria'); 
    
            
    if ( $id_modo_pago != 2 && $fecha_de_acreditacion != ""  )/*ERROR!!! El tipo de pago NO es cheque pero seleccionó la fecha de acreditacion*/
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' La fecha de acreditacion solo debe seleccionarse para pagos en cheques');  
        return FALSE;
    } 
    
    if ( $id_modo_pago != 5 && $cuenta_bancaria != ""  )/*ERROR!!! El numero de cuenta solo debe seleccionarse si el pago es por transferencia bancaria*/
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' La cuenta bancaria solo debe seleccionarse si el pago es por transferencia bancaria');  
        return FALSE;
    } 
    
    if ( $id_modo_pago != 2 && $idBanco != ""  )/*ERROR!!! El tipo de pago NO es cheque pero seleccionó un banco*/
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' El banco solo debe seleccionarse para pagos en cheques');  
        return FALSE;
    } 
    
    if ( $id_modo_pago != 2 && $numero_de_cheque != ""  )/*ERROR!!! El tipo de pago NO es cheque pero ingreso un numero cheque*/
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' El numero de cheque solo debe ingresarse para pagos en cheques');  
        return FALSE;
    } 
    
    if ( $id_modo_pago != 2 && $cuit != ""  )/*ERROR!!! El tipo de pago NO es cheque pero seleccionó un banco*/
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' El numero de cuit solo debe ingresarse para pagos en cheques');  
        return FALSE;
    } 
    
    if ($id_modo_pago == 2 && ($idBanco == "" || $fecha_de_acreditacion == "" || $id_sucursal_bancaria == "" || $numero_de_cheque == "" ))
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' En el tipo de pago CHEQUE es obligatorio elegir el numero de cheque, la fecha de acreditacion, el banco y la sucursal');  
        return FALSE;
    }  
    
    if ($id_modo_pago == 5 && ($cuenta_bancaria == ""))
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' En el tipo de pago TRANSFERENCIA BANCARIA es obligatorio elegir la cuenta bancaria');  
        return FALSE;
    }  
    
    /*Esto lo uso como debugger para imprimir el valor de alguna variable que tenga dudas    
    
    $this->form_validation->set_message('validarPagoEnCheque', 'monto total'.$montoTotal);  
    return false;
     * 
     */
    
    return TRUE; 
    
  }
  
  public function _callback_estado($value, $row)
    {
      
        $this->load->model('facturas_proveedor_m');

        $estado = $this->facturas_proveedor_m->getEstado($row->id_estado);   
        
        return $estado[0]["descripcion"];
    }
  
  
 
}
