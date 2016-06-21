
<html lang="es">
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>sikronk</title>
	<meta name="description" content="sikronk">
	<meta name="author" content="Gonzalo Vera">
	<meta name="keyword" content="Metro, Metro UI, frutas, reportes, reparto, logistica, mercado, central">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="http://localhost/sikronk/assets/plugins/metro/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://localhost/sikronk/assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="http://localhost/sikronk/assets/plugins/metro/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="http://localhost/sikronk/assets/plugins/metro/css/style-responsive.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://localhost/sikronk//assets/bootstrap/css/dataTablesBootstrap.css">
        
        <!--<link href="http://localhost/sikronk//assets/grocery_crud/themes/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>-->
        <link rel="stylesheet" type="text/css" href="http://localhost/sikronk/assets/dataTables/jquery.dataTables.min.css">
        
        <link rel="stylesheet" type="text/css" href="http://localhost/sikronk/assets/dataTables/responsive.dataTables.min.css">
        
          
        
         <!--
            <link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <link href="https://cdn.datatables.net/responsive/2.0.0/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
         -->
        
        

        
	<!-- end: CSS -->
	
        
        

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="http://localhost/sikronk/assets/plugins/metro/img/favicon.ico">
	<!-- end: Favicon -->
        
        <style>
            
            
            tr.warning { background-color:red;}
	
        </style>
		
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
				<a class="brand" href="http://localhost/sikronk/index.php/reportes/homeProveedor"><img width="30px" src="http://localhost/sikronk/assets/uploads/logos_clientes/logoKronkis.png" alt="sikronk"><span> sikronk</span></a> 
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> Armando Rodriguez - Barcelo								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Configuración</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Datos del usuario</a></li>
								<li><a href="http://localhost/sikronk/index.php/login/logout_user"><i class="halflings-icon off"></i> Cerrar sesión</a></li>
							</ul>
						</li>
						
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
						<li><a href="http://localhost/sikronk/index.php/reportes/homeProveedor"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Resumen</span></a></li>	
						<li><a href="http://localhost/sikronk/index.php/reportes/viajesProveedor"><i class="icon-truck"></i><span class="hidden-tablet"> Viajes</span></a></li>
						<li><a href="http://localhost/sikronk/index.php/reportes/mercaderiaSinRepartir"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Mercaderia sin repartir</span></a></li>
                                                <li><a href="http://localhost/sikronk/index.php/reportes/rankingClientes/bultos"><i class="icon-sitemap"></i><span class="hidden-tablet"> Ranking clientes</span></a></li>
						<li><a href="http://localhost/sikronk/index.php/login/logout_user"><i class="icon-lock"></i><span class="hidden-tablet"> Cerrar sesión</span></a></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="http://localhost/sikronk/index.php/reportes/homeProveedor">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Ranking de clientes</a></li>
			</ul>

			
			
       

                        <!-- Aca tiene que venir el codigo de la tabla o lo que quiera mostrar... el DIV se cierra si o si incluyendo el archivo footerProveedor-->
					

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
						
						<a href="http://localhost/sikronk/index.php/reportes/rankingClientes/bultos" class="quick-button span4">
							<i class="icon-inbox"></i>
							<p>Ranking por bultos</p>
                                                        
						</a>
						<a href="http://localhost/sikronk/index.php/reportes/rankingClientes/promedio" class="quick-button span4">
							<i class="icon-tasks"></i>
							<p>Ranking por precio promedio</p>							
						</a>
						<a href="http://localhost/sikronk/index.php/reportes/rankingClientes/monto" class="quick-button span4">
							<i class="icon-money"></i>
							<p>Ranking por monto [$]</p>
						</a>
						
						<div class="clearfix"></div>
					</div>	
				</div><!--/span-->
</div><!-- <div class="row-fluid"> -->				
			

                          

<div class="row-fluid" style = "visible:false;">	
    <table id="example" class="display compact responsive nowrap" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">
        <thead>
            <tr>
                <th>Puesto</th>
                <th>Cliente</th>
                <th>Monto total facturado [$]</th>

            </tr>
        </thead>
        <tfoot>
                <tr>
                    <th colspan="2" style="text-align:right">Total:</th>
                    <th></th>
                </tr>
        </tfoot>

        <tbody>

             

                        <tr>
                            <td></td>
                            <td>Reyban s.a.</td>
                            <td>
                                1800.00
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>Rotelli Adrian</td>
                            <td>
                                13473.00
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>Calimas s.r.l</td>
                            <td>
                                240000.00
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>Daloia</td>
                            <td>
                                7327.20
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>El Trebol de Juan Calgaro</td>
                            <td>
                                10000.00
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>Productos Cecy S.R.L.</td>
                            <td>
                                7905.00
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>Sardans s.a</td>
                            <td>
                                2565.00
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>Seremy S.R.L</td>
                            <td>
                                53.20
                            </td>                                           
                        </tr>

             

                        <tr>
                            <td></td>
                            <td>Renoval S.R.L</td>
                            <td>
                                162.00
                            </td>                                           
                        </tr>

              
        </tbody>
    </table>	


                                
                                
                                
</div><!--/row-->

<div class="row-fluid">	
    <div class="box span12">
            <div class="box-header">
                    <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Participación de cada cliente</h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    </div>
            </div>
            <div class="box-content">
                            <div id="graficoTorta" style="height:600px"></div>
            </div>
    </div>
</div><!--/row-->

    

            <!-- end: Content -->
            
            </div><!--/.fluid-container-->
			<!-- end: Content -->
            </div><!--/#content.span10-->
            </div><!--/fluid-row-->
   

    

    <footer>

            <p>
                    <span style="text-align:left;float:left">&copy; 2015 <a href="#" alt="sikronk">sikronk</a></span>

            </p>

    </footer>
	
                <!-- start: JavaScript-->

    <!--<script src="http://localhost/sikronk/assets/plugins/metro/js/jquery-1.9.1.min.js"></script>-->
    <script type="text/javascript" language="javascript" src="http://localhost/sikronk/assets/dataTables/jquery-1.11.3.min.js"></script>
    
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery-migrate-1.0.0.min.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.ui.touch-punch.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/modernizr.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/bootstrap.min.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.cookie.js"></script>
    <script src='http://localhost/sikronk/assets/plugins/metro/js/fullcalendar.min.js'></script>
    <!--<script src='http://localhost/sikronk/assets/plugins/metro/js/jquery.dataTables.min.js'></script>-->
    <script src="http://localhost/sikronk/assets/plugins/metro/js/excanvas.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.flot.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.flot.pie.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.flot.stack.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.flot.resize.min.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.chosen.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.uniform.min.js"></script>		
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.cleditor.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.noty.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.elfinder.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.raty.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.iphone.toggle.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.uploadify-3.1.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.gritter.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.imagesloaded.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.masonry.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.knob.modified.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/jquery.sparkline.min.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/counter.js"></script>	
    <script src="http://localhost/sikronk/assets/plugins/metro/js/retina.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/metro/js/custom.js"></script>

    
    <!--<script type="text/javascript" language="javascript" src="http://localhost/sikronk/assets/plugins/jquery/jquery.dataTables.min.js"></script>-->
    <script type="text/javascript" language="javascript" src="http://localhost/sikronk/assets/dataTables/jquery.dataTables.min.js"></script> 
    
    
    <script type="text/javascript" language="javascript" src="http://localhost/sikronk/assets/dataTables/dataTables.responsive.min.js"></script>
   
    <!-- end: javascript dataTable -->

<!-- end: JavaScript-->
	
  
    
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
                        "url": "http://localhost/sikronk//assets/bootstrap/json/SpanishDataTable.json"
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
    
    vectorClientes = [];
    
    table
    .column( 1 )
    .data()
    .each( function ( value, index ) {
        vectorClientes.push({ label: value,  data: 12});
    } );
    
    i = 0;
    porcentajeParticipacion = 0;
    
    table
    .column( 2 )
    .data()
    .each( function ( value, index ) {
        porcentajeParticipacion = value * 100 / total;
        vectorClientes[i].data = porcentajeParticipacion;
        i++;
    } );
    
    /* ---------- Pie chart ---------- */
	var data = [
	{ label: "Akon",  data: 12},
	{ label: "Il Giardino",  data: 27},
	{ label: "Daloia",  data: 85},
	{ label: "El trebol",  data: 64},
	{ label: "Reyban",  data: 90},
	{ label: "Renoval",  data: 112}
	];
	
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

