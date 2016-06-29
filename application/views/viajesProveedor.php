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
        <a href="<?php echo "javascript:window.open('".base_url('/index.php/viaje/viajeProveedor/1/'.$this->session->userdata('empresa'))."');"?>" style="font-size:small;" class="btn btn-small btn-success"><?php echo "+ Link hacia creación de viajes" ?></a>
        <div style="padding: 10px;"></div>
        <table id="example" class="display compact responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
            <thead>
                <tr>
                    <th>idViaje</th>
                    <th>#Viaje</th>
                    <th>Monto viaje [$]</th>
                    <th>Remito</th>
                    <th>Fecha llegada</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>

                <?php 
                    if (!empty($lineasVentas[0]['id']))
                    {
                        foreach( $lineasVentas as $lineas ) : ?> 

                            <tr>
                                <td><?php echo $lineas['id'] ?></td>
                                <td><?php echo $lineas['numero_de_viaje'] ?></td>
                                <td><?php echo $lineas['montoViaje'] ?></td>
                                <td><?php echo $lineas['numero_de_remito'] ?></td>                        
                                <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_estimada_llegada']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_estimada_llegada']), 'd/m/Y'); ?></td>
                                <td><?php echo $lineas['estado'] ?></td>
                                <TD> 
                                    <a href="<?php echo base_url('/index.php/reportes/detalleViaje').'/'.$lineas['id']; ?>"> 
                                        <span class="label label-info" id="nroViaje"> + detalle </span> 
                                    </a> 
                                </TD>
                            </tr>

                <?php
                        endforeach; 
                    }
                ?>  
            </tbody>
        </table>	
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
        
$(document).ready(function() {
    
    var table = $('#example').DataTable({
        "pagingType": "full_numbers",
        "displayLength": 25,
        "scrollCollapse": true,
        "order": [[ 1, 'asc' ], [0,'asc']],        
        "language": {
                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                    }
    });
    
    
    
} );        

</script>       


