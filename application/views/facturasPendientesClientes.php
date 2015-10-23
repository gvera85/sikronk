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
                                        "columnDefs": [ {
                                            "searchable": false,
                                            "orderable": false,
                                            "targets": 0
                                        },
                                            {
                                                "targets": [ 10 ],
                                                "visible": false
                                            }
                                         ,
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
                                        ]
                                        ,
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

                                     $('#example tbody').on( 'click', 'tr', function () {
                                        
                                            valorTotalLinea = Number($(this).find("td").eq(COLUMNA_VALOR_TOTAL_LINEA).html());                                                
                                            montoPagado = Number($(this).find("td").eq(COLUMNA_MONTO_PAGADO).html());                                                
                                            saldo = Number($(this).find("td").eq(COLUMNA_SALDO).html());                                                
                                            montoPagadoConEstaFactura = Number($(this).find("td").eq(COLUMNA_MONTO_PAGADO).html());
                                            
                                            montoRestante = Number($("#montoRestante").html());                                       
                                                   
                                        
                                            if ($(this).hasClass('active'))
                                            {                                                
                                                $("#montoRestante").html(montoPagadoConEstaFactura + montoRestante);
                                                
                                                $(this).find("td").eq(COLUMNA_MONTO_PAGADO).html(montoPagado-montoPagadoConEstaFactura); // Actualizo el valor pagado
                                                
                                                $(this).find("td").eq(COLUMNA_SALDO).html(saldo+montoPagadoConEstaFactura); // Actualizo el saldo
                                                
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

                                                    $(this).find("td").eq(COLUMNA_MONTO_PAGADO).html(montoPagadoEnTotal); //Actualizo el monto pagado                                       
                                                    $(this).find("td").eq(COLUMNA_SALDO).html(saldo); //Actualizo el saldo

                                                    //$(this).find("td").eq(11).html(valorADescontar);//Esto es lo que se va a pagar con este factura
                                                    
                                                    oTable = $('#example').dataTable();
                                                    var aPos   = oTable.fnGetPosition(this);
                                                    var aData = oTable.fnGetData(aPos);
                                                    
                                                    oTable.fnUpdate( valorADescontar, aPos, COLUMNA_MONTO_PAGADO_ESTA_FACTURA ); // //Esto es lo que se va a pagar con este factura
                                                    
                                                    //montoPagado = Number(aData[COLUMNA_MONTO_PAGADO_ESTA_FACTURA] ); //$(this).find("td").eq(11).html();        

                                                    $("#montoRestante").html(montoRestante-valorADescontar);

                                                    //ACTIVAR el resaltado
                                                    $(this).toggleClass('active', true);
                                                }
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
                                                        url:"http://localhost/sikronk/index.php/procesaPago/asignarPago",                                        
                                                        }).done(function(data){
                                                                console.log(data);
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
    
    <div class="container">
        
        <div class="panel panel-primary">
        <div class="panel-heading"><?php echo $nombreCliente?></div>
        <div class="panel-body">
            
            <h4>Numero de factura <span class="label label-default" id="idPago"> <?php echo $idPago?></span></h4>
            <h4>Fecha de pago <span class="label label-default"> <?php echo date_format(date_create($fechaPago), 'd/m/Y');?></span></h4>
            <h4>Monto <span class="label label-success" id="montoPagado"> <?php echo $montoAImputar?></span></h4>
            <h4  style="float: right;">Monto restante de imputar <span class="label label-danger" id="montoRestante"> <?php echo $montoAImputar-$montoImputado[0]['montoImputado']?></span></h4>
          
        </div>
        </div> 
    
        

        <div class="panel panel-primary">
        <div class="panel-heading">Productos adeudados - Seleccione las deudas que desea abonar mediante esta factura</div>
        <div class="panel-body">
        
        <button id="button">Grabar</button>
        
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
        
        <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <TR>
                    <th>#</th>
                    <th><b># Viaje</b></th>
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
                    foreach( $facturasClientes as $lineas ) : ?>
                    <TR>
                        <TD></TD>
                        <TD> <?php echo $lineas['numero_de_viaje'] ?></TD>
                        <TD> <?php echo $lineas['proveedor'] ?></TD>                       
                        <TD> <?php echo $lineas['producto'] ?></TD>
                        <TD> <?php echo $lineas['peso'] ?></TD>
                        <TD> <?php echo $lineas['cantidad_bultos'] ?></TD>
                        <TD> <?php echo $lineas['cant_bultos_merma'] ?></TD>
                        <TD> <?php echo $lineas['precio_bulto'] ?></TD>
                        <TD> <?php echo $lineas['valor_total'] ?></TD>
                        <TD> <?php echo $lineas['monto_pagado'] ?> </TD>
                        <TD> <?php echo $lineas['valor_total'] - $lineas['monto_pagado'] ?> </TD>
                        <TD> <?php echo $lineas['id_reparto'] ?> </TD>
                        <TD> 0 </TD>
                        <TD> <?php echo $lineas['id_producto'] ?> </TD>
                        <TD> <?php echo $lineas['id_variable_logistica'] ?> </TD>
                     
                    </TR>            
                    
                <?php           
                    endforeach; 
                    }
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