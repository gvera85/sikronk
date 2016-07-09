<?php

class notaDeCreditoDebito extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->library('ajax_grocery_CRUD');
    
    $this->load->database();
    $this->load->helper('url');
    
    $this->load->helper('cambio_estados');
    
    $this->session->set_userdata('titulo', 'Nota de crédito/débito');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  function index(){
    $crud = new ajax_grocery_CRUD();  
    $crud->set_language("spanish");      
      
    $crud->set_table('nota_credito_debito');
    $crud->edit_fields('id_tipo', 'fecha', 'id_tipo_credito_debito', 'id_modo_pago',  'id_cheque_cliente', 'importe', 'observaciones', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit');
    $crud->add_fields('id_tipo', 'fecha', 'id_tipo_credito_debito','id_modo_pago',  'id_cheque_cliente', 'importe', 'observaciones', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit');
    
    $crud->set_theme('datatables');
   
    $crud->set_subject('Nota de crédito/débito');
    $crud->required_fields('id_tipo', 'id_tipo_credito_debito','id_modo_pago', 'fecha');
    $crud->columns('fecha', 'id_tipo', 'id_tipo_credito_debito','id_modo_pago','importe','observaciones');
    
    $crud->fields('id_tipo', 'fecha', 'id_tipo_credito_debito','id_modo_pago',  'id_cheque_cliente', 'importe', 'observaciones', 'numero_de_cheque',  'fecha_de_acreditacion','id_entidad_bancaria', 'id_sucursal_bancaria', 'cuit');
    
    $crud->display_as('id_tipo','Tipo');        
    $crud->set_relation('id_tipo','tipo_mov','descripcion');
    
    $crud->display_as('id_modo_pago','Tipo de pago');
    $crud->set_relation('id_modo_pago','modo_pago','{descripcion}', array('activo' => 1));
    
    $crud->set_primary_key('id','cheques_en_cartera');
    
    $crud->display_as('id_cheque_cliente','Cheque');
    $crud->set_relation('id_cheque_cliente','cheques_en_cartera','${importe} - Nro:{numero_de_cheque} - Banco:{razon_social} - Fec:{fecha_de_acreditacion}',array('id_modo_pago' => 2, 'id_estado' => 8), 'fecha_de_acreditacion ASC');
    
    $crud->display_as('id_tipo_credito_debito','Concepto');        
    $crud->set_relation('id_tipo_credito_debito','tipo_debito_credito','descripcion',array('activo' => 1));
    
    $crud->callback_before_insert(array($this,'lineas_callback'));
    $crud->callback_before_update(array($this,'lineas_callback'));
    
    $crud->display_as('fecha_de_acreditacion','Fecha acreditación (para pagos en cheque)');
    
    $crud->display_as('id_entidad_bancaria','Banco (para pagos en cheque)');    
    $crud->set_relation('id_entidad_bancaria','entidad_bancaria','{razon_social}', array('activo' => 1));
    
     $crud->set_primary_key('id','vw_sucursales_bancarias');
    
    $crud->display_as('id_sucursal_bancaria','Sucursal bancaria');
    $crud->set_relation('id_sucursal_bancaria','vw_sucursales_bancarias','{numero_sucursal}-{direccion}');
    
    $crud->set_relation_dependency('id_sucursal_bancaria','id_entidad_bancaria','id_entidad_bancaria');
    
    $crud->set_relation_dependency('id_tipo_credito_debito','id_tipo','id_tipo');
    
     $crud->set_rules('id_entidad_bancaria','Banco','callback_validarPagoEnCheque');
    
    $crud->set_rules('id_cheque_cliente','Cheque en cartera','callback_validarPagoEnChequeCartera');
    
    $output = $crud->render();
    $this->notaCredito($output);
  }
  
  function notaCredito($output = null){
    $this->load->view('mostrarABM',$output);
  } 
  
   function lineas_callback($post_array) {
    
    $id_cheque_cliente = $post_array['id_cheque_cliente'];
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
        
        transicionSimple($id_cheque_cliente, ESTADO_CHEQUE_UTILIZADO_EN_NOTA_DEBITO, "pagos_clientes_lineas");
    }
   
    return $post_array;
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
      
     */
    
    return TRUE; 
    
  }
  
  
  public function validarPagoEnChequeCartera($idBanco) 
  {
    
    $id_tipo = $this->input->post('id_tipo');    
    $id_modo_pago = $this->input->post('id_modo_pago');  
    $id_cheque_cliente = $this->input->post('id_cheque_cliente'); 
    
    $importe = $this->input->post('importe');  
    
    if ( $id_tipo != 1  )/*ERROR!!! Solo se permite pago de cheque en cartera en DEBITOS*/
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' Solo se permite utilizar CHEQUES EN CARTERA para DEBITOS');  
        return FALSE;
    } 
    
    if ( $id_modo_pago != 3 && $id_cheque_cliente != ""  )/*ERROR!!! El tipo de pago NO es cheque pero seleccionó un cheque en cartera*/
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' Solo debe seleccionar un cheque cuando el pago sea del tipo CHEQUE EN CARTERA');  
        return FALSE;
    } 
    
    if ($id_modo_pago == 3 && ($importe != ""))
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' En el tipo de pago CHEQUE EN CARTERA no debe ingresar el importe');  
        return FALSE;
    }  
    
    
    if ($id_modo_pago == 3 && ($id_cheque_cliente == ""))
    {
        $this->form_validation->set_message('validarPagoEnChequeCartera', ' En el tipo de pago CHEQUE EN CARTERA es obligatorio seleccionar un cheque de la lista');  
        return FALSE;
    }  
    
    /*Esto lo uso como debugger para imprimir el valor de alguna variable que tenga dudas  
    
    $this->form_validation->set_message('validarPagoEnChequeCartera', 'id_cheque_cliente'.$id_cheque_cliente);  
    return false;
     */
     
    
    return TRUE; 
    
  }

}
