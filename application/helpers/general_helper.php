<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('generar_string_aleatorio'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function generar_string_aleatorio($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
    {
 
         $source = 'abcdefghijklmnopqrstuvwxyz';
		if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if($n==1) $source .= '1234567890';
		if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
		if($length>0){
			$rstr = "";
			$source = str_split($source,1);
			for($i=1; $i<=$length; $i++){
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,count($source));
				$rstr .= $source[$num-1];
			}
	 
		}
		return $rstr;
    }
}

/* ----------- Borrar Archivo --------------------
 * Recibe la ruta de un archivo a borrar */

if(!function_exists('borrar_foto_perfil'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function borrar_foto_perfil($ruta_archivo)
	{
		//$file = 'assets/images/fotos_perfil/'.$nombre_archivo;
		$file = $ruta_archivo;
		$do = unlink($file);
			 
		if($do != true)
			return false;
		else
			return true;
	
	}
}

/* ----------- CREAR EL JSON --------------------
 * Crea el json para enviar al webservice. */

if(!function_exists('crear_json'))
{
    
    function crear_json($return)
	{
		if (function_exists('json_encode'))
		{
    		chrome_log(json_encode($return));
			print json_encode($return);
			//ChromePhp::log(json_encode($return));
		}
		else
		{
        	chrome_log(json_encode($return));
			print __json_encode($return);
			//ChromePhp::log(__json_encode($return));
		}
	}
}
?>
