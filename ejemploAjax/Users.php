<?php
	$bd = "sikronk";
	$server ="localhost";
	$user = "root";
	$password = "123456";
	
	$conexion = @mysqli_connect($server, $user, $password, $bd);
	
	if( ! $conexion )	die( "Error de conexion ".mysqli_connect_error() );
	
	$sql = "SELECT nombre, mail FROM usuario";
	$result = mysqli_query($conexion, $sql);
	$array_user = array();
	while($data = mysqli_fetch_assoc($result)){
		$array_user[] = $data;
	}
	
	echo json_encode($array_user);
	
?>