<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('header') ?>
<head>
    <link rel="stylesheet" href="http://localhost/sikronk/assets/plugins/chosen_v1.2.0/docsupport/style.css">
    <link rel="stylesheet" href="http://localhost/sikronk/assets/plugins/chosen_v1.2.0/docsupport/prism.css">
    <link rel="stylesheet" href="http://localhost/sikronk/assets/plugins/chosen_v1.2.0/chosen.css">
    <title>Valorizar carga del viaje</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
      <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>sikronk</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://localhost/sikronk/assets/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 60px;
      padding-bottom: 40px;
      
    }
  </style>
  <!--<link rel="stylesheet" href="/assets/css/bootstrap-responsive.min.css">-->
  <link rel="stylesheet" href="http://localhost/sikronk/assets/css/main.css">

  <script src="http://localhost/sikronk/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    
    
    
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <meta charset="utf-8" />
    
    <link href="http://localhost/sikronk/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/sikronk/assets/plugins/jquery/validationEngine.jquery.css" rel="stylesheet">
    <script src="http://localhost/sikronk/assets/plugins/jquery/jquery.min.js"></script>
    <script src="http://localhost/sikronk/assets/plugins/jquery/jquery.numeric.js"></script>
	<script src="http://localhost/sikronk/assets/plugins/jquery/jquery.validationEngine.min.js"></script>
	<script src="http://localhost/sikronk/assets/plugins/jquery/jquery.validationEngine-es.js"></script>
    
        
        <script src="http://localhost/sikronk/assets/plugins/chosen_v1.2.0/chosen.jquery.js"></script>
        
        <script src="http://localhost/sikronk/assets/plugins/chosen_v1.2.0/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
	<script>
		jQuery(document).ready(function(){
			jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
		});
	</script>
        
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
        $titulo = "Valorizar viaje - Viaje número ".$lineasViaje[0]['numero_de_viaje']." - ".$lineasViaje[0]['proveedor'];
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
                                              <table id="tblprod" class="table table-hover table-bordered">
					  <thead>
                                                <tr>
                                                  <?php $cantidad=0; 
                                                  $id_producto_ant = 0;
                                                  $cantidad2 = 0;
                                                  
                                                  if ($sinProductos == 0)
                                                  {
                                                  ?>
                                                  
                                                  <th width="2%">#</th>
                                                  <th width="18%">Producto</th>
                                                  <th width="35%">Variable Logística</th>
                                                       
                                                        <th width="15%"># Bultos </th>
                                                        <th width="15%"> Precio x bulto [$] </th>
                                                        <th width="15%"> Precio total [$] </th>
                                                        <th width="15%" colspan="2"># Pallets </th>
                                                     
                                                </tr>
					  </thead>
					  <tbody>
                                          <?php 
                                           $cantidadLineasReparto = 0;
                                           foreach( $lineasViaje as $lineas ) : ?>    
						<?php $cantidad++; ?>
                                                    <tr class="success">
                                                      <td id="linea_<?php echo $cantidad?>" ><?php echo $cantidad?></td>
                                                      <td id="producto"><?php echo $lineas['producto'] ?></td>
                                                      <TD> <?php echo $lineas['codigo_vl']." - ".$lineas['vl']." - ".$lineas['peso']. "[KG] - Pallet:".$lineas['base_pallet']."x".$lineas['altura_pallet'] ?></TD>
                                                      <TD colspan="3"> <?php echo $lineas['cant_real_bultos'] ?> </TD> 
                                                      <TD colspan="2"> <?php echo $lineas['cant_real_pallets'] ?> </TD> 
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
                                                              <td colspan=3 align="rigth"> <b><?php echo $reparto['razon_social'] ?> </b></td>
                                                              <TD> <div class="cantidad_linea" id="DivBultos_<?php echo $cantidadLineasReparto?>" name="DivBultos_<?php echo $cantidadLineasReparto?>"> <?php echo $reparto['cantidad_bultos'] ?> </div> </TD> 
                                                   
                                                              <input type="hidden" id="bultos_<?php echo $cantidadLineasReparto?>" value=<?php echo $reparto['cantidad_bultos'] ?>>
                                            
                                                              <TD>  $ <input class="importe_linea" style="width:50px; text-align:right" id="precioBulto_<?php echo $cantidadLineasReparto?>" onChange="calculo(this.value,bultos_<?php echo $cantidadLineasReparto?>.value,'input#precioTotal_<?php echo $cantidadLineasReparto?>');" name="precioBulto[]" type="text" size="10" value="<?php echo $reparto['precio_caja'] ?>"> </TD>
                                                              <TD>  $ <input  type="text"  style="width:50px; text-align:right" id="precioTotal_<?php echo $cantidadLineasReparto?>" type="text" size="10" value="-">  </TD>
                                                              <TD colspan="2"> <?php echo $reparto['cantidad_pallets'] ?></TD> 
                                                  
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
					  </tbody>
                                </table>
					
					
                                            </div>
                                        </div>
                            <?php if ($sinProductos == 0) 
                                  {?>
                            <button id="btnsubmit" value="1" type="submit" class="btn btn-default">Guardar</button>
                            <button id="btnConfirmarPrecio" value="2" class="btn btn-success">Confirmar precio</button>
                            <input id="botonPresionado" type="hidden" value="botonGuardar" name="botonPresionado">
                            <?php }?>
                            
      </div>
            
            		</form>
		</div>
	</div>
 
<script type="text/javascript">


function calculo(cantidad,precio,inputtext){
	
	/* Parametros:
	cantidad - entero con la cantidad
	precio - entero con el precio
	inputtotal - nombre del elemento del formulario donde ira el total
	*/
	
	// Calculo del subtotal
	subtotal = precio*cantidad;
        
        $(inputtext).val(subtotal);
        //precioTotal_1.value = subtotal;
	
	//Actualizar el total
	// Utilizamos el eval. Ya que el valor es un texto y si lo tratamos como tal
	// es como si estuviesemos manipulando una cadena.
	//total = eval(totaltext.value);
	//totaltext.value = total + subtotal;
}
/*
$(document).on('change', '#precioBulto_1', function(){
    var precioDeLinea = 0;
 
    precioDeLinea = $('#bultos_1').html();
    
    precioDeLinea = $('input#precioBulto_1').val() * precioDeLinea;
    $('input#precioTotal_1').val(precioDeLinea);
});
*/


    
$(function() {
    var count = 1;
    jQuery("#miform").validationEngine({promptPosition : "centerRight:0,-5"});
	
   $(document).on("click","#btnadd",function( event ) {  
	  count++;
      $('#tblprod tr:last').after('<tr><td></td><td><div class="form-group col-lg-12">Cliente <select name="gonza"> <option value="COTO">COTO</option> <option value="CARREFOUR">Carrefour</option> <option value="Wallmart">Wallmart</option> </select></div></td><td><div class="form-group col-lg-12"><input class="form-control validate[required]" name="prod[]" /></div></td><td><div class="form-group col-lg-12"><input class="form-control validate[required]" name="prod2[]" /></div></td></tr>');
      event.preventDefault();
   });
   
   $(document).on("click","#btnadd2",function( event ) {  
       var cliente;
       var idCliente;
       
       var miBoton = $(this).attr('value');        
       
       var array = miBoton.split("_");
       
       var idProducto = array[0];
       var idVL = array[1];
       
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
                    '<td align="center">'+
                          '<button id="btnBorrar" class="btn btn-xs btn-danger"> - Cliente</button>'+
                    '</td>'+
                    '<td align="left" colspan="3">'
                          +combo+
                    '</td>'+
                    '<td colspan="2">'+
                        '<div>'+
                        '<input style="width:50px; text-align:right" name="bultos[]" />'+
                        '</div>'+
                    '</td>'+
                    '<td colspan="2">'+
                        '<div class="form-group col-lg-12">'+
                        '<input style="width:50px; text-align:right" name="pallets[]" />'+
                        '</div>'+
                    '</td>'
                    +hiddenProducto+hiddenViaje+hiddenVL+
                    '</tr>';
            
      $( event.target ).closest( "tr" ).after( fila );   
      
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
   
   $(document).on("click","#btnConfirmarPrecio",function( event ) {  
      
        $('input#botonPresionado').val("botonConfirmarPrecio").css('border','3px solid blue');
        
        //event.preventDefault();
   });
   
      
   $( "#miform" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
     
        if($('#miform').validationEngine('validate')){
	  $.post( "<?php echo base_url() ?>index.php/planificacion/grabarConfirmacionPrecio", formulario)
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
 
});
	</script>
 
</body>
</html>