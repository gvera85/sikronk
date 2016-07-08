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
                        
<table id="example" class="display compact responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
    <thead>
        <tr>
            <th>#</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Total [$]</th>
            <th>Cant. viajes</th>
            <th>Bultos</th>
            <th>Pallets</th>
            
            <th></th>
        </tr>
    </thead>
 
    <tbody>
        
        <?php 
            if (!empty($lineasVentas[0]['mes']))
            {
                foreach( $lineasVentas as $lineas ) : ?> 
        
                    <tr>
                        <td><?php echo $lineas['numero'] ?></td>
                        <td><?php echo $lineas['mes'] ?></td>
                        <td><?php echo $lineas['anio'] ?></td>
                        <td><?php echo $lineas['total_facturado'] ?></td>
                        <td>
                            <?php if ($lineas['cant_viajes'] > 0)
                            {?>
                                <a href="<?php echo base_url('/index.php/reportes/viajesMensuales').'/'.$lineas['numero'].'/'.$lineas['anio']; ?>"> 
                                    <span class="label label-info" id="cantViajes"> <?php echo $lineas['cant_viajes'] ?> </span> 
                                </a> 
                            <?php
                            }else{
                                   echo $lineas['cant_viajes'];
                            }
                            ?>
                        </td>
                        <td><?php echo $lineas['total_bultos'] ?></td>
                        <td><?php echo $lineas['total_pallets'] ?></td>                       
                         <TD> 
                            <a href="<?php echo base_url('/index.php/reportes/ventasMensualesProdProveedor').'/'.$lineas['numero'].'/'.$lineas['anio']; ?>"> 
                                <span class="label label-info" id="mesAnio"> Ver Prod. </span> 
                            </a> 
                        </TD>
                        
                    </tr>
        
        <?php
                endforeach; 
            }
        ?>  
    </tbody>
</table>
</div>  

<div class="row-fluid">
<div class="box">
                                    <div class="box-header">
                                            <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Gráfico de barras [$/mes]</h2>
                                            <div class="box-icon">
                                                    
                                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                                    
                                            </div>
                                    </div>
                                    <div class="box-content">
                                             <div id="graficaDeBarras" class="center" style="height:300px;"></div>

                                           
                                    </div>
                            </div>    

</div>    

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
        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "pagingType": "full_numbers",
        "displayLength": 25,        
        "order": [[ 2, 'asc' ], [0,'asc']],        
        "language": {
                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                    }
    });
    
    mes = 0;
var d1 = [];
var d2 = [];

table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var dato = this.data();
        
        mes++;
        ventaTotal = dato[3];
        bultos = dato[5];
        
        
        d1.push([ mes,  ventaTotal]);
        d2.push([ mes,  bultos]);
        
        
    } );

if($("#graficaDeBarras").length)
	{
		/*
		for (var i = 0; i <= 12; i += 1)
                {
                    d1.push([i, parseInt(Math.random() * 30)]);
                }*/
               
		

		var stack = 0, bars = true, lines = false, steps = false;

		function plotWithOptions() {
			$.plot($("#graficaDeBarras"), [ d1 ], {
				series: {
					stack: stack,
					lines: { show: lines, fill: true, steps: steps },
					bars: { show: bars, barWidth: 0.6 },
				},
				colors: ["#FA5833", "#2FABE9", "#FABB3D"],
                                labels: ["January", "February", "March", "April", "May", "June", "July"]
			});
		}

		plotWithOptions();

		$(".stackControls input").click(function (e) {
			e.preventDefault();
			stack = $(this).val() == "With stacking" ? true : null;
			plotWithOptions();
		});
		$(".graficaDeBarras input").click(function (e) {
			e.preventDefault();
			bars = $(this).val().indexOf("Bars") != -1;
			lines = $(this).val().indexOf("Lines") != -1;
			steps = $(this).val().indexOf("steps") != -1;
			plotWithOptions();
		});
	}

    
    
    
} );



</script>        

