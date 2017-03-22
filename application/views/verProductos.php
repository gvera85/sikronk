<!DOCTYPE html>
<html lang="es">
<head>
	<?php         
            ini_set('date.timezone', 'America/Argentina/Buenos_Aires');                     
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
        
         <ul class="products">
        <?php foreach ($productos as $prod): ?>
        
        <li>
            <a href="<?php echo base_url() ?>index.php/reportes/rankingClientesPorProducto/bultos/<?php echo $prod["id_proveedor"] ?>/<?php echo $prod["id"] ?>">
                
                
                <?php if ( is_null( $prod["foto"]) || $prod["foto"]=="") 
                          $fotoProducto = "defaultProduct.png";
                      else
                          $fotoProducto = $prod["foto"];
                ?>
                <img class="imagenProducto" src="<?php echo base_url() ?>assets/uploads/productos/<?php echo $fotoProducto ?>">
                <h4><?php echo $prod["descripcion"] ?></h4>
                <p><?php echo $prod["marca"]." - ".$prod["calidad"] ?></p>
            </a>
        </li>
        
        <?php
                endforeach; ?>
        
        </ul>
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