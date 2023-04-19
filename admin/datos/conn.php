<?php
$db_host = "localhost";
$db_user = "ppsltots_crm";
$db_pass = "e!cOezk#A5eS";
$db_name = "ppsltots_crm";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
if(!$conn){
	echo 'Error, no se pudo conectar a la base de datos: '.mysqli_connect_error();
}

?>