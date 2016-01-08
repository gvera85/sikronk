<html lang="es">
<?php 
        $this->load->view('headerProveedor');
?>				
<table id="example" class="display responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
    <thead>
        <tr>
            <th>#</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Cant. viajes</th>
            <th>Bultos</th>
            <th>Pallets</th>
            <th>Total facturado [$]</th>
            <th></th>
        </tr>
    </thead>
 
    <tbody>
        
        <?php 
            if (!empty($lineasVentas[0]['mes']))
            {
                foreach( $lineasVentas as $lineas ) : ?> 
        
                    <tr>
                        <td><?php echo $lineas['numero'] ?></td>
                        <td><?php echo $lineas['mes'] ?></td>
                        <td><?php echo $lineas['anio'] ?></td>
                        <td>
                            <?php if ($lineas['cant_viajes'] > 0)
                            {?>
                                <a href="<?php echo base_url('/index.php/reportes/viajesMensuales').'/'.$lineas['numero'].'/'.$lineas['anio']; ?>"> 
                                    <span class="label label-info" id="cantViajes"> <?php echo $lineas['cant_viajes'] ?> </span> 
                                </a> 
                            <?php
                            }else{
                                   echo $lineas['cant_viajes'];
                            }
                            ?>
                        </td>
                        <td><?php echo $lineas['total_bultos'] ?></td>
                        <td><?php echo $lineas['total_pallets'] ?></td>
                        <td><?php echo $lineas['total_facturado'] ?></td>
                         <TD> 
                            <a href="<?php echo base_url('/index.php/reportes/ventasMensualesProdProveedor').'/'.$lineas['numero'].'/'.$lineas['anio']; ?>"> 
                                <span class="label label-info" id="mesAnio"> Ver Prod. </span> 
                            </a> 
                        </TD>
                        
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
        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "pagingType": "full_numbers",
        "displayLength": 25,        
        "order": [[ 2, 'asc' ], [0,'asc']],        
        "language": {
                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                    }
    });
    
    
    
} );        

</script>        
        
        
</body>
</html>

