<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('header') ?>
<head>
    
    <title>sikronk - Notas de crédito/Debito del distribuidor</title>
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
                        url:"<?php echo base_url() ?>index.php/detallesEntidades/verDetalleChequeAjuste/"+miBoton
                  })
                      .done(function(data) {
                        $("#contenidoModal").html(data);
                        console.log( "Sample of data:", data.slice( 0, 9999 ) );
                      })
                      .fail(function(data) {
                        alert( "error" );
                        console.log( "Sample of data:", data.slice( 0, 9999 ) );
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
    if (!empty($cabeceraPago[0]['id']))
    {
        foreach( $cabeceraPago as $cabecera ) : 
            $nroFactura = $cabecera['id'];
            $monto = $cabecera['importe'];
            $fechaPago = date_format(date_create($cabecera['fecha']), 'd/m/Y');
            $observaciones = $cabecera['observaciones'];
            $tipoMovimiento = $cabecera['tipo_mov'];
            $motivo = $cabecera['motivo'];
            $modoPago = $cabecera['modo_pago'];            
            $id_modo_pago = $cabecera['id_modo_pago'];            
        endforeach; 
    }      
              
?>    
    
<div id="container" style="padding: 10px;">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Detalle de notas de débito/crédito</a>
                        </h3>
                    </div>
                <div id="collapse1" class="panel-collapse collapse in">    
                    <div class="panel-body">
                        <table class="table compact table-striped" style="font-size:small; text-align: left">
                            <tr>
                                    <td>Tipo</td>
                                    <td>    
                                            <?php echo $tipoMovimiento ?>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Número de factura</td>
                                    <td>    
                                            <span data-toggle="tooltip" data-placement="bottom" title="Numero interno que el sistema asignó a este pago"><?php echo $nroFactura ?></span>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Fecha</td>
                                    <td>    
                                            <span data-toggle="tooltip" data-placement="bottom" title="Fecha en que se realizó el pago"><?php echo $fechaPago ?></span>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Concepto</td>
                                    <td>    
                                            <?php echo $motivo ?>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Modo de pago</td>
                                    <td>    
                                        <?php if ($id_modo_pago == 2  || $id_modo_pago == 3) 
                                           {?>    
                                               
                                               <button type="button" value="<?php echo $nroFactura ?>" class="btn btn-xs btn-info" style="font-size:small;" id="btnInfoCheque" data-toggle="modal" data-target="#myModal"><?php echo $modoPago ?></button>
                                           <?php                                         
                                           }
                                           else
                                           {                                        
                                              echo $modoPago;
                                           }?>       
                                        
                                        
                                    </td>
                            </tr>
                            <tr>
                                    <td>Monto total</td>
                                    <td>    
                                            <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-success" style="font-size:small;" title="Monto total del pago">$<?php echo $monto ?></button>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Observaciones</td>
                                    <td>    
                                            <?php echo $observaciones ?>
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