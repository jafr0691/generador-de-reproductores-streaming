<?php
	/*Base de Datos*/
	include ('./db.php');

	$IDR = base64_decode(addslashes(htmlentities(strip_tags($_GET['idr']))));
	$ArrayGET=array_keys($_GET);
	$Seccion=$ArrayGET[0];
	
        //Verifico que la radio sea por ID, caso contrario, uso la conf. vía GET.
    	if($Seccion!='contacto'){
    
    		if(!$IDR || empty($IDR)){
    			//Configuración vía get
    			$Tema=addslashes(htmlentities(strip_tags($_GET['tema'])));
    			$Ventana=addslashes(htmlentities(strip_tags($_GET['ventana'])));
    			$Color=trim(addslashes(htmlentities(strip_tags($_GET['color']))));
    			if(strlen($Color)==6)
    				$Color = '#'.$Color;
    			
    			$IP=addslashes(htmlentities(strip_tags($_GET['ip'])));
    			$CPuerto=addslashes(htmlentities(strip_tags($_GET['cpuerto'])));
    			$Puerto=addslashes(htmlentities(strip_tags($_GET['puerto'])));
    			$Montaje=addslashes(htmlentities(strip_tags($_GET['montaje'])));
    			$play=addslashes(htmlentities(strip_tags($_GET['autoplay'])));
    			$vrt=addslashes(htmlentities(strip_tags($_GET['vrt'])));
    			$Blur=addslashes(htmlentities(strip_tags($_GET['blur'])));
    			$Mampara=addslashes(htmlentities(strip_tags($_GET['Mampara'])));
    			$abtn=addslashes(htmlentities(strip_tags($_GET['abtn'])));
    
    			$TituloEmisora=addslashes(htmlentities(strip_tags($_GET['titulo'])));
    			$Logo = addslashes(htmlentities(strip_tags($_GET['logo'])));
    			$btn=addslashes(htmlentities(strip_tags($_GET['btn'])));
    			$Facebook=addslashes(htmlentities(strip_tags($_GET['facebook'])));
    			$Twitter=addslashes(htmlentities(strip_tags($_GET['twitter'])));
    
    			$Playstore=addslashes(htmlentities(strip_tags($_GET['playstore'])));
    			$enlace=addslashes(htmlentities(strip_tags($_GET['enlace'])));
    			$Iphone=addslashes(htmlentities(strip_tags($_GET['iphone'])));
    			$Winamp=addslashes(htmlentities(strip_tags($_GET['winamp'])));
    			$Messenger=addslashes(htmlentities(strip_tags($_GET['messenger'])));
    			$Whatsapp=addslashes(htmlentities(strip_tags($_GET['Whatsapp'])));
    			$Instagram=addslashes(htmlentities(strip_tags($_GET['instagram'])));
    			
    			$Late=addslashes(htmlentities(strip_tags($_GET['latidos'])));
    			$Artista=addslashes(htmlentities(strip_tags($_GET['artista'])));
    			$Cancion=addslashes(htmlentities(strip_tags($_GET['cancion'])));
    			$Logo2 = addslashes(htmlentities(strip_tags($_GET['imgfacebook'])));
    			$uid['activ'] = 1;
    		    $ruactive['activ'] = 1;
				
    		}else{
    
    			if($Resultado=$ConsultaDB->query("SELECT * FROM reproductores WHERE ID='$IDR'")){
    				$Datos=$Resultado->fetch_array();
    				$Tema=$Datos['Tema'];
    				$Ventana=$Datos['ventana'];
    				$Color=$Datos['Color'];
    				if(strlen($Color)==6)
    					$Color='#'.$Datos['Color'];
    
    				$IP=$Datos['Servidor'];
    				$CPuerto=$Datos['CPuerto'];
    				$Puerto=$Datos['Puerto'];
    				$Montaje=$Datos['Montaje'];
    				$play=$Datos['Autoplay'];
    				$vrt=$Datos['vertical'];
    				$Blur=$Datos['Blur'];
    				$Mampara=$Datos['Mampara'];
    				$abtn=$Datos['abtn'];
    				
    				$Artista=$Datos['Artista'];
    				$Late=$Datos['Latido'];
    				$Cancion=$Datos['Cancion'];
    
    				$TituloEmisora=$Datos['TituloEmisora'];
    				$Logo=$Datos['Logo'];
    				$Logo2= $Datos['Logo2'];
    				$btn=$Datos['btn'];
    				$Facebook=$Datos['Facebook'];
    				$Twitter=$Datos['Twitter'];
    
    				$Playstore=$Datos['Playstore'];
    				$enlace=$Datos['enlace'];
    				$Iphone=$Datos['Iphone'];
    				$Winamp=$Datos['Winamp'];
    				$Messenger=$Datos['Messenger'];
    				$Whatsapp=$Datos['Whatsapp'];
    				$Instagram=$Datos['Instagram'];
    				$relacionuser=$ConsultaDB->query("SELECT u.activ FROM user u INNER JOIN relacionrepro rr ON  rr.idrepro='$IDR' AND u.id=rr.iduser ");
                    $ruactive=$relacionuser->fetch_array();
                    
                    if(is_null($ruactive['activ'])){
                        $ruactive['activ'] = 1;
                    }
                 
                    $userid=$ConsultaDB->query("SELECT u.activ, u.id FROM  user u INNER JOIN reproductores rp ON  rp.ID='$IDR' AND u.id=rp.user_id ");
                    $uid=$userid->fetch_array();

                    $per = $ConsultaDB->query("SELECT * FROM perfil WHERE id_user={$uid['id']} ");
                    $perfil=$per->fetch_array();
    			}
    		}
    	}
    if($uid['activ']==1 AND $ruactive['activ']==1){

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
        header("location: https://mediapanel.app/dashboard/index.php?error=Servicio Suspendido.");
    }

?>