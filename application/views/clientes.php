<html lang="es">
    <?php 
        $this->load->view('header');
      
      
   
    ?>
<head>
    <title>sikronk - Lista de clientes</title>
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
                    
                    
                
                    var t = $('#example').DataTable( {                                                                              ,
                                        "order": [[ 1, 'asc' ]],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }

                                    } );



                                    t.on( 'order.dt search.dt', function () {
                                        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                                            cell.innerHTML = i+1;
                                        } );
                                    } ).draw();

                                     
            } );
                    
    </script>
    
</head>
<body>        
   
    
    <div class="container">
        
        <div class="panel panel-primary">
        <div class="panel-heading">Lista de clientes</div>
        <div class="panel-body">
        
      
            
        <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <TR>
                    <th>#</th>
                    
                    <th><b>Proveedor</b></th>                    
                    
                  
                </TR>
                </thead>
                 <tbody>
                <?php 
                    foreach( $clientes as $lineas ) : ?>
                    <TR>
                      
                        <TD> <?php echo $lineas['id'] ?></TD>
                        <TD> <?php echo $lineas['razon_social'] ?></TD>                       
                       
                     
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