<!DOCTYPE html>
<html lang="en">
<head>
	<?php         
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
                            
                        <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Resumen de pago de proveedor</a>
                        </h3>
                    </div>
                <div id="collapse1" class="panel-collapse collapse in">    
                    <div class="panel-body">
                        <table class="table compact table-striped" style="font-size:small; text-align: left">
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
                                            <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-success" style="font-size:small;" title="Monto total del pago">$<?php echo $monto ?></button>
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
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/imagenes/pagoProveedor').'/'.$nroFactura.'/'.$monto ?>')>                                     
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-info" style="font-size:small;" title="Imágenes relacionadas a este pago (subidas por el usuario)">Ver imágenes</button>
                                    </a> 
                                </TD>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>       
                    
                    
                  
			
                
                            
			
		<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2"> Detalle del pago </a>
                    </h3>

                </div>
                <div id="collapse2" class="panel-collapse collapse in">
                    <div class="panel-body">
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
                                               <button type="button" value="<?php echo $lineas['id'] ?>" class="btn btn-xs btn-info" style="font-size:small;" id="btnInfoCheque" data-toggle="modal" data-target="#myModal"><?php echo $lineas['modo_pago'] ?></button>
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
     
