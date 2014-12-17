<!DOCTYPE html>

<html>
<?php $this->load->view('header') ?>
<head>
	<meta charset="utf-8" />
        <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


</head>

<body>
	
    <div style='height:20px;'>
      
    </div>  
    <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo $this->session->userdata('titulo')?></h3>
    </div>
    <div class="panel-body">
    
        <div>
                    <?php echo $output; ?>
        </div>
    </div>
    </div>
</body>
</html>
