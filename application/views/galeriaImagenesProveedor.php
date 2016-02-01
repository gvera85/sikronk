<!DOCTYPE html>

<html>
<?php $this->load->view('headerProveedor') ?>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


</head>


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
    
</body>
</html>

</head>

<?php 
        $this->load->view('footerProveedorImg');
?>  

