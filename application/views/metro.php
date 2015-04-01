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
	<link id="bootstrap-style" href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url() ?>assets/plugins/metro/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo base_url() ?>assets/plugins/metro/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
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
	
		
		
		
</head>

<body>
		<!-- start: Header -->
        <?php 
            $cantidad = 0;
            $bultos_mensual = "";
            $facturado_mensual = "";
            $pallets_mensual = "";
            $total_facturado=0;
            $total_bultos=0;
            $total_pallets=0;
            
            foreach( $ventaMes as $mes ) : 
                
                    $cantidad++;
            
                    $total_facturado = $total_facturado + $mes['total_facturado'];
                    $total_bultos = $total_bultos + $mes['total_bultos'];
                    $total_pallets = $total_pallets + $mes['total_pallets'];
                    
                    if ($cantidad == 1)
                    {
                        $bultos_mensual = $mes['total_bultos'];
                        $facturado_mensual = $mes['total_facturado'];
                        $pallets_mensual = $mes['total_pallets'];
                    }
                    else
                    {
                        $bultos_mensual = $bultos_mensual.','.$mes['total_bultos'];
                        $facturado_mensual = $facturado_mensual.','.$mes['total_facturado'];
                        $pallets_mensual = $pallets_mensual.','.$mes['total_pallets'];
                    }
              
                    
                
            endforeach;
            
        ?>  
                
                
                
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><img width="30px" src="<?php echo base_url() ?>assets/uploads/logos_clientes/logoKronkis.png" alt="sikronk"><span> sikronk</span></a> 
								
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
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
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
                                                <li class="dropdown">
                                                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<img width="50px" src="<?php echo base_url() ?>assets/uploads/logos_clientes/logoCoto.png" alt="sikronk">                                                
							</a>
                                                
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
						<li><a href="<?php echo base_url() ?>assets/plugins/metro/index.html"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Resumen</span></a></li>	
						<li><a href="<?php echo base_url() ?>index.php/Reportes"><i class="icon-truck"></i><span class="hidden-tablet"> Viajes</span></a></li>
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

			<div class="row-fluid">
                            
				<div class="span4 statbox purple" onTablet="span6" onDesktop="span4">
					<div class="boxchart"><?php echo $facturado_mensual?></div>
					<div class="number"><?php echo "$".$total_facturado ?><i class="icon-arrow-up"></i></div>
					<div class="title">compras último año</div>
					<div class="footer">
						<a href="<?php echo base_url() ?>index.php/Reportes"> ver reporte ampliado</a>
					</div>	
				</div>
				<div class="span4 statbox green" onTablet="span6" onDesktop="span4">
					<div class="boxchart"><?php echo $bultos_mensual ?></div>
					<div class="number"><?php echo $total_bultos ?><i class="icon-arrow-up"></i></div>
					<div class="title">bultos último año</div>
					<div class="footer">
						<a href="<?php echo base_url() ?>index.php/Reportes"> ver reporte ampliado</a>
					</div>
				</div>
				<div class="span4 statbox blue noMargin" onTablet="span6" onDesktop="span4">
					<div class="boxchart"><?php echo $pallets_mensual ?></div>
					<div class="number"><?php echo $total_pallets ?><i class="icon-arrow-up"></i></div>
					<div class="title">pallets último año</div>
					<div class="footer">
						<a href="<?php echo base_url() ?>index.php/Reportes"> ver reporte ampliado</a>
					</div>
				</div>
				
				
			</div>
                        
                        <div class="row-fluid">
				
				<div class="span6 statbox purple" onTablet="span6" onDesktop="span6">
					<div class="boxchart">1,2,3,4,5,6,7,8,9,10,11</div>
					<div class="number"><?php echo "$".$total_facturado ?><i class="icon-arrow-up"></i></div>
					<div class="title">pagos adeudados</div>
					<div class="footer">
						<a href="#"> ver reporte ampliado</a>
					</div>	
				</div>
				<div class="span6 statbox green" onTablet="span6" onDesktop="span6">
					<div class="boxchart"><?php echo $bultos_mensual ?></div>
					<div class="number"><?php echo "$".$total_bultos ?><i class="icon-arrow-up"></i></div>
					<div class="title">pagos realizados</div>
					<div class="footer">
						<a href="#"> ver reporte ampliado</a>
					</div>
				</div>
				
				
			</div>	
                            
                            <div class="row-fluid">	

				<a class="quick-button metro yellow span2">
					<i class="icon-group"></i>
					<p>Users</p>
					<span class="badge">237</span>
				</a>
				<a class="quick-button metro red span2">
					<i class="icon-money"></i>
					<p>Pagos Adeudados</p>
					<span class="badge">$58000</span>
				</a>
				<a class="quick-button metro blue span2">
					<i class="icon-shopping-cart"></i>
					<p>Orders</p>
					<span class="badge">13</span>
				</a>
				<a class="quick-button metro green span2">
					<i class="icon-barcode"></i>
					<p>Products</p>
				</a>
				<a class="quick-button metro pink span2">
					<i class="icon-envelope"></i>
					<p>Messages</p>
					<span class="badge">88</span>
				</a>
				<a class="quick-button metro black span2">
					<i class="icon-calendar"></i>
					<p>Calendar</p>
				</a>
				
				<div class="clearfix"></div>
								
			</div><!--/row-->
			

			
			
					
						
			
			
			
			
       

	</div><!--/.fluid-container-->
	
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
			<span style="text-align:left;float:left">&copy; 2015 <a href="#" alt="sikronk">sikronk</a></span>
			
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
