<html lang="es">
<?php 
        $this->load->view('headerProveedor');
?>
    
    <?php 
        if (!empty($resumenViaje[0]['id']))
        {
            foreach( $resumenViaje as $resumen ) : 
                $idViaje = $resumen['id'];
                $nroViaje = $resumen['numero_de_viaje'];
                $nroRemito = $resumen['numero_de_remito'];
                $fechaSalida = date_format(date_create($resumen['fecha_estimada_salida']), 'd/m/Y');
                $valorMercaderia = $resumen['valor_mercaderia_proveedor'];
                $valorGastosProveedor = $resumen['valor_gastos_proveedor'];
                $valorGastosDistribuidor = $resumen['valor_gastos_distribuidor'];
                $valorAPagarAlProveedor = $valorMercaderia - $valorGastosProveedor;
            endforeach; 
        }
        
        $gastosDelProveedor = "";
        $gastosDelDistribuidor = 
                
        $permisoPrecio = 0;        
        
        if (!empty($lineasGastos[0]['id']))
        {
            foreach( $lineasGastos as $gastos ) : 
                $valorGasto = $gastos['precio_unitario']*$gastos['cantidad'];
                
                if ($gastos['a_cargo_del_proveedor']==1){
                    $gastosDelProveedor = $gastosDelProveedor." ".$gastos['gasto'].": $".$valorGasto;
                }
                else {
                    $gastosDelDistribuidor = $gastosDelDistribuidor." ".$gastos['gasto'].": $".$valorGasto;
                }
                
            endforeach; 
        }
    ?>  
    
    
    <div class="box span12">
        <div class="box-header">
                <h2><i class="halflings-icon plus"></i><span class="break"></span><?php echo "Viaje número ".$nroViaje." - Remito ".$nroRemito." - Fecha: ".$fechaSalida ?> </h2>
                <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                </div>
        </div>
        <div class="box-content">
                <table class="table table-bordered compact table-striped" style="font-size:small;">
                        <tr>
                                <td>Valor total de la mercadería</td>
                                <td>
                                        <a href="#" title="Ver detalle en la tabla situada en la parte inferior de la pantalla" style="font-size:small;"  data-rel="tooltip" class="btn btn-small btn-success">$<?php echo $valorMercaderia ?></a>
                                </td>
                        </tr>
                        <tr>
                                <td>Valor total de los gastos a cargo del proveedor</td>
                                <td>
                                    <a href="#" style="font-size:small;" class="btn btn-small btn-danger" data-rel="popover"  data-content="<?php echo $gastosDelProveedor ?>" title="Detalle de los gastos">$<?php echo $valorGastosProveedor ?></a>                                    
                                </td>
                        </tr>
                        <tr>
                                <td>Valor total de los gastos a cargo del distribuidor</td>
                                <td>
                                    <a href="#" style="font-size:small;" class="btn btn-small btn-warning" data-rel="popover"  data-content="<?php echo $gastosDelDistribuidor ?>" title="Detalle de los gastos">$<?php echo $valorGastosDistribuidor ?></a>
                                </td>
                        </tr>
                        <tr>
                                <td><b><i>Valor total a abonar al proveedor</i></b></td>
                                <td>  
                                    <a href="#" title="Es el valor total de la mercadería, restandole los gastos a cargo del proveedor" style="font-size:small;"  data-rel="tooltip" class="btn btn-small btn-success">$<?php echo $valorAPagarAlProveedor ?></a>
                                </td>
                        </tr>
                        <tr>
                                
                            <TD colspan="2" style="text-align: center;"> 
                                    <a href="<?php echo base_url('/index.php/imagenes/verImagenesViaje').'/'.$idViaje; ?>"> 
                                        <span class="label label-info" id="imgagenesViaje"> Ver imagenes </span> 
                                    </a> 
                                </TD>
                        </tr>
                </table>
        </div>	
    </div><!--/span-->
    <?php if ($permisos['detalleReparto']) 
    {        
    ?>
    <div class="box-header">
                <h2><i class="halflings-icon plus"></i><span class="break"></span>Detalle</h2>
                <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                </div>
        </div>
        <div class="box-content">
    <table id="example" class="display responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
        <thead>
                <tr>                                                        
                        <th>Cliente</th>
                        <th>Fecha reparto</th>
                        <th>Producto</th>
                        <th>Fecha precio</th>
                        <th>Cant. bultos</th>
                        <th>Cant. merma</th>                                                        
                        <?php if ($permisos['precio']) 
                        {
                            echo '<th>Precio bulto[$]</th>';
                            echo '<th>Precio total[$]</th>';
                            $permisoPrecio = 1;
                        }
                        ?>
                        
                        
                </tr>
        </thead>
        <tbody>

             <?php 
                if (!empty($lineasReparto[0]['razon_social']))
                {
                    foreach( $lineasReparto as $lineas ) : 
                        $cantBultosAPagar = ($lineas['cantidad_bultos'] - $lineas['cant_bultos_merma']);
                        $totalAPagar = $cantBultosAPagar * $lineas['precio_sugerido_caja'];

                        ?> 

                        <tr>
                            <td><?php echo $lineas['razon_social'] ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_reparto']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_reparto']), 'd/m/Y'); ?></td>
                            <td><?php echo $lineas['descripcion_producto'] ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'd/m/Y'); ?></td>
                            <td><?php echo $lineas['cantidad_bultos'] ?></td>
                            <td><?php echo $lineas['cant_bultos_merma'] ?></td>
                            
                            <?php if ($permisos['precio']) 
                                {
                                    echo '<td>'. $lineas['precio_sugerido_caja'] .'</td>';
                                    echo '<td>'. $totalAPagar .'</td>';
                                }
                            ?>

                        </tr>

            <?php
                    endforeach; 
                }
            ?>  
        </tbody>
    </table>   
            <
    <input type="hidden" name="permisoPrecio" id="permisoPrecio" value="<?php echo $permisoPrecio ?>">
    </div>
    <?php 
    } ?>

                           
    
<?php 
        $this->load->view('footerProveedor');
?>    
    
    
<script type="text/javascript">
        
$(document).ready(function() {
    var table = $('#example').DataTable({			
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "pagingType": "full_numbers",
        "order": [[ 2, 'asc' ], [1,'asc']],   
        "language": {
                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                    },
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            
            var last = null;
                var subTotal = new Array();
                var grandTotal = new Array();
                var groupID = -1;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    groupID++;
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color: #3A3A3A; font-weight: 600; color: white;" ><td colspan="3" class="groupTitle">'+group+' </td></tr>'
                    );
 
                    last = group;
                }
                
                
                //Sub-total of each column within the same grouping
               var val = api.row(api.row($(rows).eq(i)).index()).data(); //Current order index
                $.each(val, function (colIndex, colValue) {
                    if (typeof subTotal[groupID] == 'undefined') {
                        subTotal[groupID] = new Array();
                    }
                    if (typeof subTotal[groupID][colIndex] == 'undefined') {
                        subTotal[groupID][colIndex] = 0;
                    }
                    if (typeof grandTotal[colIndex] == 'undefined') {
                        grandTotal[colIndex] = 0;
                    }

                    value = colValue ? parseFloat(colValue) : 0;
                    subTotal[groupID][colIndex] += value;
                    grandTotal[colIndex] += value;
                });
                
               
                
            } );
            
            var cotaInferior = 4;
            var cotaSuperior = 7;
            
            permisoPrecio =  $("#permisoPrecio").val(); 
            
            if (permisoPrecio == 0)
            {
                cotaInferior = 4;
                cotaSuperior = 5;
            }
            
            /*Recorro las filas buscando los agrupamientos por PLU*/ 
            $('tbody').find('.group').each(function (i, v) {
                var rowCount = $(this).nextUntil('.group').length;
                var subTotalInfo = "";
                
                
                for (var a = cotaInferior; a <= cotaSuperior; a++) {
                    
                    if (a == 4 || a == 5) /*Cantidad de bultos y cantidad con merma NO son decimales*/
                        subTotalInfo += "<td class='groupTD'>" + subTotal[i][a] + " / " + grandTotal[a] + "</td>";
                    if (a == 6 || a == 7) 
                        subTotalInfo += "<td class='groupTD'>" + subTotal[i][a].toFixed(2) + " / " + grandTotal[a].toFixed(2) + "</td>";
                }
                $(this).append(subTotalInfo);
            });
            
                
            
                
        }
    } );
 
    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );        

</script>      


</body>
</html>