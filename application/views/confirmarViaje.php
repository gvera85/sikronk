<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('header') ?>
<head>
    <title>sikronk - Reparto de stock a los clientes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <!--<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/docsupport/style.css">-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/docsupport/prism.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/chosen.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/estilosReparto.css">
    
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/bootstrap/js/bootstrap.js"></script>
    
    <script src="<?php echo base_url() ?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.numeric.js"></script>
    
    <script src="<?php echo base_url() ?>assets/utils/utils.js"></script>
    
    <script src="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/chosen.jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

    <script>
        jQuery(document).ready(function(){
                jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
                
                $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <style>
        .top-buffer { 
                margin-top:20px; 
        }
        
    </style> 
    

</head>
</head>
<body>
<?php 
    $sinProductos = 0;
    if (empty($lineasViaje[0]['numero_de_viaje']))
    {
        $titulo = "Viaje sin productos asociados. Para asignar productos al viaje debe ir a la pagina de creacion de viajes";
        $sinProductos = 1;
    }
    else
    {
        $titulo = "Reparto del viaje - Viaje número ".$lineasViaje[0]['numero_de_viaje']." - Remito ".$lineasViaje[0]['numero_de_remito']." - ".$lineasViaje[0]['proveedor'];
        
        if ($lineasViaje[0]['id_estado'] != 12 && $lineasViaje[0]['id_estado'] != 4) /* El viaje ya tiene los precios acordados, por eso se ocultan los botones */ {
            $modo = "viajeCerrado";
        }
    }             
?>    

    
<div id="container ">
    <div class="row-fluid top-buffer text-center" style="padding: 10px;">
            <form id="miform" method="post" name="miform" >
                
                <div class="panel panel-primary" width="100%">
                    <div class="panel-heading" data-placement="bottom" data-toggle="tooltip" title="Mediante esta página usted debe confirmar las cantidades recibidas de cada producto y además confirmar como se reparte el stock a cada cliente">
                        <h3 class="panel-title"><?php echo $titulo  ?> </h3>
                    </div>
                        <div class="panel-body">
                            <div class="table-responsive">        
                            <table id="tblprod" class="table compact table-striped table-bordered" style="font-size:small; text-align: left">    
                            <thead>
                                <tr class="active">
                                    <?php $cantidad=0; 
                                    $id_producto_ant = 0;
                                    $cantidad2 = 0;
                                    $cantidadClientes = 0;

                                    if ($sinProductos == 0)
                                    {
                                    ?>
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Acciones disponibles">Acción</span></th>  
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Número de línea">#</span></th>
                                    <th><span data-placement="bottom" data-toggle="tooltip" title="Producto que se pidió al proveedor">Producto</span></th></th>
                                    <th style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Forma en que viene el producto, peso y tamaño del pallet">Presentación</span></th>
                                                                        <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Precio sugerido por el proveedor">Precio sugerido</span></th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos"># Bultos</span></th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de pallets"># Pallets</span></th>
                                </tr>
                                 <tr class="active">

                                     <th><div data-placement="bottom" data-toggle="tooltip" title="Ingresar la fecha en que se entrega el producto al cliente">Fecha de reparto</div></th>  
                            <th><div data-placement="bottom" data-toggle="tooltip" title="Cliente al cual se le va realizar una entrega del producto">Cliente</div></th>
                                       
                                       
                                   </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach( $lineasViaje as $lineas ) :   
                            $cantidad++; ?>
                            <tr class="success">
                                <td align="left">
                                     <?php 
                                        if ($modo == "edicion")
                                        {
                                        ?>
                                            <button id="btnAgregarCliente" value="<?php echo $lineas['id_producto']."_".$lineas['id_vl']."_".$lineas['base_pallet']."_".$lineas['altura_pallet']."_".$cantidad?>" class="btn btn-xs btn-primary" data-placement="rigth" data-toggle="tooltip" title="Agregar un cliente al que se quiera repartir este producto">+ Cliente</button>
                                        <?php
                                        }
                                        ?>
                                </td>    
                                    
                                <td id="linea_<?php echo $cantidad?>"><B><?php echo $cantidad?></B></td>
                                <td id="producto" align="left"><?php echo $lineas['producto'] ?></td>
                                <TD align="left"> <?php echo $lineas['marca']." - ".$lineas['vl']." - ".$lineas['tipo_envase']." - ".$lineas['peso']. "[KG]" ?></TD>
                                <TD> <?php echo "$". $lineas['precio_sugerido_bulto'] ?></TD>
                                <TD > 
                                    <?php 
                                    $cantBultos = $lineas['cant_real_bultos'] == 0 ? $lineas['cantidad_bultos'] : $lineas['cant_real_bultos'];
                                    $bultosRestantes = $cantBultos-$lineas['cant_repartida'];
                                    
                                    echo $cantBultos ?> 
                                    <span id="tdBultos_<?php echo $lineas['id_vl'] ?>"> <?php echo "(".$bultosRestantes." restantes)" ?> </span>
                                    
                                    <input type="hidden" id="cantBultosViaje_<?php echo $cantidad ?>" value="<?php echo $cantBultos ?>">
                                </TD> 
                                 
                                <TD> <?php echo $lineas['cantidad_pallets'] ?> </TD> 
                               
                                <input type="hidden" id="Viaje" name="Viaje" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="VL" name="VL[]" value="<?php echo $lineas['id_vl'] ?>">
                                
                                <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="idProductoViaje" name="idProductoViaje[]" value=<?php echo $lineas['id_producto']?>>
                                <input type="hidden" id="idViajeViaje" name="idViajeViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="DescProducto_<?php echo $lineas['id_vl'] ?>" name="DescProducto_<?php echo $lineas['id_vl'] ?>" value="<?php echo $lineas['producto'] ?>">
                                <input type="hidden" id="cantBultos_<?php echo $lineas['id_vl'] ?>" name="cantBultos_<?php echo $lineas['id_vl'] ?>" value="<?php echo $lineas['cantidad_bultos'] ?>">
                            </tr>
                            <?php 
                            if (is_array($lineasReparto))
                            {
                                foreach( $lineasReparto as $reparto ) : 
                                    
                                $tagImagenPago = "";
                                if ($reparto['cant_pagos'] != 0)
                                {
                                    $tagImagenPago = "<span data-placement='bottom' data-toggle='tooltip' title='El cliente ya abonó esta línea'>"
                                            . "<img style='max-width: 20px;' src='". base_url() ."/assets/img/lineaPagada.png'> </img>"
                                            . "</span>";
                                }    
                                    
                                if ($reparto['id_producto'] == $lineas['id_producto'] && $reparto['id_variable_logistica'] == $lineas['id_vl'])
                                {
                                     $cantidadClientes ++;
                                ?>  
                                <tr class="warning">
                                    <td></td>
                                    <td align="left">
                                        <?php                                               
                                        if ($modo == "edicion" && $reparto['cant_pagos']=="0")
                                        {
                                        ?>
                                            <button id="btnBorrar" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Botón para eliminar a este cliente"> - Cliente</button>
                                        <?php
                                        }
                                        
                                        if ($reparto['cant_pagos']!="0")
                                        {
                                        ?>
                                            
                                            <div data-placement="bottom" data-toggle="tooltip" title="No se puede modificar este reparto porque ya fue abonado por el cliente"><button disabled class="btn btn-xs btn-danger"> - Cliente</button></div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td style="vertical-align: middle; text-align: center">
                                        <?php    
                                                if ($modo == "edicion" && $reparto['cant_pagos']=="0")
                                                {
                                                ?>
                                                    <span data-placement="bottom" data-toggle="tooltip" title="Ingrese la fecha en la cual entregó este producto al cliente">
                                                    <input type="date" style="height:25px;" name="fechaReparto[]" max="<?php echo date("Y-m-d");?>" id="fecha_reparto_html_<?php echo $cantidadClientes?>" value=<?php echo $reparto['fecha_reparto'] ?>> 
                                                    </span>
                                                <?php
                                                }
                                                else
                                                {                                                    
                                                    if ($reparto['cant_pagos']!="0")
                                                    {?>
                                                        <span data-placement="bottom" data-toggle="tooltip" title="No se puede modificar la fecha">
                                                        <input type="date" style="height:25px;" readonly name="fechaReparto[]" max="<?php echo date("Y-m-d");?>" id="fecha_reparto_html_<?php echo $cantidadClientes?>" value=<?php echo $reparto['fecha_reparto'] ?>> 
                                                        </span>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        $f_reparto  = empty($reparto['fecha_reparto']) ? NULL : $reparto['fecha_reparto'];

                                                        if (!is_null($f_reparto))                                                    
                                                            echo date_format(date_create($reparto['fecha_reparto']), 'd/m/Y');
                                                        else
                                                            echo "Sin fecha";
                                                    }
                                                } 
                                        ?> 
                                    
                                    </td>
                                    <td style="vertical-align: middle; text-align: center"> <?php echo $reparto['razon_social']. $tagImagenPago ?> </td>
                                    <td> </td>
                                    <TD style="vertical-align: middle; text-align: center"> <?php echo $reparto['cantidad_bultos'] ?></TD>
                                    <TD style="vertical-align: middle; text-align: center"> <?php echo $reparto['cantidad_pallets']  ?></TD>
                                    <input type="hidden" id="idProducto" name="idProducto[]" value=<?php echo $reparto['id_producto'] ?>>
                                    <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                    <input type="hidden" id="idCliente" name="comboClientes[]" value="<?php echo $reparto['id_cliente'] ?>">
                                    <input type="hidden" id="idVL" name="idVL[]" value="<?php echo $lineas['id_vl'] ?>">
                                    <input type="hidden" id="cantPagos" name="cantPagos[]" value="<?php echo $reparto['cant_pagos'] ?>">
                                    
                                    
                                    
                                    
                                    <input type="hidden" id="idPallets" name="pallets[]" value="<?php echo $reparto['cantidad_pallets'] ?>">
                                    <input type="hidden" class="cantidad_bultos_<?php echo $reparto['id_variable_logistica'] ?>" id="idBultos" name="bultos[]" value="<?php echo $reparto['cantidad_bultos'] ?>">
                                </tr>
                            <?php
                                }
                                endforeach;
                            }
                            endforeach; 
                            }?>
                            <input type="hidden" id="cantidadLineas" name="cantidadLineas" value="<?php echo $cantidadClientes ?>">
                            </tbody>
                            </table>
                            </div>    
			</div>
                </div>
                <?php if ($sinProductos == 0 && $modo == "edicion") 
                      {?>
                <button id="btnsubmit" value="1" type="submit" class="btn btn-default" data-placement="left" data-toggle="tooltip" title="Se guardarán los cambios y luego se podrá seguir modificando valores">Guardar</button>
                <button id="btnCierreViaje" value="2" class="btn btn-success" data-placement="rigth" data-toggle="tooltip" title="Si usted confirma el viaje ya NO podrá modificar las cantidades repartidas">Confirmar reparto</button>
                <input id="botonPresionado" type="hidden" value="botonGuardar" name="botonPresionado">
                <?php }?>
            </form>
    </div>
</div>
 
<script type="text/javascript">

var nroLineaAgregada = 0;

function validarNumero()
{
        $(".numerico").each(
		function(index, value) {
                        
                    $(valor).numeric();
		}
	)
}  


    
$(function() {
    
        
   $(document).on("click","#btnAgregarCliente",function( event ) {  
       var cliente;
       var idCliente;
       
       nroLineaAgregada++;
       
       var miBoton = $(this).attr('value');        
       
       var array = miBoton.split("_");
       
       var idProducto = array[0];
       var idVL = array[1];
       var basePallet = array[2];
       var alturaPallet = array[3];
       var numeroLinea = array[4];
       
       var descProducto = $("#DescProducto_"+idVL).val();
       var cantBultos = $("#cantBultosViaje_"+numeroLinea).val();
       
       var nomCampoBultos = "#cantBultosViaje_"+numeroLinea;
       
      // alert (idProducto);
       var hiddenProducto = '<input type="hidden" id="idProducto" name="idProducto[]" value='+idProducto+'>';
       
       var hiddenViaje = '<input type="hidden" id="idViaje" name="idViaje[]" value="'+$('input#Viaje').val()+'">';
       var hiddenVL = '<input type="hidden" id="idVL" name="idVL[]" value="'+idVL+'">';
       var hiddenPago = '<input type="hidden" id="cantPagos" name="cantPagos[]" value="0">';
       
       var combo = '<div>'+
                        '<select data-placeholder="Seleccione un cliente..." class="chosen-select" name="comboClientes[]" style="display: true;" tabindex="-1" id="cliente_'+nroLineaAgregada+'">'+
                          '<option value=""></option>';
    
       <?php
       foreach( $clientes as $cliente ) : ?> 
           idCliente = <?php echo $cliente['id'] ?>;
           cliente = '<?php echo $cliente['razon_social'] ?>';
           combo = combo+'<option value="'+idCliente+'"> '+cliente+'</option>';
           
       <?php endforeach; ?>
       
       combo = combo + '</select> </div>';
       
       //alert (combo);
              
       var fila = '<tr class="warning">'+
                    '<td></td>'+    
                    '<td> <span data-placement="bottom" data-toggle="tooltip" title="Botón para eliminar a este cliente">'+
                          '<button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button>'+
                    '</span></td>'+
                    '<td align="center"> ' +
                    '<span data-placement="bottom" data-toggle="tooltip" title="Ingrese la fecha en la cual entregó este producto al cliente">' +
                    '<input required type="date" style="height:25px;" name="fechaReparto[]" max="<?php echo date("Y-m-d");?>" id="fecha_reparto_'+nroLineaAgregada+'"> '+
                    '</span> </td>'+
                    '<td align="center" colspan="1"> <span data-placement="bottom" data-toggle="tooltip" title="Seleccione el cliente al que quiere entregarle mercadería">'
                          +combo+
                    '</span></td>'+
                    '<td>'+
                    '</td>'+
                    '<td align="center">'+
                        '<div >'+
                        '<input type="number" data-placement="bottom" data-toggle="tooltip" title="Ingrese la cantidad de bultos a entregar a este cliente" id="cantBultos_'+nroLineaAgregada+'" class="cantidad_bultos_'+idVL+' numerico" onchange="validarBultos('+nroLineaAgregada+','+idVL+',\'' + descProducto + '\',\''+nomCampoBultos+'\','+basePallet+','+alturaPallet+',this);" style="width:50px; text-align:right" name="bultos[]" >'+
                        '</div>'+
                    '</td>'+
                    '<td align="center">'+
                        '<div>'+
                        '<input type="number" id="cantPallets_'+nroLineaAgregada+'" name="pallets[]" class="numerico" onchange="calcularCantidadBultos2('+nroLineaAgregada+','+idVL+',\'' + descProducto + '\',\''+nomCampoBultos+'\',this.value, '+basePallet+','+ alturaPallet+',cantBultos_'+nroLineaAgregada+');" style="width:50px; text-align:right;">'+
                        '</div>'+
                    '</td>'
                    +hiddenProducto+hiddenViaje+hiddenVL+hiddenPago+
                    '</tr>';
            
      $( event.target ).closest( "tr" ).after( fila );   
      
      //alert(fila);
      
         var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
              }
              for (var selector in config) {
                $(selector).chosen(config[selector]);
              }
              
            $('[data-toggle="tooltip"]').tooltip();              
            
           jQuery(document).ready(function() {
                jQuery('.numerico').keypress(function(tecla) {
                if(tecla.charCode < 48 || tecla.charCode > 57) return false;
                });
            });
    
            event.preventDefault();

   });

   $(document).on("click","#btnBorrar",function( event ) {  
      
        $( event.target ).closest( "tr" ).remove();
        
        //alert($('#linea_3').html());
        
        //alert($( event.target ).closest( "td" ).html());
        var trs=$("#tblprod td").length;
        
        //alert (trs);
        
        var total=0;
        
        //valor2 = $("#tblprod tr").find('linea_1').html();
        
        //alert(valor2);
 
        //selector >>  $("#GridView1 tr").find('td:eq(1)')
        //De esta manera utilizando eq seleccionamos la segunda fila, ya que la primera es 0
        $("#tblprod tr").find('td:eq(1)').each(function () {

         //obtenemos el valor de la celda
          valor = $(this).html();

         //sumamos, recordar parsear, si no se concatenara.
         total += parseInt(valor)
        })

        //mostramos el total
        //alert(total)

        event.preventDefault();
   });
   
   $(document).on("click","#btnCierreViaje",function( event ) {  
      
        $('input#botonPresionado').val("botonCierreViaje").css('border','3px solid blue');
        
        //event.preventDefault();
   });
   
   $(document).on("click","#btnsubmit",function( event ) {  
      
        $('input#botonPresionado').val("botonGuardar");
        
        //event.preventDefault();
   });
   
      //Nombre del controlador al que se envian los datos
   $( "#miform" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
          
          if (validacionFormulario()){
         
                $.post( "<?php echo base_url() ?>index.php/planificacion/grabarConfirmacionViaje", formulario)
                      .done(function(data){
                
                        $(frm)[0].reset();
                        location.reload();

                        swal("Guardada!", data, "success");
                        //alert(data);

                      })
                      .fail(function(xhr, textStatus, errorThrown) {
                          swal("Oops...", errorThrown, "error");
                      });
                  }
            event.preventDefault();
          
	});
        
});

function validacionFormulario() 
{
    
  cantidadItems = $("#cantidadLineas").val();   
  
  /*Valido todas las lineas agregadas en tiempo de ejecucion*/
  for (i = 1; i <= nroLineaAgregada ; i++) { 
    fecha = "#fecha_reparto_" + i; 
    fechaid = "fecha_reparto_" + i; 
    cliente = "#cliente_" + i; 
    bultos = "#cantBultos_" + i; 
    pallets = "#cantPallets_" + i; 
    
    botonPresionado = "#botonPresionado";
    
    
    
    if(document.getElementById(fechaid) !== null) /*La linea completa fue eliminada por el usuario*/
    {
        if ($(fecha).val() == null || $(fecha).val().length == 0 )
        {
            mensaje = 'La fecha de reparto agregada no puede ser vacia';

            swal("Atención...", mensaje, "error");

            marcarInputConError(fecha);
            return false;
        }
        else
        {
            limpiarInputConError(fecha);  
        }

        if ($(cliente).val() == null || $(cliente).val().length == 0)
        {   
            mensaje = 'Debe seleccionar un cliente';
            swal("Atención...", mensaje, "error");
            return false;
        }

        if ($(bultos).val() == null || $(bultos).val().length == 0 || $(bultos).val() <= 0)
        {
            mensaje = 'La cantidad de bultos debe ser mayor a 0 (cero)';

            swal("Atención...", mensaje, "error");

            marcarInputConError(bultos);
            return false;
        }
        else
        {
            limpiarInputConError(bultos);  
        }
    }
    
    
  }     
  
  /*Valido todas las lineas que ya existian en BD */
  for (i = 1; i <= cantidadItems ; i++) { 
    fecha = "#fecha_reparto_html_" + i; 
    fechaid = "fecha_reparto_html_" + i; 
    nombreCampoFecha = "fecha_reparto_html_" + i; 
    
    if(document.getElementById(fechaid) !== null) /*La linea completa fue eliminada por el usuario*/
    {
        if ($(fecha).val() == null || $(fecha).val().length == 0 && $(botonPresionado).val()=="botonCierreViaje")
        {
            mensaje = 'La fecha de reparto no puede ser vacia';

            swal("Atención...", mensaje, "error");

            marcarInputConError(fecha);
            return false;
        }
        else
        {
            limpiarInputConError(fecha);  
        }
    } //Fin if(document.getElementById(fechaid) !== null)
  }
  
  return true;
}




	</script>
 
</body>
</html>
