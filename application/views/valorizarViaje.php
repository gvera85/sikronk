<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('header') ?>
<head>
    
    <title>sikronk - Valorizar carga del viaje</title>
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
    

  
    <script type="text/javascript">
    $(document).ready(function(){
       
       $('[data-toggle="popover"]').popover(); 
       $('[data-toggle="tooltip"]').tooltip()
        
       cantidad = $("#cantidadItems").val();

        for (i = 0; i <= cantidad; i++) { 
           campoBultos = "#precioBulto_" + i; 
           campoMerma = "#cant_merma_" + i;

           $(campoBultos).numeric();
           $(campoMerma).numeric();
        }
        
        
    });
    </script>
    
    
    
    <style>
        .top-buffer { 
                margin-top:20px; 
        }
        
        .panel-heading .accordion-toggle:after {
            /* symbol for "opening" panels */
            font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
            content: "\e114";    /* adjust as needed, taken from bootstrap.css */
            float: right;        /* adjust as needed */
            color: white;         /* adjust as needed */
        }
        .panel-heading .accordion-toggle.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\e080";    /* adjust as needed, taken from bootstrap.css */
        }
        
    </style>
    
</head>
<body onload="actualizarPrecioTotalViaje()">
    
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
    
<div id="container" style="padding: 10px;">
            <?php if ($modo != "edicion") { ?>
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo "Resumen ".$titulo  ?></a>
                        </h3>
                    </div>
                <div id="collapse1" class="panel-collapse collapse in">    
                    <div class="panel-body">
                        <table class="table compact table-striped" style="font-size:small; text-align: left">
                            <tr>
                                    <td>Valor total de la mercadería cobrada a los clientes</td>
                                    <td>    
                                            <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-success" style="font-size:small;" title="Valor total de la mercadería facturada a los clientes">$<?php echo $valorMercaderia ?></button>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Valor total de la mercadería adeudada al proveedor</td>
                                    <td>    
                                            <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-danger" style="font-size:small;" title="Valor total de la mercadería informada al proveedor">$<?php echo $valorMercaderiaProveedor ?></button>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Valor total de los gastos a cargo del proveedor</td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-danger" data-toggle="popover" title="Detalle de los gastos" data-content="<?php echo $gastosDelProveedor ?>">$<?php echo $valorGastosProveedor ?></a>
                                    </td>
                            </tr>
                            <tr>
                                    <td>Valor total de los gastos a cargo del distribuidor</td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-warning" data-toggle="popover" title="Detalle de los gastos" data-content="<?php echo $gastosDelDistribuidor ?>">$<?php echo $valorGastosDistribuidor ?></a>
                                    </td>
                            </tr>
                            <tr>
                                    <td><b><i>Valor total a abonar al proveedor</i></b></td>
                                    <td>
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-danger" style="font-size:small;" title="Es el valor total de la mercadería, restandole los gastos a cargo del proveedor">$<?php echo $valorAPagarAlProveedor ?></button>
                                    </td>
                            </tr>
                            <tr>                                
                                <TD colspan="2" style="text-align: center;"> 
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/imagenes/viaje').'/'.$idViaje?>')>                                     
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-info" style="font-size:small;" title="Imágenes relacionadas a este viaje (subidas por el usuario)">Ver imágenes</button>
                                    </a> 
                                </TD>
                            </tr>
                            <tr>                                
                                <TD colspan="2" style="text-align: center;"> 
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/generarPDFConf/dopdf').'/'.$idViaje?>')>                                  
                                    
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs btn-info" style="font-size:small;" title="Generar un comprobante en formato PDF">Comprobante PDF</button>
                                    </a> 
                                </TD>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>      
            <?}?>
            <form id="formValorizacion" method="post" name="formValorizacion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2"> <span id="precioTotalViaje" name="precioTotalViaje"> </span> </a>
                        </h3>
                        
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table id="tblprod" class="table compact table-striped table-hover table-condensed table-responsive">
                                <thead>
                                    <tr class="info">
                                        <?php $cantidad=0; 
                                        $id_producto_ant = 0;
                                        $cantidad2 = 0;

                                        if ($sinProductos == 0)
                                        {
                                        ?>
                                        <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Número de línea">#</span></th>
                                            <th><span data-placement="bottom" data-toggle="tooltip" title="Producto que se entregó al cliente">Producto</span></th>
                                            <th><span data-placement="bottom" data-toggle="tooltip" title="Forma en que viene el producto, peso y tamaño del pallet">Presentación</span></th>
                                            <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos"># Bultos </span></th>
                                            <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de pallets"># Pallets </span></th>
                                            <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos con merma"># Bultos con merma </span></th>
                                            <th colspan="3" rowspan="2" style="vertical-align: middle;"> Valorización </th>
                                    </tr>
                                    <tr class="info">
                                        
                                        <th>Fecha valorización</th>
                                        <th>Clientes</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                 $cantidadLineasReparto = 0;
                                 foreach( $lineasViaje as $lineas ) : 
                                    
                                    
                                    if ($lineas['precio_sugerido_bulto'] != 0)
                                        $toolTipPrecioSugerido = "Precio sugerido por el proveedor: ".$lineas['precio_sugerido_bulto']." por bulto";
                                    else
                                        $toolTipPrecioSugerido = "El proveedor no sugirió un precio para este producto";
                                        
                                 
                                    $cantidad++; ?>
                                        <tr class="danger">
                                            <td id="linea_<?php echo $cantidad?>" ><b><?php echo $cantidad?></b></td>
                                            <td id="producto"><?php echo $lineas['producto'] ?></td>
                                            <TD> <?php echo $lineas['codigo_vl']." - ".$lineas['vl']." - ".$lineas['peso']. "[KG] - Pallet:".$lineas['base_pallet']."x".$lineas['altura_pallet'] ?></TD>
                                            <TD> <span data-placement="bottom" data-toggle="tooltip" title="<?php echo $toolTipPrecioSugerido ?>"><?php echo $lineas['cant_real_bultos'] ?></span> </TD> 
                                            <TD> <?php echo $lineas['cant_real_pallets'] ?> </TD> 
                                            <TD> 0 </TD> 
                                            <TD> <b>Precio proveedor [$]</b> </TD> 
                                            <TD> <b>Precio cliente [$]</b> </TD> 
                                            <TD> <b>Precio total [$] </b> </TD> 
                                            <input type="hidden" id="Viaje" name="Viaje" value="<?php echo $lineas['id_viaje'] ?>">
                                            <input type="hidden" id="VL" name="VL" value="<?php echo $lineas['id_vl'] ?>">
                                            <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">

                                            <input type="hidden" id="idProductoViaje" name="idProductoViaje[]" value=<?php echo $lineas['id_producto']?>>
                                            <input type="hidden" id="idViajeViaje" name="idViajeViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                        </tr>

                                        <?php                                         
                                        if (is_array($lineasReparto))
                                        {
                                            foreach( $lineasReparto as $reparto ) : 
                                            if ($reparto['id_producto'] == $lineas['id_producto'] && $reparto['id_variable_logistica'] == $lineas['id_vl'])
                                            {
                                            
                                                $precioSugerido = $reparto['precio_sugerido_caja'] == 0 ? $lineas['precio_sugerido_bulto'] : $reparto['precio_sugerido_caja'];    
                                            
                                            ?>  
                                                <tr class="warning">
                                                  <?php $cantidadLineasReparto++; ?>
                                                  <td> </td>
                                                  <td> 
                                                    <?php    
                                                    if ($modo == "edicion")
                                                    {
                                                    ?>
                                                      <span data-placement="bottom" data-toggle="tooltip" title="Ingrese la fecha en la cual se acordó el precio de este producto con el cliente"> 
                                                      <input type="date" style="height:25px;" name="fechaValorizacion[]" max="<?php echo date("Y-m-d");?>" id="fecha_valor_html_<?php echo $cantidadLineasReparto?>" value=<?php echo $reparto['fecha_valorizacion'] ?>> 
                                                      </span>
                                                    <?php
                                                    }
                                                    else
                                                    {

                                                        echo date_format(date_create($reparto['fecha_valorizacion']), 'd/m/Y');
                                                    } 
                                                    ?>
                                                  </td> 
                                                  <td align="rigth"> <?php echo $reparto['razon_social'] ?> </td>
                                                  <TD> <div class="cantidad_linea" id="DivBultos_<?php echo $cantidadLineasReparto?>" name="DivBultos_<?php echo $cantidadLineasReparto?>"> <?php echo $reparto['cantidad_bultos'] ?> </div> </TD> 
                                                  <input type="hidden" id="bultos_<?php echo $cantidadLineasReparto?>" value=<?php echo $reparto['cantidad_bultos'] ?>>
                                                  <TD> <?php echo $reparto['cantidad_pallets'] ?></TD> 

                                                  <?php 

                                                  if ($modo == "edicion")
                                                  {
                                                  ?>

                                                  <TD>
                                                      <span data-placement="bottom" data-toggle="tooltip" title="Ingrese la cantidad de bultos de este producto que tuvieron merma (no aptos para la venta)"> 
                                                      <input class="cant_merma" style="width:50px; text-align:right" tabindex="<?php echo $cantidadLineasReparto?>" id="cant_merma_<?php echo $cantidadLineasReparto?>" onChange="validarCantidadMermaLinea(bultos_<?php echo $cantidadLineasReparto?>.value,  this.value, precioBulto_<?php echo $cantidadLineasReparto?>.value, this, 'div#precioTotal_<?php echo $cantidadLineasReparto?>');" name="cantMerma[]" type="text" size="10" value="<?php echo $reparto['cant_bultos_merma'] ?>"> 
                                                      </span>
                                                  </TD> 
                                                  <TD>
                                                      <span data-placement="bottom" data-toggle="tooltip" title="Ingrese el precio que se mostrará al proveedor">   
                                                      $ <input class="importe_sugerido" style="width:50px; text-align:right" tabindex="<?php echo $cantidadLineasReparto?>" id="precioSugerido_<?php echo $cantidadLineasReparto?>" name="precioParaElProveedor[]" type="text" size="10" value="<?php echo $precioSugerido ?>"> 
                                                      </span>
                                                  </TD>  
                                                  <TD>
                                                      <span data-placement="bottom" data-toggle="tooltip" title="Ingrese el precio acordado con el cliente">   
                                                      $ <input class="importe_linea" style="width:50px; text-align:right" tabindex="<?php echo $cantidadLineasReparto?>" id="precioBulto_<?php echo $cantidadLineasReparto?>" onChange="calcularPrecioLinea(this.value,bultos_<?php echo $cantidadLineasReparto?>.value, cant_merma_<?php echo $cantidadLineasReparto?>.value, 'div#precioTotal_<?php echo $cantidadLineasReparto?>');" name="precioBulto[]" type="text" size="10" value="<?php echo $reparto['precio_caja'] ?>"> 
                                                      </span>
                                                  </TD>

                                                  <?php
                                                  }
                                                  else
                                                  {
                                                  ?>

                                                  <TD> <?php echo $reparto['cant_bultos_merma'] ?> </TD> 
                                                  <TD> <?php echo $reparto['precio_sugerido_caja'] ?> </TD> 
                                                  <TD> <?php echo $reparto['precio_caja'] ?> </TD>

                                                  <?php
                                                  }
                                                  ?>

                                                  <?php $precioTotalLinea = $reparto['precio_caja'] * ( $reparto['cantidad_bultos'] - $reparto['cant_bultos_merma']); ?>
                                                  <!--<TD>  $ <input  class="importe_linea" type="text"  style="width:65px; text-align:right" id="precioTotal_<?php echo $cantidadLineasReparto?>" type="text" size="15" value="<?php echo $precioTotalLinea?>" readonly>  </TD>-->
                                                  <TD>   <div id="precioTotal_<?php echo $cantidadLineasReparto?>" value="<?php echo $precioTotalLinea?>"> <?php echo $precioTotalLinea?></div> </TD>
                                                  <input type="hidden" id="idProducto" name="idProducto[]" value=<?php echo $reparto['id_producto'] ?>>
                                                  <input type="hidden" id="idReparto" name="idReparto[]" value=<?php echo $reparto['id'] ?>>
                                                  <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                                  <input type="hidden" id="idCliente" name="comboClientes[]" value="<?php echo $reparto['id_cliente'] ?>">
                                                  <input type="hidden" id="idVL" name="idVL[]" value="<?php echo $lineas['id_vl'] ?>">
                                                  <input type="hidden" id="idBultos" name="bultos[]" value="<?php echo $reparto['cantidad_bultos'] ?>">
                                                  <input type="hidden" id="idPallets" name="pallets[]" value="<?php echo $reparto['cantidad_pallets'] ?>">

                                                </tr>
                                            <?php
                                            }
                                            endforeach;
                                            } ?>
                                  <?php endforeach; 
                                  }?>
                                                <input type="hidden" id="cantidadItems" name="cantidadItems" value="<?php echo $cantidadLineasReparto ?>">
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div>
                
                <?php if ($sinProductos == 0 && $modo == "edicion") 
                      {?>
                <div class="row-fluid top-buffer text-center" >
                    <?php if ($FlagUnSoloCliente == 0) {?>
                        <button value="volverAStock" id="btnVolverAConfirmarViaje" class="btn btn-danger" data-placement="left" data-toggle="tooltip" title="El viaje vuelve al estado anterior para poder modificar la cantidades recibidas">Volver a confirmar viaje</button>
                    <?php }?>
                    <button id="btnsubmit" value="1" type="submit" class="btn btn-default" data-placement="left" data-toggle="tooltip" title="Se guardarán los cambios y luego se podrá seguir modificando valores">Guardar</button>
                    <?php if ($FlagUnSoloCliente == 0) {?>
                        <button id="btnConfirmarPrecio" value="2" class="btn btn-success" data-placement="rigth" data-toggle="tooltip" title="Si usted confirma los precios ya NO podrá modificarlos">Confirmar precios</button>
                    <?php }?>
                    <input id="botonPresionado" type="hidden" value="botonGuardar" name="botonPresionado">
                </div>                    
                <?php }?>
            
        </form>    
</div>
 
<script type="text/javascript">

var hayError = 0;

function validacionFormulario() {
    
  cantidadItems = $("#cantidadItems").val();   
  
  botonPresionado = "#botonPresionado";
  
  if ($(botonPresionado).val() == "botonConfirmarPrecio")
  { 
        for (i = 1; i <= cantidadItems; i++) { 
          campoBultos = "#bultos_" + i; 
          campoMerma = "#cant_merma_" + i; 
          fecha = "#fecha_valor_html_" + i; 
          precioBulto = "#precioBulto_" + i; 

          nombreCampoMerma = "cant_merma_" + i; 

          //alert($(campoBultos).val() + ' '+ $(campoMerma).val());

          esValido = validarCantidadMerma($(campoBultos).val(), $(campoMerma).val() ) 

          if (esValido)
          {
              limpiarInputConError(nombreCampoMerma);

          }
          else
          {

              marcarInputConError(nombreCampoMerma);
              return false;  
          }

          /*Validar que las fechas sean todas distintas de vacio*/
          if ($(fecha).val() == null || $(fecha).val().length == 0)
          {
              mensaje = 'La fecha de valorizacion no puede ser vacia';

              swal("Atención...", mensaje, "error");

              marcarInputConError(fecha);
              return false;
          }
          else
          {
              limpiarInputConError(fecha);  
          }

          /*Validar que los campos bultos sean > 0 y vacios*/
          if ($(precioBulto).val() == null || $(precioBulto).val().length == 0 || $(precioBulto).val() <= 0)
          {
              mensaje = 'El precio debe ser mayor a 0 (cero)';

              swal("Atención...", mensaje, "error");

              marcarInputConError(precioBulto);
              return false;
          }
          else
          {
              limpiarInputConError(precioBulto);  
          }
        }
    }
  
  return true;
}
    
   
    
function actualizarPrecioTotalViaje() {
    precioTotalViaje = 0;
    cantidad = $("#cantidadItems").val();
    for(i=1; i <= cantidad; i++)
    {
       inputPrecio = "div#precioTotal_"+i;
       precioTotalViaje += parseInt($(inputPrecio).html());
       $("#precioTotalViaje").html("<?php echo $titulo ?> - Valor total de la mercadería: <span style='font-size:15px;' class='label label-success'> $"+precioTotalViaje+"</span>");
       
       

    }
}

function calcularPrecioLinea(precio, cantidad,  cantidadConMerma, inputtext){
	/* Parametros:
	cantidad - entero con la cantidad
	precio - entero con el precio
	inputtotal - nombre del elemento del formulario donde ira el total
	*/
	
	// Calculo del total de la linea
	subtotal = precio* (cantidad - cantidadConMerma);
        $(inputtext).html(subtotal);
        
        actualizarPrecioTotalViaje();
       // input#precioTotalViaje.val(4);
}

function validarCantidadMerma(cantidadBultosLinea,  cantidadConMerma){
	
    if (Number(cantidadBultosLinea) < Number(cantidadConMerma))
    {   
        mensaje = 'La cantidad con merma ['+ cantidadConMerma +'] no puede superar la cantidad de bultos ['+cantidadBultosLinea+']';
        
        swal("Atención...", mensaje, "error");
        
        return false;
    }
    
    return true;
}


function validarCantidadMermaLinea(cantidadBultosLinea,  cantidadConMerma, precio, inputMerma, inputPrecioTotal)
{
    if (!validarCantidadMerma (cantidadBultosLinea,  cantidadConMerma))
    {
        //alert('La cantidad con merma no puede superar la cantidad de bultos ['+cantidadBultosLinea+']');
        marcarInputConError(inputMerma);
        return false;
    }
    else
    {
        limpiarInputConError(inputMerma);  
    }
    
    calcularPrecioLinea(precio, cantidadBultosLinea, cantidadConMerma, inputPrecioTotal);
        
    return true;   
}
    
$(function() {
    var count = 1;

    $(document).on("click","#btnConfirmarPrecio",function( event ) {  
        $('input#botonPresionado').val("botonConfirmarPrecio").css('border','3px solid blue');        
    });
    
    $(document).on("click","#btnsubmit",function( event ) {  
        $('input#botonPresionado').val("botonGuardar").css('border','3px solid blue');        
    });
    
    $(document).on("click","#btnVolverAConfirmarViaje",function( event ) {  
        var answer = confirm("¿Está seguro de que quiere volver a confirmar el reparto del viaje?. Luego de aceptar se cerrará esta ventana y podrá ir al punto '4 - Reparto a clientes'")
        if (answer)
        {
            $('input#botonPresionado').val("btnVolverAConfirmarViaje").css('border','3px solid blue');
        }
        else
        {
            return false;
        }
        
        
    });
    
         
   $( "#formValorizacion" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
     
          if (validacionFormulario()){
             
	  $.post( "<?php echo base_url() ?>index.php/planificacion/grabarConfirmacionPrecio", formulario)
		        .done(function(data){
		         
                          if($('input#botonPresionado').val() ==  "btnVolverAConfirmarViaje")
                          {
                            alert(data);                  
                            close();
                          }
                  
			  $(frm)[0].reset();
                          location.reload();
			})
			.fail(function() {
                            alert( "error no pude enviar los datos" );
			});
	  }
	  event.preventDefault();
	});
 
});
</script>

</body>
</html>