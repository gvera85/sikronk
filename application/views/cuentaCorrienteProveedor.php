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
                                                    title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'excel',
                                                    title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'copy',
                                                    title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                extend: 'pdfHtml5',
                                                title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val(),
                                                orientation: 'landscape',
                                                pageSize: 'A4',
                                                exportOptions: {
                                                        columns: ':visible'
                                                    }
                                            }
                                             
                                        ],
                                        "order": [[1,"desc"], [2,"desc"]],
                                         "columnDefs": [
                                            {
                                                "targets": [ 0 ],
                                                "visible": true,
                                                "searchable": true
                                            },
                                            {
                                                "targets": [ 2 ],
                                                "visible": false,
                                                "searchable": false
                                            }
                                        ],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }
                                        

                                    } );
                
                    
                                    
                                    
                    saldo = $("#idSaldo").val();
                    
                    if (saldo >= 0)
                        classSaldo = 'label label-success';
                    else
                        classSaldo = 'label label-danger';
                        
                     
                
                    $("#cabeceraPanel").html($("#cabeceraPanel").html()+' - Saldo: <span class="' +classSaldo+ '" style="font-size:15px;" id="tipoMovimiento">$ '+saldo+'</span>' ); 
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
    
     <?php 
          foreach( $proveedor as $i_proveedor ) :
                $nombreProveedor = $i_proveedor['razon_social']; 
               
        endforeach; 
    ?>    
   
    <div class="container">
        
        <?php 
            if (empty($facturasProveedor[0]['tipo']))
            {
                $titulo = "Productos sin valorizar - No hay productos sin valorizar";
                $sinProductos = 0;
            }
            else
            {
                $titulo = "Productos sin valorizar";
                $sinProductos = 1;
            }             
        ?>    
        

        <div class="panel panel-primary">
        
        <div class="panel-heading" id="cabeceraPanel"> Cuenta corriente <?php echo $nombreProveedor ?>
        
        
        </div>
        <div class="panel-body">
            
        <table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
                <thead>
                <TR>
                    <th><b>Tipo</b></th>
                    <th><b>Fecha</b></th>
                    <th><b>Stamp</b></th>
                    <th><b>Nro Viaje</b></th>                    
                    <th><b>Debe</b></th>                    
                    <th><b>Haber</b></th>                    
                    <th><b>Saldo parcial</b></th>   
                  
                </TR>
                </thead>
                
                <tbody>
                <?php 
                
                    $saldo = 0;
                    
                
                    if ($sinProductos == 1)
                    {

                        foreach( $facturasProveedor as $lineas ) :     
                            
                        $debe = $lineas['debe'];
                        $haber = $lineas['haber'];

                        $saldo = $saldo +  $haber - $debe;     
                        
                        if ($lineas['tipo'] == 'Pago') {
                            $classTipo = 'label label-success';
                        } else if ($lineas['tipo'] == 'Deuda'){
                            $classTipo = "label label-danger";
                        } else if ($lineas['tipo'] == 'Gasto'){
                            $classTipo = "label label-default";
                        }
                        
                    ?>
                    <TR>
                            <TD> <span class="<?php echo $classTipo ?>" id="tipoMovimiento"> <?php echo $lineas['tipo'] ?></span></TD>
                            <td><?php echo date_format(date_create($lineas['fecha_estimada_llegada']), 'd/m/Y'); ?></td>
                            <td><?php echo date_format(date_create($lineas['stamp']), 'd/m/Y H:i:s'); ?></td>
                            
                            <?php
                            if ($lineas['numero_de_viaje'])
                            {   
                            ?>
                                <TD> 
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/planificacion/verViaje').'/'.$lineas['id_viaje']; ?>')> 
                                        <span class="label label-info" id="nroViaje"> <?php echo $lineas['numero_de_viaje'] ?> </span> 
                                    </a> 
                                </TD>
                            <?php
                            }
                            else
                            {   
                            ?>
                                <TD> 
                                        <?php echo $lineas['numero_de_viaje'] ?>
                                </TD>    
                            <?php
                            }
                            ?>    
                            <TD style="background-color: #F1ABAB;"> <?php echo $debe ?></TD>
                            <TD style="background-color: #B7E4B7;"> <?php echo $haber ?></TD>
                            <TD> <?php echo $saldo ?></TD>
                            
                <?php           
                    endforeach; 
                }
                ?>
                    
                <input type="hidden" name="idSaldo" id="idSaldo" value=<?php echo $saldo ?>>
                <input type="hidden" name="empresaEvaluada" id="empresaEvaluada" value="<?php echo $nombreProveedor ?>">
                   
                        
                </tbody>    
            </table>
             </div>
        </div>     
        
  </div>  
   


</body>
</html>