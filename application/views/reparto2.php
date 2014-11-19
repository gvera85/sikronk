<!DOCTYPE html>
<html lang="es">
<head>
    <title>Repartos</title>
    
    
    <!--
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-es.js"></script>
	<style>
		.top-buffer { 
			margin-top:20px; 
		}
	</style>
    
</head>
<body> 
 
</head>
<body>
<div id="container ">
	<div class="row-fluid top-buffer">
		<div class="col-lg-6 col-lg-offset-3 text-center">
			<form id="miform" method="post" name="miform" >
				
                                        
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">Planificacion de viaje - Reparto de stock a los clientes</h3>
                                            </div>
                                            <div class="panel-body">
                                              <table id="tblprod" class="table table-hover table-bordered">
					  <thead>
                                                <tr>
                                                  <th>Producto</th>
                                                  <th>Presentacion</th>
                                                  <th>Cantidad bultos</th>
                                                  <th>Cantidad pallets</th>
                                                </tr>
					  </thead>
					  <tbody>
                                          <?php 
                                           foreach( $lineasViaje as $lineas ) : ?>    
						<tr>
						  <td><?php echo $lineas['producto'] ?></td>
						  <TD> <?php echo $lineas['vl']." - ".$lineas['peso']. "[KG]" ?></TD>
                                                  <TD> <?php echo $lineas['cantidad_bultos'] ?></TD>
                                                  <TD> <?php echo $lineas['cantidad_pallets'] ?></TD>
                                                  <input type="hidden" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                                  <input type="hidden" name="idProducto[]" value="<?php echo $lineas['id_producto'] ?>">
                                                  <input type="hidden" name="idVL[]" value="<?php echo $lineas['id_vl'] ?>">
						</tr>
                                                <tr>
                                                    <td align="left" colspan="4"><button id="btnadd2" class="btn btn-xs btn-primary">+ Cliente</button></td>
                                                </tr>
                                        <?php endforeach; ?>
					  </tbody>
                                </table>
					
					
                                            </div>
                                        </div>
                            <button id="btnsubmit" type="submit" class="btn btn-success">Guardar</button>
			</form>
		</div>
	</div>
</div>
 
<script type="text/javascript">

  
    
$(function() {
    var count = 1;
    jQuery("#miform").validationEngine({promptPosition : "centerRight:0,-5"});
	
   $(document).on("click","#btnadd",function( event ) {  
	  count++;
      $('#tblprod tr:last').after('<tr><td></td><td><div class="form-group col-lg-12">Cliente <select name="gonza"> <option value="COTO">COTO</option> <option value="CARREFOUR">Carrefour</option> <option value="Wallmart">Wallmart</option> </select></div></td><td><div class="form-group col-lg-12"><input class="form-control validate[required]" name="prod[]" /></div></td><td><div class="form-group col-lg-12"><input class="form-control validate[required]" name="prod2[]" /></div></td></tr>');
      event.preventDefault();
   });
   
   $(document).on("click","#btnadd2",function( event ) {  
       
       var combo = 'Cliente <select name="comboClientes[]">';
       var cliente;
       var idCliente;
       var contador = 1;
       
       <?php 
       foreach( $clientes as $cliente ) : ?> 
           
           idCliente = <?php echo $cliente['id'] ?>;
           cliente = '<?php echo $cliente['razon_social'] ?>';
           combo = combo+'<option value="'+idCliente+'"> '+cliente+'</option>';
           
       <?php endforeach; ?>
       
       combo = combo + '</select>';
       
       //alert (combo);
       
       var fila = '<tr>\n\
                    <td align="left" colspan="2">\n\
                        <div class="form-group col-lg-12">'
                          +combo+
                        '</div>\n\
                    </td>\n\
                    <td>\n\
                        <div class="form-group col-lg-12">\n\
                        <input class="form-control " name="bultos[]" />\n\
                        </div>\n\
                    </td>\n\
                    <td>\n\
                        <div class="form-group col-lg-12">\n\
                        <input class="form-control " name="pallets[]" />\n\
                        </div>\n\
                    </td>\n\
                  </tr>';
      
      contador++;
      $( event.target ).closest( "tr" ).after( fila );      
            event.preventDefault();

   });
   
      
   $( "#miform" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
	  
	  if($('#miform').validationEngine('validate')){
	  $.post( "<?php echo base_url() ?>index.php/planificacion/grabarReparto", formulario)
		        .done(function(data){
		          alert(data);
			  $(frm)[0].reset();
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