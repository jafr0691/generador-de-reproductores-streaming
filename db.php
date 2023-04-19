<?php
    $UsuarioDB='ppsltots_crm';
	$PasswdDB='e!cOezk#A5eS';
	$HostDB='localhost';
	$NombreDB='ppsltots_crm';
	$ConsultaDB = new mysqli($HostDB,$UsuarioDB,$PasswdDB,$NombreDB);
	$ConsultaDB->set_charset("utf8");
	
	if(mysqli_connect_errno()){
		header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=Conexion fallo.");
	}
?>