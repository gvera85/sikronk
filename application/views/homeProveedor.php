<html lang="es">
<?php 
        $this->load->view('headerProveedor');
?>
                            
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
                            
				<div class="span4 statbox purple" onTablet="span6" onDesktop="span4">
					<div class="boxchart"><?php echo $facturado_mensual?></div>
					<div class="number"><?php echo "$".$total_facturado ?><i class="icon-arrow-up"></i></div>
					<div class="title">ventas último año</div>
					<div class="footer">
						<a href="<?php echo base_url() ?>index.php/reportes/ventasMensualesProveedor"> ver reporte ampliado</a>
					</div>	
				</div>
				<div class="span4 statbox green" onTablet="span6" onDesktop="span4">
					<div class="boxchart"><?php echo $bultos_mensual ?></div>
					<div class="number"><?php echo $total_bultos ?><i class="icon-arrow-up"></i></div>
					<div class="title">bultos último año</div>
					<div class="footer">
						<a href="<?php echo base_url() ?>index.php/reportes/ventasMensualesProveedor"> ver reporte ampliado</a>
					</div>
				</div>
				<div class="span4 statbox blue noMargin" onTablet="span6" onDesktop="span4">
					<div class="boxchart"><?php echo $pallets_mensual ?></div>
					<div class="number"><?php echo $total_pallets ?><i class="icon-arrow-up"></i></div>
					<div class="title">pallets último año</div>
					<div class="footer">
						<a href="<?php echo base_url() ?>index.php/reportes/ventasMensualesProveedor"> ver reporte ampliado</a>
					</div>
				</div>
				
				
			</div>
                        
                        <div class="row-fluid">
				
				<div class="span6 statbox purple" onTablet="span6" onDesktop="span6">
					<div class="boxchart">80450,70000,99400,40100,35000,21090,10000,18000,24800,14500,16800</div>
					<div class="number"> $15800 <i class="icon-arrow-up"></i></div>
					<div class="title">pagos pendiente de recibir</div>
					<div class="footer">
                                                <a href="<?php echo base_url() ?>index.php/reportes/pagosPendientesDeRecibir"> ver reporte ampliado</a>
					</div>	
				</div>
				<div class="span6 statbox green" onTablet="span6" onDesktop="span6">
					<div class="boxchart">80,80,79,83,81,80,79,78,79,81,83</div>
					<div class="number"> 84% <i class="icon-arrow-up"></i></div>
					<div class="title">Eficiencia de entrega</div>
					<div class="footer">
						<a href="<?php echo base_url() ?>index.php/reportes/pagosRecibidos"> ver reporte ampliado</a>
					</div>
				</div>
				
				
			</div>	
                            
                            <div class="row-fluid">	
				
				<a class="quick-button metro red span2" href="<?php echo base_url() ?>index.php/cuentaCorrienteProveedor/getCCProveedorPorFiltro/<?php echo $this->session->userdata('empresa') ?>/ccProveedor">
					<i class="icon-money" style="font-size: 34px;"> $183400</i>                                        
                                        <p href="#" title="Detalle de todas las deudas e ingresos con el distribuidor" style="font-size:small;"  data-rel="tooltip">Cuenta corriente</p>
				</a>
				
				<a class="quick-button metro green span2" href="<?php echo base_url() ?>index.php/reportes/verProductos">
					<i class="icon-barcode"></i>
					<p>Productos</p>
				</a>
				
				<a class="quick-button metro black span2" href="<?php echo base_url() ?>index.php/reportes/entregasPendientes">
					<i class="icon-calendar"></i>
					<p href="#" title="Son los productos que todavía no arribaron al distribuidor (están en viaje)" style="font-size:small;"  data-rel="tooltip">Entregas pendientes</p>
                                        
				</a>
				
				<div class="clearfix"></div>
								
			</div><!--/row-->
					
						
		    
<?php 
        $this->load->view('footerProveedorSinDT');
?>    
