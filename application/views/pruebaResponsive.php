<!DOCTYPE html>
<html lang="en">
<head>
	
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
	


      
        
        
</body>


</html>

