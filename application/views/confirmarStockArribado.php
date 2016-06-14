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
        $titulo = "Confirmación de viaje - Viaje número ".$lineasViaje[0]['numero_de_viaje']." - Remito ".$lineasViaje[0]['numero_de_remito']." - ".$lineasViaje[0]['proveedor'];
        
        if ($lineasViaje[0]['id_estado'] != 11 && $lineasViaje[0]['id_estado'] != 3 && $lineasViaje[0]['id_estado'] != 2) /* El viaje ya tiene el stock confirmado. Debo eliminar los botones*/ {
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
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Número de línea">#</span></th>
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Producto que se pidió al proveedor">Producto</span></th></th>
                                    <th rowspan="2" style="vertical-align: middle;"><span data-placement="bottom" data-toggle="tooltip" title="Forma en que viene el producto, peso y tamaño del pallet">Presentación</span></th>
                                    <th colspan="2" style="vertical-align: middle; text-align: center"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos"># Bultos</span></th>
                                    <th colspan="2" style="vertical-align: middle; text-align: center"><span data-placement="bottom" data-toggle="tooltip" title="Cantidad de pallets"># Pallets</span></th>
                                </tr>
                                 <tr class="active">

                                    <th><div data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos que se pidieron al proveedor">Pedidos</div></th>
                                    <th><div data-placement="bottom" data-toggle="tooltip" title="Cantidad de bultos que se recibieron(puede diferir a la cantidad de bultos que se pidieron)">Arribados</div></th>
                                    <th><div data-placement="bottom" data-toggle="tooltip" title="Cantidad de pallets que se pidieron al proveedor">Pedidos</div></th>
                                    <th><div data-placement="bottom" data-toggle="tooltip" title="Cantidad de pallets que se recibieron (puede diferir a la cantidad de pallets que se pidieron)">Arribados</div></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach( $lineasViaje as $lineas ) :   
                            $cantidad++; ?>
                            <tr class="success">
                                    
                                <td id="linea_<?php echo $cantidad?>"><B><?php echo $cantidad?></B></td>
                                <td id="producto" align="left"><?php echo $lineas['producto'] ?></td>
                                <TD align="left"> <?php echo $lineas['marca']." - ".$lineas['vl']." - ".$lineas['tipo_envase']." - ".$lineas['peso']. "[KG]" ?></TD>
                                <TD> <?php echo $lineas['cantidad_bultos'] ?> </TD> 
                                <TD >   
                                    <?php 
                                    
                                    $cantBultos = $lineas['cant_real_bultos'] == 0 ? $lineas['cantidad_bultos'] : $lineas['cant_real_bultos'];
                                    $bultosRestantes = $cantBultos-$lineas['cant_repartida'];
                                    if ($modo == "edicion")
                                    {
                                    ?>    
                                        <span data-placement="bottom" data-toggle="tooltip" title="Ingrese la cantidad de bultos que se recibieron en el camión">
                                        <input type="number" required class="textBoxNumerico" id="cantBultosViaje_<?php echo $cantidad?>" name="cantBultosViaje[]" size="10" value="<?php echo ($lineas['cant_real_bultos'] == 0 ? $lineas['cantidad_bultos'] : $lineas['cant_real_bultos']) ?>" onChange="calcularCantidadPallets(this.value,<?php echo $lineas['base_pallet']?>, <?php echo $lineas['altura_pallet']?>, 'input#cantPalletsViaje_<?php echo $cantidad?>');">                                         
                                        </span>
                                    <?php
                                    }
                                    else
                                    {
                                         echo ($lineas['cant_real_bultos'] == 0 ? $lineas['cantidad_bultos'] : $lineas['cant_real_bultos']) ;
                                    }                                     
                                    ?>
                                    <span id="tdBultos_<?php echo $lineas['id_vl'] ?>"> </span>
                                </TD> 
                                <TD> <?php echo $lineas['cantidad_pallets'] ?> </TD> 
                                <TD>  
                                    
                                    <?php 
                                    if ($modo == "edicion")
                                    {
                                    ?>    
                                      <input type="number" required class="textBoxNumerico" id="cantPalletsViaje_<?php echo $cantidad?>" name="cantPalletsViaje[]" size="10" value="<?php echo ($lineas['cant_real_pallets'] == 0 ? $lineas['cantidad_pallets'] : $lineas['cant_real_pallets']) ?>" onChange="calcularCantidadBultos(this.value,<?php echo $lineas['base_pallet']?>, <?php echo $lineas['altura_pallet']?>, 'input#cantBultosViaje_<?php echo $cantidad?>');" > 
                                    <?php
                                    }
                                    else
                                    {
                                        echo ($lineas['cant_real_pallets'] == 0 ? $lineas['cantidad_pallets'] : $lineas['cant_real_pallets']) ;
                                    }
                                    ?>
                                </TD>
                                <input type="hidden" id="Viaje" name="Viaje" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="VL" name="VL[]" value="<?php echo $lineas['id_vl'] ?>">
                                
                                <input type="hidden" id="idViaje" name="idViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="idProductoViaje" name="idProductoViaje[]" value=<?php echo $lineas['id_producto']?>>
                                <input type="hidden" id="idViajeViaje" name="idViajeViaje[]" value="<?php echo $lineas['id_viaje'] ?>">
                                <input type="hidden" id="DescProducto_<?php echo $lineas['id_vl'] ?>" name="DescProducto_<?php echo $lineas['id_vl'] ?>" value="<?php echo $lineas['producto'] ?>">
                                <input type="hidden" id="cantBultos_<?php echo $lineas['id_vl'] ?>" name="cantBultos_<?php echo $lineas['id_vl'] ?>" value="<?php echo $lineas['cantidad_bultos'] ?>">
                            </tr>
                            <?php 
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
                <button id="botonCierreStock" value="2" class="btn btn-success" data-placement="rigth" data-toggle="tooltip" title="Si usted confirma el stock ya NO podrá modificar las cantidades arribadas">Confirmar stock</button>
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
   
   $(document).on("click","#botonCierreStock",function( event ) {  
      
        $('input#botonPresionado').val("botonCierreStock").css('border','3px solid blue');
        
        //event.preventDefault();
   });
   
      //Nombre del controlador al que se envian los datos
   $( "#miform" ).submit(function( event ) {
          var frm = $(this);
	  var formulario = $(this).serialize();
          
          if (validacionFormulario()){
         
                $.post( "<?php echo base_url() ?>index.php/planificacion/grabarConfirmacionStock", formulario)
                      .done(function(data){                
                        //alert(data);                
                        $(frm)[0].reset();
                        location.reload();
                        swal("Operación exitosa!", data, "success");
                      })
                      .fail(function(xhr, textStatus, errorThrown) {                          
                            //alert(errorThrown);
                            swal("Oops...", errorThrown, "error");
                      });
                  }
            event.preventDefault();
          
	});        
});

function validacionFormulario() 
{
  cantidadItems = $("#cantidadLineas").val();   
  
  return true;
}




	</script>
 
</body>
</html>
