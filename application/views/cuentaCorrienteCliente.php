<html lang="es">
    <?php 
        $this->load->view('header');
    ?>
<head>
    <title>Cuenta corriente del cliente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css">

    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/plugins/jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>/assets/bootstrap/js/dataTablesBootstrap.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>  
    
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>  
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>  
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>  
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>  
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>  
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>  
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>  
    
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>  
    <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.10/sorting/datetime-moment.js"></script>  
    
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css">
    







    
    <script type="text/javascript" charset="utf-8">
    
            $(document).ready(function() {
                
                    $.fn.dataTable.moment( 'HH:mm MMM D, YY' );
                    
                
                    var t = $('#example').DataTable( {   
                                        dom: 'Bfrtip',
                                        lengthMenu: [
                                            [ 10, 20, 50, -1 ],
                                            [ '10 filas', '20 filas', '50 filas', 'Show all' ]
                                        ],
                                        buttons: [
                                            'pageLength',
                                             {
                                                    extend: 'print',
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'excel',
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'copy',
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                extend: 'pdfHtml5',
                                                orientation: 'landscape',
                                                pageSize: 'A4',
                                                exportOptions: {
                                                        columns: ':visible'
                                                    }
                                            }
                                             
                                        ],
                                        "order": [[3,"desc"], [0,"desc"]],
                                         "columnDefs": [
                                            {
                                                "targets": [ 0 ],
                                                "visible": false,
                                                "searchable": false
                                            }
                                        ],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }
                                        

                                    } );
                                    
                    var x = $('#example2').DataTable( {   
                                        "order": [[ 0, 'desc' ]],
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
            
            
            
            
            $(document).on("click","#btnAgrupado",function( event ) {  

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo base_url().'index.php/cuentaCorrienteCliente/cargarLineasCC'; ?>",
                    data: "id_publicacion=<?php echo "1"; ?>",
                    success: function(data){
                                                //alert(data.facturasClientes);    
                                                
                                                for(i=0; i < data.length; i++){
                                                    alert(data[i].facturasClientes);
                                                }
                                           }
                });
            });
            
            
            $(document).on("click","#btnLineas",function( event ) {  
                //$('#btnAgrupado').val("botonCierreViaje").css('border','3px solid blue');
                alert ('Este boton mostrará la cuenta corriente sin computar pagos');
            
            });
 
                    
    </script>
    
</head>
<body>        
    
     <?php 
          foreach( $cliente as $i_cliente ) :
                $nombreCliente = $i_cliente['razon_social']; 
               
        endforeach; 
    ?>    
   
    <div class="container">
        
        <?php 
            if (empty($facturasClientes[0]['id_linea']))
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
        
        <div class="panel-heading" id="cabeceraPanel"> Cuenta corriente <?php echo $nombreCliente ?>
        <!--<div class="col-sm-6 col-lg-4">
            <div class="btn-group">
              <button type="button" id="btnAgrupado" class="btn btn-danger btn-xs">Ver pagos asignados</button>
              <button type="button" id="btnLineas" class="btn btn-default btn-xs">Ver en líneas</button>
            </div>
        </div>-->
        
        </div>
        <div class="panel-body">
            
        <table id="example" class="display" cellspacing="0" width="100%" style="font-size:small; ">
                <thead>
                <TR>
                    <th><b>IdLinea</b></th>
                    <th><b>Tipo</b></th>
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
                
                <tbody>
                <?php 
                
                    $saldo = 0;
                
                    if ($sinProductos == 1)
                    {

                        foreach( $facturasClientes as $lineas ) : 
                       
                        $haber =  $lineas['haber'];

                        $cantidad = $lineas['cantidad_bultos'];
                        $cantidadConMerma = $lineas['cant_bultos_merma'];
                        $cantidadAPagar = $cantidad - $cantidadConMerma;

                        $debe =  $cantidadAPagar * $lineas['precio_bulto'];    
                        
                        if ($haber < $debe && $lineas['tipo'] == 'Entrega')
                            $linkPagos = 1;
                        else
                            $linkPagos = 0;

                        $saldo = $saldo + $haber - $debe;     

                        if ($lineas['tipo'] == 'Pago') {
                            $classTipo = 'label label-success';
                        } else{
                            $classTipo = "label label-danger";
                        }
                        
                    
                    
                    ?>
                    <TR>
                            <TD> <?php echo $lineas['id_linea'] ?></TD>
                            <TD> <span class="<?php echo $classTipo ?>" id="tipoMovimiento"> <?php echo $lineas['tipo'] ?></span></TD>
                            <td><?php echo date_format(date_create($lineas['fecha']), 'd/m/Y'); ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_valorizacion']), 'd/m/Y'); ?></td>
                            <TD> <?php echo $lineas['producto'] ?></TD>
                            <TD> <?php echo $lineas['peso'] ?></TD>
                            <!--<TD> <?php //echo $cantidad ?></TD>-->
                            
                            <?php
                            if ($lineas['id_viaje'])
                            {   
                            ?>
                                <TD> 
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/planificacion/verViaje').'/'.$lineas['id_viaje']; ?>')> 
                                        <span class="label label-info" id="nroViaje"> <?php echo $cantidad ?> </span> 
                                    </a> 
                                </TD>
                            <?php
                            }
                            else
                            {   
                            ?>
                                <TD> 
                                        <?php echo $cantidad ?>
                                </TD>    
                            <?php
                            }
                            ?>    
                            
                            <TD> <?php echo $cantidadConMerma ?> </TD>
                            <TD> <?php echo $cantidadAPagar ?></TD>
                            <TD> <?php echo $lineas['precio_bulto'] ?></TD>
                            <TD> <?php echo $debe  ?></TD>
                            <TD> <?php if ($linkPagos ==1) 
                                        { ?> 
                               
                                <span class="label label-danger" id="linkPagos"> <?php echo $haber ?> </span> 
                             
                                <?php   } 
                                        else 
                                        {  
                                            echo $haber;                                         
                                        }?>
                            </TD>
                            <TD> <?php echo $saldo ?> </TD>
                    </TR>               
                    
                <?php           
                    endforeach; 
                }
                ?>
                    
                <input type="hidden" name="idSaldo" id="idSaldo" value=<?php echo $saldo ?>>
                   
                        
                </tbody>    
            </table>
             </div>
        </div>     
        
            <?php 
            if (empty($lineasSinValorizar[0]['id_linea']))
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
          
  
            
            <div class="panel panel-info">
            <div class="panel-heading" id="cabeceraPanel"><?php echo $titulo ?> </div>
            <div class="panel-body">
            <table id="example2" class="display" cellspacing="0" width="100%">
                <thead>
                <TR>
                  
                    <th><b>Fecha entrega</b></th>
                  
                    <th><b>Producto</b></th>
                    <th><b>Peso</b></th>
                    <th><b>Cantidad</b></th>
                    <th><b>Cant. con merma</b></th>
                    <th><b>Cant. a pagar</b></th>
                    <th><b>Precio</b></th>
                   
                  
                </TR>
                </thead>
                
                <?php 
                
                    if ($sinProductos == 1)
                    {
                
                        foreach( $lineasSinValorizar as $lineas ) :                     


                        $cantidad = $lineas['cantidad_bultos'];
                        $cantidadConMerma = 0;
                        $cantidadAPagar = $cantidad - $cantidadConMerma;    


                ?>
                
                <tbody>
                
                    <TR>
                            
                            <td>
                                <?php 
                                                
                                                $f_reparto  = empty($lineas['fecha']) ? NULL : $lineas['fecha'];
                                                
                                                if (! is_null($f_reparto))
                                                {
                                                    $f_reparto = date_format(date_create($f_reparto), 'd/m/Y');
                                                }
                                                else
                                                {
                                                    $f_reparto = "Sin fecha";
                                                }
                                                
                                ?>
                                <span style='display: none;'><?php echo date_format(date_create($lineas['fecha']), 'Ymd'); ?></span>
                                <?php echo $f_reparto; ?>
                            </td>
                           
                            <TD> <?php echo $lineas['producto'] ?></TD>
                            <TD> <?php echo $lineas['peso'] ?></TD>
                            <TD> <?php echo $cantidad ?></TD>
                            <TD> <?php echo $cantidadConMerma ?> </TD>
                            <TD> <?php echo $cantidadAPagar ?></TD>                         
                            
                            <TD> <a href=javascript:window.open('<?php echo base_url('/index.php/planificacion/valorizarViajeCliente').'/'.$lineas['id_viaje'].'/'.$lineas['id_cliente']; ?>')> <span class="label label-danger" id="tipoMovimiento"> ? </span> </a> </TD>
                            
                            
                                  
                    </TR>               
                    
                                  
                        
                </tbody>  
                
                <?php 
                
                    endforeach; 
                    }
                ?>
                
            </table>
            
         </div>
        </div>     
          
        
  </div>  
   
    
  <script type="text/javascript">
      
     
      
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-hover table-bordered table-compact');
        
        // For demo to fit into DataTables site builder...
	$('#example2')
		.removeClass( 'display' )
		.addClass('table table-hover table-bordered table-compact');
  </script>  

</body>
</html>