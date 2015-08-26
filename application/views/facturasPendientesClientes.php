<html lang="es">
    <?php $this->load->view('header') ?>
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
            $(document).ready(function() {
                    var t = $('#example').DataTable( {
                                        "columnDefs": [ {
                                            "searchable": false,
                                            "orderable": false,
                                            "targets": 0
                                        },
                                            {
                                                "targets": [ 6 ],
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
                                        
                                            valorViaje = Number($(this).find("td").eq(3).html());                                                
                                            montoPagado = Number($(this).find("td").eq(4).html());                                                
                                            saldo = Number($(this).find("td").eq(5).html());                                                
                                            montoPagadoConEstaFactura = Number($(this).find("td").eq(6).html());
                                            montoRestante = Number($("#montoRestante").html());                                       
                                                   
                                        
                                            if ($(this).hasClass('active'))
                                            {                                                
                                                $("#montoRestante").html(montoPagadoConEstaFactura + montoRestante);
                                                
                                                $(this).find("td").eq(4).html(montoPagado-montoPagadoConEstaFactura); // Actualizo el valor pagado
                                                
                                                $(this).find("td").eq(5).html(saldo+montoPagadoConEstaFactura); // Actualizo el saldo
                                                
                                                $(this).find("td").eq(6).html(0); // Actualizo el monto pagado con esta factura
                                                
                                                //desactivar el resaltado
                                                $(this).toggleClass('active', false);
                                                
                                            }
                                            else
                                            {      
                                                if (montoRestante > 0 && saldo > 0 )
                                                {
                                                    valorViaje = Number($(this).find("td").eq(3).html());

                                                    if ( montoRestante > saldo)
                                                        valorADescontar = saldo;
                                                    else
                                                        valorADescontar = montoRestante;

                                                    montoPagadoEnTotal = montoPagado+valorADescontar;
                                                    saldo = valorViaje - montoPagadoEnTotal;

                                                    $(this).find("td").eq(4).html(montoPagadoEnTotal); //Actualizo el monto pagado                                       
                                                    $(this).find("td").eq(5).html(saldo); //Actualizo el saldo

                                                    $(this).find("td").eq(6).html(valorADescontar);//Esto es lo que se va a pagar con este factura

                                                    $("#montoRestante").html(montoRestante-valorADescontar);

                                                    //ACTIVAR el resaltado
                                                    $(this).toggleClass('active', true);
                                                }
                                            }

                                            

                                           
                                        
                                        
                                    } );

                                    $('#button').click( function () {
                                        
                                        oTable = $('#example').dataTable();
                                        
                                        var arrayPagos = []; 
                                        var contador = 0;
                                        
                                        $( oTable.fnGetNodes() ).each(function(){
                                            var totalViaje, idViaje, montoPagado;
                                                                                        
                                            if ($(this).hasClass('active'))
                                            {
                                               
                                                var aPos   = oTable.fnGetPosition(this);
                                                var aData = oTable.fnGetData(aPos);        
                                            
                                                totalViaje = Number(aData[3]);     
                                                
                                                montoPagado = $(this).find("td").eq(6).html();
                                                
                                                
                                                idViaje = Number(aData[6]);
                                                                                               
                                                arrayPagos.push({ 
                                                                idViaje: idViaje, 
                                                                idPago: $("#idPago").html(), 
                                                                totalViaje: totalViaje,
                                                                montoPagado: montoPagado
                                                          });  
                                                          
                                                /*alert ('arrayPagos['+contador+']: idViaje: '+arrayPagos[contador].idViaje+
                                                      ' idPago: '+arrayPagos[contador].idPago+' totalViaje:'+arrayPagos[contador].totalViaje+
                                                      ' montoPagado'+arrayPagos[contador].montoPagado
                                                      );  */       
                                              
                                                console.log('arrayPagos['+contador+']: idViaje: '+arrayPagos[contador].idViaje+
                                                      ' idPago: '+arrayPagos[contador].idPago+' totalViaje:'+arrayPagos[contador].totalViaje+
                                                      ' montoPagado'+arrayPagos[contador].montoPagado);
                                                          
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
                                        })
                                        
                                                  

                                        
                                        

                                    } );
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
            <h4>Fecha de pago <span class="label label-default"> <?php echo $fechaPago?></span></h4>
            <h4>Monto <span class="label label-success" id="montoPagado"> <?php echo $montoAImputar?></span></h4>
            <h4  style="float: right;">Monto restante de imputar <span class="label label-danger" id="montoRestante"> <?php echo $montoAImputar-$montoImputado[0]['montoImputado']?></span></h4>
          
        </div>
        </div> 
    
        

        <div class="panel panel-primary">
        <div class="panel-heading">Viajes adeudados - Seleccione los viajes que desea abonar mediante esta factura</div>
        <div class="panel-body">
        
        <button id="button">Grabar</button>
            
        <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <TR>
                    <th>#</th>
                    <th><b>Proveedor</b></th>
                    <th><b>Nro de Viaje</b></th>
                    <th><b>Valor viaje</b></th>
                    <th><b>Monto Pagado</b></th>
                    <th><b>Saldo</b></th>
                    <th><b>IdViaje</b></th>
                    <th><b>Pagado con esta factura</b></th>
                  
                </TR>
                </thead>
                 <tbody>
                <?php 
                    foreach( $facturasClientes as $lineas ) : ?>
                    <TR>
                        <TD></TD>
                        <TD> <?php echo $lineas['proveedor'] ?></TD>
                        <TD> <?php echo $lineas['numero_de_viaje'] ?></TD>
                        <TD> <?php echo $lineas['valor_total'] ?></TD>
                        <TD> <?php echo $lineas['monto_pagado'] ?> </TD>
                        <TD> <?php echo $lineas['valor_total'] - $lineas['monto_pagado'] ?> </TD>
                        <TD> <?php echo $lineas['id_viaje'] ?> </TD>
                        <TD> 0 </TD>
                     
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