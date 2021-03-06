<html lang="es">
    <?php 
        $this->load->view('header');
      
      
   
    ?>
<head>
    <title>sikronk - Facturas pendientes del cliente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.js"></script> 
    
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/moment.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/datetime-moment.js"></script>  
    
    <!-- start: CSS -->
    <link id="bootstrap-style" href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url() ?>assets/plugins/metro/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url() ?>assets/plugins/metro/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/buttons.dataTables.min.css"> 
    
    <script type="text/javascript" charset="utf-8">
            const COLUMNA_VALOR_TOTAL_LINEA = 8;
            const COLUMNA_MONTO_PAGADO = 9;
            const COLUMNA_SALDO = 10;
            const COLUMNA_ID_REPARTO = 11;
            const COLUMNA_MONTO_PAGADO_ESTA_FACTURA = 12;
            const COLUMNA_ID_PRODUCTO = 13;
            const COLUMNA_ID_VL = 14;
        
            $(document).ready(function() {
                    
                    $.fn.dataTable.moment( 'DD/MM/YYYY' );
                
                    var t = $('#example').DataTable( {                                        
                                        "columnDefs": [ 
                                            {
                                                "targets": [ 11 ],
                                                "visible": false
                                            }
                                         ,
                                            {
                                                "targets": [ 12 ],
                                                "visible": false
                                            }
                                         ,
                                            {
                                                "targets": [ 13 ],
                                                "visible": false
                                            }
                                         ,
                                            {
                                                "targets": [ 14 ],
                                                "visible": false
                                            }   
                                        ]
                                        ,
                                        "order": [[ 1, 'asc' ]],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }

                                    } );
                                    
                                    $('button').prop('disabled', true);

                                     $('#example tbody').on( 'click', 'tr', function () {
                                        
                                            valorTotalLinea = Number($(this).find("td").eq(COLUMNA_VALOR_TOTAL_LINEA).html());                                                
                                            montoPagado = Number($(this).find("td").eq(COLUMNA_MONTO_PAGADO).html());                                                
                                            saldo = Number($(this).find("td").eq(COLUMNA_SALDO).html());                                                
                                            montoPagadoConEstaFactura = Number($(this).find("td").eq(COLUMNA_MONTO_PAGADO).html());
                                            
                                            montoRestante = Number($("#montoRestante").html());    
                                            
                                        
                                            if ($(this).hasClass('active'))
                                            {                                                
                                                $("#montoRestante").html( Math.round((montoPagadoConEstaFactura + montoRestante) * 100) / 100 );
                                                
                                                $(this).find("td").eq(COLUMNA_MONTO_PAGADO).html( Math.round(( montoPagado-montoPagadoConEstaFactura) * 100) / 100); // Actualizo el valor pagado
                                                
                                                $(this).find("td").eq(COLUMNA_SALDO).html(Math.round(( saldo+montoPagadoConEstaFactura) * 100) / 100); // Actualizo el saldo
                                                
                                                $(this).find("td").eq(COLUMNA_MONTO_PAGADO_ESTA_FACTURA).html(0); // Actualizo el monto pagado con esta factura
                                                
                                                //desactivar el resaltado
                                                $(this).toggleClass('active', false);
                                                
                                                
                                            }
                                            else
                                            {      
                                                if (montoRestante > 0 && saldo > 0 )
                                                {                                                    

                                                    if ( montoRestante > saldo)
                                                        valorADescontar = saldo;
                                                    else
                                                        valorADescontar = montoRestante;

                                                    montoPagadoEnTotal = montoPagado+valorADescontar;
                                                    saldo = valorTotalLinea - montoPagadoEnTotal;
                                                    
                                                    
                                                    montoPagadoEnTotal = Math.round(montoPagadoEnTotal * 100) / 100;
                                                    saldo = Math.round(saldo * 100) / 100;

                                                    $(this).find("td").eq(COLUMNA_MONTO_PAGADO).html(montoPagadoEnTotal); //Actualizo el monto pagado                                       
                                                    $(this).find("td").eq(COLUMNA_SALDO).html(saldo); //Actualizo el saldo

                                                    //$(this).find("td").eq(11).html(valorADescontar);//Esto es lo que se va a pagar con este factura
                                                    
                                                    oTable = $('#example').dataTable();
                                                    var aPos   = oTable.fnGetPosition(this);
                                                    var aData = oTable.fnGetData(aPos);
                                                    
                                                    oTable.fnUpdate( valorADescontar, aPos, COLUMNA_MONTO_PAGADO_ESTA_FACTURA ); // //Esto es lo que se va a pagar con este factura
                                                    
                                                    //montoPagado = Number(aData[COLUMNA_MONTO_PAGADO_ESTA_FACTURA] ); //$(this).find("td").eq(11).html();        

                                                    $("#montoRestante").html(Math.round((montoRestante-valorADescontar) * 100) / 100);

                                                    //ACTIVAR el resaltado
                                                    $(this).toggleClass('active', true);
                                                }
                                            }
                                            
                                            montoRestante = Number($("#montoRestante").html());    
                                            montoOriginalRestante = Number($("#montoOriginalRestante").val());    
                                            
                                            /*Para habilitar/deshabilitar el boton de "Confirmar"*/
                                            if (montoOriginalRestante != montoRestante)                                            
                                            {
                                                $('button').prop('disabled', false);
                                            }
                                            else
                                            {
                                                $('button').prop('disabled', true);
                                            }
                                            
                                    } );

                                    $('#button').click( function () {
                                        
                                        var answer = confirm("¿Está seguro de computar estos pagos?. Luego de aceptar no se podrá revertir los cambios")

                                        if (answer)
                                        {
                                            oTable = $('#example').dataTable();

                                            var arrayPagos = []; 
                                            var contador = 0;

                                            $( oTable.fnGetNodes() ).each(function(){
                                                var idReparto, montoPagado, montoTotal, idProducto, idVL;

                                                if ($(this).hasClass('active'))
                                                {

                                                    var aPos   = oTable.fnGetPosition(this);
                                                    var aData = oTable.fnGetData(aPos);        

                                                    montoTotal = Number(aData[COLUMNA_VALOR_TOTAL_LINEA]);     

                                                    montoPagado = Number(aData[COLUMNA_MONTO_PAGADO_ESTA_FACTURA]); //$(this).find("td").eq(11).html();          

                                                    idReparto = Number(aData[COLUMNA_ID_REPARTO]);
                                                    idProducto = Number(aData[COLUMNA_ID_PRODUCTO]);
                                                    idVL = Number(aData[COLUMNA_ID_VL]);

                                                    arrayPagos.push({ 
                                                                    idReparto: idReparto, 
                                                                    idPago: $("#idPago").html(), 
                                                                    montoTotal: montoTotal,
                                                                    montoPagado: montoPagado,
                                                                    idProducto: idProducto,
                                                                    idVL: idVL
                                                              });  

                                                    /*alert ('arrayPagos['+contador+']: idReparto: '+arrayPagos[contador].idReparto+
                                                          ' idPago: '+arrayPagos[contador].idPago+' totalViaje:'+arrayPagos[contador].totalViaje+
                                                          ' montoPagado'+arrayPagos[contador].montoPagado
                                                          );  */       

                                                    console.log('arrayPagos['+contador+']: idReparto: '+arrayPagos[contador].idReparto+
                                                          ' idPago: '+arrayPagos[contador].idPago+' montoTotal:'+arrayPagos[contador].montoTotal+
                                                          ' montoPagado'+arrayPagos[contador].montoPagado+
                                                          ' idProducto:'+arrayPagos[contador].idProducto+
                                                          ' idVL:'+arrayPagos[contador].idVL);

                                                    $.ajax({
                                                        type:"POST",
                                                        data:  arrayPagos[contador],
                                                        url:"<?php echo base_url() ?>index.php/procesaPago/asignarPago",                                        
                                                        }).done(function(data){
                                                                console.log(data);
                                                                
                                                                swal("Guardada!", data, "success");
                                                                
                                                                location.reload();
                                                                //alert(data);
                                                    });

                                                    contador++;
                                                } 

                                            }
                                        )
                                
                                        //close();    
                                    }
                                    } ); //Fin de la funcion del boton
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
          foreach( $pago as $pagoRecibido ) :
                $idPago = $pagoRecibido['id']; 
                $montoAImputar = $pagoRecibido['monto'] ;
                $fechaPago = $pagoRecibido['fecha_pago'] ;
                $nombreCliente = $pagoRecibido['cliente'] ;                
        endforeach; 
    ?>
    
    <div class="container" style="padding: 15px;">
        
        <div class="panel panel-primary">
        <div class="panel-heading"><?php echo $nombreCliente?></div>
        <div class="panel-body">
            
            <h4>Numero de factura <span class="label label-default" id="idPago"> <?php echo $idPago?></span></h4>
            <h4>Fecha de pago <span class="label label-default"> <?php echo date_format(date_create($fechaPago), 'd/m/Y');?></span></h4>
            <h4>Monto <span class="label label-success" id="montoPagado"> <?php echo $montoAImputar?></span></h4>
            
            <h4  style="float: right;">Monto restante de imputar <span class="label label-danger" id="montoRestante"> <?php echo $montoAImputar-$montoImputado[0]['montoImputado']?></span></h4>
            <input type="hidden" name="montoOriginalRestante" id="montoOriginalRestante" value="<?php echo $montoAImputar-$montoImputado[0]['montoImputado']?>">
            
        </div>
        </div> 
    
        

        <div class="panel panel-primary">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Productos adeudados - Seleccione las deudas que desea abonar mediante esta factura</h4>
                <div class="btn-group pull-right">
                  <button id="button" class="btn btn-danger">Confirmar pagos</button> 
                </div>
            </div>
        
        <div class="panel-body">
        
        
        
        <?php 
        if (empty($facturasClientes[0]['numero_de_viaje']))
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
        
        <table id="example" class="table compact" cellspacing="0" width="100%" style="font-size:small; text-align: left;">
            
           
                <thead>
                <TR>
                    <th><b>Fecha entrega<b></th> 
                    <th><b>Fecha valorizacion</b></th>
                    <th><b>Proveedor</b></th>                    
                    <th><b>Producto</b></th>
                    <th><b>Peso bulto</b></th>
                    <th><b>Cantidad</b></th>
                    <th><b>Cant. merma</b></th>
                    <th><b>Precio x bulto</b></th>
                    <th><b>Total</b></th>
                    <th><b>Monto Pagado</b></th>
                    <th><b>Saldo</b></th>
                    <th><b>IdReparto</b></th>
                    <th><b>Pagado con esta factura</b></th>
                    <th><b>IdProducto</b></th>
                    <th><b>IdVL</b></th>
                    
                </TR>
                </thead>
                 <tbody>
                <?php 
                    if ($sinProductos == 1)
                    {
                    foreach( $facturasClientes as $lineas ) : 
                        $saldo = 0;
                        $saldo = $lineas['valor_total'] - $lineas['monto_pagado'];
                        
                        $saldo = round($saldo, 2);

                        if ($saldo > 0)
                        {
                        ?>
                        <TR>
                             
                            <td>
                            
                                <?php 
                                                
                                                $f_reparto  = empty($lineas['fecha_reparto']) ? NULL : $lineas['fecha_reparto'];
                                                
                                                if (! is_null($f_reparto))
                                                {
                                                    $f_reparto = date_format(date_create($f_reparto), 'd/m/Y');
                                                }
                                                else
                                                {
                                                    $f_reparto = "-";
                                                }
                                                
                                ?>
                                
                                <?php echo $f_reparto; ?>
                                
                            </td>
                            <td>
                                <?php 
                                                
                                                $f_valorizacion  = empty($lineas['fecha_valorizacion']) ? NULL : $lineas['fecha_valorizacion'];
                                                
                                                if (! is_null($f_reparto))
                                                {
                                                    $f_valorizacion = date_format(date_create($f_valorizacion), 'd/m/Y');
                                                }
                                                else
                                                {
                                                    $f_valorizacion = "-";
                                                }
                                                
                                ?>
                                
                                <?php echo $f_valorizacion; ?>
                            
                            </td>
                            <TD> <?php echo $lineas['proveedor'] ?></TD>                       
                            <TD> <?php echo $lineas['producto'] ?></TD>
                            <TD> <?php echo $lineas['peso'] ?></TD>
                            <TD> <?php echo $lineas['cantidad_bultos'] ?></TD>
                            <TD> <?php echo $lineas['cant_bultos_merma'] ?></TD>
                            <TD> <?php echo $lineas['precio_bulto'] ?></TD>
                            <TD> <?php echo $lineas['valor_total'] ?></TD>
                            <TD> <?php echo $lineas['monto_pagado'] ?> </TD>
                            <TD> <?php echo $saldo ?> </TD>
                            <TD> <?php echo $lineas['id_reparto'] ?> </TD>
                            <TD> 0 </TD>
                            <TD> <?php echo $lineas['id_producto'] ?> </TD>
                            <TD> <?php echo $lineas['id_variable_logistica'] ?> </TD>

                        </TR>            

                <?php  
                        }
                    endforeach; 
                    }
                ?>
                </tbody>    
            </table>
            
         </div>
        </div>     
          
  </div>
  

</body>
</html>