<!DOCTYPE html>
<html lang="en">
<head>
	<?php         
            ini_set('date.timezone', 'America/Argentina/Buenos_Aires');                     
            $this->load->view('headerProv');
        ?>
    
        <meta charset="utf-8" />
        <?php 
        foreach($css_files as $file): ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach($js_files as $file): ?>
                <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
		
</head>

<body>

<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>

<body>
	
    <div style='height:20px;'>
      
    </div>  
    
    <?php         
                $this->load->view('menuSuperiorProv');
    ?>
    <div class="container-fluid-full">
    <div class="row-fluid">
        
    <div id="content" class="span10">


    <ul class="breadcrumb">
            <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo base_url() ?>index.php/reportes/homeProveedor">Home</a> 
                    <i class="icon-angle-right"></i>
            </li>
            <li><a href="#"><?php echo $this->session->userdata('ruta') ?></a></li>
    </ul>    
    
    	
        <div class="box-header">
                    <h2><i class="halflings-icon plus"></i><span class="break"></span><?php echo $this->session->userdata('titulo')?> </h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    </div>
        </div>
        <div class="box-content">

            <div>
                        <?php echo $output; ?>
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

