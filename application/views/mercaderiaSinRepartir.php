<html lang="es">
<?php 
        $this->load->view('headerProveedor');
        $fechaEjecucion = date("Y-m-d H:i:s"); //Por default la fecha ejecucion es el dia de hoy    
?>					

<div style="padding: 10px;"></div>
            <table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">            
                <thead>
                <TR>
                    <th>idViaje</th>
                    <th>Nro. viaje</th>
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
<?php 
        $this->load->view('footerProveedor');
?>  
    
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
        
        
</body>
</html>

