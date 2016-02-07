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
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/docsupport/prism.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/chosen.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/jquery/validationEngine.jquery.css">
    
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.numeric.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.validationEngine.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.validationEngine-es.js"></script>
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
        $titulo = "Planificación de viaje - Reparto de productos a los clientes. Viaje numero ".$lineasViaje[0]['numero_de_viaje']." - ".$lineasViaje[0]['proveedor'];
         if ($lineasViaje[0]['id_estado'] != 1 && $lineasViaje[0]['id_estado'] != 2) /* El viaje ya tiene los precios acordados, por eso se ocultan los botones */ {
            $modo = "viajeConRepartoPlanificado";
        }
    }             
?>    

    
<div id="container ">
    <div class="row-fluid top-buffer text-center" style="padding: 10px;">
            <form id="miform" method="post" name="miform" >
	        <div class="panel panel-primary panel-responsive">
                    <div class="panel-heading" data-placement="bottom" data-toggle="tooltip" title="Mediante esta página usted puede planificar a que clientes desea repartir la mercadería. Recuerde que es solo una planificación, en el siguiente paso (confirmación del viaje) esta planificación puede modificarse">
                        <h3 class="panel-title" ><?php echo $titulo  ?> </h3>
                    </div>
                    <div class="panel-body">
                        
                        <table id="tblprod" class="table compact table-striped" style="font-size:small; text-align: left">    
                            <thead>
                                <tr class="active">
                                    <?php $cantidad=0; 
                                    $id_producto_ant = 0;
                                    $cantidadClientes = 0;

                                    if ($sinProductos == 0)
                                    {
                                    ?>
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Acciones disponibles">Acción</span></th>  
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Número de línea">#</span></th>
                                    <th><div data-placement="bottom" data-toggle="tooltip" title="Producto a ser repartido">Producto</div></th>
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Forma en que viene el producto, peso y tamaño del pallet">Presentación</span></th>
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos"># Bultos</span></th>
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de pallets"># Pallets</span></th>
                                </tr>
                                <tr class="active">

                                       <th><span data-placement="bottom" data-toggle="tooltip" title="Cliente al cual se le va realizar una entrega del producto">Cliente</span></th>
                                      


                                   </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach( $lineasViaje as $lineas ) : ?>    
				<?php $cantidad++; ?>
                                <tr class="success">
                                    <td align="left">
                                        <?php 
                                        if ($modo == "edicion")
                                        {
                                        ?>
                                            <button id="btnAgregarCliente" value="<?php echo $lineas['id_producto']."_".$lineas['id_vl']."_".$lineas['base_pallet']."_".$lineas['altura_pallet']?>" class="btn btn-xs btn-primary" data-placement="bottom" data-toggle="tooltip" title="Agregar un cliente al cual entregarle este producto">+ Cliente</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td id="linea_<?php echo $cantidad?>" ><?php echo $cantidad?></td>
                                    <td id="producto"><?php echo $lineas['producto'] ?></td>
                                    <TD> <?php echo $lineas['codigo_vl']." - ".$lineas['vl']." - ".$lineas['peso']. "[KG] - Pallet:".$lineas['base_pallet']."x".$lineas['altura_pallet'] ?></TD>
                                    <TD > <?php echo $lineas['cantidad_bultos'] ?> <span id="tdBultos_<?php echo $lineas['id_vl'] ?>">(<?php echo $lineas['cantidad_bultos']-$lineas['cant_bultos_plani'] ?> restantes)</span> </TD>
                                    
                                    
                                    <TD> <?php echo $lineas['cantidad_pallets'] ?></TD>
                                    <input type="hidden" id="Viaje" name="Viaje" value="<?php echo $lineas['id_viaje'] ?>">
                                    <input type="hidden" id="DescProducto_<?php echo $lineas['id_vl'] ?>" name="DescProducto_<?php echo $lineas['id_vl'] ?>" value="<?php echo $lineas['producto'] ?>">
                                    <input type="hidden" id="cantBultos_<?php echo $lineas['id_vl'] ?>" name="cantBultos_<?php echo $lineas['id_vl'] ?>" value="<?php echo $lineas['cantidad_bultos'] ?>">
                                    <input type="hidden" id="VL" name="VL" value="<?php echo $lineas['id_vl'] ?>">
                                    <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                </tr>
                                <?php 
                                if (is_array($lineasReparto))
                                {
                                    foreach( $lineasReparto as $reparto ) :                                     
                                    if ($reparto['id_producto'] == $lineas['id_producto'] && $reparto['id_vl'] == $lineas['id_vl'])
                                    {
                                        
                                        $cantidadClientes ++;
                                    ?>  
                                    
                                    <tr class="warning">
                                        <td></td>
                                        <td align="rigth">
                                            <?php                                               
                                            if ($modo == "edicion")
                                            {
                                            ?>
                                                <button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td colspan=2 align="rigth"><?php echo $reparto['razon_social'] ?></td>
                                        <TD> <?php echo $reparto['cant_bultos'] ?></TD>
                                        <TD> <?php echo $reparto['cant_pallets'] ?></TD>

                                        <input type="hidden" id="idProducto" name="idProducto[]" value=<?php echo $reparto['id_producto'] ?>>
                                        <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                        <input type="hidden" id="idCliente" name="comboClientes[]" value="<?php echo $reparto['id_cliente'] ?>">
                                        <input type="hidden" id="idVL" name="idVL[]" value="<?php echo $lineas['id_vl'] ?>">
                                        <input type="hidden" class="cantidad_bultos_<?php echo $reparto['id_vl'] ?>" id="idBultos" name="bultos[]" value="<?php echo $reparto['cant_bultos'] ?>">
                                        <input type="hidden" id="idPallets" name="pallets[]" value="<?php echo $reparto['cant_pallets'] ?>">
                                    </tr>
                                <?php
                                    }
                                    endforeach;
                                }?>
                                                    
                                <?php endforeach; 
                                }
                                ?>
                                <input type="hidden" id="cantidadLineas" name="cantidadLineas" value="<?php echo $cantidadClientes ?>">
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($sinProductos == 0 && $modo == "edicion") 
                {?>
                    <button id="btnsubmit" value="1" type="submit" class="btn btn-default" data-placement="left" data-toggle="tooltip" title="Se guardarán los cambios y luego se podrá seguir modificando valores">Guardar</button>
                    <button id="btnPlanificacion" value="2" class="btn btn-success" data-placement="rigth" data-toggle="tooltip" title="Al confirmar la planificación ya NO se podrá modificar y deberá pasar al siguiente estado '3 - Confirmar viajes'">Confirmar planificacion</button>
                    <input id="botonPresionado" type="hidden" value="botonGuardar" name="botonPresionado">
                <?php 
                }?>
            </form>
    </div>
</div>
 
<script type="text/javascript">
    


    var nroLineaAgregada = 0;

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
       
       var descProducto = $("#DescProducto_"+idVL).val();
       var cantBultos = $("#cantBultos_"+idVL).val();
       
       var nomCampoBultos = "#cantBultos_"+idVL;
       
      // alert (idProducto);
       var hiddenProducto = '<input type="hidden" id="idProducto" name="idProducto[]" value='+idProducto+'>';
       
       var hiddenViaje = '<input type="hidden" id="idViaje" name="idViaje[]" value="'+$('input#Viaje').val()+'">';
       var hiddenVL = '<input type="hidden" id="idVL" name="idVL[]" value="'+idVL+'">';
       
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
       
              
       var fila = '<tr class="active">'+
            '<td></td>'+        
            '<td>'+
                          '<button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button>'+
                    '</td>'+
                    '<td align="left" colspan="2">'
                          +combo+
                    '</td>'+
                    '<td>'+
                        '<div>'+ 
                        '<input id="cantBultos_'+nroLineaAgregada+'" name="bultos[]" type="text"  style="width:50px; text-align:right;" class="cantidad_bultos_'+idVL+' numerico" onchange="validarBultos('+nroLineaAgregada+','+idVL+',\'' + descProducto + '\',\''+nomCampoBultos+'\','+basePallet+','+alturaPallet+',this)";>'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<div class="form-group col-lg-12">'+
                        //'<input id="cantPallets_'+nroLineaAgregada+'" name="pallets[]" type="text"  style="width:50px; text-align:right;"/>'+
                        '<input id="cantPallets_'+nroLineaAgregada+'" name="pallets[]" type="text" class="numerico" onchange="calcularCantidadBultos2('+nroLineaAgregada+','+idVL+',\'' + descProducto + '\',\''+nomCampoBultos+'\',this.value, '+basePallet+','+ alturaPallet+',cantBultos_'+nroLineaAgregada+');" style="width:50px; text-align:right;">'+
                        '</div>'+
                    '</td>'
                    +hiddenProducto+hiddenViaje+hiddenVL+
                    '</tr>';
      
      $( event.target ).closest( "tr" ).after( fila );   
      
         var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'No se encuentra el cliente!'},
                '.chosen-select-width'     : {width:"95%"}
              }
              for (var selector in config) {
                $(selector).chosen(config[selector]);
              }
        
        //Para que solo se puedan ingresar numeros
        jQuery(document).ready(function() {
                jQuery('.numerico').keypress(function(tecla) {
                if(tecla.charCode < 48 || tecla.charCode > 57) return false;
                });
            });
              
            event.preventDefault();

   });

   $(document).on("click","#btnBorrar",function( event ) {  
      
        $( event.target ).closest( "tr" ).remove();

        event.preventDefault();
   });
   
   $(document).on("click","#btnPlanificacion",function( event ) {  
      
        $('input#botonPresionado').val("botonPlanificacion").css('border','3px solid blue');
        
        //event.preventDefault();
   });
   
      $(document).on("click","#btnsubmit",function( event ) {  
      
        $('input#botonPresionado').val("btnsubmit").css('border','3px solid blue');
        
        //event.preventDefault();
   });
   
   
   
      
   $( "#miform" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
          
        if (validacionFormulario()){
	  $.post( "<?php echo base_url() ?>index.php/planificacion/grabarReparto", formulario)
		        .done(function(data){
		          swal("Guardada!", data, "success");
			  $(frm)[0].reset();
                          location.reload();
			})
			.fail(function(xhr, textStatus, errorThrown) {
                
                        
                        swal("Oops...", errorThrown, "error");
			});
	  }
	  event.preventDefault();
	});
 
 
function validacionFormulario() 
{
    
  cantidadItems = $("#cantidadLineas").val();   
    
  for (i = 1; i <= nroLineaAgregada ; i++) { 
    bultos = "#cantBultos_" + i; 
    pallets = "#cantPallets_" + i; 
    cliente = "#cliente_" + i; 
    
    clienteId = "cliente_" + i; 
    
    
    nombreCampoCliente = "cliente_" + i; 
    
    if(document.getElementById(clienteId) !== null) /*La linea completa fue eliminada por el usuario*/
    {
        if ($(cliente).val() == null || $(cliente).val().length == 0)
        {   
            mensaje = 'El cliente no puede ser vacio';

            swal("Atención...", mensaje, "error");

            $(nombreCampoCliente).focus();

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
  
  return true;
  
  
}
 
 
 </script>
 
</body>
</html>
