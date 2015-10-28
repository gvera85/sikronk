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
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/jquery/validationEngine.jquery.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/estilosReparto.css">
    
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
        
    </style>
    
    <script type="text/javascript">
    $(document).ready(function(){
    for (i = 0; i < 10; i++) { 
           campoBultos = "#cantBultosViaje_" + i; 
           campoPallets = "#cantPalletsViaje_" + i;

           $(campoBultos).numeric();
           $(campoPallets).numeric();
        }
    });
    </script>

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
        $titulo = "Confirmación de viaje - Viaje número ".$lineasViaje[0]['numero_de_viaje']." - ".$lineasViaje[0]['proveedor'];
    }             
?>    

    
<div id="container ">
    <div class="row-fluid top-buffer text-center" style="padding: 10px;">
            <form id="miform" method="post" name="miform" >
	        <div class="panel panel-primary" width="100%">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $titulo  ?> </h3>
                    </div>
                        <div class="panel-body">
                            <table id="tblprod" class="table table-hover table-responsive table-condensed">
                            <thead>
                                <tr>
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
                                    <th width="15%" colspan="2"># bultos [est vs real]</th>
                                    <th width="15%" colspan="2"># pallets [est vs real]</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach( $lineasViaje as $lineas ) :   
                            $cantidad++; ?>
                            <tr class="success">
                                <td align="left"><button id="btnAgregarCliente" value="<?php echo $lineas['id_producto']."_".$lineas['id_vl']."_".$lineas['base_pallet']."_".$lineas['altura_pallet']."_".$cantidad?>" class="btn btn-xs btn-primary">+ Cliente</button></td>
                                <td id="linea_<?php echo $cantidad?>"><B><?php echo $cantidad?></B></td>
                                <td id="producto"><?php echo $lineas['producto'] ?></td>
                                <TD> <?php echo $lineas['codigo_vl']." - ".$lineas['vl']." - ".$lineas['peso']. "[KG] - Pallet:".$lineas['base_pallet']."x".$lineas['altura_pallet'] ?></TD>
                                <TD> <?php echo $lineas['cantidad_bultos'] ?> </TD> 
                                    <TD>  <input class="textBoxNumerico" id="cantBultosViaje_<?php echo $cantidad?>" name="cantBultosViaje[]" type="text" size="10" value="<?php echo ($lineas['cant_real_bultos'] == 0 ? $lineas['cantidad_bultos'] : $lineas['cant_real_bultos']) ?>" onChange="calcularCantidadPallets(this.value,<?php echo $lineas['base_pallet']?>, <?php echo $lineas['altura_pallet']?>, 'input#cantPalletsViaje_<?php echo $cantidad?>');"> </TD>
                                <TD> <?php echo $lineas['cantidad_pallets'] ?> </TD> 
                                    <TD>  <input class="textBoxNumerico" id="cantPalletsViaje_<?php echo $cantidad?>" name="cantPalletsViaje[]" type="text" size="10" value="<?php echo ($lineas['cant_real_pallets'] == 0 ? $lineas['cantidad_pallets'] : $lineas['cant_real_pallets']) ?>" onChange="calcularCantidadBultos(this.value,<?php echo $lineas['base_pallet']?>, <?php echo $lineas['altura_pallet']?>, 'input#cantBultosViaje_<?php echo $cantidad?>');" > </TD>
                                <input type="hidden" id="Viaje" name="Viaje" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="VL" name="VL" value="<?php echo $lineas['id_vl'] ?>">
                                
                                <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="idProductoViaje" name="idProductoViaje[]" value=<?php echo $lineas['id_producto']?>>
                                <input type="hidden" id="idViajeViaje" name="idViajeViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="DescProducto_<?php echo $lineas['id_producto'] ?>" name="DescProducto_<?php echo $lineas['id_producto'] ?>" value="<?php echo $lineas['producto'] ?>">
                                <input type="hidden" id="cantBultos_<?php echo $lineas['id_producto'] ?>" name="cantBultos_<?php echo $lineas['id_producto'] ?>" value="<?php echo $lineas['cantidad_bultos'] ?>">
                            </tr>
                            <?php 
                            if (is_array($lineasReparto))
                            {
                                foreach( $lineasReparto as $reparto ) : 
                                if ($reparto['id_producto'] == $lineas['id_producto'] && $reparto['id_variable_logistica'] == $lineas['id_vl'])
                                {
                                ?>  
                                <tr class="warning">
                                    <td></td>
                                    <td align="rigth"><button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button></td>
                                    <td colspan=2 align="rigth"> <?php echo $reparto['razon_social'] ?> </td>
                                    <TD colspan=2> <?php echo $reparto['cantidad_bultos'] ?></TD>
                                    <TD colspan=2> <?php echo $reparto['cantidad_pallets'] ?></TD>
                                    <input type="hidden" id="idProducto" name="idProducto[]" value=<?php echo $reparto['id_producto'] ?>>
                                    <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                    <input type="hidden" id="idCliente" name="comboClientes[]" value="<?php echo $reparto['id_cliente'] ?>">
                                    <input type="hidden" id="idVL" name="idVL[]" value="<?php echo $lineas['id_vl'] ?>">
                                    
                                    <input type="hidden" id="idPallets" name="pallets[]" value="<?php echo $reparto['cantidad_pallets'] ?>">
                                    <input type="hidden" class="cantidad_bultos_<?php echo $reparto['id_producto'] ?>" id="idBultos" name="bultos[]" value="<?php echo $reparto['cantidad_bultos'] ?>">
                                </tr>
                            <?php
                                }
                                endforeach;
                            }
                            endforeach; 
                            }?>
                            </tbody>
                            </table>
			</div>
                </div>
                <?php if ($sinProductos == 0) 
                      {?>
                <button id="btnsubmit" value="1" type="submit" class="btn btn-default">Guardar</button>
                <button id="btnCierreViaje" value="2" class="btn btn-success">Confirmar viaje</button>
                <input id="botonPresionado" type="hidden" value="botonGuardar" name="botonPresionado">
                <?php }?>
            </form>
    </div>
</div>
 
<script type="text/javascript">
    
function validarNumero()
{
        $(".numerico").each(
		function(index, value) {
                        
                    $(valor).numeric();
		}
	)
}    
    
$(function() {
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
       var numeroLinea = array[4];
       
       var descProducto = $("#DescProducto_"+idProducto).val();
       var cantBultos = $("#cantBultosViaje_"+numeroLinea).val();
       
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
       
       //alert (combo);
              
       var fila = '<tr class="active">'+
                    '<td></td>'+    
                    '<td align="center">'+
                          '<button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button>'+
                    '</td>'+
                    '<td align="left" colspan="2">'
                          +combo+
                    '</td>'+
                    '<td colspan="2">'+
                        '<div>'+
                        '<input id="cantBultos_'+nroLineaAgregada+'" class="cantidad_bultos_'+idProducto+' numerico" type="text" onchange="validarBultos('+nroLineaAgregada+','+idProducto+',\'' + descProducto + '\','+cantBultos+','+basePallet+','+alturaPallet+',this);" style="width:50px; text-align:right" name="bultos[]" >'+
                        '</div>'+
                    '</td>'+
                    '<td colspan="2">'+
                        '<div>'+
                        '<input id="cantPallets_'+nroLineaAgregada+'" name="pallets[]" type="text" class="numerico" onchange="calcularCantidadBultos(this.value, '+basePallet+','+ alturaPallet+',cantBultos_'+nroLineaAgregada+');" style="width:50px; text-align:right;">'+
                        '</div>'+
                    '</td>'
                    +hiddenProducto+hiddenViaje+hiddenVL+
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
            
           jQuery(document).ready(function() {
                jQuery('.numerico').keypress(function(tecla) {
                if(tecla.charCode < 48 || tecla.charCode > 57) return false;
                });
            });
    
            event.preventDefault();

   });
          
       
   $(document).on("click","#btnadd3",function( event ) {  
	  
      $( event.target ).closest( "tr" ).after
         ('<div>'+
          '<em>Into This</em>'+
          '<select data-placeholder="Elegir un pais..." class="chosen-select" id="combito" style="display: true;" tabindex="-1">'+
            '<option value=""></option>'+                                                                                                         
            '<option value="United States">United States</option>'+
            '<option value="United Kingdom">United Kingdom</option>'+
            '<option value="Afghanistan">Afghanistan</option>'+
            '<option value="Aland Islands">Aland Islands</option>'+            
          '</select>'+          
          '</div>');

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
                 
      //$('#combito').prop('disabled', true).trigger("liszt:updated");           

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
   
      //Nombre del controlador al que se envian los datos
   $( "#miform" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
          
          exito = false;
          mensaje = "error";
     
        
        $.post( "<?php echo base_url() ?>index.php/planificacion/grabarConfirmacionViaje", formulario)
                      .done(function(data){

                        swal("Guardada!", data, "success");
                
                        $(frm)[0].reset();
                        location.reload();

                        exito = true;
                        mensaje = data;

                      })
                      .fail(function() {
                          swal("Oops...", "Algo falló!", "error");
                      });
          
        event.preventDefault();
        
              
          
	});
        
});
	</script>
 
</body>
</html>
