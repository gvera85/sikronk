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


                            
                                <?php 
                                    $cantidad = 0;
                                    $bultos_mensual = "";
                                    $facturado_mensual = "";
                                    $pallets_mensual = "";
                                    $total_facturado=0;
                                    $total_bultos=0;
                                    $total_pallets=0;

                                    foreach( $lineasVentas as $mes ) : 

                                            $cantidad++;

                                            $total_facturado = $total_facturado + $mes['total_facturado'];
                                            $total_bultos = $total_bultos + $mes['total_bultos'];
                                            $total_pallets = $total_pallets + $mes['total_pallets'];

                                            if ($cantidad == 1)
                                            {
                                                $bultos_mensual = $mes['total_bultos'];
                                                $facturado_mensual = $mes['total_facturado'];
                                                $pallets_mensual = $mes['total_pallets'];
                                            }
                                            else
                                            {
                                                $bultos_mensual = $bultos_mensual.','.$mes['total_bultos'];
                                                $facturado_mensual = $facturado_mensual.','.$mes['total_facturado'];
                                                $pallets_mensual = $pallets_mensual.','.$mes['total_pallets'];
                                            }



                                    endforeach;

                                ?>
    
                        <div class="row-fluid">	        
                                
				<a href="<?php echo base_url() ?>index.php/reportes/ventasMensualesProveedor" class="span4 statbox purple" onTablet="span6" onDesktop="span4">
                                
					
                                        <div class="boxchart"><?php echo $facturado_mensual?></div>
					<div class="number"><?php echo "$".$total_facturado ?><i class="icon-arrow-up"></i></div>
					<div class="title">ventas último año</div>
					<div class="footer">
						 ver reporte ampliado
					</div>	
                                
				</a>
                               
                                 
    
                                <a href="<?php echo base_url() ?>index.php/reportes/ventasMensualesProveedor" class="span4 statbox green" onTablet="span6" onDesktop="span4">  
                               
				
					<div class="boxchart"><?php echo $bultos_mensual ?></div>
					<div class="number"><?php echo $total_bultos ?><i class="icon-arrow-up"></i></div>
					<div class="title">bultos último año</div>
					<div class="footer">
						 ver reporte ampliado    
					</div>
				
                           
                                </a>    
                                
    
                                
                                
				<a href="<?php echo base_url() ?>index.php/reportes/ventasMensualesProveedor" class="span4 statbox blue noMargin" onTablet="span6" onDesktop="span4">
                            
					<div class="boxchart"><?php echo $pallets_mensual ?></div>
					<div class="number"><?php echo $total_pallets ?><i class="icon-arrow-up"></i></div>
					<div class="title">pallets último año</div>
					<div class="footer">
						 ver reporte ampliado
					</div>
				
                                </a>
				
                               
				
			</div>
                            
                            <div class="row-fluid">	
				
				<a class="quick-button metro red span2" href="<?php echo base_url() ?>index.php/cuentaCorrienteProveedor/getCCProveedorPorFiltro/<?php echo $this->session->userdata('empresa') ?>/ccProveedor">
					<i class="icon-money"></i>$0
                                        <p href="#" title="Detalle de todas las deudas e ingresos con el distribuidor" style="font-size:small;"  data-rel="tooltip">Cuenta corriente</p>
				</a>
				
                                <?php if ($permisos['listaProductos']) 
                                {?>
                                    <a class="quick-button metro green span2" href="<?php echo base_url() ?>index.php/reportes/verProductos">
                                    <i class="icon-barcode"></i>
                                    <p>Productos</p>
                                    </a>
                                <?php
                                }
                                ?>  				
                                				
				
				<a class="quick-button metro black span2" href="<?php echo base_url() ?>index.php/reportes/entregasPendientes">
					<i class="icon-calendar"></i>
					<p href="#" title="Son los productos que todavía no arribaron al distribuidor (están en viaje)" style="font-size:small;"  data-rel="tooltip">Entregas</p>
                                        
				</a>
				
				<div class="clearfix"></div>
								
			</div><!--/row-->
					
</div><!--/#content.span10-->			
</div>
</div><!--/fluid-row-->



<?php         
    $this->load->view('footerProv');
?>	
        
                
	
</body>
</html>      
