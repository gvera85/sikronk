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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">
        <link href="<?php echo base_url() ?>/assets/grocery_crud/themes/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
        
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
				<a class="brand" href="index.html"><img width="30px" src="<?php echo base_url() ?>assets/uploads/logos_clientes/logoKronkis.png" alt="sikronk"><span> sikronk</span></a> 
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
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
								<li><a href="#"><i class="halflings-icon user"></i> Datos del usuario</a></li>
								<li><a href="<?php echo base_url() ?>index.php/login/logout_user"><i class="halflings-icon off"></i> Logout</a></li>
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
						<li><a href="<?php echo base_url() ?>index.php/reportes/homeProveedor"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Resumen</span></a></li>	
						<li><a href="<?php echo base_url() ?>index.php/reportes/viajesProveedor"><i class="icon-truck"></i><span class="hidden-tablet"> Viajes</span></a></li>
						<li><a href="<?php echo base_url() ?>index.php/reportes/mercaderiaSinRepartir"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Mercaderia sin repartir</span></a></li>
						<li><a href="<?php echo base_url() ?>index.php/login/logout_user"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
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
				<li><a href="#"><?php echo $this->session->userdata('ruta') ?></a></li>
			</ul>

			<div class="row-fluid">
			
       

                        <!-- Aca tiene que venir el codigo de la tabla o lo que quiera mostrar... el DIV se cierra si o si incluyendo el archivo footerProveedor-->
