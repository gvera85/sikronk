<?php

class pagoProveedoresLineas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Agregar item a pagos de proveedores');
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function popUp($id_proveedor, $primary_key){
    $id_pago = $primary_key;    
    if ($id_pago) {
            $this->session->set_userdata('id_pago', $id_pago);        
    }          
    
    $this->load->library('grocery_CRUD');
    $this->load->library('ajax_grocery_CRUD');
    
    //create ajax_grocery_CRUD instead of grocery_CRUD. This extends the functionality with the set_relation_dependency method keeping all original functionality as well
    $crud = new ajax_grocery_CRUD();
    
    $crud->set_language("spanish");
            
    $crud->where('pagos_proveedor_lineas.id_pago', $id_pago);      
    
    $crud->set_theme('datatables');
    
    $crud->set_table('pagos_proveedor_lineas');
    $crud->edit_fields( 'id_modo_pago', 'id_cheque_cliente', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones');
    $crud->add_fields( 'id_modo_pago', 'id_cheque_cliente', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones');
    
    //$crud->set_theme('datatables');
   
    $crud->set_subject('Item a la factura');
    $crud->required_fields('id_modo_pago');
    $crud->columns( 'id_modo_pago', 'importe', 'numero_de_cheque', 'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones');
    
    $crud->fields('id_pago', 'id_modo_pago', 'id_cheque_cliente', 'id_cheque_distribuidor', 'importe', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit', 'observaciones');
    $crud->change_field_type('id_pago','invisible');
    
    $crud->callback_before_insert(array($this,'lineas_callback'));
    $crud->callback_before_update(array($this,'lineas_callback'));
    
    $crud->callback_after_delete(array($this,'monto_total_callback'));
    $crud->callback_after_update(array($this,'monto_total_callback'));
    $crud->callback_after_insert(array($this,'monto_total_callback'));
    
    $crud->callback_before_delete(array($this,'revivir_cheque_callback'));
    
    $crud->display_as('fecha_de_acreditacion','Fecha acreditación (para pagos en cheque)');
    
    $crud->display_as('id_entidad_bancaria','Banco (para pagos en cheque)');    
    $crud->set_relation('id_entidad_bancaria','entidad_bancaria','{razon_social}', array('activo' => 1));
    
    $crud->display_as('id_modo_pago','Tipo de pago');
    $crud->set_relation('id_modo_pago','modo_pago','{descripcion}', array('activo' => 1));
    
    $crud->set_primary_key('id','cheques_en_cartera');
    
    $crud->display_as('id_cheque_cliente','Cheque');
    $crud->set_relation('id_cheque_cliente','cheques_en_cartera','${importe} - Nro:{numero_de_cheque} - Banco:{razon_social} - Fec:{fecha_de_acreditacion}',array('id_modo_pago' => 2, 'id_estado' => 8), 'fecha_de_acreditacion ASC');
    
    $crud->set_primary_key('id','vw_cheques_en_cartera_distribuidor');
    
    $crud->display_as('id_cheque_distribuidor','Cheque propio');
    $crud->set_relation('id_cheque_distribuidor','vw_cheques_en_cartera_distribuidor','${importe} - Nro:{numero_de_cheque} - Banco:{razon_social} - Fec:{fecha_de_acreditacion}', null, 'fecha_de_acreditacion ASC');
    
    $crud->set_primary_key('id','vw_sucursales_bancarias');
    
    $crud->display_as('id_sucursal_bancaria','Sucursal bancaria');
    $crud->set_relation('id_sucursal_bancaria','vw_sucursales_bancarias','{numero_sucursal}-{direccion}');
    
    //$crud->callback_column('id_viaje',array($this,'item_description_callback'));
    
    $crud->set_relation_dependency('id_sucursal_bancaria','id_entidad_bancaria','id_entidad_bancaria');
    
    $crud->set_rules('id_entidad_bancaria','Banco','callback_validarPagoEnCheque');
    
    $crud->set_rules('id_cheque_cliente','Cheque en cartera','callback_validarPagoEnChequeCartera');

    $output = $crud->render();
    
    $this->load->model('facturas_proveedor_m');

    $proveedor = $this->facturas_proveedor_m->getProveedorXId($id_proveedor);

    $this->session->set_userdata('titulo', "Proveedor ".$proveedor[0]["razon_social"]." - Factura ".$id_pago." - Agregar items a la factura"); 
        
    $this->pago_output($output);
  }
  
  function lineas_callback($post_array) {
    $post_array['id_pago'] = $this->session->userdata('id_pago');//Fijo el Id de viaje recibido por parametro

    $id_cheque_cliente = $post_array['id_cheque_cliente'];
    $id_cheque_distribuidor = $post_array['id_cheque_distribuidor'];
    $id_modo_pago = $post_array['id_modo_pago'];

    if ($id_modo_pago == 3)/*Si el pago es cheque en cartera, averiguo todos los datos del cheque y los uso*/
    {
        $this->load->model('facturas_proveedor_m');

        $cheque = $this->facturas_proveedor_m->getDatosCheque($id_cheque_cliente);

        $post_array['importe'] = $cheque[0]["importe"];     
        $post_array['id_entidad_bancaria'] = $cheque[0]["id_entidad_bancaria"];     
        $post_array['id_sucursal_bancaria'] = $cheque[0]["id_sucursal_bancaria"];     
        $post_array['fecha_de_acreditacion'] = $cheque[0]["fecha_de_acreditacion"];     
        $post_array['numero_de_cheque'] = $cheque[0]["numero_de_cheque"];     
        $post_array['cuit'] = $cheque[0]["cuit"];  
        
        transicionSimple($id_cheque_cliente, 9, "pagos_clientes_lineas");
    }
    
    if ($id_modo_pago == 4)/*Si el pago es cheque en cartera de distribuidor, averiguo todos los datos del cheque y los uso*/
    {
        $this->load->model('facturas_proveedor_m');

        $cheque = $this->facturas_proveedor_m->getDatosChequeDistribuidor($id_cheque_distribuidor);

        $post_array['importe'] = $cheque[0]["importe"];     
        $post_array['id_entidad_bancaria'] = $cheque[0]["id_entidad_bancaria"];     
        $post_array['id_sucursal_bancaria'] = $cheque[0]["id_sucursal_bancaria"];     
        $post_array['fecha_de_acreditacion'] = $cheque[0]["fecha_de_acreditacion"];     
        $post_array['numero_de_cheque'] = $cheque[0]["numero_de_cheque"];     
        $post_array['cuit'] = $cheque[0]["cuit"];  
        
        transicionSimple($id_cheque_distribuidor, 16, "cheque_distribuidor");
    }
   
    return $post_array;
}

  function monto_total_callback($post_array) {
   
   return $this->actualizarMontoTotal(); /*Hace un update de la tabla pago_proveedor para actualizar el monto total que suman las lineas de pagos */
   
}
  
  function pago_output($output = null){
    $this->load->view('mostrarABM',$output);
  }
  
  function cek_before_delete($primary_key) {
        $this->db->db_debug = false;
        $this->db->trans_begin();
        $this->db->where('id', $primary_key);
        $this->db->delete('viaje');
        $num_rows = $this->db->affected_rows();
        $this->db->trans_rollback();
        if ($num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
   }
  
  function revivir_cheque_callback($primary_key) {
    
    $this->load->model('facturas_proveedor_m');

    $cheque = $this->facturas_proveedor_m->getChequeProveedor($primary_key);  
      
    $id_modo_pago = $cheque[0]["id_modo_pago"];
    $id_cheque_cliente = $cheque[0]["id_cheque_cliente"];
    $id_cheque_distribuidor = $cheque[0]["id_cheque_distribuidor"];
    
    if ($id_modo_pago == 3)/*Si el pago es cheque en cartera, averiguo todos los datos del cheque y los uso*/
    {   
        transicionSimple($id_cheque_cliente, 8, "pagos_clientes_lineas");
    }
    
    if ($id_modo_pago == 4)/*Si el pago es cheque en cartera, averiguo todos los datos del cheque y los uso*/
    {   
        transicionSimple($id_cheque_distribuidor, 15, "cheque_distribuidor");
    }
      
  }
  
  /*Hace un update de la tabla pago_cliente para actualizar el monto total que suman las lineas de pagos */
  function actualizarMontoTotal() {
   
    $this->load->model('facturas_proveedor_m');

    $montoTotal = $this->facturas_proveedor_m->getMontoTotal($this->session->userdata('id_pago'));/*Obtengo el monto actual en la BD*/
    
    $this->facturas_proveedor_m->updateMontoTotalPago($montoTotal, $this->session->userdata('id_pago'));
   
   
}

  public function validarPagoEnCheque($idBanco) 
  {
      
    $id_modo_pago = $this->input->post('id_modo_pago');  
    $fecha_de_acreditacion = $this->input->post('fecha_de_acreditacion'); 
    $id_sucursal_bancaria = $this->input->post('id_sucursal_bancaria'); 
    $cuit = $this->input->post('cuit'); 
    $numero_de_cheque = $this->input->post('numero_de_cheque'); 
    
    $importe = $this->input->post('importe');  
    
    if ( ($id_modo_pago == 2 || $id_modo_pago == 1) &&  $importe == "" )/*ERROR!!! El importe no puede ser vacio enpago en cheques o efectivo*/
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' Es obligatorio colocar el importe para los pagos en CHEQUES y EFECTIVO');  
        return FALSE;
    } 
    
            
    if ( $id_modo_pago != 2 && $fecha_de_acreditacion != ""  )/*ERROR!!! El tipo de pago NO es cheque pero seleccionó la fecha de acreditacion*/
    {
        $this->form_validation->set_message('validarPagoEnCheque', ' La fecha de acreditacion solo debe seleccionarse para pagos en cheques');  
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
    
    /*Esto lo uso como debugger para imprimir el valor de alguna variable que tenga dudas    
    
    $this->form_validation->set_message('validarPagoEnCheque', 'monto total'.$montoTotal);  
    return false;
     * 
     */
    
    return TRUE; 
    
  }
  
  
  public function validarPagoEnChequeCartera($idBanco) 
  {
      
    $id_modo_pago = $this->input->post('id_modo_pago');  
    $id_cheque_cliente = $this->input->post('id_cheque_cliente'); 
    $id_cheque_distribuidor = $this->input->post('id_cheque_distribuidor'); 
    
    $importe = $this->input->post('importe');  
    
    if ( $id_modo_pago != 3 && $id_cheque_cliente != ""  )/*ERROR!!! El tipo de pago NO es cheque pero seleccionó un cheque en cartera*/
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' Solo debe seleccionar un cheque cuando el pago sea del tipo CHEQUE EN CARTERA');  
        return FALSE;
    } 
    
    if ( $id_modo_pago != 4 && $id_cheque_distribuidor != ""  )/*ERROR!!! El tipo de pago NO es cheque pero seleccionó un cheque en cartera*/
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' Solo debe seleccionar un cheque cuando el pago sea del tipo CHEQUE PROPIO');  
        return FALSE;
    } 
    
    if ( $id_modo_pago == 3 && ($importe != ""))
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' En el tipo de pago CHEQUE EN CARTERA no debe ingresar el importe');  
        return FALSE;
    }  
    
    if ( $id_modo_pago == 4 && ($importe != ""))
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' En el tipo de pago CHEQUE PROPIO no debe ingresar el importe');  
        return FALSE;
    }  
    
    
    if ($id_modo_pago == 3 && ($id_cheque_cliente == ""))
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' En el tipo de pago CHEQUE EN CARTERA es obligatorio seleccionar un cheque de la lista');  
        return FALSE;
    }  
    
    if ($id_modo_pago == 4 && ($id_cheque_distribuidor == ""))
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' En el tipo de pago CHEQUE PROPIO es obligatorio seleccionar un cheque de la lista');  
        return FALSE;
    }  
    
    /*Esto lo uso como debugger para imprimir el valor de alguna variable que tenga dudas    
    
    $this->form_validation->set_message('validarPagoEnChequeCartera', 'monto total'.$montoTotal);  
    return false;
     * 
     */
    
    return TRUE; 
    
  }
 
}
