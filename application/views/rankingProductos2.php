<!DOCTYPE html>
<html lang="en">
<head>
	<?php         
                            $this->load->view('headerProv');
        ?>
		
</head>

<body>
		<?php         
                            $this->load->view('menuSuperiorProv');
                ?>
	
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
                    
    
		<div class="container-fluid-full">
		<div class="row-fluid">				
			<?php         
                            $this->load->view('menuLateral');
                        ?>
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="<?php echo base_url() ?>index.php/reportes/homeProveedor">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#"><?php echo $this->session->userdata('ruta') ?></a></li>
			</ul>
                    
                <div class="row-fluid">                            
                        <div class="box blue span12">
                        <div class="box-header">
                                <h2><i class="halflings-icon signal"></i><span class="break"></span>Rankings de productos</h2>
                                <div class="box-icon">
                                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                </div>
                        </div>
                        <div class="box-content">

                                <a href="<?php echo base_url() ?>index.php/reportes/rankingProductos/bultos" class="quick-button span4">
                                        <i class="icon-inbox"></i>
                                        <p class="<?php echo $claseBultos ?>">Ranking por bultos</p>

                                </a>
                                <a href="<?php echo base_url() ?>index.php/reportes/rankingProductos/promedio" class="quick-button span4">
                                        <i class="icon-tasks"></i>
                                        <p class="<?php echo $clasePromedio ?>">Ranking por precio promedio</p>							
                                </a>
                                <a href="<?php echo base_url() ?>index.php/reportes/rankingProductos/monto" class="quick-button span4">
                                        <i class="icon-money"></i>
                                        <p class="<?php echo $claseMonto ?>">Ranking por monto [$]</p>
                                </a>

                                <div class="clearfix"></div>
                        </div>	
                        </div><!--/span-->    
                    </div><!--/row-->     
                    
                    
                <div class="row-fluid">		    
                    <table id="example" class="display compact responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
                        <thead>
                            <tr>
                                <th>Puesto</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Calidad</th>
                                <th><?php echo $tituloColumna ?></th>

                            </tr>
                        </thead>
                        <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                        </tfoot>

                        <tbody>

                            <?php 
                                if (!empty($lineasRanking[0]['id_producto']))
                                {
                                    foreach( $lineasRanking as $lineas ) : ?> 

                                        <tr>
                                            <td></td>
                                            <td><?php echo $lineas['producto'] ?></td>
                                            <td><?php echo $lineas['marca'] ?></td>
                                            <td><?php echo $lineas['calidad'] ?></td>
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
                </div>    
			
                    
                    <?php if ($tipoConsulta != "promedio")    
                    { ?>
                    <br>
                    <div class="row-fluid">
                        <div class="box span12">
                            <div class="box-header">
                                    <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Participación de cada producto</h2>                
                            </div>
                            <div class="box-content">

                                <div id="container">
                                    <div id="graficoTorta" style="height:500px;"></div>
                                </div>

                            </div>
                        </div>        
                    </div>
                    <?php } ?>


			
			
			
			
			
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
        </div><!--/#content.span10-->
        </div><!--/fluid-row-->
		
	
	
	<?php         
            $this->load->view('footerProv');
        ?>	
        
                
	
</body>
</html>


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
        "order": [[ 4, 'desc' ]],        
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
                .column( 4)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
             
                
            <?php if ($tipoConsulta == "promedio")    
                echo "total = total / cantRegistros";
            ?> 
                            
            total = Math.round(total * 100) / 100;   
                         
            // Update footer
            $( api.column( 4 ).footer() ).html(
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
        
        porcentajeParticipacion = dato[4] * 100 / total;
        nombreCliente = dato[1].substring(0,10);
        
        if (porcentajeParticipacion < 4)
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
