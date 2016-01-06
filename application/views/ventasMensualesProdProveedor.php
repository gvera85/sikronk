<html lang="es">
<?php 
        $this->load->view('headerProveedor');
?>				
<table id="example" class="display responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Marca</th>
            <th>Calidad</th>
            <th>Cant. viajes</th>
            <th>Bultos</th>
            <th>Pallets</th>
            <th>Total facturado [$]</th>            
        </tr>
    </thead>
 
    <tbody>
        
        <?php 
            if (!empty($lineasVentas[0]['id_producto']))
            {
                foreach( $lineasVentas as $lineas ) : ?> 
        
                    <tr>
                        <td><?php echo $lineas['descripcion'] ?></td>
                        <td><?php echo $lineas['marca'] ?></td>
                        <td><?php echo $lineas['calidad'] ?></td>
                        <td><?php echo $lineas['cant_viajes'] ?></td>
                        <td><?php echo $lineas['total_bultos'] ?></td>
                        <td><?php echo $lineas['total_pallets'] ?></td>
                        <td><?php echo $lineas['total_facturado'] ?></td>                        
                        
                    </tr>
        
        <?php
                endforeach; 
            }
        ?>  
    </tbody>
</table>	
<?php 
        $this->load->view('footerProveedor');
?>  

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
        
        
</body>
</html>

