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
        ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
        $fechaEjecucion = date("Y-m-d H:i:s"); //Por default la fecha ejecucion es el dia de hoy    
?>					

<div style="padding: 10px;"></div>
<div class="row-fluid">	        
            <table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">            
                <thead>
                <TR>
                    <th>idViaje</th>
                    <th>Nro. viaje</th>
                    <th>Remito</th>
                    <th>Fecha llegada</th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Calidad</th>          
                    <th>Cant. sin repartir</th>          
                    <th>Estado</th> 
                  
                </TR>
                </thead>
                
                <tbody>
                <?php 
                    if (!empty($lineasSinRepartir[0]['id_viaje']))
                    {
                        foreach( $lineasSinRepartir as $lineas ) : ?> 

                            <tr>
                                <td><?php echo $lineas['id_viaje'] ?></td>
                                <td><?php echo $lineas['numero_de_viaje'] ?></td>
                                <td><?php echo $lineas['numero_de_remito'] ?></td>
                                <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_estimada_llegada']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_estimada_salida']), 'd/m/Y'); ?></td>                                                                                                
                                <td><?php echo $lineas['producto'] ?></td>
                                <td><?php echo $lineas['marca'] ?></td>
                                <td><?php echo $lineas['calidad'] ?></td>
                                <td><?php echo $lineas['restan_repartir'] ?></td>
                                <td><?php echo $lineas['estado'] ?></td>
                                
                            </tr>

                <?php
                        endforeach; 
                    }
                ?>        
                        
                </tbody>    
            </table>	
            <input type="hidden" name="fecha_ejecucion_hidden" id="fecha_ejecucion_hidden" value="<?php echo date_format(date_create($fechaEjecucion), 'd/m/Y H:i:s') ?>">   
</div>

</div><!--/#content.span10-->			
</div>
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
        

