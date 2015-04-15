<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>sikronk</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 60px;
      padding-bottom: 40px;
      
      
    }
  </style>
  <!--<link rel="stylesheet" href="<?php /*echo base_url();*/?>/assets/css/bootstrap-responsive.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">

  <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

</head>
<body>
    <div>	
        <div class="navbar" >
            <div class="navbar-inner" style="line-height: 1;">
              <div class="container-fluid">
                <a class="brand" href="#" name="top">sikronk</a>
                  <ul class="nav">
                    <li style="font-size: 14px;"><a href="<?php echo base_url() ?>index.php/main/show_main"><i class="icon-home"></i> Home</a></li>
                    <li style="font-size: 14px;"><a href="javascript:history.go(-1);"><i class="icon-arrow-left"></i> <?php echo "Atras" ?> </a></li>
                    <li class="divider-vertical"></li>
                    <li class="userInfo"><strong><?php echo $this->session->userdata('nombre')." - ".$this->session->userdata('imagen_razonsocial')." - " ; ?> </strong></li>
                  </ul>

                  <div class="btn-group pull-right">
                    <ul class="nav">
                        <li style="font-size: 14px;">
                            <a href="<?php echo base_url() ?>index.php/login/logout_user"><i class="icon-share"></i> Salir</a> 
                        </li>    
                    </ul>
                  </div>
              </div>
            </div>
        </div>
    </div>
    
