<?php
	/*Base de Datos*/
	include ('./db.php');

	$IDR = base64_decode(addslashes(htmlentities(strip_tags($_GET['idr']))));
	$ArrayGET=array_keys($_GET);
	$Seccion=$ArrayGET[0];
    
    $relacionuser = mysqli_query($ConsultaDB, "SELECT u.activ FROM user u INNER JOIN relacionrepro rr ON  rr.idrepro='$IDR' AND u.id=rr.iduser");
    $ruactive = mysqli_fetch_assoc($relacionuser);
    
    if(is_null($ruactive['activ'])){
        $ruactive['activ'] = 1;
    }
    
    $userid = mysqli_query($ConsultaDB, "SELECT u.activ FROM  user u INNER JOIN reproductores rp ON  rp.ID='$IDR' AND u.id=rp.user_id");
    $uid = mysqli_fetch_assoc($userid);

    if($uid['activ']==1 AND $ruactive['activ']==1){

    	//Verifico que la radio sea por ID, caso contrario, uso la conf. vía GET.
    	if($Seccion!='contacto'){
    
    		if(!$IDR || empty($IDR)){
    			//Configuración vía get
    			$Tema=addslashes(htmlentities(strip_tags($_GET['tema'])));
    
    			$Color=trim(addslashes(htmlentities(strip_tags($_GET['color']))));
    			if(strlen($Color)==6)
    				$Color = '#'.$Color;
    
    			$IP=addslashes(htmlentities(strip_tags($_GET['ip'])));
    			$BPuerto=addslashes(htmlentities(strip_tags($_GET['bpuerto'])));
    			$Puerto=addslashes(htmlentities(strip_tags($_GET['puerto'])));
    			$Montaje=addslashes(htmlentities(strip_tags($_GET['montaje'])));
    			$Autoplay=(addslashes(htmlentities(strip_tags($_GET['autoplay']=='true'))))?'autoplay':'';
    			$Portada=addslashes(htmlentities(strip_tags($_GET['portada'])));
    
    			$TituloEmisora=addslashes(htmlentities(strip_tags($_GET['titulo'])));
    			$Logo = addslashes(htmlentities(strip_tags($_GET['logo'])));
    			$Email=addslashes(htmlentities(strip_tags($_GET['email'])));
    			$Facebook=addslashes(htmlentities(strip_tags($_GET['facebook'])));
    			$Twitter=addslashes(htmlentities(strip_tags($_GET['twitter'])));
    
    			$Playstore=addslashes(htmlentities(strip_tags($_GET['playstore'])));
    			$Windows=addslashes(htmlentities(strip_tags($_GET['windows'])));
    			$Iphone=addslashes(htmlentities(strip_tags($_GET['iphone'])));
    			$Winamp=addslashes(htmlentities(strip_tags($_GET['winamp'])));
    			$Messenger=addslashes(htmlentities(strip_tags($_GET['messenger'])));
    			$Whatsapp=addslashes(htmlentities(strip_tags($_GET['whatsapp'])));
    			$Instagram=addslashes(htmlentities(strip_tags($_GET['instagram'])));
    			$Cover2=addslashes(htmlentities(strip_tags($_GET['Cover2'])));
    			$Youtube=addslashes(htmlentities(strip_tags($_GET['Youtube'])));
    		}else{
    
    			if($Resultado=$ConsultaDB->query("SELECT * FROM reproductores WHERE ID='$IDR'")){
    				$Datos=$Resultado->fetch_array();
    				$Tema=$Datos['Tema'];
    				$Color=$Datos['Color'];
    				if(strlen($Color)==6)
    					$Color='#'.$Datos['Color'];
    
    				$IP=$Datos['Servidor'];
    				$BPuerto=$Datos['BPuerto'];
    				$Puerto=$Datos['Puerto'];
    				$Montaje=$Datos['Montaje'];
    				$Autoplay=$Datos['Autoplay'];
    				$Portada=$Datos['Portada'];
    
    				$TituloEmisora=$Datos['TituloEmisora'];
    				$Logo=$Datos['Logo'];
    				$Logo2=$Datos['Logo2'];
    				$Email=$Datos['Email'];
    				$Facebook=$Datos['Facebook'];
    				$Twitter=$Datos['Twitter'];
    
    				$Playstore=$Datos['Playstore'];
    				$Windows=$Datos['Windows'];
    				$Iphone=$Datos['Iphone'];
    				$Winamp=$Datos['Winamp'];
    				$Messenger=$Datos['Messenger'];
    				$Whatsapp=$Datos['Whatsapp'];
    				$Instagram=$Datos['Instagram'];
    				$Cover2=$Datos['Cover2'];
    				$Youtube=$Datos['Youtube'];
    			}
    		}
    	}
    	if($Seccion=='contacto'){
    
    		if($Resultado=$ConsultaDB->query("SELECT * FROM reproductores WHERE ID='$IDR'")){
    				$Datos=$Resultado->fetch_array();
    				$TituloEmisora=$Datos['TituloEmisora'];
    				$Logo=$Datos['Logo'];
    				$Logo2=$Datos['Logo2'];
    				$Email=$Datos['Email'];
    				$Facebook=$Datos['Facebook'];
    				$Twitter=$Datos['Twitter'];
    			}
    
    		$nombre=addslashes(htmlentities(strip_tags($_POST['nombre'])));
    		$email=addslashes(htmlentities(strip_tags($_POST['email'])));
    		$telefono=addslashes(htmlentities(strip_tags($_POST['telefono'])));
    		$mensaje=addslashes(htmlentities(strip_tags($_POST['mensaje'])));
    		$fecha="Mensaje enviado el ".date("d/m/Y \a \l\a\s H:i").":";
    
    		if(empty($telefono))
    			$telefono='N/A';
    
    		$mensaje_final = '<br/><b>Nombre: </b>'.$nombre.'<br/>
    							   <b>E-Mail: </b>'.$email.'<br/>
    							   <b>Tel&eacute;fono: </b>'.$telefono.'<br/>
    							   <b>Mensaje: </b><br/>'.nl2br($mensaje).'<br/>';
    		if($_POST){
    			if(!empty($nombre) && !empty($email) && !empty($mensaje)){
    				//$body = 'Mensaje enviado por ASd';
    			
    				include('inc/class.phpmailer.php');
    				include('inc/class.smtp.php');
    				$mail = new PHPMailer();
    				$mail->CharSet = 'UTF-8';
    
    				$body = file_get_contents('inc/index.htm');
    				$arrayReplace=array('//nombreradio//','//fecha//','//mensaje//');
    				$arrayReplaceTo=array(utf8_encode($TituloEmisora),$fecha,utf8_encode($mensaje_final));
    				$body = str_ireplace($arrayReplace, $arrayReplaceTo, $body);
    				$body = eregi_replace("[\]",'',$body);
    				
                    
    				$mail->IsSMTP(); // telling the class to use SMTP
    				//$mail->Host       = "mail.pitucomputer.com.ar"; // SMTP server
    				//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    				                                           // 1 = errors and messages
    				                                           // 2 = messages only
    				$mail->SMTPAuth   = true;                  // enable SMTP authentication
    				$mail->Host       = "mail.pitucomputer.com.ar"; // sets the SMTP server
    				$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
    				$mail->Username   = "reproductores@pitucomputer.com.ar"; // SMTP account username
    				$mail->Password   = "G,16mmU@Sk^Q"; 
    
    				$mail->SMTPSecure = 'ssl';       // SMTP account password
    
    				$mail->SetFrom('reproductores@evolucionstreaming.com', 'Contacto Web');
    
    				$mail->AddReplyTo($email,$nombre);
    				$mail->Subject = utf8_decode('Tiene un nuevo mensaje | Reproductores Evoluci贸n Streaming');
    
    				$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    
    				$mail->MsgHTML($body);
    
    				$address = $Email;
    				$mail->AddAddress($address);
    
    
    				if(!$mail->Send()){
    				  $alerta_contacto = '<div class="alerta_contacto danger">Hubo un error al enviar el mensaje, notifique al administrador.</div>';
    				}else{
    				  $alerta_contacto = '<div class="alerta_contacto success">Mensaje enviado correctamente, nos contactaremos a la brevedad.</div>';
    				}
    			}
    		}
    	}
    	
    ?>
    
      	<?php
      		switch ($Seccion) {
    			case 'contacto':
    				include('inc/contacto.php');
    				case 'comentarios':
    				include('inc/comentarios.php');
    				break;
    				case 'currentsong':
    				include('inc/currentsong.php');
    				break;
    			default:
    				include('inc/inicio.php');
    				break;
    		}
    }else{
        header("location: https://suemisora.com.ar/index.php?error=Servicio Suspendido.");
    }
  	?>
