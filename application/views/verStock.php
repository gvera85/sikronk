<html lang="es">
    <?php 
        $this->load->view('header');
        ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
    ?>
<head>
    <title>sikronk - Cuenta corriente del cliente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.js"></script> 
    
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/dataTables.buttons.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/buttons.flash.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/jszip.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/pdfmake.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/vfs_fonts.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/buttons.html5.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/buttons.print.min.js"></script>  
    
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/moment.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/datetime-moment.js"></script>  
    
    <!-- start: CSS -->
    <link id="bootstrap-style" href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url() ?>assets/plugins/metro/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url() ?>assets/plugins/metro/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">

    <!--<link href="<?php echo base_url() ?>/assets/grocery_crud/themes/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/buttons.dataTables.min.css">
    
    <script type="text/javascript" charset="utf-8">
    
            $(document).ready(function() {
                
                    $.fn.dataTable.moment( 'DD/MM/YYYY' );
                     
                
                    var t = $('#example').DataTable( {   
                                        dom: 'Bfrtip',
                                        lengthMenu: [
                                            [ 10, 25, 50, -1 ],
                                            [ '10 filas', '25 filas', '50 filas', 'Mostrar todas' ]
                                        ],
                                        "displayLength": 10,
                                        buttons: [
                                            'pageLength',
                                             {
                                                    extend: 'print',
                                                    title: 'Stock del distribuidor',
                                                    message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'excel',
                                                    title: 'Stock del distribuidor',
                                                    message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'copy',
                                                    title: 'Stock del distribuidor',                                                    
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                extend: 'pdfHtml5',
                                                title: 'Stock del distribuidor',
                                                message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val(),
                                                orientation: 'landscape',
                                                pageSize: 'A4',                                                
                                                exportOptions: {
                                                        columns: ':visible'
                                                    }
                                            }
                                             
                                        ],
                                        "order": [[1,"desc"], [2,"desc"]],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }
                                        

                                    } );
                    
            } );
            
            
            
            
            $.fn.dataTable.moment = function ( format, locale ) {
                    var types = $.fn.dataTable.ext.type;

                    // Add type detection
                    types.detect.unshift( function ( d ) {
                        return moment( d, format, locale, true ).isValid() ?
                            'moment-'+format :
                            null;
                    } );

                    // Add sorting method - use an integer for the sorting
                    types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
                        return moment( d, format, locale, true ).unix();
                    };
                };
                    
            
           
                    
    </script>
    
</head>
<body>        
    
    <div class="container" style="padding: 15px;">
        
        <?php
            ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
            $fechaEjecucion = date("Y-m-d H:i:s"); //Por default la fecha ejecucion es el dia de hoy    
        ?>
        
        
        <div class="panel panel-primary">        
        <div class="panel-heading" id="cabeceraPanel"> Stock del distribuidor</div>
        <div class="panel-body">
            
        <!--<table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">-->
        <table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">            
                <thead>
                <TR>
                    <th><b>Producto</b></th>
                    <th><b>Marca</b></th>
                    <th><b>Calidad</b></th>
                    <th><b>Presentacion</b></th>                    
                    <th><b>Tipo envase</b></th>                    
                    <th><b>Peso x bulto [KG]</b></th>                    
                    <th><b>Stock en bultos</b></th>                    
                    <th><b>Stock en pallets</b></th>   
                  
                </TR>
                </thead>
                
                <tbody>
                <?php 
                
                    if (!empty($lineasStock[0]['id_producto']))
                    {

                        foreach( $lineasStock as $lineas ) :     
                        
                    ?>
                    <TR>
                            <TD> <?php echo $lineas['producto'] ?></TD>
                            <TD> <?php echo $lineas['marca'] ?></TD>
                            <TD> <?php echo $lineas['calidad'] ?></TD>
                            <TD> <?php echo $lineas['presentacion'] ?></TD>
                            <TD> <?php echo $lineas['tipo_envase'] ?></TD>
                            <TD> <?php echo $lineas['peso'] ?></TD>
                            <TD> 
                                <?php 
                                    if ($lineas['stock_en_bultos'] > 0)
                                    { ?>
                                
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/stock/verViajesProducto').'/'.$lineas['id_producto'].'/'.$lineas['id_vl']; ?>')> 
                                        <span class="label label-info" id="nroViaje"> <?php echo $lineas['stock_en_bultos'] ?> </span> 
                                    </a> 
                                <?php
                                    }
                                else
                                    {
                                        echo $lineas['stock_en_bultos'];
                                    }
                                ?>    
                            </TD>
                            <TD> <?php echo $lineas['stock_en_pallets'] ?></TD>  
                    </TR>
                            
                <?php           
                        endforeach; 
                    }
                ?>          
                        
                </tbody>    
            </table>
            <input type="hidden" name="fecha_ejecucion_hidden" id="fecha_ejecucion_hidden" value="<?php echo date_format(date_create($fechaEjecucion), 'd/m/Y H:i:s') ?>">   
                  
             </div>
        </div>     
        
  </div>  
   


</body>

</html>