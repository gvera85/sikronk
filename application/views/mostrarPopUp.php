<!DOCTYPE html>

<html>
<?php $this->load->view('header') ?>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
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

<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://localhost/sikronk/assets/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="http://localhost/sikronk/assets/bootstrap/css/bootstrap-theme.min.css">

</head>

<body>
	
    <div style='height:20px;'>
        
    </div>  

    <div class="panel panel-default">
      <div class="panel-heading"><?php echo $this->session->userdata('titulo')?>  </div>
      <div class="panel-body">
        <?php echo $output; ?>
      </div>
    </div>
   
    
</body>
</html>
