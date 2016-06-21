<html lang="es">
<?php 
        $this->load->view('headerProveedor');
        ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
?>					

<!-- start: Content -->

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
							<i class="icon-lemon"></i>
							<p>Ranking por bultos</p>
                                                        
						</a>
						<a href="<?php echo base_url() ?>index.php/reportes/rankingClientes/promedio" class="quick-button span4">
							<i class="icon-tasks"></i>
							<p>Ranking por precio promedio</p>							
						</a>
						<a href="<?php echo base_url() ?>index.php/reportes/rankingClientes/monto" class="quick-button span4">
							<i class="icon-money"></i>
							<p>Ranking por monto [$]</p>
						</a>
						
						<div class="clearfix"></div>
					</div>	
				</div><!--/span-->
				
			

 <?php  if ($tipoConsulta == "bultos")
        {
            $tituloColumna = "Cantidad bultos";            
        }
        else
        {
            if ($tipoConsulta == "promedio")
            {
                $tituloColumna = "Precio promedio del bulto [$]";            
            }
            else
            {
                if ($tipoConsulta == "monto")
                {
                    $tituloColumna = "Monto total facturado [$]";            
                }
                else 
                {
                   $tituloColumna = "-";
                }
            }           
        }       
?>                         
                        
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
    
    
    
} );        

</script>       
        
        
</body>
</html>

