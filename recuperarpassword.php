<?php

	require './player/reproductores/db.php';
	require './function.php';
	$errors = array();
	
	if(!empty($_POST))
	{
		$email = $ConsultaDB->real_escape_string($_POST['email']);
		
		if(!isEmail($email))
		{
			$errors[] = "Debe ingresar un correo electronico valido";
		}
		
		if(emailExiste($email))
		{	
		    $rol = getValor("roles", "email", $email);
		    $id = getValor("id", "email", $email);
		    $userid = getValor("userid", "email", $email);
		    
		    if($rol=='usuario'){
                $idus = $userid;
            }else{
                $idus = $id;
            }
            
            $logo = getValor("logo","id_user", $idus,"perfil");
            $firma = getValor("firma","id_user", $idus,"perfil");
            $web = getValor("web","id_user", $idus,"perfil");
            $txtweb = getValor("text_footer","id_user", $idus,"perfil");

			$nombre = getValor('username', 'email', $email);

			$token = generaTokenPass($email);
			
			$url = 'https://'.$_SERVER["SERVER_NAME"].'/cambia_pass.php?token='.$token.'&email='.$email;
			
			$asunto = 'Recuperar Contraseña - Sistema de Usuarios';
			$cuerpo = '<center><div style="width:600px"><table cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <a href="'.$web.'" target="_blank">
                                            <img alt="logo" src="https://'.$_SERVER['SERVER_NAME'].'/panel-control'.$perfil['logo'].'" style="max-width:300px;padding-bottom:0px;vertical-align:bottom;display:inline!important;border-radius:0%" width="280" align="middle">
                                        </a>
                                        <br><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:26px;line-height:25px;font-family:Helvetica,Arial,sans-serif;color:#26a9e0" align="center">
                                        <span>&#161;Hola <strong style="text-transform: capitalize;"> '.$nombre.'</strong>!</span><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:14px;font-family:Helvetica,Arial,sans-serif;font-weight:normal;">
                                        <br> <span>Has solicitado un cambio de contrase&#241;a en tu cuenta de <strong style="line-height:25px;font-family:Helvetica,Arial,sans-serif;color:#26a9e0;cursor:pointer"><a href="'.$web.'" target="_blank">'.$txtweb.'</a></strong>.</span>
                                        <br><br>
                                        <center>
                                            <a href="'.$url.'" style="cursor:pointer;font-size:12px;font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#ffffff;text-decoration:none;background-color:#26a9e0;border-top:7px solid #26a9e0;border-bottom:7px solid #26a9e0;border-left:20px solid #26a9e0;border-right:20px solid #26a9e0;border-radius:25px;display:inline-block" target="_blank">
                                                <span style="color:#ffffff;font-size:18px;font-weight:bold;font-family:Arial,Helvetica,sans-serif;text-decoration:none;line-height:30px;width:100%;display:inline-block;vertical-align:middle">Reestablecer contrase&#241;a</span>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:14px;font-family:Helvetica,Arial,sans-serif;font-weight:normal;">
                                    <br><br><br>
                                        <p>Aqu&#237; tienes algunos tips para elegir una contrase&#241;a segura:<br>
                                        <ul>

                                                <li>Debe contener m&#225;s de ocho caracteres</li>
                                            
                                                <li>Combina n&#250;meros y letras</li>
                                            
                                                <li>Utiliza may&#250;sculas y min&#250;sculas</li>
                                            
                                                <li>Incluye signos de puntuaci&#243;n</li>
                                            
                                                <li>No utilices palabras comunes ni nombres familiares</li>
                                            
                                                <li>Para mayor seguridad, te recomendamos no utilizar la misma contrase&#241;a de tu correo electr&#243;nico u otro tipo de cuentas</li>
                                            
                                                <li>No utilices palabras comunes ni nombres familiares</li>
                                            </ul>
                                            <br><br>
                                            
                                            Si no has sido t&#250; quien ha solicitado este correo, simplemente haz caso omiso.<br><br>
                                            
                                            Un cordial saludo...
                                            </p>
                                            <p>El equipo de '.$txtweb.'</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:14px;font-family:Helvetica,Arial,sans-serif;font-weight:normal;">
                                        Si tienes problemas haciendo click en el bot&#243;n "Reestablecer contrase&#241;a", copia y pega el siguiente enlace en tu navegador: '.$url.'
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br><br>
                                        '.$firma.'
                                    </td>
                                </tr>
                            </tbody>
                        </table></div></center>';
                			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				exit(true);
			}
		} else {
			$errors[] = "La direccion de correo electronico no existe";
		}
	}
	exit(resultBlock($errors));
?>