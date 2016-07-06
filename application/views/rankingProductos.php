<html lang="en">
<head>
<?php         
        //$this->load->view('headerProveedor');

        

        ini_set('date.timezone', 'America/Argentina/Buenos_Aires'); 
?>	
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- start: CSS -->
	<link id="bootstrap-style" href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url() ?>assets/plugins/metro/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo base_url() ?>assets/plugins/metro/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        
        
        
	<!-- end: CSS -->

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


</head>

<body>
    
    <!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><span>Metro</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white warning-sign"></i>
							</a>
							<ul class="dropdown-menu notifications">
								<li class="dropdown-menu-title">
 									<span>You have 11 notifications</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>	
                            	<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">1 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">7 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">8 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">16 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">36 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon yellow"><i class="icon-shopping-cart"></i></span>
										<span class="message">2 items sold</span>
										<span class="time">1 hour</span> 
                                    </a>
                                </li>
								<li class="warning">
                                    <a href="#">
										<span class="icon red"><i class="icon-user"></i></span>
										<span class="message">User deleted account</span>
										<span class="time">2 hour</span> 
                                    </a>
                                </li>
								<li class="warning">
                                    <a href="#">
										<span class="icon red"><i class="icon-shopping-cart"></i></span>
										<span class="message">New comment</span>
										<span class="time">6 hour</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">yesterday</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                            		<a>View all notifications</a>
								</li>	
							</ul>
						</li>
						<!-- start: Notifications Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white tasks"></i>
							</a>
							<ul class="dropdown-menu tasks">
								<li class="dropdown-menu-title">
 									<span>You have 17 tasks in progress</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>
								<li>
                                    <a href="#">
										<span class="header">
											<span class="title">iOS Development</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim red">80</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">Android Development</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim green">47</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">ARM Development</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim yellow">32</div> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="header">
											<span class="title">ARM Development</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim greenLight">63</div> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">ARM Development</span>
											<span class="percent"></span>
										</span>
                                        <div class="taskProgress progressSlim orange">80</div> 
                                    </a>
                                </li>
								<li>
                            		<a class="dropdown-menu-sub-footer">View all tasks</a>
								</li>	
							</ul>
						</li>
						<!-- end: Notifications Dropdown -->
						<!-- start: Message Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white envelope"></i>
							</a>
							<ul class="dropdown-menu messages">
								<li class="dropdown-menu-title">
 									<span>You have 9 messages</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>	
                            	<li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	6 min
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	56 min
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	3 hours
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	yesterday
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar5.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	Jul 25, 2012
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
								<li>
                            		<a class="dropdown-menu-sub-footer">View all messages</a>
								</li>	
							</ul>
						</li>
						<!-- end: Message Dropdown -->
						<li>
							<a class="btn" href="#">
								<i class="halflings-icon white wrench"></i>
							</a>
						</li>
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> Dennis Ji
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="login.html"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->

    <div class="container-fluid-full">
		<div class="row-fluid">
                        <!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="index.html"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
						<li><a href="messages.html"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
						<li><a href="tasks.html"><i class="icon-tasks"></i><span class="hidden-tablet"> Tasks</span></a></li>
						<li><a href="ui.html"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
						<li><a href="widgets.html"><i class="icon-dashboard"></i><span class="hidden-tablet"> Widgets</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Dropdown</span><span class="label label-important"> 3 </span></a>
							<ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
						<li><a href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
						<li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
						<li><a href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
						<li><a href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
						<li><a href="table.html"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a href="calendar.html"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
						<li><a href="icon.html"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
						<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
        
<!-- start: Content -->
<div id="content" class="span10">


<ul class="breadcrumb">
        <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a> 
                <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Tables</a></li>
</ul>        

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


                                
                                
                                


<?php if ($tipoConsulta != "promedio")    
{ ?>
<br>

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

<?php } ?>
<?php 
        //$this->load->view('footerProveedor');
?>  


</div><!--/.fluid-container-->
	
			<!-- end: Content -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->


<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.ui.touch-punch.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/modernizr.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/bootstrap.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.cookie.js"></script>
	
		<script src='<?php echo base_url() ?>assets/plugins/metro/js/fullcalendar.min.js'></script>
	
		<script src='<?php echo base_url() ?>assets/plugins/metro/js/jquery.dataTables.min.js'></script>

		<script src="<?php echo base_url() ?>assets/plugins/metro/js/excanvas.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.pie.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.stack.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.resize.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.chosen.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.uniform.min.js"></script>
		
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.cleditor.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.noty.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.elfinder.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.raty.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.iphone.toggle.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.gritter.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.imagesloaded.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.masonry.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.knob.modified.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.sparkline.min.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/counter.js"></script>
	
		<script src="<?php echo base_url() ?>assets/plugins/metro/js/retina.js"></script>

		<script src="<?php echo base_url() ?>assets/plugins/metro/js/custom.js"></script>
	<!-- end: JavaScript-->
	
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

