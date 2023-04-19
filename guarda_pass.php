<?php
	require './player/reproductores/db.php';
	require './function.php';
	
	$email = $ConsultaDB->real_escape_string($_POST['email']);
	$token = $ConsultaDB->real_escape_string($_POST['token']);
	$password = $ConsultaDB->real_escape_string($_POST['password']);
	$con_password = $ConsultaDB->real_escape_string($_POST['con_password']);
	$errors = array();
	if(validaPassword($password, $con_password))
	{
		
		$pass_hash = hashPassword($password);
		
		if(cambiaPassword($pass_hash, $email, $token))
		{
			exit(true);
		}
		else 
		{
			$error[]= "Error al modificar la contraseña";
		}
	}
	else
	{
		$error[]= 'Las contraseñas no coinciden';
	}
	exit(resultBlock($error));
?>