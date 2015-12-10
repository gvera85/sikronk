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
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/jquery/validationEngine.jquery.css">

    <script src="<?php echo base_url() ?>/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/utils/utils.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.numeric.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.validationEngine.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.validationEngine-es.js"></script>
    

  
    <script type="text/javascript">
    $(document).ready(function(){
        
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
        
    </style>
    
</head>
<body onload="actualizarPrecioTotalViaje()">
    
<?php 
    $sinProductos = 0;
    if (empty($lineasViaje[0]['numero_de_viaje']))
    {
        $titulo = "Viaje sin productos asociados. Para asignar productos al viaje debe ir a la pagina de creacion de viajes";
        $sinProductos = 1;
    }
    else
    {
        $titulo = "Viaje número ".$lineasViaje[0]['numero_de_viaje']." - ".$lineasViaje[0]['proveedor'];
        
        if ($lineasViaje[0]['id_estado'] == 7) /* El viaje ya tiene los precios acordados, por eso se ocultan los botones */ {
            $modo = "viajeConPrecioCerrado";
        }
    }             
?>    
    
<div id="container ">
    <div class="row-fluid top-buffer text-center" style="padding: 10px;">
            <form id="formValorizacion" method="post" name="formValorizacion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $titulo  ?> <b><div id="precioTotalViaje" name="precioTotalViaje"> </div></b></h3>
                    </div>
                    <div class="panel-body">
                        <table id="tblprod" class="table table-hover table-responsive table-condensed">
                            <thead>
                                <tr class="active">
                                    <?php $cantidad=0; 
                                    $id_producto_ant = 0;
                                    $cantidad2 = 0;

                                    if ($sinProductos == 0)
                                    {
                                    ?>
                                        <th valign="middle" width="2%">#</th>
                                        <th valign="middle" width="10%">Producto</th>
                                        <th valign="middle" width="25%">Variable Logística</th>
                                        <th width="10%"># Bultos </th>
                                        <th width="10%"># Pallets </th>
                                        <th width="10%"># Bultos con merma </th>
                                        <th colspan="2" width="30%"> Valorización </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                             $cantidadLineasReparto = 0;
                             foreach( $lineasViaje as $lineas ) : ?>    
                                <?php $cantidad++; ?>
                                    <tr class="success">
                                        <td id="linea_<?php echo $cantidad?>" ><b><?php echo $cantidad?></b></td>
                                        <td id="producto"><?php echo $lineas['producto'] ?></td>
                                        <TD> <?php echo $lineas['codigo_vl']." - ".$lineas['vl']." - ".$lineas['peso']. "[KG] - Pallet:".$lineas['base_pallet']."x".$lineas['altura_pallet'] ?></TD>
                                        <TD> <?php echo $lineas['cant_real_bultos'] ?> </TD> 
                                        <TD> <?php echo $lineas['cant_real_pallets'] ?> </TD> 
                                        <TD> 0 </TD> 
                                        <TD> <b>Precio x bulto [$]</b> </TD> 
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
                                        ?>  
                                            <tr class="warning">
                                              <?php $cantidadLineasReparto++; ?>
                                              <td align="rigth"> </td>
                                              <td> 
                                                <?php    
                                                if ($modo == "edicion")
                                                {
                                                ?>
                                                   <input type="date" name="fechaValorizacion[]" value=<?php echo $reparto['fecha_valorizacion'] ?>> 
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
                                              
                                              <TD> <input class="cant_merma" style="width:50px; text-align:right" tabindex="<?php echo $cantidadLineasReparto?>" id="cant_merma_<?php echo $cantidadLineasReparto?>" onChange="validarCantidadMermaLinea(bultos_<?php echo $cantidadLineasReparto?>.value,  this.value, precioBulto_<?php echo $cantidadLineasReparto?>.value, this, 'input#precioTotal_<?php echo $cantidadLineasReparto?>');" name="cantMerma[]" type="text" size="10" value="<?php echo $reparto['cant_bultos_merma'] ?>"> </TD> 
                                              <TD>  $ <input class="importe_linea" style="width:50px; text-align:right" tabindex="<?php echo $cantidadLineasReparto?>" id="precioBulto_<?php echo $cantidadLineasReparto?>" onChange="calcularPrecioLinea(this.value,bultos_<?php echo $cantidadLineasReparto?>.value, cant_merma_<?php echo $cantidadLineasReparto?>.value, 'input#precioTotal_<?php echo $cantidadLineasReparto?>');" name="precioBulto[]" type="text" size="10" value="<?php echo $reparto['precio_caja'] ?>"> </TD>
                                              
                                              <?php
                                              }
                                              else
                                              {
                                              ?>
                                              
                                              <TD> <?php echo $reparto['cant_bultos_merma'] ?> </TD> 
                                              <TD>  <?php echo $reparto['precio_caja'] ?> </TD>
                                              
                                              <?php
                                              }
                                              ?>
                                              
                                              <?php $precioTotalLinea = $reparto['precio_caja'] * ( $reparto['cantidad_bultos'] - $reparto['cant_bultos_merma']); ?>
                                              <TD>  $ <input  class="importe_linea" type="text"  style="width:65px; text-align:right" id="precioTotal_<?php echo $cantidadLineasReparto?>" type="text" size="15" value="<?php echo $precioTotalLinea?>" readonly>  </TD>
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
                <?php if ($sinProductos == 0 && $modo == "edicion") 
                      {?>
                <button value="volverAStock" id="btnVolverAConfirmarViaje" class="btn btn-danger">Volver a confirmar viaje</button>
                <button id="btnsubmit" value="1" type="submit" class="btn btn-default">Guardar</button>
                <button id="btnConfirmarPrecio" value="2" class="btn btn-success">Confirmar precio</button>
                <input id="botonPresionado" type="hidden" value="botonGuardar" name="botonPresionado">
                <?php }?>
            </div>
        </form>    
</div>
 
<script type="text/javascript">

var hayError = 0;

function validacionFormulario() {
    
  cantidadItems = $("#cantidadItems").val();   
    
  for (i = 1; i <= cantidadItems; i++) { 
    campoBultos = "#bultos_" + i; 
    campoMerma = "#cant_merma_" + i; 
    
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
    
  }      
  
  return true;
}
    
function actualizarPrecioTotalViaje() {
    precioTotalViaje = 0;
    cantidad = $("#cantidadItems").val();
    for(i=1; i <= cantidad; i++)
    {
       inputPrecio = "input#precioTotal_"+i;
       precioTotalViaje += parseInt($(inputPrecio).val());
       $("#precioTotalViaje").html("Valor total del viaje: $"+precioTotalViaje);

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
        $(inputtext).val(subtotal);
        
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
    jQuery("#formValorizacion").validationEngine({promptPosition : "centerRight:0,-5"});

    $(document).on("click","#btnConfirmarPrecio",function( event ) {  
        $('input#botonPresionado').val("botonConfirmarPrecio").css('border','3px solid blue');
        
    });
    
    $(document).on("click","#btnVolverAConfirmarViaje",function( event ) {  
        var answer = confirm("¿Está seguro de que quiere volver a confirmar el stock del viaje?. Luego de aceptar se cerrará esta ventana y podrá ir al punto '3 - Confirmar viajes'")
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