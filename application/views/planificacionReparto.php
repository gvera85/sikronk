<?php include 'header.php' ?>

  <div class="container">
    <table>
        <TR>
             <?php 
                $sinProductos = 0;
                if (empty($lineasViaje[0]['numero_de_viaje']))
                {
                    $titulo = "Viaje sin productos asociados. Para asignar productos al viaje debe ir a la pagina de creacion de viajes";
                    $sinProductos = 1;
                }
                else
                {
                    $titulo = "Viaje numero ".$lineasViaje[0]['numero_de_viaje']." - ".$lineasViaje[0]['proveedor'];
                }             
             ?>
            
            
            <TD><b> <?php echo $titulo  ?> </b></TD>
        </TR>  
    </table>  
    <BR>  
    <?php 
        if ($sinProductos == 0)
        {       
    ?>
    <table border="1">
        
        <TR>
            <TD><b>Producto</b></TD>
            <TD><b>Presentacion</b></TD>
            <TD><b>Cantidad bultos</b></TD>
            <TD><b>Cantidad pallets</b></TD>
        </TR>
        
        <?php 
              foreach( $lineasViaje as $lineas ) : ?>
                <TR>
                    <TD> <?php echo $lineas['producto'] ?></TD>
                    <TD> <?php echo $lineas['vl']." - ".$lineas['peso']. "[KG]" ?></TD>
                    <TD> <?php echo $lineas['cantidad_bultos'] ?></TD>
                    <TD> <?php echo $lineas['cantidad_pallets'] ?></TD>
                </TR>            
        <?php           
            endforeach; 
        }?>
     
    </table>
  </div>

<?php include 'footer.php' ?>