<html lang="es">
<?php 
        $this->load->view('headerProveedor');
        
?>	
    
   
    
    
    
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
    
<?php 
        $this->load->view('footerProveedor');
?>     