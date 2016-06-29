<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
        <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                        <li><a href="<?php echo base_url() ?>index.php/reportes/homeProveedor"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Resumen</span></a></li>	
                        <li><a href="<?php echo base_url() ?>index.php/reportes/viajesProveedor"><i class="icon-truck"></i><span class="hidden-tablet"> Viajes</span></a></li>
                        <li><a href="<?php echo base_url() ?>index.php/reportes/mercaderiaSinRepartir"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Mercaderia sin repartir</span></a></li>
                        <?php if ($permisos['rankingClientes']) 
                        {?>
                            <li><a href="<?php echo base_url() ?>index.php/reportes/rankingClientes/bultos"><i class="icon-sitemap"></i><span class="hidden-tablet"> Ranking clientes</span></a></li>
                        <?php
                        }
                        ?>

                        <?php if ($permisos['rankingProductos']) 
                        {?>
                            <li><a href="<?php echo base_url() ?>index.php/reportes/rankingProductos/bultos"><i class="icon-barcode"></i><span class="hidden-tablet"> Ranking productos</span></a></li>
                        <?php
                        }
                        ?>    


                        <li><a href="<?php echo base_url() ?>index.php/login/logout_user"><i class="icon-lock"></i><span class="hidden-tablet"> Cerrar sesión</span></a></li>
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