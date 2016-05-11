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
    

  
    <style>
        /* cellpadding */
        th, td { padding: 2px; }

        /* valign */
        th, td { vertical-align: top; }

        /* align (center) */
            
        .arribaDerecha{
            float: right;
        }

        .tituloProveedor{
            font-weight: bold;
        }

        .filaCabeceraCeleste{
            background-color: #0092ef;
            color: white;
        }
        
        .filaCabeceraRoja{
            background-color: #ec4844;
            color: white;
        }

        .claseDistribuidor{
            background-color: red;
            color: white;
        }
        
    
    </style>
    
    
    
    
</head>
<body>
    
<?php
    $fechaImpresion = date("d/m/Y H:i:s"); //La fecha y hora de ejecuccion del "reporte"

    if (!empty($resumenViaje[0]['id']))
    {
        foreach( $resumenViaje as $resumen ) : 
            $idViaje = $resumen['id'];
            $nroViaje = $resumen['numero_de_viaje'];
            $fechaSalida = date_format(date_create($resumen['fecha_estimada_salida']), 'd/m/Y');
            $fechaLlegada = date_format(date_create($resumen['fecha_estimada_llegada']), 'd/m/Y');
            $valorMercaderia = $resumen['valor_mercaderia'];
            $valorMercaderiaProveedor = $resumen['valor_mercaderia_proveedor'];
            $valorGastosProveedor = $resumen['valor_gastos_proveedor'];
            $valorGastosDistribuidor = $resumen['valor_gastos_distribuidor'];
            $valorAPagarAlProveedor = $valorMercaderiaProveedor - $valorGastosProveedor;
        endforeach; 
    }   
    
    if (!empty($cabeceraProveedor[0]['id']))
    {
        foreach( $cabeceraProveedor as $cabecera ) : 
            $idViaje = $cabecera['id'];
            $nroViaje = $cabecera['numero_de_viaje'];
            $razonSocial = $cabecera['razon_social'];
            $direccionComercial = $cabecera['direccion_comercial'];
            $cuit = $cabecera['cuit'];
            $tipoIva = $cabecera['tipo_iva'];
            $provincia = $cabecera['provincia'];
            $localidad = $cabecera['localidad'];
            $remito = $cabecera['numero_de_remito'];
            $distribuidor = $cabecera['nombre_distribuidor'];
            $cuitDistribuidor = $cabecera['cuit_distribuidor'];
                    
        endforeach; 
    }  
    
    $existenGastosDelProveedor = 0;
    
    if (!empty($lineasGastos[0]['id']))
    {
        foreach( $lineasGastos as $gastos ) : 

            if ($gastos['a_cargo_del_proveedor'] == 1){
                $existenGastosDelProveedor = 1;
                break;//No recorro mas el cursor si al menos hay un gasto a cargodel proveedor
            }

        endforeach; 
    }

    $sinProductos = 0;
    if (empty($lineasViaje[0]['numero_de_viaje']))
    {
        $titulo = "Viaje sin productos asociados";
        $sinProductos = 1;
    }
?>        
    
<div style="padding:10px;">
     
    <div class="claseDistribuidor">
        <b><?php echo $distribuidor." - CUIT:".$cuitDistribuidor ?></b>
    </div>    
    <div style="padding:10px;"></div>
    

    <div>  
        <table  border=0 cellspacing=0 cellpadding=2 bordercolor="#666633" >
            
            <tr >
                    <td class="tituloProveedor">Proveedor</td>
                    <td>    
                            <?php echo $razonSocial ?>
                    </td>
                    <td class="tituloProveedor">Provincia</td>
                    <td>
                        <?php echo $provincia ?>
                    </td>
            </tr>
            <tr>
                    <td class="tituloProveedor">Localidad</td>
                    <td>
                        <?php echo $localidad ?>
                    </td>
                    <td class="tituloProveedor">Dirección</td>
                    <td>
                        <?php echo $direccionComercial ?>
                    </td>
            </tr>
            <tr>
                    <td class="tituloProveedor">CUIT</td>
                    <td>
                        <?php echo $cuit ?>
                    </td>
                     <td class="tituloProveedor">Tipo IVA</td>
                    <td>
                        <?php echo $tipoIva ?>
                    </td>
            </tr>
            
        </table> 
    </div>    

    <div style="padding:10px;"></div>
    
   
        <table  border=1 cellspacing=0 cellpadding=2 bordercolor="#666633" >
            <tr >
                    <td class="tituloProveedor">Id de viaje</td>
                    <td>
                        <?php echo $idViaje ?>
                    </td>
                    <td class="tituloProveedor">Numero de viaje</td>
                    <td>
                        <?php echo $nroViaje ?>
                    </td>
                    
            </tr>           
            <tr>
                    <td class="tituloProveedor">Remito</td>
                    <td>
                        <?php echo $remito ?>
                    </td>                   
                    <td class="tituloProveedor">Fecha arribo viaje</td>
                    <td>    
                            <?php echo $fechaLlegada ?>
                    </td>                    
            </tr> 
        </table> 
    
    
    <div style="padding:10px;"></div>

    
    <table border=1 cellspacing=0 cellpadding=2 bordercolor="#666633" >
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
                <td><b><i>Valor total a abonar al proveedor</i></b></td>
                <td>
                    $<?php echo $valorAPagarAlProveedor ?>
                </td>
        </tr>


    </table>          
    

    <div style="padding:10px;">Detalle de mercadería</div>

        <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000000" >
        <tr class="filaCabeceraCeleste">           

            <th>Producto</th>
            <th>Envase</th>
            <th>Peso bul</th>
            <th>Marca</th>
            <th>Desc</th>
            <th># Bultos </th>
            <th># Merma </th>
            <th> $ bulto </th>
            <th> $ total </th>
        </tr>


        <?php
            $totalPeso = 0;    
            $totalBultos = 0;
            $totalPallets = 0;
            $totalMerma = 0;
            $totalMonto = 0;
            foreach( $lineasReparto as $reparto ) : 


                //$precioSugerido = $reparto['precio_sugerido_caja'] == 0 ? $lineas['precio_sugerido_bulto'] : $reparto['precio_sugerido_caja'];    
                $precioPromedioBulto = $reparto['total_al_proveedor'] / ($reparto['total_bultos'] - $reparto['total_merma']);
                $precioPromedioBulto = round ($precioPromedioBulto, 2);

            ?>  
                <tr class="warning">             
                  <td align="rigth"> <?php echo $reparto['descripcion_producto'] ?> </td>
                  <td align="rigth"> <?php echo $reparto['descripcion_envase'] ?> </td>
                  <td align="rigth"> <?php echo $reparto['peso'] ?> </td>
                  <td align="rigth"> <?php echo $reparto['marca'] ?> </td>
                  <td align="rigth"> <?php echo $reparto['descripcion_vl'] ?> </td>
                  <TD> <?php echo $reparto['total_bultos'] ?> </TD> 
                  <TD> <?php echo $reparto['total_merma'] ?> </TD> 
                  <TD> <?php echo $precioPromedioBulto ?> </TD> 




                  <?php 
                        $precioTotalLinea = $reparto['total_al_proveedor'];//$reparto['precio_sugerido_caja'] * ( $reparto['cantidad_bultos'] - $reparto['cant_bultos_merma']); 

                        $totalPeso = $totalPeso +  $reparto['peso'];
                        $totalBultos = $totalBultos +  $reparto['total_bultos'];
                        $totalMerma = $totalMerma +  $reparto['total_merma'];
                        $totalMonto = $totalMonto +  $precioTotalLinea;
                        $totalMonto = $totalMonto;
                  ?>

                  <TD>   <?php echo $precioTotalLinea?></TD>


                </tr>
            <?php
            endforeach;
            ?>

            <tfoot>
            <tr style="font-weight: bold; ">
                <td colspan="2">Total</td>
                    <td><?php echo $totalPeso ?></td>
                    <td>-</td>                    
                    <td>-</td>
                    <td><?php echo $totalBultos ?></td>
                    <td><?php echo $totalMerma ?></td>
                    <td>-</td>
                    <td>$<?php echo round($totalMonto) ?></td>            
            </tr>
            </tfoot>
    </table>
    
    
    <?php
    if ($existenGastosDelProveedor)
    {
    ?>
        <div style="padding:10px;">Detalle de gastos</div>

        <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000000" >
            <thead>
                <tr class="filaCabeceraRoja">
                        <th>Proveedor</th>
                        <th>Gasto</th>
                        <th>Precio unitario</th>                                            
                        <th>Cantidad</th>                                            
                        <th>Precio total</th>                                                                
                        <th>Observaciones</th>                                            
                </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($lineasGastos[0]['id']))
            {
                foreach( $lineasGastos as $gastos ) :  

                    if ($gastos['a_cargo_del_proveedor'] == 1)
                    {    
                    ?>
                       <tr>
                           <td><?php echo $gastos['proveedor_del_servicio'] ?></td>
                           <td><?php echo $gastos['gasto'] ?></td>
                           <td>$<?php echo $gastos['precio_unitario'] ?></td>
                           <td><?php echo $gastos['cantidad'] ?></td>
                           <td>$<?php echo $gastos['precio_unitario'] * $gastos['cantidad'] ?></td>                       
                           <td><?php echo $gastos['observaciones'] ?></td>
                       </tr>
            <?php 
                    }
                endforeach; 
            }?>
            </tbody>
        </table>
    <?php
    }//Fin if ($existenGastosDelProveedor)
    ?>
    <div class="arribaDerecha">
        <b><?php echo "Fecha de impresión ".$fechaImpresion ?></b>
    </div>        

</div>        


    
</body>
</html>