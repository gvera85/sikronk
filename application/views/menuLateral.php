<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
        <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                        <?php
                        
                            if (is_array($this->session->userdata('menu')) || is_object($this->session->userdata('menu')))
                            {   
                                foreach( $this->session->userdata('menu') as $menu ) : ?> 

                                    <li><a href="<?php echo base_url()."index.php/".$menu['controlador'];?>">
                                            <i class="<?php echo $menu['path_icono']?>"></i><span class="hidden-tablet"> <?php echo $menu['descripcion']; ?></span></a></li>


                        <?php 
                                endforeach; 
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