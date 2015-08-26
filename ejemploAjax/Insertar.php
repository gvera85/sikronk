<?php
	$bd = "sikronk";
	$server ="localhost";
	$user = "root";
	$password = "123456";
	

// Create connection
$conn = mysqli_connect($server, $user, $password, $bd);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$mail = $_POST['mail']; 

$sql = "INSERT INTO usuario (nombre, apellido, mail, password, foto, id_tipo_empresa)
VALUES ('$nombre', 'Doe', '$mail','a','a',1)";

if (mysqli_query($conn, $sql)) {
    echo "Registro insertado";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>