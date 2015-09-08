<html lang="es">
    <?php 
        $this->load->view('header');
    ?>
<head>
    <title>sikronk - Cuenta corriente del cliente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">

    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/plugins/jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>/assets/bootstrap/js/dataTablesBootstrap.js"></script>
    <script type="text/javascript" charset="utf-8">
        
   
        
            const COLUMNA_VALOR_TOTAL_LINEA = 7;
            const COLUMNA_MONTO_PAGADO = 8;
            const COLUMNA_SALDO = 9;
            const COLUMNA_ID_REPARTO = 10;
            const COLUMNA_MONTO_PAGADO_ESTA_FACTURA = 11;
            const COLUMNA_ID_PRODUCTO = 12;
            const COLUMNA_ID_VL = 13;
        
            $(document).ready(function() {
                    
                    
                
                    var t = $('#example').DataTable( {
                        
                                        "footerCallback": function ( row, data, start, end, display ) {
                                            var api = this.api(), data;

                                            // Remove the formatting to get integer data for summation
                                            var intVal = function ( i ) {
                                                return typeof i === 'string' ?
                                                    i.replace(/[\$,]/g, '')*1 :
                                                    typeof i === 'number' ?
                                                        i : 0;
                                            };

                                            // Total over all pages
                                            total = api
                                                .column( 11 )
                                                .data()
                                                .reduce( function (a, b) {
                                                    return intVal(a) + intVal(b);
                                                } );

                                            // Total over this page
                                            pageTotal = api
                                                .column( 11, { page: 'current'} )
                                                .data()
                                                .reduce( function (a, b) {
                                                    return intVal(a) + intVal(b);
                                                }, 0 );

                                            // Update footer
                                            $( api.column( 11 ).footer() ).html(
                                                '$'+pageTotal +' ( $'+ total +' total)'
                                            );    
                                        },
                                        "columnDefs": [ {
                                            "searchable": false,
                                            "orderable": false,
                                            "targets": 0
                                        }
                                        ]
                                        ,
                                        "order": [[ 2, 'desc' ]],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }
                                        

                                    } );
            } );
            
 
                    
    </script>
    
</head>
<body>        
   
    <div class="container">
        

        <div class="panel panel-primary">
        <div class="panel-heading">Cuenta corriente AKON - 05/08/2015 AL 05/09/2015</div>
        <div class="panel-body">
            
        <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <TR>
                    <th>#</th>
                    <th><b>Fecha entrega</b></th>
                    <th><b>Fecha valorizacion</b></th>                    
                    <th><b>Producto</b></th>
                    <th><b>Peso</b></th>
                    <th><b>Cantidad</b></th>
                    <th><b>Cant. con merma</b></th>
                    <th><b>Cant. a pagar</b></th>
                    <th><b>Precio</b></th>
                    <th><b>Debe</b></th>
                    <th><b>Haber</b></th>
                    <th><b>Saldo parcial</b></th>   
                  
                </TR>
                </thead>
                
                <tfoot>
                    <tr>
                        <th colspan="6" style="text-align:right">Saldo al 05/08/2015: 10000</th>
                        <th colspan="5" style="text-align:right">Total:</th>
                        <th></th>
                    </tr>
                </tfoot>
                
                 <tbody>
                <?php 
                    $saldo = 0;
                    $saldoInicial = 0;
                    
                    foreach( $facturasClientes as $lineas ) : 
                    
                    //$saldo = $saldoInicial;
                        
                    $haber =  $lineas['haber'];
                    
                    $cantidad = $lineas['cantidad_bultos'];
                    $cantidadConMerma = 0;
                    $cantidadAPagar = $cantidad - $cantidadConMerma;
                    
                    $debe =  $cantidadAPagar * $lineas['precio_bulto'];                    

                    $saldo = $saldo + $debe - $haber;                    
                    
                    
                    ?>
                    <TR>
                            <TD></TD>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha']), 'Ymd'); ?></span><?php echo date_format(date_create($lineas['fecha']), 'd/m/Y'); ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'Ymd'); ?></span><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'd/m/Y'); ?></td>
                            <TD> <?php echo $lineas['producto'] ?></TD>
                            <TD> <?php echo $lineas['peso'] ?></TD>
                            <TD> <?php echo $cantidad ?></TD>
                            <TD> <?php echo $cantidadConMerma ?> </TD>
                            <TD> <?php echo $cantidadAPagar ?></TD>
                            <TD> <?php echo $lineas['precio_bulto'] ?></TD>
                            <TD> <?php echo $debe  ?></TD>
                            <TD> <?php echo $haber ?></TD>
                            <TD> <?php echo $saldo ?> </TD>
                    </TR>               
                    
                <?php           
                    endforeach; 
                ?>
                   
                        
                </tbody>    
            </table>
         </div>
        </div>     
          
  </div>
    
   
    
  <script type="text/javascript">
      
     
      
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
  </script>  

</body>
</html>