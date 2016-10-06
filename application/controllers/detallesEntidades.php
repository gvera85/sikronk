<?php

class detallesEntidades extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
    
    $this->session->set_userdata('titulo', 'Planificaciones');
    
    $this->load->helper('cambio_estados');
             
    if( !$this->session->userdata('isLoggedIn') ) {
        redirect('/login/show_login');
    }
  }
  
  
  function verPagoCliente($idPago){
    $this->load->model('pagos_m');

    $cabeceraPago = $this->pagos_m->getCabeceraPagoCliente($idPago);
    $lineasPago = $this->pagos_m->getLineasPagoCliente($idPago);
    
    $data['cabeceraPago'] = $cabeceraPago;    
    $data['lineasPago'] = $lineasPago;
   
    $this->load->view('detallePagoCliente',$data);
  }
  
  function verNotaCreditoDebito($idAjuste){
    $this->load->model('pagos_m');

    $cabeceraPago = $this->pagos_m->getDetalleAjuste($idAjuste);
    
    $data['cabeceraPago'] = $cabeceraPago;
   
    $this->load->view('detalleAjuste',$data);
  }
  
  function verNotaCredito($idCredito){
    $this->load->model('pagos_m');
    
    $cabeceraCredito = $this->pagos_m->getCabeceraCredito($idCredito);
    $lineasCredito = $this->pagos_m->getLineasCredito($idCredito);
    
    $data['cabeceraCredito'] = $cabeceraCredito;    
    $data['lineasCredito'] = $lineasCredito;
   
    $this->load->view('detalleNotaCredito',$data);
  }
  
  function verNotaDebito($idDebito){
    $this->load->model('pagos_m');
    
    $cabeceraDebito = $this->pagos_m->getCabeceraDebito($idDebito);
    $lineasDebito = $this->pagos_m->getLineasDebito($idDebito);
    
    $data['cabeceraDebito'] = $cabeceraDebito;    
    $data['lineasDebito'] = $lineasDebito;
   
    $this->load->view('detalleNotaDebito',$data);
  }
  
  function verChequeDistribuidor($idCheque){
    $this->load->model('pagos_m');
    
    $chequeDistribuidor = $this->pagos_m->getChequeEmitido($idCheque);
    
    $data['chequeDistribuidor'] = $chequeDistribuidor;    
   
    $this->load->view('detalleChequeDistribuidor',$data);
  }
  
  function verPagoProveedor($idPago){
    $this->load->model('pagos_m');

    $cabeceraPago = $this->pagos_m->getCabeceraPagoProveedor($idPago);
    $lineasPago = $this->pagos_m->getLineasPagoProveedor($idPago);
    
    $data['cabeceraPago'] = $cabeceraPago;    
    $data['lineasPago'] = $lineasPago;
   
    $this->load->view('detallePagoProveedor',$data);
  }
  
  function verPagoEnPaginaProveedor($idPago){
    $this->load->model('pagos_m');
    
    $this->session->set_userdata('ruta', "Resumen > Detalle del pago");    

    $cabeceraPago = $this->pagos_m->getCabeceraPagoProveedor($idPago);
    $lineasPago = $this->pagos_m->getLineasPagoProveedor($idPago);
    
    $data['cabeceraPago'] = $cabeceraPago;    
    $data['lineasPago'] = $lineasPago;
    
    $this->load->model('usuario_m');
    $permisos["rankingClientes"] =  $this->usuario_m->tieneEstePermiso( $this->session->userdata('idLineaPerfil'), 3);            
    $permisos["rankingProductos"] = $this->usuario_m->tieneEstePermiso( $this->session->userdata('idLineaPerfil'), 4);  
    $data['permisos'] = $permisos;
   
    $this->load->view('detallePagoPaginaProveedor',$data);
  }
  
  function verDetalleCheque($idLineaPago){
    $this->load->model('pagos_m');

    $detalleCheque = $this->pagos_m->getDetalleCheque($idLineaPago);
    
    $respuestaHTML = "<table id='tablaDatosCheque' class='table compact table-striped table-hover table-condensed table-responsive'>                        
                        <tbody>
                            <tr>
                                <td> <div id='nroCheque'>Cheque emitido por</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cliente"]." </div> </td>
                            </tr> 
                            <tr>
                                <td> <div id='nroCheque'>Importe</div></td>
                                <td> <div id='bancoCheque'> $". $detalleCheque[0]["importe"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Numero de cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_de_cheque"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Fecha de acreditacion</div></td>
                                <td> <div id='bancoCheque'> ".date_format(date_create($detalleCheque[0]["fecha_de_acreditacion"]), 'd/m/Y')." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Cuit del cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cuit"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Banco</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["razon_social"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Número de Sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_sucursal"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Dirección sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["direccion_sucursal"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Estado del cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["estado_del_cheque"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Observaciones</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["observaciones"]." </div> </td>
                            </tr>
                        </tbody>
                        </table>";
    
    echo $respuestaHTML;
    
  }
  
  function verDetalleChequeProveedor($idLineaPago){
    $this->load->model('pagos_m');

    $detalleCheque = $this->pagos_m->getDetalleChequeProveedor($idLineaPago);
    
    $respuestaHTML = "<table id='tablaDatosCheque' class='table compact table-striped table-hover table-condensed table-responsive'>                        
                        <tbody>
                            <tr>
                                <td> <div id='nroCheque'>Cheque emitido por</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cliente"]." </div> </td>
                            </tr> 
                            <tr>
                                <td> <div id='nroCheque'>Importe</div></td>
                                <td> <div id='bancoCheque'> $". $detalleCheque[0]["importe"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Numero de cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_de_cheque"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Fecha de acreditacion</div></td>
                                <td> <div id='bancoCheque'> ".date_format(date_create($detalleCheque[0]["fecha_de_acreditacion"]), 'd/m/Y')." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Cuit del cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cuit"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Banco</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["razon_social"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Número de Sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_sucursal"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Dirección sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["direccion_sucursal"]." </div> </td>
                            </tr>
                           
                            <tr>
                                <td> <div id='nroCheque'>Observaciones</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["observaciones"]." </div> </td>
                            </tr>
                        </tbody>
                        </table>";
    
    echo $respuestaHTML;
    
  }
  
  function verDetalleChequeAjuste($idLineaPago){
    $this->load->model('pagos_m');

    $detalleCheque = $this->pagos_m->getDetalleChequeAjuste($idLineaPago);
    
    $respuestaHTML = "<table id='tablaDatosCheque' class='table compact table-striped table-hover table-condensed table-responsive'>                        
                        <tbody>
                            <tr>
                                <td> <div id='nroCheque'>Cheque emitido por</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cliente"]." </div> </td>
                            </tr>        
                            <tr>
                                <td> <div id='nroCheque'>Importe</div></td>
                                <td> <div id='bancoCheque'> $". $detalleCheque[0]["importe"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Numero de cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_de_cheque"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Fecha de acreditacion</div></td>
                                <td> <div id='bancoCheque'> ".date_format(date_create($detalleCheque[0]["fecha_de_acreditacion"]), 'd/m/Y')." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Cuit del cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cuit"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Banco</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["razon_social"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Número de Sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_sucursal"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Dirección sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["direccion_sucursal"]." </div> </td>
                            </tr>
                                               
                            <tr>
                                <td> <div id='nroCheque'>Observaciones</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["observaciones"]." </div> </td>
                            </tr>
                        </tbody>
                        </table>";
    
    echo $respuestaHTML;
    
  }
  
  function verDetalleChequeCredito($idLineaPago){
    $this->load->model('pagos_m');

    $detalleCheque = $this->pagos_m->getDetalleChequeCredito($idLineaPago);
    
    $respuestaHTML = "<table id='tablaDatosCheque' class='table compact table-striped table-hover table-condensed table-responsive'>                        
                        <tbody>
                            <tr>
                                <td> <div id='nroCheque'>Cheque emitido por</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cliente"]." </div> </td>
                            </tr>        
                            <tr>
                                <td> <div id='nroCheque'>Importe</div></td>
                                <td> <div id='bancoCheque'> $". $detalleCheque[0]["importe"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Numero de cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_de_cheque"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Fecha de acreditacion</div></td>
                                <td> <div id='bancoCheque'> ".date_format(date_create($detalleCheque[0]["fecha_de_acreditacion"]), 'd/m/Y')." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Cuit del cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cuit"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Banco</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["razon_social"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Número de Sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_sucursal"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Dirección sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["direccion_sucursal"]." </div> </td>
                            </tr>
                                               
                            <tr>
                                <td> <div id='nroCheque'>Observaciones</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["observaciones"]." </div> </td>
                            </tr>
                        </tbody>
                        </table>";
    
    echo $respuestaHTML;
    
  }
  
  function verDetalleChequeDebito($idLineaPago){
    $this->load->model('pagos_m');

    $detalleCheque = $this->pagos_m->getDetalleChequeDebito($idLineaPago);
    
    $respuestaHTML = "<table id='tablaDatosCheque' class='table compact table-striped table-hover table-condensed table-responsive'>                        
                        <tbody>
                            <tr>
                                <td> <div id='nroCheque'>Cheque emitido por</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cliente"]." </div> </td>
                            </tr>        
                            <tr>
                                <td> <div id='nroCheque'>Importe</div></td>
                                <td> <div id='bancoCheque'> $". $detalleCheque[0]["importe"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Numero de cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_de_cheque"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Fecha de acreditacion</div></td>
                                <td> <div id='bancoCheque'> ".date_format(date_create($detalleCheque[0]["fecha_de_acreditacion"]), 'd/m/Y')." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Cuit del cheque</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["cuit"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Banco</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["razon_social"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Número de Sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["numero_sucursal"]." </div> </td>
                            </tr>
                            <tr>
                                <td> <div id='nroCheque'>Dirección sucursal</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["direccion_sucursal"]." </div> </td>
                            </tr>
                                               
                            <tr>
                                <td> <div id='nroCheque'>Observaciones</div></td>
                                <td> <div id='bancoCheque'> ". $detalleCheque[0]["observaciones"]." </div> </td>
                            </tr>
                        </tbody>
                        </table>";
    
    echo $respuestaHTML;
    
  }
  
  function verDetalleSaldoCaja(){
    $this->load->model('caja_distribuidor_m');

    $detalleSaldo = $this->caja_distribuidor_m->getSaldoPorTipoDePago();
    
    if (empty($detalleSaldo[0]['importe']))
    {
        $respuestaHTML = "Sin datos";
        echo $respuestaHTML;
        return true;
    }
    
    $respuestaHTML = "<table id='tablaSaldoCaja' class='table compact table-striped table-hover table-condensed table-responsive'>
                      <tbody>";
    
    $body = "";
    $importeTotal = 0;
    
    foreach( $detalleSaldo as $detalle ) : 
            $body = $body."<tr>
                    <td> ".$detalle['modo_pago']."</td>
                    <td> ".$detalle['importe']."</td>
                    </tr>";
    
            $importeTotal = $importeTotal + $detalle['importe'];
    endforeach; 
    
    $body = $body."<tfooter>
                   <tr class='info'> 
                    <td> Total</td>
                    <td> ".$importeTotal."</td>
                  </tr>
                  </tfooter>";
    
    $respuestaHTML = $respuestaHTML . $body . "</tbody> </table>";
    
    echo $respuestaHTML;
    
  }
  
  function verGastos($idViaje){
    $this->load->model('viaje_m');
    $this->load->model('cliente_m');
    $this->load->model('reporte_ventas_m');
    
    $resumenViaje = $this->reporte_ventas_m->getResumenViaje($idViaje);
    $lineasGastos = $this->reporte_ventas_m->getGastos($idViaje);
    $lineasViaje = $this->viaje_m->getLineasViaje($idViaje);
    
    $data['resumenViaje'] = $resumenViaje;    
    $data['lineasViaje'] = $lineasViaje;
    $data['lineasGastos'] = $lineasGastos;
    $data['modo'] = "vista";
   
    $this->load->view('detalleGastosDeUnViaje',$data);
  }
}



  

