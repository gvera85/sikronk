<!-- start: Header -->
                
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo base_url() ?>index.php/reportes/homeProveedor"><img width="30px" src="<?php echo base_url() ?>assets/uploads/logos_clientes/logoKronkis.png" alt="sikronk"><span> sikronk</span></a> 
								
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
								<li><a href="<?php echo base_url() ?>index.php/login/logout_user"><i class="halflings-icon off"></i> Cerrar sesión</a></li>
							</ul>
						</li>
						
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->