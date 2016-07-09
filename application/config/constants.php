<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


define('ESTADO_VIAJE_CREADO','1');
define('ESTADO_VIAJE_PLANIFICANDO_REPARTO','2');
define('ESTADO_VIAJE_REPARTO_PLANIFICADO','3');
define('ESTADO_VIAJE_REVISANDO_STOCK','11');
define('ESTADO_VIAJE_STOCK_ARRIBADO_Y_CONFIRMADO','12');
define('ESTADO_VIAJE_REPARTO_EN_PROCESO','4');
define('ESTADO_VIAJE_REPARTO_FINALIZADO','5');
define('ESTADO_VIAJE_DETERMINANDO_PRECIO','6');
define('ESTADO_VIAJE_PRECIO_ACORDADO','7');
define('ESTADO_CHEQUE_SIN_USAR','8');
define('ESTADO_CHEQUE_ENTREGADO_A_PROVEEDOR','9');
define('ESTADO_CHEQUE_UTILIZADO_X_DISTRIBUIDOR','10');
define('ESTADO_VIAJE_PRECIO_ACORDADO_PROVEEDOR','13');
define('ESTADO_CHEQUE_UTILIZADO_EN_NOTA_DEBITO','14');

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

/* End of file constants.php */
/* Location: ./application/config/constants.php */