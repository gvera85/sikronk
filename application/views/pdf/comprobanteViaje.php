<!DOCTYPE html>
<html lang="es">
    
<head>
    
    <title>sikronk - Comprobante de viaje</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/chosen_v1.2.0/docsupport/prism.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/chosen_v1.2.0/chosen.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    

    <script src="<?php echo base_url() ?>/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/utils/utils.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.numeric.js"></script>
    <script src="<?php echo base_url() ?>/assets/bootstrap/js/bootstrap.js"></script>
    

  
      
    
    
    
    
</head>
<body>
    
<?php
    if (!empty($resumenViaje[0]['id']))
    {
        foreach( $resumenViaje as $resumen ) : 
            $idViaje = $resumen['id'];
            $nroViaje = $resumen['numero_de_viaje'];
            $fechaSalida = date_format(date_create($resumen['fecha_estimada_salida']), 'd/m/Y');
            $valorMercaderia = $resumen['valor_mercaderia'];
            $valorMercaderiaProveedor = $resumen['valor_mercaderia_proveedor'];
            $valorGastosProveedor = $resumen['valor_gastos_proveedor'];
            $valorGastosDistribuidor = $resumen['valor_gastos_distribuidor'];
            $valorAPagarAlProveedor = $valorMercaderiaProveedor - $valorGastosProveedor;
        endforeach; 
    }      
    
    $gastosDelProveedor = "";
    $gastosDelDistribuidor = "";
    
    if ($idCliente[0] != "")
        $FlagUnSoloCliente = 1;
    else
        $FlagUnSoloCliente = 0;
    
    if (!empty($lineasGastos[0]['id']))
    {
        foreach( $lineasGastos as $gastos ) : 
            $valorGasto = $gastos['precio_unitario']*$gastos['cantidad'];

            if ($gastos['a_cargo_del_proveedor']==1){
                $gastosDelProveedor = $gastosDelProveedor." ".$gastos['gasto'].": $".$valorGasto;
            }
            else {
                $gastosDelDistribuidor = $gastosDelDistribuidor." ".$gastos['gasto'].": $".$valorGasto;
            }

        endforeach; 
    }

    $sinProductos = 0;
    if (empty($lineasViaje[0]['numero_de_viaje']))
    {
        $titulo = "Viaje sin productos asociados. Para asignar productos al viaje debe ir a la pagina de creacion de viajes";
        $sinProductos = 1;
    }
    else
    {
        $titulo = "Viaje número ".$lineasViaje[0]['numero_de_viaje']." - Remito ".$lineasViaje[0]['numero_de_remito']." - ".$lineasViaje[0]['proveedor'];
        
        if ($lineasViaje[0]['id_estado'] == 7) /* El viaje ya tiene los precios acordados, por eso se ocultan los botones */ {
            $modo = "viajeConPrecioCerrado";
        }
    }             
?>          


<table  border=1 cellspacing=0 cellpadding=2 bordercolor="#666633" >
    <tr>
            <td>Valor total de la mercadería</td>
            <td>    
                    $<?php echo $valorMercaderiaProveedor ?>
            </td>
    </tr>
    <tr>
            <td>Valor total de los gastos a cargo del proveedor</td>
            <td>
                $<?php echo $valorGastosProveedor ?>
            </td>
    </tr>
    <tr>
            <td>Valor total de los gastos a cargo del distribuidor</td>
            <td>
                $<?php echo $valorGastosDistribuidor ?>
            </td>
    </tr>
    <tr>
            <td><b><i>Valor total a abonar al proveedor</i></b></td>
            <td>
                $<?php echo $valorAPagarAlProveedor ?>
            </td>
    </tr>


</table>          

    <div style="padding:10px;"></div>
    


    <style>
        /* cellpadding */
        th, td { padding: 5px; }

        /* cellspacing */
        table { border-collapse: separate; border-spacing: 5px; } /* cellspacing="5" */
        table { border-collapse: collapse; border-spacing: 0; }   /* cellspacing="0" */

        /* valign */
        th, td { vertical-align: top; }

        /* align (center) */
        table { margin: 0 auto; }
    
    </style>

    <table  border=1  cellpadding="10" bordercolor="#666633" >
    <tr>           
                                     
        <th>Fecha valorización</th>
        <th><span data-placement="bottom" data-toggle="tooltip" title="Producto que se entregó al cliente">Producto</span></th>
        <th><span data-placement="bottom" data-toggle="tooltip" title="Forma en que viene el producto, peso y tamaño del pallet">Envase</span></th>
        <th><span data-placement="bottom" data-toggle="tooltip" title="Forma en que viene el producto, peso y tamaño del pallet">Peso bulto</span></th>
        <th><span data-placement="bottom" data-toggle="tooltip" title="Forma en que viene el producto, peso y tamaño del pallet">Palletizado</span></th>
        <th  style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos"># Bultos </span></th>
        <th style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de pallets"># Pallets </span></th>
        <th style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos con merma"># Merma </span></th>
        <th style="vertical-align: middle;"> $ bulto </th>
        <th style="vertical-align: middle;"> $ total </th>
    </tr>
    
    
    <?php
        foreach( $lineasReparto as $reparto ) : 
       

            $precioSugerido = $reparto['precio_sugerido_caja'] == 0 ? $lineas['precio_sugerido_bulto'] : $reparto['precio_sugerido_caja'];    

        ?>  
            <tr class="warning">             
             
              <td> 
                <?php  

                    echo date_format(date_create($reparto['fecha_valorizacion']), 'd/m/Y');
               
                ?>
              </td> 
              <td align="rigth"> <?php echo $reparto['descripcion_producto'] ?> </td>
              <td align="rigth"> <?php echo $reparto['descripcion_envase'] ?> </td>
              <td align="rigth"> <?php echo $reparto['peso']." KG" ?> </td>
              <td align="rigth"> <?php echo $reparto['base_pallet']." x ".$reparto['altura_pallet'] ?> </td>
              <TD> <?php echo $reparto['cantidad_bultos'] ?> </TD> 
              <TD> <?php echo $reparto['cantidad_pallets'] ?></TD> 
              <TD> <?php echo $reparto['cant_bultos_merma'] ?> </TD> 
              <TD> <?php echo $reparto['precio_sugerido_caja'] ?> </TD> 
           

             

              <?php $precioTotalLinea = $reparto['precio_sugerido_caja'] * ( $reparto['cantidad_bultos'] - $reparto['cant_bultos_merma']); ?>
              
              <TD>   <?php echo $precioTotalLinea?></TD>
             

            </tr>
        <?php
        
        endforeach;
         ?>
   
    
    


</table>


</body>
</html>