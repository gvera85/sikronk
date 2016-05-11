<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('header') ?>
<head>
    
    <title>sikronk - Detalle de gastos de un viaje</title>
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
                        url:"<?php echo base_url() ?>index.php/detallesEntidades/verDetalleCheque/"+miBoton
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
    
    if (!empty($resumenViaje[0]['id']))
    {
        foreach( $resumenViaje as $resumen ) : 
            $idViaje = $resumen['id'];
            $nroViaje = $resumen['numero_de_viaje'];
            $fechaSalida = date_format(date_create($resumen['fecha_estimada_salida']), 'd/m/Y');
            $valorMercaderia = $resumen['valor_mercaderia'];
            $valorMercaderiaProveedor = $resumen['valor_mercaderia_proveedor'];
            $valorGastosProveedor = $resumen['valor_gastos_proveedor'];
            $valorGastosDistribuidor = $resumen['valor_gastos_distribuidor'];
            $valorAPagarAlProveedor = $valorMercaderiaProveedor - $valorGastosProveedor;
        endforeach; 
    }      
    
    $gastosDelProveedor = "";
    $gastosDelDistribuidor = "";
    
    
    

    $sinProductos = 0;
    if (empty($lineasViaje[0]['numero_de_viaje']))
    {
        $titulo = "Viaje sin productos asociados. Para asignar productos al viaje debe ir a la pagina de creacion de viajes";
        $sinProductos = 1;
    }
    else
    {
        $titulo = "Viaje número ".$lineasViaje[0]['numero_de_viaje']." - Remito ".$lineasViaje[0]['numero_de_remito']." - ".$lineasViaje[0]['proveedor'];
        
        if ($lineasViaje[0]['id_estado'] == 7) /* El viaje ya tiene los precios acordados, por eso se ocultan los botones */ {
            $modo = "viajeConPrecioCerrado";
        }
    }             
?> 
              

    
<div id="container" style="padding: 10px;">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo "Resumen ".$titulo  ?></a>
                        </h3>
                    </div>
                <div id="collapse1" class="panel-collapse collapse in">    
                    <div class="panel-body">
                        <table class="table compact table-striped" style="font-size:small; text-align: left">
                            <tr>
                                    <td>Valor total de la mercadería cobrada a los clientes</td>
                                    <td>    
                                            <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-success" style="font-size:small;" title="Valor total de la mercadería facturada a los clientes">$<?php echo $valorMercaderia ?></button>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Valor total de la mercadería adeudada al proveedor</td>
                                    <td>    
                                            <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-danger" style="font-size:small;" title="Valor total de la mercadería informada al proveedor">$<?php echo $valorMercaderiaProveedor ?></button>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Valor total de los gastos a cargo del proveedor</td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-danger">$<?php echo $valorGastosProveedor ?></a>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Valor total de los gastos a cargo del distribuidor</td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-warning">$<?php echo $valorGastosDistribuidor ?></a>
                                    </td>
                            </tr>
                            <tr>
                                    <td><b><i>Valor total a abonar al proveedor</i></b></td>
                                    <td>
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-danger" style="font-size:small;" title="Es el valor total de la mercadería, restandole los gastos a cargo del proveedor">$<?php echo $valorAPagarAlProveedor ?></button>
                                    </td>
                            </tr>
                            <tr>                                
                                <TD colspan="2" style="text-align: center;"> 
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/imagenes/viaje').'/'.$idViaje?>')>                                     
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-info" style="font-size:small;" title="Imágenes relacionadas a este viaje (subidas por el usuario)">
                                           <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Ver imágenes
                                        </button>
                                    </a> 
                                </TD>
                            </tr>
                            <?php if ($modo == "viajeConPrecioCerrado") {?>
                            <tr>                                
                                <TD colspan="2" style="text-align: center;"> 
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/generarPDFConf/comprobanteViaje').'/'.$idViaje.'/1'?>')>                                  
                                    
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-danger" style="font-size:small;" title="Generar un comprobante en formato PDF">
                                            <span class="fa fa-file-pdf-o" aria-hidden="true"></span> Comprobante PDF
                                        </button>
                                        
                                    </a> 
                                </TD>
                            </tr>
                            <?}?>
                        </table>
                    </div>
                </div>
            </div>    
    
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2"> Detalle de gastos </a>
                    </h3>

                </div>
                <div id="collapse2" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <table id="tblDetalle" class="table compact table-striped table-hover table-condensed table-responsive">
                            <thead>
                                <tr class="info">                                      
                                        <th><span data-placement="top" data-toggle="tooltip" title="Proveedor que brinda el servicio">Proveedor del servicio</span></th>
                                        <th><span data-placement="top" data-toggle="tooltip" title="Proveedor que brinda el servicio">Gasto</span></th>
                                        <th><span data-placement="top" data-toggle="tooltip" title="Precio por unidad de trabajo">Precio unitario</span></th>                                            
                                        <th><span data-placement="top" data-toggle="tooltip" title="Cantidad">Cantidad</span></th>                                            
                                        <th><span data-placement="top" data-toggle="tooltip" title="Precio total">Precio total</span></th>                                            
                                        <th><span data-placement="top" data-toggle="tooltip" title="El proveedor se hace cargo del gasto?">A cargo de</span></th>                                            
                                        <th><span data-placement="top" data-toggle="tooltip" title="Observaciones sobre el gasto">Observaciones</span></th>                                            
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                            if (!empty($lineasGastos[0]['id']))
                            {
                                foreach( $lineasGastos as $gastos ) :  
                                
                                    if ($gastos['a_cargo_del_proveedor'] == 1)
                                        $aCargoDe = "Proveedor";
                                    else    
                                        $aCargoDe = "Distribuidor";
                                    ?>
                                       <tr>
                                           <td><?php echo $gastos['proveedor_del_servicio'] ?></td>
                                           <td><?php echo $gastos['gasto'] ?></td>
                                           <td>$<?php echo $gastos['precio_unitario'] ?></td>
                                           <td><?php echo $gastos['cantidad'] ?></td>
                                           <td>$<?php echo $gastos['precio_unitario'] * $gastos['cantidad'] ?></td>
                                           <td><?php echo $aCargoDe ?></td>
                                           <td><?php echo $gastos['observaciones'] ?></td>
                                       </tr>
                            <?php endforeach; 
                            }?>
                            </tbody>
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