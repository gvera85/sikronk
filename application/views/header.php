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
    
    .dgcAlert {top: 0;position: absolute;width: 100%;display: block;height: 1000px; background: url(http://www.dgcmedia.es/recursosExternos/fondoAlert.png) repeat; text-align:center; opacity:0; display:none; z-index:999999999999999;}
.dgcAlert .dgcVentana{width: 500px; background: white;min-height: 150px;position: relative;margin: 0 auto;color: black;padding: 10px;border-radius: 10px;}
.dgcAlert .dgcVentana .dgcCerrar {height: 25px;width: 25px;float: right; cursor:pointer; background: url(http://www.dgcmedia.es/recursosExternos/cerrarAlert.jpg) no-repeat center center;}
.dgcAlert .dgcVentana .dgcMensaje { margin: 0 auto; padding-top: 45px; text-align: center; width: 400px;font-size: 20px;}
.dgcAlert .dgcVentana .dgcAceptar{background:#09C; bottom:20px; display: inline-block; font-size: 12px; font-weight: bold; height: 24px; line-height: 24px; padding-left: 5px; padding-right: 5px;text-align: center; text-transform: uppercase; width: 75px;cursor: pointer; color:#FFF; margin-top:50px;}
  </style>
  <!--<link rel="stylesheet" href="<?php /*echo base_url();*/?>/assets/css/bootstrap-responsive.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/sweetalert-master/dist/sweetalert.css">
    
    
    <script src="<?php echo base_url() ?>/assets/sweetalert-master/dist/sweetalert.min.js"></script>

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
                    <li class="userInfo"><strong><?php echo $this->session->userdata('nombre')." - ".$this->session->userdata('DescEmpresa') ; ?> </strong></li>
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
    
