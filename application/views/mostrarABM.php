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

<link rel="stylesheet" href="<?=base_url()?>assets/grocery_crud/css/jquery_plugins/fancybox/jquery.fancybox.css?v=2.0.6" type="text/css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>assets/grocery_crud/css/jquery_plugins/fancybox/jquery.fancybox.pack.js?v=2.0.6"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".fancybox").fancybox();
});
</script>

</head>

<body>
	
    <div style='height:20px;'>
        
    </div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
