<!DOCTYPE html>
<html lang="en">
<?php 
        $this->load->view('headerProveedor');
?>    

	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>sikronk</title>
	<meta name="description" content="sikronk">
	<meta name="author" content="Gonzalo Vera">
	<meta name="keyword" content="Metro, Metro UI, frutas, reportes, reparto, logistica, mercado, central">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	
        
        <link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/responsive.dataTables.min.css">
        
        
        
	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/dataTables.responsive.min.js"></script>
        
	<script type="text/javascript" class="init">

            $(document).ready(function() {
                    $('#example').DataTable();
            } );

	</script>
    


       
		
</head>

<body>
       
		
                        <!-- Aca tiene que venir el codigo de la tabla o lo que quiera mostrar... el DIV se cierra si o si incluyendo el archivo footerProveedor-->
				
<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Cant. viajes</th>
            <th>Bultos</th>
            <th>Pallets</th>
            <th>Total facturado [$]</th>
            <th>Total facturado2 [$]</th>
            <th>Total facturado3 [$]</th>
            <th>Total facturado4 [$]</th>
            <th>Total facturado5 [$]</th>
            <th>Total facturado6 [$]</th>
            <th>Total facturado7 [$]</th>
            <th>Total facturado8 [$]</th>
            <th>Total facturado9 [$]</th>
            <th>Total facturado10 [$]</th>
            <th>Total facturado11 [$]</th>
        </tr>
    </thead>
 
    <tbody>
        
        <?php 
            if (!empty($lineasVentas[0]['mes']))
            {
                foreach( $lineasVentas as $lineas ) : ?> 
        
                    <tr>
                        <td><?php echo $lineas['numero'] ?></td>
                        <td><?php echo $lineas['mes'] ?></td>
                        <td><?php echo $lineas['anio'] ?></td>
                        <td><?php echo $lineas['cant_viajes'] ?></td>
                        <td><?php echo $lineas['total_bultos'] ?></td>
                        <td><?php echo $lineas['total_pallets'] ?></td>
                        <td><?php echo $lineas['total_facturado'] ?></td>
                        <td><?php echo $lineas['total_facturado']+1 ?></td>
                        <td><?php echo $lineas['total_facturado']+2 ?></td>
                        <td><?php echo $lineas['total_facturado']+3 ?></td>
                        <td><?php echo $lineas['total_facturado']+4 ?></td>
                        <td><?php echo $lineas['total_facturado']+5 ?></td>
                        <td><?php echo $lineas['total_facturado']+6 ?></td>
                        <td><?php echo $lineas['total_facturado']+7 ?></td>
                        <td><?php echo $lineas['total_facturado']+8 ?></td>
                        <td><?php echo $lineas['total_facturado']+9 ?></td>
                        <td><?php echo $lineas['total_facturado']+10 ?></td>
                    </tr>
        
        <?php
                endforeach; 
            }
        ?>  
    </tbody>
</table>      


    


    

<!-- end: JavaScript-->
	


    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery-migrate-1.0.0.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.ui.touch-punch.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/modernizr.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.cookie.js"></script>
    <script src='<?php echo base_url() ?>assets/plugins/metro/js/fullcalendar.min.js'></script>
    
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/excanvas.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.flot.resize.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.chosen.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.uniform.min.js"></script>		
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.cleditor.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.noty.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.elfinder.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.raty.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.iphone.toggle.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.uploadify-3.1.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.gritter.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.imagesloaded.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.masonry.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.knob.modified.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/jquery.sparkline.min.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/counter.js"></script>	
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/retina.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/metro/js/custom.js"></script>
    
    <!--
    <script src="https://cdn.datatables.net/responsive/2.0.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    -->
    
    
    
    
    <!-- start: javascrip dataTable -->
    <!--<script src="http://datatables.net/release-datatables/media/js/jquery.js"></script>-->
    <!--<script src="http://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>-->

    
    
    <!--<script src="http://datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>-->
    <!--<script src="http://datatables.net/release-datatables/extensions/Plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>-->

    <!-- end: javascript dataTable -->

<!-- end: JavaScript-->
	

        
        
</body>


</html>

