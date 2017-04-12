<html lang="es">
    <?php 
        $this->load->view('header');
    ?>
<head>
    <title>sikronk - Cuenta corriente del distribuidor</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.js"></script> 
    <script src="<?php echo base_url() ?>/assets/bootstrap/js/bootstrap.js"></script>
    
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
    <!--<link id="bootstrap-style" href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <!--<link href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">-->
    <!--<link id="base-style" href="<?php echo base_url() ?>assets/plugins/metro/css/style.css" rel="stylesheet">-->
    <!--<link id="base-style-responsive" href="<?php echo base_url() ?>assets/plugins/metro/css/style-responsive.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">
    <link href="../../assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>

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
                                                    title: 'Cuenta corriente del distribuidor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                    message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val() +' - Fecha filtrada: Desde '+$("#fecha_desde_hidden").val()+ ' hasta '+ $("#fecha_hasta_hidden").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'excel',
                                                    title: 'Cuenta corriente del distribuidor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                    message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val() +' - Fecha filtrada: Desde '+$("#fecha_desde_hidden").val()+ ' hasta '+ $("#fecha_hasta_hidden").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'copy',
                                                    title: 'Cuenta corriente del distribuidor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                extend: 'pdfHtml5',
                                                title: 'Cuenta corriente del distribuidor ' + $("#empresaEvaluada").val() + ' - Saldo actual: $'+ $("#idSaldo").val(),
                                                orientation: 'landscape',
                                                pageSize: 'A4',
                                                message: 'Fecha de ejecución: '+ $("#fecha_ejecucion_hidden").val() +' - Fecha filtrada: Desde '+$("#fecha_desde_hidden").val()+ ' hasta '+ $("#fecha_hasta_hidden").val(),
                                                exportOptions: {
                                                        columns: ':visible'
                                                    }
                                            }
                                             
                                        ],
                                        "order": [[1,"desc"], [0,"asc"]],
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
                        classSaldo = 'btn btn-xs btn-success';
                    else
                        classSaldo = 'btn btn-xs btn-danger';
                    
                    $("#cabeceraPanel").html($("#cabeceraPanel").html()+' - Saldo actual: <button type="button" class="' +classSaldo+ '" style="font-size:15px;" id="btnInfoSaldo" data-toggle="modal" data-target="#myModal">$ '+saldo+'</button>' ); 
                    
                    
                    $(document).on("click","#btnInfoSaldo",function( event ) {  

                        $.ajax({                        
                                    url:"<?php echo base_url() ?>index.php/detallesEntidades/verDetalleSaldoCaja"
                              })
                                  .done(function(data) {
                                    $("#contenidoModal").html(data);
                                    //console.log( "Sample of data:", data.slice( 0, 9999 ) );
                                  })
                                  .fail(function(data) {
                                    alert( "error" );
                                    //console.log( "Sample of data:", data.slice( 0, 100 ) );
                                  });

                   });
                    
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
          foreach( $distribuidor as $i_distribuidor ) :
                $nombreDistribuidor = $i_distribuidor['razon_social']; 
               
        endforeach; 
    ?>    
   
    <div class="container" style="padding: 15px;">
        
        <?php 
        
            /*El controlador me envia los datos filtrados en estos vectores*/
            $fechaFiltroDesde = $filtros['fecha_desde'];
            $fechaFiltroHasta = $filtros['fecha_hasta'];
            $idDistribuidorFiltro = $filtros['id_distribuidor'];
            $saldoTotal = $saldo['saldo_total'];
            $fechaEjecucion = $filtros['fecha_ejecucion'];
                    
            if (empty($pagos[0]['tipo']))
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
        
        <form id="formFiltros" method="post" action="<?php echo base_url() ?>index.php/cajaDistribuidor/getCCDistribuidorPorFiltro/<?php echo $idDistribuidorFiltro ?>/cajaDistribuidor" name="formFiltros">

                <table class="table compact" cellspacing="0" width="100%" style="font-size:small; text-align: left; ">
                    <tr>
                            <td>Fecha desde</td>
                            <td>    
                                <input style="height:25px; width: 150px;" required type="date" name="fecha_desde" id="fecha_desde" value="<?php echo $fechaFiltroDesde ?>">
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
        
        <div class="panel-heading" id="cabeceraPanel"> Cuenta corriente <?php echo $nombreDistribuidor ?>
       
        
        </div>
        <div class="panel-body">
            
        <table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">            
                <thead>
                <TR>
                    <th><b>Tipo</b></th>
                    <th><b>Fecha</b></th>
                    <th><b>Stamp</b></th>
                    <th><b>Empresa</b></th>       
                    <th><b>Debe</b></th>                    
                    <th><b>Haber</b></th>                    
                    <th><b>Saldo parcial</b></th>   
                  
                </TR>
                </thead>
                
                <tbody>
                <?php 
                    if ($sinProductos == 1)
                    {

                        foreach( $pagos as $lineas ) :     
                            
                        $debe = $lineas['debe'];
                        $haber = $lineas['haber'];
                        $saldoParcial = $lineas['saldo_parcial'];

                        $linkHaciaDetalles = "#";    
                        
                        if ($lineas['tipo'] == 'Ingreso de cliente') {
                            $classTipo = 'label label-success';
                            $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verPagoCliente').'/'.$lineas['id']."'". ')';
                        } else if ($lineas['tipo'] == 'Pago a proveedor'){
                            $classTipo = "label label-warning";
                            $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verPagoProveedor').'/'.$lineas['id']."'". ')';
                        } else if ($lineas['tipo'] == 'Gasto'){
                            $classTipo = "label label-warning";                            
                        } else if ($lineas['tipo'] == 'Ganancia'){
                            $classTipo = "label label-success";
                        } else if ($lineas['tipo'] == 'Ajuste'){
                            $classTipo = "label label-info";    
                            $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verNotaCreditoDebito').'/'.$lineas['id']."'". ')';
                        } else if ($lineas['tipo'] == 'Crédito'){
                            $classTipo = "label label-success";    
                            $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verNotaCredito').'/'.$lineas['id']."'". ')';
                        } else if ($lineas['tipo'] == 'Emisión cheque'){
                            $classTipo = "label label-success";    
                            $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verChequeDistribuidor').'/'.$lineas['id']."'". ')';
                        } else if ($lineas['tipo'] == 'Deposito para cheque'){
                            $classTipo = "label label-warning";    
                            $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verChequeDistribuidor').'/'.$lineas['id']."'". ')';
                        }
                        else if ($lineas['tipo'] == 'Débito'){
                            $classTipo = "label label-warning";    
                            $linkHaciaDetalles = 'javascript:window.open('."'".base_url('/index.php/detallesEntidades/verNotaDebito').'/'.$lineas['id']."'". ')';
                        }
                        else if ($lineas['tipo'] == 'Débito banco'){
                            $classTipo = "label label-warning";    
                            $linkHaciaDetalles = '';
                        }
                        else if ($lineas['tipo'] == 'Crédito banco'){
                            $classTipo = "label label-success";    
                            $linkHaciaDetalles = '';
                        }
                        else{
                            $classTipo = "label label-warning";    
                            $linkHaciaDetalles = '';                            
                        }
                    ?>
                    <TR>
                            <TD> 
                                <a href=<?php echo $linkHaciaDetalles;?> >
                                <span class="<?php echo $classTipo ?>" id="tipoMovimiento"> <?php echo $lineas['tipo'] ?></span>
                                </a>
                            </TD>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_pago']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_pago']), 'd/m/Y'); ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['stamp']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['stamp']), 'd/m/Y'); ?></td>
                            <TD> <?php echo $lineas['razon_social'] ?></TD>
                            <TD> <?php echo $lineas['debe'] ?></TD>
                            <TD> <?php echo $lineas['haber'] ?></TD>
                            <TD> <?php echo $lineas['saldo_parcial'] ?></TD>
                            
                <?php           
                    endforeach; 
                }
                ?>
                    
                <input type="hidden" name="idSaldo" id="idSaldo" value=<?php echo $saldoTotal ?>>
                <input type="hidden" name="empresaEvaluada" id="empresaEvaluada" value="<?php echo $nombreDistribuidor ?>">
                <input type="hidden" name="fecha_ejecucion_hidden" id="fecha_ejecucion_hidden" value="<?php echo date_format(date_create($fechaEjecucion), 'd/m/Y H:i:s') ?>">   
                <input type="hidden" name="fecha_desde_hidden" id="fecha_desde_hidden" value="<?php echo date_format(date_create($fechaFiltroDesde), 'd/m/Y') ?>">
                <input type="hidden" name="fecha_hasta_hidden" id="fecha_hasta_hidden" value="<?php echo date_format(date_create($fechaFiltroHasta), 'd/m/Y') ?>">
                   
                        
                </tbody>    
            </table>
             </div>
        </div>     
    </div>
    
    <!-- Modal (solo visible al hacer clic en el modo de pago en cheques -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Saldo agrupado por tipos de pago</h4>
          </div>
          <div class="modal-body">
              <div id="contenidoModal">
                  
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>

      </div>
    </div>  
      
  
</body>

    
      
</html>