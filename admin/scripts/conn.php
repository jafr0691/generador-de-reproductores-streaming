<?php
$db_host = "localhost";
$db_user = "suemisoracom_reprouser";
$db_pass = "Fv2YbH6PHl*E";
$db_name = "suemisoracom_repro-2020-html5";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
if(mysqli_connect_errno()){
	echo 'Error, no se pudo conectar a la base de datos: '.mysqli_connect_error();
}

?>