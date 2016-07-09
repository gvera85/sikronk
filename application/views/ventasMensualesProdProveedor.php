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

<div class="row-fluid">     
<table id="example" class="display responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Total [$]</th> 
            <th>Marca</th>
            <th>Calidad</th>
            <th>Cant. viajes</th>
            <th>Bultos</th>
            <th>Pallets</th>                      
        </tr>
    </thead>
 
    <tbody>
        
        <?php 
            if (!empty($lineasVentas[0]['id_producto']))
            {
                foreach( $lineasVentas as $lineas ) : ?> 
        
                    <tr>
                        <td><?php echo $lineas['descripcion'] ?></td>
                        <td><?php echo $lineas['total_facturado'] ?></td> 
                        <td><?php echo $lineas['marca'] ?></td>
                        <td><?php echo $lineas['calidad'] ?></td>
                        <td><?php echo $lineas['cant_viajes'] ?></td>
                        <td><?php echo $lineas['total_bultos'] ?></td>
                        <td><?php echo $lineas['total_pallets'] ?></td>
                    </tr>
        
        <?php
                endforeach; 
            }
        ?>  
    </tbody>
</table>	

</div><!--/.fluid-container-->    
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
        "order": [[ 6, 'desc' ]],        
        "language": {
                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                    }
    });
    
    
    
} );        

</script>        


