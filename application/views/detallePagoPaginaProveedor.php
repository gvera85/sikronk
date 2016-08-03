<!DOCTYPE html>
<html lang="es">
<head>
	<?php         
            ini_set('date.timezone', 'America/Argentina/Buenos_Aires');                     
            $this->load->view('headerProv');
        ?>
	
        
    
    
</head>	
<body>
<?php         
            $this->load->view('menuSuperiorProv');
?>
    
<?php
    if (!empty($cabeceraPago[0]['id']))
    {
        foreach( $cabeceraPago as $cabecera ) : 
            $nroFactura = $cabecera['id'];
            $monto = $cabecera['monto'];
            $fechaPago = date_format(date_create($cabecera['fecha_pago']), 'd/m/Y');
            $observaciones = $cabecera['observaciones'];
            $proveedor = $cabecera['razon_social'];
        endforeach; 
    }      
              
?>      
    
<div class="container-fluid-full">
<div class="row-fluid">				
    <?php         
        $this->load->view('menuLateral');
    ?>
    <!-- start: Content -->
    <div id="content" class="span10">


    <ul class="breadcrumb">
            <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo base_url() ?>index.php/reportes/homeProveedor">Home</a> 
                    <i class="icon-angle-right"></i>
            </li>
            <li><a href="#"><?php echo $this->session->userdata('ruta') ?></a></li>
    </ul>	
    <div class="row-fluid">	    
        
        <div class="box-header">
                <h2><i class="halflings-icon plus"></i><span class="break"></span>Resumen de pago al proveedor</h2>
                <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                </div>
        </div>
        <div class="box-content">        
            <table id="example" class="display compact responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
                <tr>
                        <td>Proveedor</td>
                        <td>    
                                <?php echo $proveedor ?>
                        </td>
                </tr>
                <tr>
                        <td>Número de factura</td>
                        <td>    
                                <span data-toggle="tooltip" data-placement="bottom" title="Numero interno que el sistema asignó a este pago"><?php echo $nroFactura ?></span>
                        </td>
                </tr>
                <tr>
                        <td>Fecha de pago</td>
                        <td>    
                                <span data-toggle="tooltip" data-placement="bottom" title="Fecha en que se realizó el pago"><?php echo $fechaPago ?></span>
                        </td>
                </tr>
                <tr>
                        <td>Monto total</td>
                        <td>    
                                <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-small btn-success" style="font-size:small;" title="Monto total del pago">$<?php echo $monto ?></button>
                        </td>
                </tr>
                <tr>
                        <td>Observaciones</td>
                        <td>    
                                <?php echo $observaciones ?>
                        </td>
                </tr>
                <tr>                                
                    <TD colspan="2" style="text-align: center;"> 
                        <a href=javascript:window.open('<?php echo base_url('/index.php/imagenes/verImagenesPagoProveedor').'/'.$nroFactura.'/'.$monto ?>')>                                     
                            <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-small btn-info" style="font-size:small;" title="Imágenes relacionadas a este pago (subidas por el usuario)">Ver imágenes</button>
                        </a> 
                    </TD>
                </tr>
            </table>
        
        </div>    
    </div>
        
        
    <div class="row-fluid">	        
        <div class="box-header">
                    <h2><i class="halflings-icon plus"></i><span class="break"></span>Detalle</h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    </div>
            </div>

        <div class="box-content">
        <table id="tblDetalle" class="table compact table-striped table-hover table-condensed table-responsive">
                            <thead>
                                <tr class="info">                                      
                                        <th><span data-placement="top" data-toggle="tooltip" title="Importe abonado">Importe</span></th>
                                        <th><span data-placement="top" data-toggle="tooltip" title="Forma en que se recibió el importe abonado">Modo pago</span></th>                                            
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if (!empty($lineasPago[0]['id']))
                            {
                                foreach( $lineasPago as $lineas ) : ?>
                                       <tr>
                                           <td id="producto">$<?php echo $lineas['importe'] ?></td>
                                           <td id="producto">
                                           <?php if ($lineas['id_modo_pago'] == 2  || $lineas['id_modo_pago'] == 3) 
                                           {?>    
                                               <button type="button" value="<?php echo $lineas['id'] ?>" class="btn btn-small btn-info" style="font-size:small;" id="btnInfoCheque" data-toggle="modal" data-target="#myModal"><?php echo $lineas['modo_pago'] ?></button>
                                           <?php                                         
                                           }
                                           else
                                           {                                        
                                              echo $lineas['modo_pago'];
                                           }?>                                                
                                           </td>

                                       </tr>
                                 <?php endforeach; 
                            }?>
                            </tbody>
                        </table>
        
        </div>
    </div>            
        

</div><!--/.fluid-container-->
	
			<!-- end: Content -->
        </div><!--/#content.span10-->
        </div><!--/fluid-row-->
		
	
	
	<?php         
            $this->load->view('footerProv');
        ?>	
        
                
	
</body>
</html>     

<script type="text/javascript">
            $(document).ready(function(){

               $(document).on("click","#btnInfoCheque",function( event ) {  

                    var miBoton = $(this).attr('value');     

                    $.ajax({                        
                                url:"<?php echo base_url() ?>index.php/detallesEntidades/verDetalleChequeProveedor/"+miBoton
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


