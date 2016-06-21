<html lang="es">
<?php         
        $this->load->view('headerProveedor');
        ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
?>					

<!-- start: Content -->

<?php  
        $claseBultos = "";
        $claseMonto = "";
        $clasePromedio = "";
        
        if ($tipoConsulta == "bultos")
        {
            $tituloColumna = "Cantidad bultos";    
            $claseBultos = "blue";
        }
        else
        {
            if ($tipoConsulta == "promedio")
            {
                $tituloColumna = "Precio promedio del bulto [$]";   
                $clasePromedio = "blue";
            }
            else
            {
                if ($tipoConsulta == "monto")
                {
                    $tituloColumna = "Monto total facturado [$]";  
                    $claseMonto = "blue";
                }
                else 
                {
                   $tituloColumna = "-";
                }
            }           
        }       
?>    



<div class="row-fluid">	
    <div class="box blue span12">
            <div class="box-header">
                    <h2><i class="halflings-icon signal"></i><span class="break"></span>Rankings de clientes</h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    </div>
            </div>
            <div class="box-content">

                    <a href="<?php echo base_url() ?>index.php/reportes/rankingClientes/bultos" class="quick-button span4">
                            <i class="icon-inbox"></i>
                            <p class="<?php echo $claseBultos ?>">Ranking por bultos</p>

                    </a>
                    <a href="<?php echo base_url() ?>index.php/reportes/rankingClientes/promedio" class="quick-button span4">
                            <i class="icon-tasks"></i>
                            <p class="<?php echo $clasePromedio ?>">Ranking por precio promedio</p>							
                    </a>
                    <a href="<?php echo base_url() ?>index.php/reportes/rankingClientes/monto" class="quick-button span4">
                            <i class="icon-money"></i>
                            <p class="<?php echo $claseMonto ?>">Ranking por monto [$]</p>
                    </a>

                    <div class="clearfix"></div>
            </div>	
    </div><!--/span-->
</div><!-- <div class="row-fluid"> -->				
			

                      

<div class="row-fluid" >	
    <table id="example" class="display compact responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
        <thead>
            <tr>
                <th>Puesto</th>
                <th>Cliente</th>
                <th><?php echo $tituloColumna ?></th>

            </tr>
        </thead>
        <tfoot>
                <tr>
                    <th colspan="2" style="text-align:right">Total:</th>
                    <th></th>
                </tr>
        </tfoot>

        <tbody>

            <?php 
                if (!empty($lineasRanking[0]['id_cliente']))
                {
                    foreach( $lineasRanking as $lineas ) : ?> 

                        <tr>
                            <td></td>
                            <td><?php echo $lineas['cliente'] ?></td>
                            <td>
                                <?php 
                                if ($tipoConsulta == "bultos")
                                    echo $lineas['cantidad_bultos'];   
                                else
                                {
                                    if ($tipoConsulta == "promedio")
                                    {
                                        $precioPromedioBulto = $lineas['monto_total'] /  $lineas['cantidad_bultos'];
                                        echo round($precioPromedioBulto,2);  
                                    }
                                    else
                                    {
                                        if ($tipoConsulta == "monto")
                                            echo $lineas['monto_total'];
                                        else 
                                           echo "/";
                                    }           
                                }       
                                ?>

                            </td>                                           
                        </tr>

            <?php
                    endforeach; 
                }
            ?>  
        </tbody>
    </table>	


                                
                                
                                
</div><!--/row-->

<?php if ($tipoConsulta != "promedio")    
{ ?>
<br>
<div class="row-fluid">    
    <div class="box span12">
        <div class="box-header">
                <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Participación de cada cliente</h2>                
        </div>
        <div class="box-content">
            
            <div id="container">
                <div id="graficoTorta" style="height:300px; height:100%;"></div>
            </div>
            
        </div>
    </div>        
</div><!--/row-->
<?php } ?>
<?php 
        $this->load->view('footerProveedor');
?>  
    
<script type="text/javascript">
        
$(document).ready(function() {
    
    var table = $('#example').DataTable({
         "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "pagingType": "full_numbers",
        "displayLength": 25,
        "scrollCollapse": false,
        "order": [[ 2, 'desc' ]],        
        "language": {
                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                    },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            
            cantRegistros = api.rows().count();
            
             
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
             
                
            <?php if ($tipoConsulta == "promedio")    
                echo "total = total / cantRegistros";
            ?> 
                            
            total = Math.round(total * 100) / 100;   
                         
            // Update footer
            $( api.column( 2 ).footer() ).html(
                total 
            );
    
           
    
        }
    });
    
    table.on( 'order.dt search.dt', function () {
        table.column(0).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    
    i = 0;
    porcentajeParticipacion = 0;
    porcentajeOtrosAcumulado = 0;
    nombreCliente="";
    vectorClientes = [];
    
    table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var dato = this.data();
        
        porcentajeParticipacion = dato[2] * 100 / total;
        nombreCliente = dato[1];
        
        if (porcentajeParticipacion < 2)
        {
            porcentajeOtrosAcumulado = porcentajeParticipacion + porcentajeOtrosAcumulado;            
        }
        else
        {
            vectorClientes.push({ label: nombreCliente,  data: porcentajeParticipacion});
        }
        
        
        
        
    } );
    
    if (porcentajeOtrosAcumulado > 0)
    {    
        nombreCliente = 'Otros';
        vectorClientes.push({ label: nombreCliente,  data: porcentajeOtrosAcumulado});
    }
    
   /* 
    table
    .column( 2 )
    .data()
    .each( function ( value, index ) {
        

        porcentajeParticipacion = value * 100 / total;

       // if (porcentajeParticipacion < 2)
            

        vectorClientes.push({ label: value,  data: porcentajeParticipacion});
        vectorClientes[i].data = porcentajeParticipacion;
        i++;
    } );

    
    
    table
    .column( 1 )
    .data()
    .each( function ( value, index ) {
        vectorClientes.push({ label: value,  data: 12});
    } );
    */
    
    
    /* ---------- Grafico de torta ---------- */
	
	if($("#graficoTorta").length)
	{
		$.plot($("#graficoTorta"), vectorClientes,
		{
			series: {
					pie: {
							show: true
					}
			},
			grid: {
					hoverable: true,
					clickable: true
			},
			legend: {
				show: false
			},
			colors: ["#FA5833", "#2FABE9", "#FABB3D", "#78CD51"]
		});
		
		function pieHover(event, pos, obj)
		{
			if (!obj)
					return;
			percent = parseFloat(obj.series.percent).toFixed(2);
			$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
		}
		$("#graficoTorta").bind("plothover", pieHover);
	}
    
    
    
} );        

</script>       
        
        
</body>
</html>

