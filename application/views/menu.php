<?php $this->load->view('header') ?>
  
  
  
  <div>  
  <?php if ($hayMenu)
    {
    
        foreach( $menues as $menu ) : ?> 
            
            <!--<div class="productBox small color-green">-->
            <div class="imagenes" >    
                <a href="
                    <?php if ($menu['cant_hijos'] == 0) 
                                echo base_url()."index.php/main/redireccionarControlador/".urlencode($menu['controlador']); 
                                /*echo site_url("main/redireccionarControlador/".urlencode($menu['controlador']));*/
                          else 
                                echo base_url()."index.php/main/recargarMenu/".$menu['id_menu'];  ?>">
                <img src="<?php echo base_url()."assets/img/".$menu['path_icono']?>" title="<?php echo $menu['descripcion']?>"/>
                </a>
                <p></p>
                <p><?php echo $menu['descripcion']; ?>   </p>
            </div>
        
      
    <?php 
        endforeach; 
    }
    else 
    {?>
        <div class="imagenes" >
            <p> No tiene permisos para acceder a ningún punto de este menú</p>            
        </div>
    <?php
    }
    ?>     
    
   
</div>
  


