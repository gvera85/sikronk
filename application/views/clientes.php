<html lang="es">
  
<head>
    <title>sikronk - Lista de clientes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    
    
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.js"></script> 
    
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/dataTables.buttons.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/buttons.flash.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/jszip.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/pdfmake.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/vfs_fonts.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/buttons.html5.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/buttons.print.min.js"></script>  
    
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/moment.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url() ?>assets/dataTables/datetime-moment.js"></script>  
    
    <!-- start: CSS -->
    
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/buttons.dataTables.min.css">

    

    <link href="<?php echo base_url() ?>assets/plugins/metro/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url() ?>assets/plugins/metro/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url() ?>assets/plugins/metro/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/bootstrap/css/dataTablesBootstrap.css">

    <!--<link href="<?php echo base_url() ?>/assets/grocery_crud/themes/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables/buttons.dataTables.min.css">
    
   
</head>
<body>        
   
    
    <div class="container">
        
        <div class="panel panel-primary">
        <div class="panel-heading">Lista de clientes</div>
        <div class="panel-body">
        
      
            
            <table id="example" style="padding: 50px; width: 100%;" border="1" cellspacing="0" width="100%">
                <thead>
                    <TR style="padding: 50px; width: 100%;">
                        <th>#</th>
                        <th><b>Proveedor</b></th>  
                    </TR>
                </thead>
                <tbody>
                <?php 
                    foreach( $clientes as $lineas ) : ?>
                    <TR style="padding: 50px; width: 100%;">
                        <TD> <?php echo $lineas['id'] ?></TD>
                        <TD> <?php echo $lineas['razon_social'] ?></TD>   
                    </TR>            
                    
                <?php           
                    endforeach; 
                ?>
                </tbody>    
            </table>
         </div>
        </div>     
          
  </div>
</body>
</html>