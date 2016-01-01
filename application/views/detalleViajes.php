<!DOCTYPE html>
<html lang="es">
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
	<link id="bootstrap-style" href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url() ?>assets/plugins/metro/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo base_url() ?>assets/plugins/metro/css/style-responsive.css" rel="stylesheet">
        <link href="../../assets/grocery_crud/themes/datatables/css/demo_table_jui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">
	
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
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/plugins/metro/img/favicon.ico">
        
        
        
	<!-- end: Favicon -->
	
        <style>
            
            div.DTTT { margin-bottom: 0.5em; float: right;  }
            div.dataTables_wrapper { clear: both; margin: 10px;}	
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
				<a class="brand" href="index.html"><span>sikronk</span></a>

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
										<span class="avatar"><img src="<?php echo base_url() ?>assets/plugins/metro/img/avatar.jpg" alt="Avatar"></span>
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
										<span class="avatar"><img src="<?php echo base_url() ?>assets/plugins/metro/img/avatar.jpg" alt="Avatar"></span>
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
										<span class="avatar"><img src="<?php echo base_url() ?>assets/plugins/metro/img/avatar.jpg" alt="Avatar"></span>
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
										<span class="avatar"><img src="<?php echo base_url() ?>assets/plugins/metro/img/avatar.jpg" alt="Avatar"></span>
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
										<span class="avatar"><img src="<?php echo base_url() ?>assets/plugins/metro/img/avatar.jpg" alt="Avatar"></span>
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
								<i class="halflings-icon white user"></i> <?php echo $this->session->userdata('nombre')." - ".$this->session->userdata('DescEmpresa') ; ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Configuración</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="<?php echo base_url() ?>index.php/login/logout_user"><i class="halflings-icon off"></i> Logout</a></li>
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
						<li><a href="<?php echo base_url() ?>index.php/homeProveedor"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Resumen</span></a></li>	
						<li><a href="<?php echo base_url() ?>index.php/Reportes/viajesProveedor"><i class="icon-truck"></i><span class="hidden-tablet"> Viajes</span></a></li>
						<li><a href="<?php echo base_url() ?>assets/plugins/metro/tasks.html"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Mercaderia a recibir</span></a></li>
						<li><a href="<?php echo base_url() ?>assets/plugins/metro/login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
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
					<a href="<?php echo base_url() ?>assets/plugins/metro/index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Resumen</a></li>
			</ul>
                            

			
				
						
			<!-- <div class="row-fluid"> -->
<div class="row-fluid" >				

    <!--<div class="box black span12 noMargin" onTablet="span12" onDesktop="span12">
            <div class="box-header">
                    <h2><i class="halflings-icon white list"></i><span class="break"></span>Reparto del viaje 129 - Valor total $135000</h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                    </div>
            </div>
            <div class="box-content">
                    <ul class="tickets metro">
                            <li class="ticket blue">
                                    <a href="#">
                                            <span class="header">
                                                    <span class="avatar"><img src="<?php echo base_url() ?>/assets/uploads/productos/6d0aa-durazno2.jpg" alt="Duranzo de baja calidad"></span>
                                                    <span class="title">Durazno Pluma - Calidad Alta</span>
                                                    <span class="number">[ $97000 ]</span>
                                            </span>	
                                            <span class="content">

                                                    <span class="name">Procom SRL</span>
                                                    <span class="status">[10/12/2015] $ x bulto: [ $50 ]</span>
                                                     <span class="status">600 bultos</span>
                                                    <span class="priority">Total: [ $75000 ]</span>

                                            </span>	  
                                           <span class="content">

                                                    <span class="name">Daloia</span>
                                                    <span class="status">[12/12/2015] $ x bulto: [ $43 ]</span>
                                                    <span class="status">300 bultos</span>
                                                    <span class="priority">Total: [ $34000 ]</span>

                                            </span>	
                                            <span class="content">

                                                    <span class="name">Akon</span>
                                                    <span class="status">[15/12/2015] $ x bulto: [ $42 ]</span>
                                                    <span class="status">210 bultos</span>
                                                    <span class="priority">Total: [ $23000 ]</span>

                                            </span>	
                                    </a>
                            </li>
                            <li class="ticket red">
                                    <a href="#">
                                            <span class="header">
                                                    <span class="avatar"><img src="<?php echo base_url() ?>/assets/uploads/productos/511c3-frutilla2.jpg" alt="Duranzo de baja calidad"></span>
                                                    <span class="title">Frutilla Premium - Calidad Alta - 1100 bultos - 130 kg</span>
                                                    <span class="number">[ $97000 ]</span>
                                            </span>	
                                            <span class="content">

                                                    <span class="name">Procom SRL</span>
                                                    <span class="status">[10/12/2015] $ x bulto: [ $50 ]</span>
                                                     <span class="status">900 bultos</span>
                                                    <span class="priority">Total: [ $75000 ]</span>

                                            </span>	 

                                            <span class="content">

                                                    <span class="name">Akon</span>
                                                    <span class="status">[15/12/2015] $ x bulto: [ $42 ]</span>
                                                    <span class="status">200 bultos</span>
                                                    <span class="priority">Total: [ $23000 ]</span>

                                            </span>	                                                     
                                    </a>
                            </li>
                            <li class="ticket blue">
                                    <a href="#">
                                            <span class="header">
                                                    <span class="avatar"><img src="<?php echo base_url() ?>/assets/uploads/productos/7a699-limon_turquia.jpg" alt="Duranzo de baja calidad"></span>
                                                    <span class="title">Limon del norte - Calidad Media</span>
                                                    <span class="number">[ $97000 ]</span>
                                            </span>	
                                            <span class="content">

                                                    <span class="name">Procom SRL</span>
                                                    <span class="status">[10/12/2015] $ x bulto: [ $50 ]</span>
                                                     <span class="status">600 bultos</span>
                                                    <span class="priority">Total: [ $75000 ]</span>

                                            </span>	  
                                           <span class="content">

                                                    <span class="name">Daloia</span>
                                                    <span class="status">[12/12/2015] $ x bulto: [ $43 ]</span>
                                                    <span class="status">300 bultos</span>
                                                    <span class="priority">Total: [ $34000 ]</span>

                                            </span>	
                                            <span class="content">

                                                    <span class="name">Akon</span>
                                                    <span class="status">[15/12/2015] $ x bulto: [ $42 ]</span>
                                                    <span class="status">210 bultos</span>
                                                    <span class="priority">Total: [ $23000 ]</span>

                                            </span>	                                                       
                                    </a>
                            </li>

                    </ul>
            </div>
    </div>
    -->
    
    <table id="example" class="table table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>                                                        
                                                        <th>Cliente</th>
							<th>Fecha de reparto</th>
                                                        <th>Producto</th>
                                                        <th>Fecha de valorizacion</th>
							<th>Precio por bulto[$]</th>
							<th>Cant. de bultos</th>
                                                        <th>Cant. merma</th>                                                        
							<th>Precio total[$]</th>
						</tr>
					</thead>
					<tbody>
                                        
                                             <?php 
                                                if (!empty($lineasReparto[0]['razon_social']))
                                                {
                                                    foreach( $lineasReparto as $lineas ) : 
                                                        $cantBultosAPagar = ($lineas['cantidad_bultos'] - $lineas['cant_bultos_merma']);
                                                        $totalAPagar = $cantBultosAPagar * $lineas['precio_caja'];
                                                        
                                                        ?> 

                                                        <tr>
                                                            <td><?php echo $lineas['razon_social'] ?></td>
                                                            <td><?php echo $lineas['fecha_reparto'] ?></td>
                                                            <td><?php echo $lineas['descripcion_producto'] ?></td>
                                                            <td><?php echo $lineas['fecha_valorizacion'] ?></td>
                                                            <td><?php echo $lineas['precio_caja'] ?></td>
                                                            <td><?php echo $lineas['cantidad_bultos'] ?></td>
                                                            <td><?php echo $lineas['cant_bultos_merma'] ?></td>
                                                            <td><?php echo $totalAPagar ?></td>
                                                            
                                                        </tr>

                                            <?php
                                                    endforeach; 
                                                }
                                            ?>  
					</tbody>
				</table>
    
</div>								
				
				
			
<!-- 			</div> -->
			
			
		
                

	
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">Ã—</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2015 <a href="#" alt="Bootstrap_Metro_Dashboard">sikronk</a></span>
			
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
                
                
                <!-- start: javascrip dataTable -->
                <script src="http://datatables.net/release-datatables/media/js/jquery.js"></script>
                <script src="http://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
                <script src="http://datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
                <script src="http://datatables.net/release-datatables/extensions/Plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        
                <!-- end: javascript dataTable -->
                
	<!-- end: JavaScript-->

<script type="text/javascript">
        
$(document).ready(function() {
    var table = $('#example').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ], [1,'asc']],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            
            var last = null;
                var subTotal = new Array();
                var grandTotal = new Array();
                var groupID = -1;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    groupID++;
                    $(rows).eq( i ).before(
                        '<tr class="active" ><td colspan="3" class="groupTitle">'+group+' </td></tr>'
                    );
 
                    last = group;
                }
                
                
                //Sub-total of each column within the same grouping
               var val = api.row(api.row($(rows).eq(i)).index()).data(); //Current order index
                $.each(val, function (colIndex, colValue) {
                    if (typeof subTotal[groupID] == 'undefined') {
                        subTotal[groupID] = new Array();
                    }
                    if (typeof subTotal[groupID][colIndex] == 'undefined') {
                        subTotal[groupID][colIndex] = 0;
                    }
                    if (typeof grandTotal[colIndex] == 'undefined') {
                        grandTotal[colIndex] = 0;
                    }

                    value = colValue ? parseFloat(colValue) : 0;
                    subTotal[groupID][colIndex] += value;
                    grandTotal[colIndex] += value;
                });
                
               
                
            } );
            
            /*Recorro las filas buscando los agrupamientos por PLU*/ 
            $('tbody').find('.active').each(function (i, v) {
                var rowCount = $(this).nextUntil('.active').length;
                var subTotalInfo = "";
                for (var a = 4; a <= 7; a++) {
                    
                    if (a == 5 || a == 6) /*Cantidad de bultos y cantidad con merma NO son decimales*/
                        subTotalInfo += "<td class='groupTD'>" + subTotal[i][a] + " / " + grandTotal[a] + "</td>";
                    else
                        subTotalInfo += "<td class='groupTD'>" + subTotal[i][a].toFixed(2) + " / " + grandTotal[a].toFixed(2) + "</td>";
                }
                $(this).append(subTotalInfo);
            });
            
                
            
                
        }
    } );
 
    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.active', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );        

</script>        
        
        
</body>
</html>

