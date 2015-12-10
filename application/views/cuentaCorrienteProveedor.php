<html lang="es">
    <?php 
        $this->load->view('header');
    ?>
<head>
    <title>sikronk - Cuenta corriente del cliente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css">

    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/plugins/jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>/assets/bootstrap/js/dataTablesBootstrap.js"></script>
    
    <script type="text/javascript" charset="utf-8">
    
            $(document).ready(function() {
                
                    var t = $('#example').DataTable( {   
                                        "order": [[1,"desc"], [2,"desc"]],
                                         "columnDefs": [
                                            {
                                                "targets": [ 0 ],
                                                "visible": true,
                                                "searchable": false
                                            },
                                            {
                                                "targets": [ 2 ],
                                                "visible": false,
                                                "searchable": false
                                            }
                                        ],
                                        "language": {
                                                        "url": "<?php echo base_url() ?>/assets/bootstrap/json/SpanishDataTable.json"
                                                    }
                                        

                                    } );
                                    
                                    
                    saldo = $("#idSaldo").val();
                    
                    if (saldo >= 0)
                        classSaldo = 'label label-success';
                    else
                        classSaldo = 'label label-danger';
                        
                     
                
                    $("#cabeceraPanel").html($("#cabeceraPanel").html()+' - Saldo: <span class="' +classSaldo+ '" style="font-size:15px;" id="tipoMovimiento">$ '+saldo+'</span>' ); 
            } );
            
            
            
            
            $(document).on("click","#btnAgrupado",function( event ) {  

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo base_url().'index.php/cuentaCorrienteCliente/cargarLineasCC'; ?>",
                    data: "id_publicacion=<?php echo "1"; ?>",
                    success: function(data){
                                                //alert(data.facturasClientes);    
                                                
                                                for(i=0; i < data.length; i++){
                                                    alert(data[i].facturasClientes);
                                                }
                                           }
                });
            });
            
           
                    
    </script>
    
</head>
<body>        
    
     <?php 
          foreach( $proveedor as $i_proveedor ) :
                $nombreProveedor = $i_proveedor['razon_social']; 
               
        endforeach; 
    ?>    
   
    <div class="container">
        
        <?php 
            if (empty($facturasProveedor[0]['id_viaje']))
            {
                $titulo = "Productos sin valorizar - No hay productos sin valorizar";
                $sinProductos = 0;
            }
            else
            {
                $titulo = "Productos sin valorizar";
                $sinProductos = 1;
            }             
        ?>    
        

        <div class="panel panel-primary">
        
        <div class="panel-heading" id="cabeceraPanel"> Cuenta corriente <?php echo $nombreProveedor ?>
        
        
        </div>
        <div class="panel-body">
            
        <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <TR>
                    <th><b>Tipo</b></th>
                    <th><b>Fecha</b></th>
                    <th><b>Stamp</b></th>
                    <th><b>Nro Viaje</b></th>                    
                    <th><b>Debe</b></th>                    
                    <th><b>Haber</b></th>                    
                    <th><b>Saldo parcial</b></th>   
                  
                </TR>
                </thead>
                
                <tbody>
                <?php 
                
                    $saldo = 0;
                    
                
                    if ($sinProductos == 1)
                    {

                        foreach( $facturasProveedor as $lineas ) :     
                            
                        $debe = $lineas['debe'];
                        $haber = $lineas['haber'];

                        $saldo = $saldo +  $haber - $debe;     
                        
                        if ($lineas['tipo'] == 'Pago') {
                            $classTipo = 'label label-success';
                        } else if ($lineas['tipo'] == 'Deuda'){
                            $classTipo = "label label-danger";
                        } else if ($lineas['tipo'] == 'Gasto'){
                            $classTipo = "label label-default";
                        }
                        
                    ?>
                    <TR>
                            <TD> <span class="<?php echo $classTipo ?>" id="tipoMovimiento"> <?php echo $lineas['tipo'] ?></span></TD>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['fecha_estimada_llegada']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['fecha_estimada_llegada']), 'd/m/Y'); ?></td>
                            <td><span style='display: none;'><?php echo date_format(date_create($lineas['stamp']), 'YmdHis'); ?></span><?php echo date_format(date_create($lineas['stamp']), 'd/m/Y H:i:s'); ?></td>
                            
                            <?php
                            if ($lineas['numero_de_viaje'])
                            {   
                            ?>
                                <TD> 
                                    <a href=javascript:window.open('<?php echo base_url('/index.php/planificacion/verViaje').'/'.$lineas['id_viaje']; ?>')> 
                                        <span class="label label-info" id="nroViaje"> <?php echo $lineas['numero_de_viaje'] ?> </span> 
                                    </a> 
                                </TD>
                            <?php
                            }
                            else
                            {   
                            ?>
                                <TD> 
                                        <?php echo $lineas['numero_de_viaje'] ?>
                                </TD>    
                            <?php
                            }
                            ?>    
                            <TD> <?php echo $debe ?></TD>
                            <TD> <?php echo $haber ?></TD>
                            <TD> <?php echo $saldo ?></TD>
                            
                <?php           
                    endforeach; 
                }
                ?>
                    
                <input type="hidden" name="idSaldo" id="idSaldo" value=<?php echo $saldo ?>>
                   
                        
                </tbody>    
            </table>
             </div>
        </div>     
        
  </div>  
   
    
  <script type="text/javascript">     
      
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-hover table-bordered table-compact');        
      
  </script>  

</body>
</html>