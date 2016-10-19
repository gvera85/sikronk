<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('header') ?>
<head>
    
    <title>sikronk - Detalle de cheque emitido</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url() ?>/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/bootstrap/js/bootstrap.js"></script>
    

  
    <script type="text/javascript">
    $(document).ready(function(){
       
       $('[data-toggle="popover"]').popover(); 
       $('[data-toggle="tooltip"]').tooltip();
       
       $(document).on("click","#btnInfoCheque",function( event ) {  
           
            var miBoton = $(this).attr('value');     
            
            $.ajax({                        
                        url:"<?php echo base_url() ?>index.php/detallesEntidades/verDetalleChequeDebito/"+miBoton
                  })
                      .done(function(data) {
                        $("#contenidoModal").html(data);
                        console.log( "Sample of data:", data.slice( 0, 100 ) );
                      })
                      .fail(function(data) {
                        alert( "error" );
                        console.log( "Sample of data:", data.slice( 0, 100 ) );
                      });
        
       });
        
        
    });
    </script>
    
    
    
    <style>
        .top-buffer { 
                margin-top:20px; 
        }
        
        .panel-heading .accordion-toggle:after {
            /* symbol for "opening" panels */
            font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
            content: "\e114";    /* adjust as needed, taken from bootstrap.css */
            float: right;        /* adjust as needed */
            color: white;         /* adjust as needed */
        }
        .panel-heading .accordion-toggle.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\e080";    /* adjust as needed, taken from bootstrap.css */
        }
        
    </style>
    
</head>
<body>
    
<?php
    if (!empty($chequeDistribuidor[0]['importe']))
    {
        
        foreach( $chequeDistribuidor as $cabecera ) : 
            $importe = $cabecera['importe'];
            $numero_de_cheque = $cabecera['numero_de_cheque'];
            $fecha_de_acreditacion = date_format(date_create($cabecera['fecha_de_acreditacion']), 'd/m/Y');
            $fecha_de_emision = date_format(date_create($cabecera['fecha_emision']), 'd/m/Y');
            $fecha_deposito_efectivo = date_format(date_create($cabecera['fecha_deposito_efectivo']), 'd/m/Y');
            $cuit = $cabecera['cuit'];           
            $observaciones = $cabecera['observaciones'];           
            $banco = $cabecera['razon_social'];           
            $direccion_banco = $cabecera['direccion_banco'];           
            $numero_sucursal = $cabecera['numero_sucursal'];           
            $direccion_sucursal = $cabecera['direccion_sucursal'];           
            $distribuidor = $cabecera['distribuidor'];   
            $estado  = $cabecera['estado']; 
        endforeach; 
    }      
              
?>    
    
<div id="container" style="padding: 10px;">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Cheque del distribuidor</a>
                        </h3>
                    </div>
                <div id="collapse1" class="panel-collapse collapse in">    
                    <div class="panel-body">
                        <table class="table compact table-striped" style="font-size:small; text-align: left">                            
                            <tr>
                                    <td>Importe</td>
                                    <td>    
                                            <span data-toggle="tooltip" data-placement="bottom" title="Numero interno que el sistema asignó a este pago"><?php echo $importe ?></span>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Número de cheque</td>
                                    <td>    
                                            <?php echo $numero_de_cheque ?>
                                    </td>
                            </tr>  
                            <tr>
                                    <td>Fecha de emisión</td>
                                    <td>    
                                            <?php echo $fecha_de_emision ?>
                                    </td>
                            </tr> 
                           <tr>
                                    <td>Fecha de acreditación</td>
                                    <td>    
                                            <?php echo $fecha_de_acreditacion ?>
                                    </td>
                            </tr>     
                            <tr>
                                    <td>Cuit</td>
                                    <td>    
                                            <?php echo $cuit ?>
                                    </td>
                            </tr> 
                            <tr>
                                    <td>Banco</td>
                                    <td>    
                                            <?php echo $banco ?>
                                    </td>
                            </tr>     
                            <tr>
                                    <td>Dirección</td>
                                    <td>    
                                            <?php echo $direccion_banco ?>
                                    </td>
                            </tr>     
                            <tr>
                                    <td>Número de sucursal</td>
                                    <td>    
                                            <?php echo $numero_sucursal ?>
                                    </td>
                            </tr>     
                            <tr>
                                    <td>Dirección de sucursal</td>
                                    <td>    
                                            <?php echo $direccion_sucursal ?>
                                    </td>
                            </tr>
                             <tr>
                                    <td>Fecha de depósito del efectivo</td>
                                    <td>    
                                            <?php echo $fecha_deposito_efectivo ?>
                                    </td>
                            </tr>     
                            <tr>
                                    <td>Observaciones</td>
                                    <td>    
                                            <?php echo $observaciones ?>
                                    </td>
                            </tr> 
                            <tr>
                                    <td>Estado del cheque</td>
                                    <td>    
                                            <?php echo $estado ?>
                                    </td>
                            </tr> 
                        </table>
                    </div>
                </div>
            </div>      
    
          
                
        
</div>
    
 <!-- Modal (solo visible al hacer clic en el modo de pago en cheques -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Datos del cheque</h4>
          </div>
          <div class="modal-body">
              <div id="contenidoModal">
                  
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>

      </div>
    </div>  
    
</body>
</html>