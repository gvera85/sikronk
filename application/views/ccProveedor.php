<!DOCTYPE html>
<html lang="en">
<head>
	<?php         
            ini_set('date.timezone', 'America/Argentina/Buenos_Aires');                     
            $this->load->view('headerProv');
        ?>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/moment.min.js"></script>  
        <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/datetime-moment.js"></script>  
		
</head>

<body>
    <?php         
                $this->load->view('menuSuperiorProv');
    ?>
<div class="container-fluid-full">
<div class="row-fluid">				
    <?php         
        $this->load->view('menuLateral');
    ?>
    <!-- start: Content -->
    <div id="content" class="span10">


    <ul class="breadcrumb">
            <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo base_url() ?>index.php/reportes/homeProveedor">Home</a> 
                    <i class="icon-angle-right"></i>
            </li>
            <li><a href="#"><?php echo $this->session->userdata('ruta') ?></a></li>
    </ul>
    
     <?php 
            foreach( $proveedor as $i_proveedor ) :
                $nombreProveedor = $i_proveedor['razon_social']; 
               
            endforeach; 
        
            /*El controlador me envia los datos filtrados en estos vectores*/
            $fechaFiltroDesde = $filtros['fecha_desde'];
            $fechaFiltroHasta = $filtros['fecha_hasta'];
            $idProveedorFiltro = $filtros['id_proveedor'];
            $saldoTotal = $saldo['saldo_total'];
            $fechaEjecucion = $filtros['fecha_ejecucion'];
                    
            if (empty($facturasProveedor[0]['tipo']))
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
        <div class="row-fluid">	
            <div class="box span12">
        <div class="box-header">
                <h2><i class="halflings-icon plus"></i><span class="break"></span><?php echo "Filtros" ?> </h2>
                <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                </div>
        </div>
        <div class="box-content">
                <form id="formFiltros" method="post" action="<?php echo base_url() ?>index.php/cuentaCorrienteProveedor/getCCProveedorPorFiltro/<?php echo $idProveedorFiltro ?>/ccProveedor" name="formFiltros">

                <table class="table compact" cellspacing="0" width="100%" style="font-size:small; text-align: left; ">
                    <tr>
                            <td>Fecha desde</td>
                            <td>    
                                <input style="height:25px; width: 150px; border-color: red;" required type="date" name="fecha_desde" id="fecha_desde" value="<?php echo $fechaFiltroDesde ?>">
                            </td>
                                <td>Fecha hasta</td>
                            <td>
                                <input style="height:25px; width: 150px;" required type="date" name="fecha_hasta"  id="fecha_hasta" value="<?php echo $fechaFiltroHasta ?>">
                            </td>
                    </tr>
                     <tr>
                         <td colspan="4" style="text-align: center; ">    

                                    <input type="submit" class="btn btn-success" value="Filtrar">
                         </td>
                    </tr>
                </table>
        
                </form>
        </div>	
        </div><!--/span-->
        </div>
                
        <div class="row-fluid">	
            <div class="box-header" >
                <h2><i class="halflings-icon plus"></i><span class="break"></span><span id="cabeceraPanel"></span></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    </div>
            </div>
        </div>
    
        <div class="row-fluid">	
            <div class="box-content">
            
            <table id="example" class="display responsive" cellspacing="0" width="100%" style="font-size:small; border-color: #000;">    
                <thead>
                <TR>
                    <th><b>Tipo</b></th>
                    <th><b>Fecha</b></th>
                    <th><b>Stamp</b></th>
                    <th><b>#Viaje</b></th>                    
                    <th><b>Debe</b></th>                    
                    <th><b>Haber</b></th>                    
                    <th><b>Saldo parcial</b></th>   
                  
                </TR>
                </thead>
                
                <tbody>
                <?php 
                    if ($sinProductos == 1)
                    {

                        foreach( $facturasProveedor as $lineas ) :     
                            
                        $debe = $lineas['debe'];
                        $haber = $lineas['haber'];
                      
                        $linkHaciaDetalles = "#";        
                        
                        if ($lineas['tipo'] == 'Pago') {
                            $classTipo = 'label label-success';
                            $linkHaciaDetalles = base_url('/index.php/detallesEntidades/verPagoEnPaginaProveedor/'.$lineas['id_linea']); 
                        } else if ($lineas['tipo'] == 'Deuda'){
                            $classTipo = "label label-danger";
                            $linkHaciaDetalles = base_url('/index.php/reportes/detalleViaje/'.$lineas['id_viaje']); 
                        } else if ($lineas['tipo'] == 'Gasto'){
                            $classTipo = "label label-default";
                        }
                    ?>
                    <TR>
                            <TD> 
                                <a href=<?php echo $linkHaciaDetalles;?> >
                                <span class="<?php echo $classTipo ?>" id="tipoMovimiento"> <?php echo $lineas['tipo'] ?></span>
                                </a>
                            </TD>
                            <td><?php echo date_format(date_create($lineas['fecha_estimada_llegada']), 'd/m/Y'); ?></td>
                            <td><?php echo date_format(date_create($lineas['stamp']), 'd/m/Y H:i:s'); ?></td>
                            
                            <?php
                            if ($lineas['numero_de_viaje'])
                            {   
                            ?>
                                <TD>
                                    <a href="<?php echo base_url('/index.php/reportes/detalleViaje').'/'.$lineas['id_viaje']; ?>"> 
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
                            <TD style="background-color: #F1ABAB;"> <?php echo $debe ?></TD>
                            <TD style="background-color: #B7E4B7;"> <?php echo $haber ?></TD>
                            <TD> <?php echo $lineas['saldo_parcial'] ?></TD>
                            
                <?php           
                    endforeach; 
                }
                ?>
                    
                <input type="hidden" name="idSaldo" id="idSaldo" value=<?php echo $saldoTotal ?>>
                <input type="hidden" name="empresaEvaluada" id="empresaEvaluada" value="<?php echo $nombreProveedor ?>">
                <input type="hidden" name="fecha_desde_hidden" id="fecha_desde_hidden" value="<?php echo date_format(date_create($fechaFiltroDesde), 'd/m/Y') ?>">
                <input type="hidden" name="fecha_hasta_hidden" id="fecha_hasta_hidden" value="<?php echo date_format(date_create($fechaFiltroHasta), 'd/m/Y') ?>">
                <input type="hidden" name="fecha_ejecucion_hidden" id="fecha_ejecucion_hidden" value="<?php echo date_format(date_create($fechaEjecucion), 'd/m/Y H:i:s') ?>">   
                        
                </tbody>    
            </table>
        </div>
        </div>

</div><!--/.fluid-container-->	
<!-- end: Content -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->
	
<?php         
    $this->load->view('footerProv');
?>	
	
</body>
</html>    

<script type="text/javascript" charset="utf-8">
        
        $(document).ready(function() {
            
                   $.fn.dataTable.moment( 'DD/MM/YYYY' ); 
                
                   var table = $('#example').DataTable({
                        "pagingType": "full_numbers",
                        "displayLength": 25,
                        "scrollCollapse": true,
                        "order": [[ 1, 'desc' ], [2,'asc']],        
                        "columnDefs": [
                                            {
                                                "targets": [ 0 ],
                                                "visible": true,
                                                "searchable": true
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
                    });
                
                    
                                    
                                    
                    saldo = $("#idSaldo").val();
                    
                    if (saldo >= 0)
                        classSaldo = 'label label-success';
                    else
                        classSaldo = 'label label-danger';
                
                    $("#cabeceraPanel").html($("#cabeceraPanel").html()+'Saldo actual: <span class="' +classSaldo+ '" style="font-size:15px;" id="tipoMovimiento">$ '+saldo+'</span>' ); 
            } );
            
            
            
            
            $.fn.dataTable.moment = function ( format, locale ) {
                    var types = $.fn.dataTable.ext.type;

                    // Add type detection
                    types.detect.unshift( function ( d ) {
                        return moment( d, format, locale, true ).isValid() ?
                            'moment-'+format :
                            null;
                    } );

                    // Add sorting method - use an integer for the sorting
                    types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
                        return moment( d, format, locale, true ).unix();
                    };
                };
                    
            
           
                    
    </script>

