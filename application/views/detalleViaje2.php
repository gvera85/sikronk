<html lang="es">
<?php 
        $this->load->view('headerProveedor');
?>


    <table id="example" class="table table-bordered table-responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
        <thead>
                <tr>                                                        
                        <th>Cliente</th>
                        <th>Fecha de reparto</th>
                        <th>Producto</th>
                        <th>Fecha de valorizacion</th>
                        <th>Precio por bulto[$]</th>
                        <th>Cant. de bultos</th>
                        <th>Cant. merma</th>                                                        
                        <th>Precio total[$]</th>
                </tr>
        </thead>
        <tbody>

             <?php 
                if (!empty($lineasReparto[0]['razon_social']))
                {
                    foreach( $lineasReparto as $lineas ) : 
                        $cantBultosAPagar = ($lineas['cantidad_bultos'] - $lineas['cant_bultos_merma']);
                        $totalAPagar = $cantBultosAPagar * $lineas['precio_caja'];

                        ?> 

                        <tr>
                            <td><?php echo $lineas['razon_social'] ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_reparto']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_reparto']), 'd/m/Y'); ?></td>
                            <td><?php echo $lineas['descripcion_producto'] ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'd/m/Y'); ?></td>
                            <td><?php echo $lineas['precio_caja'] ?></td>
                            <td><?php echo $lineas['cantidad_bultos'] ?></td>
                            <td><?php echo $lineas['cant_bultos_merma'] ?></td>
                            <td><?php echo $totalAPagar ?></td>

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
                        '<tr class="active" ><td colspan="3" class="groupTitle">'+group+' </td></tr>'
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
            
            /*Recorro las filas buscando los agrupamientos por PLU*/ 
            $('tbody').find('.active').each(function (i, v) {
                var rowCount = $(this).nextUntil('.active').length;
                var subTotalInfo = "";
                for (var a = 4; a <= 7; a++) {
                    
                    if (a == 5 || a == 6) /*Cantidad de bultos y cantidad con merma NO son decimales*/
                        subTotalInfo += "<td class='groupTD'>" + subTotal[i][a] + " / " + grandTotal[a] + "</td>";
                    else
                        subTotalInfo += "<td class='groupTD'>" + subTotal[i][a].toFixed(2) + " / " + grandTotal[a].toFixed(2) + "</td>";
                }
                $(this).append(subTotalInfo);
            });
            
                
            
                
        }
    } );
 
    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.active', function () {
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