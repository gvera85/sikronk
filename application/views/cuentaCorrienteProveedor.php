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
        
        function convertDate(inputFormat) {
            function pad(s) { return (s < 10) ? '0' + s : s; }
            var d = new Date(inputFormat);
            return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
          }
    
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
                                                    title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                    message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val() +' - Fecha filtrada: Desde '+$("#fecha_desde_hidden").val()+ ' hasta '+ $("#fecha_hasta_hidden").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'excel',
                                                    title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                    message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val() +' - Fecha filtrada: Desde '+$("#fecha_desde_hidden").val()+ ' hasta '+ $("#fecha_hasta_hidden").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'copy',
                                                    title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                extend: 'pdfHtml5',
                                                title: 'Cuenta corriente del proveedor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                orientation: 'landscape',
                                                pageSize: 'A4',
                                                message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val() +' - Fecha filtrada: Desde '+$("#fecha_desde_hidden").val()+ ' hasta '+ $("#fecha_hasta_hidden").val(),
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
                        
                     
                
                    $("#cabeceraPanel").html($("#cabeceraPanel").html()+' - Saldo actual: <span class="' +classSaldo+ '" style="font-size:15px;" id="tipoMovimiento">$ '+saldo+'</span>' ); 
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
  
    
    <div class="container" style="padding: 15px;">
        
        <?php 
        
            /*El controlador me envia los datos filtrados en estos vectores*/
            $fechaFiltroDesde = $filtros['fecha_desde'];
            $fechaFiltroHasta = $filtros['fecha_hasta'];
            $idProveedorFiltro = $filtros['id_proveedor'];
            $saldoTotal = $saldo['saldo_total'];
            $fechaEjecucion = $filtros['fecha_ejecucion'];
                    
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
        
        <form id="formFiltros" method="post" action="<?php echo base_url() ?>index.php/cuentaCorrienteProveedor/getCCProveedorPorFiltro/<?php echo $idProveedorFiltro ?>/cuentaCorrienteProveedor" name="formFiltros">

                <table class="table compact" cellspacing="0" width="100%" style="font-size:small; text-align: left; ">
                    <tr>
                            <td>Fecha desde</td>
                            <td>    
                                <input style="height:25px; width: 150px; border-color: red;" required type="date" name="fecha_desde" id="fecha_desde" value="<?php echo $fechaFiltroDesde ?>">
                            </td>
                                <td>Fecha hasta</td>
                            <td>
                                <input style="height:25px; width: 150px;" required type="date" name="fecha_hasta"  id="fecha_hasta" value="<?php echo $fechaFiltroHasta ?>">
                            </td>
                    </tr>
                     <tr>
                         <td colspan="4" style="text-align: center; ">    

                                    <input type="submit" class="btn btn-success" value="Filtrar">
                         </td>
                    </tr>
                </table>
        
        </form>
        <div class="panel panel-primary">
        
        <div class="panel-heading" id="cabeceraPanel">Cuenta corriente <?php echo $nombreProveedor ?>
        
        
        </div>
        <div class="panel-body">
            
        <!--<table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">-->
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
                    if ($sinProductos == 1)
                    {

                        foreach( $facturasProveedor as $lineas ) :     
                            
                            $debe = $lineas['debe'];
                            $haber = $lineas['haber'];

                            $linkHaciaDetalles = "#";    

                            if ($lineas['tipo'] == 'Pago') {
                                $classTipo = 'label label-success';
                                $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verPagoProveedor').'/'.$lineas['id_linea']."'". ')';
                            } else if ($lineas['tipo'] == 'Deuda'){
                                $classTipo = "label label-danger";
                            } else if ($lineas['tipo'] == 'Gasto'){
                                $classTipo = "label label-default";
                            }
                            else {
                                $classTipo = "label label-danger";
                                $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verGastos').'/'.$lineas['id_viaje']."'". ')';
                            }
                        
                    ?>
                    <TR>
                            <TD> 
                                <a href=<?php echo $linkHaciaDetalles;?> >
                                <span class="<?php echo $classTipo ?>" id="tipoMovimiento"> <?php echo $lineas['tipo'] ?></span>
                                </a>
                            </TD>
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
                            <TD> <?php echo $lineas['saldo_parcial'] ?></TD>
                            
                <?php           
                    endforeach; 
                }
                ?>
                    
                <input type="hidden" name="idSaldo" id="idSaldo" value=<?php echo $saldoTotal ?>>
                <input type="hidden" name="empresaEvaluada" id="empresaEvaluada" value="<?php echo $nombreProveedor ?>">
                <input type="hidden" name="fecha_desde_hidden" id="fecha_desde_hidden" value="<?php echo date_format(date_create($fechaFiltroDesde), 'd/m/Y') ?>">
                <input type="hidden" name="fecha_hasta_hidden" id="fecha_hasta_hidden" value="<?php echo date_format(date_create($fechaFiltroHasta), 'd/m/Y') ?>">
                <input type="hidden" name="fecha_ejecucion_hidden" id="fecha_ejecucion_hidden" value="<?php echo date_format(date_create($fechaEjecucion), 'd/m/Y H:i:s') ?>">   
                        
                </tbody>    
            </table>
             </div>
        </div>     
        
  </div>  
   


</body>

</html>