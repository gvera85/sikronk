<html lang="es">
    <?php 
        $this->load->view('header');
    ?>
<head>
    <title>sikronk - Marcar cheque como cubierto por efectivo en el banco</title>
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
                                                    title: 'Cheques ',
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'excel',
                                                    title: 'Cheques ' ,
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                    extend: 'copy',
                                                    title: 'Cheques ',
                                                    exportOptions: {
                                                        columns: ':visible'
                                                    }
                                             },
                                             {
                                                extend: 'pdfHtml5',
                                                title: 'Cheques ',
                                                orientation: 'landscape',
                                                pageSize: 'A4',                                                
                                                exportOptions: {
                                                        columns: ':visible'
                                                    }
                                            }
                                             
                                        ],
                                        "order": [[1,"desc"], [1,"desc"]],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }
                                        

                                    } );
                
                    
                    $('[data-toggle="popover"]').popover(); 
                    $('[data-toggle="tooltip"]').tooltip();  
                    
                    $(document).on("click","#btnDepositar",function( event ) { 
                    
                        var answer = confirm("¿Está seguro?. Esta acción hará que se debite de su efectivo el TOTAL del importe del cheque")
                        if (answer)
                        {
                            var idCheque = $(this).attr('value');     
        
                            $.ajax({                        
                                   url:"<?php echo base_url() ?>index.php/depositarEfectivoParaCheque/generarDepositoEfectivo/"+idCheque
                             })
                           .done(function(data) {
                               console.log( "Error:", data.slice( 0, 1000 ) );
                               /*location.reload();
                               swal("Operación exitosa!", data, "success");*/
                           })
                           .fail(function(data) {
                             alert( "error" );
                             console.log( "Error:", data.slice( 0, 100 ) );
                           });
                        }
                        else
                        {
                            return false;
                        }
                    
                        

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
            
          if (empty($cheques[0]['id']))
          {
              $sinProductos = 0;
          }
          else
          {
              $sinProductos = 1;
          }
    ?>    
   
    <div class="container" style="padding: 15px;">
        
        <div class="panel panel-primary">
        
        <div class="panel-heading" id="cabeceraPanel"> Cheques sin marcar. <?php echo $nombreDistribuidor ?>
       
        
        </div>
        <div class="panel-body">
            
        <table id="example" class="display compact responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">            
                <thead>
                <TR>
                    <th><b>Nro. cheque</b></th>
                    <th><b>Fecha de acreditación</b></th>
                    <th><b>Importe</b></th>
                    <th><b>Banco</b></th>                           
                    <th><b>Nro. sucursal</b></th>                           
                    <th><b>Dirección</b></th>                           
                    <th><b>Acción</b></th>                           
                </TR>
                </thead>
                
                <tbody>
                <?php 
                    if ($sinProductos == 1)
                    {

                        foreach( $cheques as $lineas ) :                                
                       
                    ?>
                    <TR>
                        <TD> <?php echo $lineas['numero_de_cheque'] ?></TD>    
                        <td> <?php echo date_format(date_create($lineas['fecha_de_acreditacion']), 'd/m/Y'); ?></td>
                        <TD> <?php echo $lineas['importe'] ?></TD>                           
                        <TD> <?php echo $lineas['razon_social'] ?></TD>  
                        <TD> <?php echo $lineas['numero_sucursal'] ?></TD>  
                        <TD> <?php echo $lineas['direccion'] ?></TD>  
                        <TD> <button type="button" id="btnDepositar" value="<?php echo $lineas['id'] ?>" class="btn btn-primary">Depositar efectivo</button></TD>  
                        
                        
                        
                            
                <?php           
                    endforeach; 
                }
                ?>
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