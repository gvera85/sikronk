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
    
    <script src="<?php echo base_url() ?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.numeric.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.validationEngine.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.validationEngine-es.js"></script>
    <script src="<?php echo base_url() ?>assets/utils/utils.js"></script>
    
    <script src="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/chosen.jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/chosen_v1.2.0/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

    <script>
        jQuery(document).ready(function(){
                jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
        });
    </script>

    <style>
        .top-buffer { 
                margin-top:20px; 
        }

        body .panel-primary {
            /* new custom width */
            width:1024px;
            /* must be half of the width, minus scrollbar on the left (30px) */
            margin-left: -200px;
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
        $titulo = "Planificacion de viaje - Reparto de stock a los clientes. Viaje numero ".$lineasViaje[0]['numero_de_viaje']." - ".$lineasViaje[0]['proveedor'];
    }             
?>    

    
<div id="container ">
    <div class="row-fluid top-buffer">
        <div class="col-lg-6 col-lg-offset-3 text-center">
            <form id="miform" method="post" name="miform" >
	        <div class="panel panel-primary" width="100%">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $titulo  ?> </h3>
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
                                    <th width="5%">Acción</th>  
                                    <th width="2%">#</th>
                                    <th width="18%">Producto</th>
                                    <th width="35%">Variable Logística</th>
                                    <th width="15%"># bultos</th>
                                    <th width="15%"># pallets</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach( $lineasViaje as $lineas ) : ?>    
				<?php $cantidad++; ?>
                                <tr class="success">
                                    <td align="left"><button id="btnAgregarCliente" value="<?php echo $lineas['id_producto']."_".$lineas['id_vl']."_".$lineas['base_pallet']."_".$lineas['altura_pallet']?>" class="btn btn-xs btn-primary">+ Cliente</button></td>
                                    <td id="linea_<?php echo $cantidad?>" ><?php echo $cantidad?></td>
                                    <td id="producto"><?php echo $lineas['producto'] ?></td>
                                    <TD> <?php echo $lineas['codigo_vl']." - ".$lineas['vl']." - ".$lineas['peso']. "[KG] - Pallet:".$lineas['base_pallet']."x".$lineas['altura_pallet'] ?></TD>
                                    <TD> <?php echo $lineas['cantidad_bultos'] ?></TD>
                                    <TD> <?php echo $lineas['cantidad_pallets'] ?></TD>
                                    <input type="hidden" id="Viaje" name="Viaje" value="<?php echo $lineas['id_viaje'] ?>">
                                    <input type="hidden" id="DescProducto_<?php echo $lineas['id_producto'] ?>" name="DescProducto_<?php echo $lineas['id_producto'] ?>" value="<?php echo $lineas['producto'] ?>">
                                    <input type="hidden" id="cantBultos_<?php echo $lineas['id_producto'] ?>" name="cantBultos_<?php echo $lineas['id_producto'] ?>" value="<?php echo $lineas['cantidad_bultos'] ?>">
                                    <input type="hidden" id="VL" name="VL" value="<?php echo $lineas['id_vl'] ?>">
                                    <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                </tr>
                                <?php 
                                if (is_array($lineasReparto))
                                {
                                    foreach( $lineasReparto as $reparto ) : 
                                    if ($reparto['id_producto'] == $lineas['id_producto'] && $reparto['id_vl'] == $lineas['id_vl'])
                                    {
                                    ?>  
                                    <tr class="warning">
                                        <td></td>
                                        <td align="rigth"><button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button></td>
                                        <td colspan=2 align="rigth"><?php echo $reparto['razon_social'] ?></td>
                                        <TD> <?php echo $reparto['cant_bultos'] ?></TD>
                                        <TD> <?php echo $reparto['cant_pallets'] ?></TD>

                                        <input type="hidden" id="idProducto" name="idProducto[]" value=<?php echo $reparto['id_producto'] ?>>
                                        <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                        <input type="hidden" id="idCliente" name="comboClientes[]" value="<?php echo $reparto['id_cliente'] ?>">
                                        <input type="hidden" id="idVL" name="idVL[]" value="<?php echo $lineas['id_vl'] ?>">
                                        <input type="hidden" class="cantidad_bultos_<?php echo $reparto['id_producto'] ?>" id="idBultos" name="bultos[]" value="<?php echo $reparto['cant_bultos'] ?>">
                                        <input type="hidden" id="idPallets" name="pallets[]" value="<?php echo $reparto['cant_pallets'] ?>">
                                    </tr>
                                <?php
                                    }
                                    endforeach;
                                }?>
                                                    
                                <?php endforeach; 
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($sinProductos == 0) 
                {?>
                    <button id="btnsubmit" value="1" type="submit" class="btn btn-default">Guardar</button>
                    <button id="btnPlanificacion" value="2" class="btn btn-success">Confirmar planificacion</button>
                    <input id="botonPresionado" type="hidden" value="botonGuardar" name="botonPresionado">
                <?php 
                }?>
            </form>
        </div>    
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
       
       var descProducto = $("#DescProducto_"+idProducto).val();
       var cantBultos = $("#cantBultos_"+idProducto).val();
       
      // alert (idProducto);
       var hiddenProducto = '<input type="hidden" id="idProducto" name="idProducto[]" value='+idProducto+'>';
       
       var hiddenViaje = '<input type="hidden" id="idViaje" name="idViaje[]" value="'+$('input#Viaje').val()+'">';
       var hiddenVL = '<input type="hidden" id="idVL" name="idVL[]" value="'+idVL+'">';
       
       var combo = '<div>'+
                        '<select data-placeholder="Seleccione un cliente..." class="chosen-select" name="comboClientes[]" style="display: true;" tabindex="-1">'+
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
            '<td align="center">'+
                          '<button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button>'+
                    '</td>'+
                    '<td align="left" colspan="2">'
                          +combo+
                    '</td>'+
                    '<td>'+
                        '<div>'+ 
                        '<input id="cantBultos_'+nroLineaAgregada+'" name="bultos[]" type="text"  style="width:50px; text-align:right;" class="cantidad_bultos_'+idProducto+' numerico" onchange="validarBultos('+nroLineaAgregada+','+idProducto+',\'' + descProducto + '\','+cantBultos+','+basePallet+','+alturaPallet+',this)";>'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<div class="form-group col-lg-12">'+
                        //'<input id="cantPallets_'+nroLineaAgregada+'" name="pallets[]" type="text"  style="width:50px; text-align:right;"/>'+
                        '<input id="cantPallets_'+nroLineaAgregada+'" name="pallets[]" type="text" class="numerico" onchange="calcularCantidadBultos(this.value, '+basePallet+','+ alturaPallet+',cantBultos_'+nroLineaAgregada+');" style="width:50px; text-align:right;">'+
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
   
      
   $( "#miform" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
          
        if($('#miform').validationEngine('validate')){
	  $.post( "<?php echo base_url() ?>index.php/planificacion/grabarReparto", formulario)
		        .done(function(data){
		          alert(data);
			  $(frm)[0].reset();
                          location.reload();
			})
			.fail(function() {
                alert( "error no pude enviar los datos" );
			});
	  }
	  event.preventDefault();
	});
 
 
 
 </script>
 
</body>
</html>