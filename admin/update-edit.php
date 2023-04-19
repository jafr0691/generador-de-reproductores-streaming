<?php
include "conn.php";


if(isset($_POST['update'])){
		$id			= intval($_POST['id']);


		$Tema	= mysqli_real_escape_string($conn,(strip_tags($_POST['Tema'], ENT_QUOTES)));


		if($_POST['Tema']=='uno' AND $_POST['vertical']=='false'){$dimensiones="width=326,height=117";}
		if($_POST['Tema']=='uno' AND $_POST['vertical']=='true'){$dimensiones="width=326,height=497";}
		if($_POST['Tema']=='dos'){$dimensiones="width=326,height=447";}
		function subirimg($img,$var_img_dir){
		    $filename = "";
    		if(!empty($img)){
          	    $allowedfileExtensions = array('jpg', 'gif', 'png', 'ico');
          		$file_parts = $img['name'];
        		$fileNameCmps = explode(".", $file_parts);
                $fileExtension = strtolower(end($fileNameCmps));
                if (in_array($fileExtension, $allowedfileExtensions)) {
    				$temp = explode(".", $img["name"]);
    				$newfilename = substr(rand(),0,4). '.' . end($temp);
    				if (move_uploaded_file($img["tmp_name"], $var_img_dir . $newfilename)){
    					$filename = $newfilename;
    				}
                }
        	}
        	return $filename;
		}
				
				
		if(filter_var($_POST['imglogo'], FILTER_VALIDATE_URL)){
		    $Logo  = mysqli_real_escape_string($conn,(strip_tags($_POST['imglogo'], ENT_QUOTES)));
		    mysqli_query($conn, "UPDATE reproductores SET Logo='$Logo' WHERE ID='$id'") or die(mysqli_error());
        }else{
  		    $img = $_FILES['filelogo'];
  		    $var_img_dir = '../player/reproductores/img/portadas/';
  		    $Logo  = mysqli_real_escape_string($conn,(strip_tags(subirimg($img,$var_img_dir), ENT_QUOTES)));
  		    mysqli_query($conn, "UPDATE reproductores SET Logo='$Logo' WHERE ID='$id'") or die(mysqli_error());
		}
		
		if(filter_var($_POST['imgfacebook'], FILTER_VALIDATE_URL)){
            $Logo2 = $_POST['imgfacebook'];
            mysqli_query($conn, "UPDATE reproductores SET Logo2='$Logo2' WHERE ID='$id'") or die(mysqli_error());
        }else{
  		    $img2 = $_FILES['filefacebook'];
  		    $var_img_dir2 = '../player/reproductores/img/fb/';
  		    $Logo2  = mysqli_real_escape_string($conn,(strip_tags(subirimg($img2,$var_img_dir2), ENT_QUOTES)));
  		    mysqli_query($conn, "UPDATE reproductores SET Logo2='$Logo2' WHERE ID='$id'") or die(mysqli_error());
		}
		
  		if(filter_var($_POST['imgcover'], FILTER_VALIDATE_URL)){
            $cover2 = $_POST['imgcover'];
            mysqli_query($conn, "UPDATE reproductores SET cover2='$cover2' WHERE ID='$id'") or die(mysqli_error());
        }else{
  		    $img3 = $_FILES['filecover'];
  		    $var_img_dir3 = '../player/reproductores/img/cover/';
  		    $cover2  = mysqli_real_escape_string($conn,(strip_tags(subirimg($img3,$var_img_dir3), ENT_QUOTES)));
  		    mysqli_query($conn, "UPDATE reproductores SET cover2='$cover2' WHERE ID='$id'") or die(mysqli_error());
		}
		


		$Ventana	= mysqli_real_escape_string($conn,(strip_tags($dimensiones, ENT_QUOTES)));
		$Enlace 		= mysqli_real_escape_string($conn,(strip_tags($_POST['enlace'], ENT_QUOTES)));
		$Servidor 		= mysqli_real_escape_string($conn,(strip_tags($_POST['Servidor'], ENT_QUOTES)));
		$Puerto  = mysqli_real_escape_string($conn,(strip_tags($_POST['Puerto'], ENT_QUOTES)));
		$CPuerto  = mysqli_real_escape_string($conn,(strip_tags($_POST['CPuerto'], ENT_QUOTES)));
		$BPuerto  = mysqli_real_escape_string($conn,(strip_tags($_POST['BPuerto'], ENT_QUOTES)));
		$TituloEmisora  = mysqli_real_escape_string($conn,(strip_tags($_POST['TituloEmisora'], ENT_QUOTES)));
		$Autoplay  = mysqli_real_escape_string($conn,(strip_tags($_POST['Autoplay'], ENT_QUOTES)));
		
		$abtn  = mysqli_real_escape_string($conn,(strip_tags($_POST['abtn'], ENT_QUOTES)));
		$btn  = mysqli_real_escape_string($conn,(strip_tags($_POST['btn'], ENT_QUOTES)));
		$Artista  = mysqli_real_escape_string($conn,(strip_tags($_POST['Artista'], ENT_QUOTES)));
		$Cancion  = mysqli_real_escape_string($conn,(strip_tags($_POST['Cancion'], ENT_QUOTES)));
		$colore=$_POST['Color'];
		$color = substr($colore, 1);
		$Color  = mysqli_real_escape_string($conn,(strip_tags($color, ENT_QUOTES)));
		$Facebook  = mysqli_real_escape_string($conn,(strip_tags($_POST['Facebook'], ENT_QUOTES)));
		$Messenger  = mysqli_real_escape_string($conn,(strip_tags($_POST['Messenger'], ENT_QUOTES)));
		$Twitter  = mysqli_real_escape_string($conn,(strip_tags($_POST['Twitter'], ENT_QUOTES)));
		$Instagram  = mysqli_real_escape_string($conn,(strip_tags($_POST['Instagram'], ENT_QUOTES)));
		$Youtube  = mysqli_real_escape_string($conn,(strip_tags($_POST['Youtube'], ENT_QUOTES)));
		$Whatsapp  = mysqli_real_escape_string($conn,(strip_tags($_POST['Whatsapp'], ENT_QUOTES)));
		$Playstore  = mysqli_real_escape_string($conn,(strip_tags($_POST['Playstore'], ENT_QUOTES)));
		$enlace  = mysqli_real_escape_string($conn,(strip_tags($_POST['enlace'], ENT_QUOTES)));
		$Winamp  = mysqli_real_escape_string($conn,(strip_tags($_POST['Winamp'], ENT_QUOTES)));
		$vertical  = mysqli_real_escape_string($conn,(strip_tags($_POST['vertical'], ENT_QUOTES)));
        

		$update = mysqli_query($conn, "UPDATE reproductores SET Tema='$Tema',ventana='$Ventana',vertical='$vertical', Servidor='$Servidor', enlace='$Enlace',Puerto='$Puerto', CPuerto='$CPuerto', BPuerto='$BPuerto', TituloEmisora='$TituloEmisora', Autoplay='$Autoplay', abtn='$abtn', Artista='$Artista', Cancion='$Cancion', Color='$Color', btn='$btn', Facebook='$Facebook', Messenger='$Messenger', Twitter='$Twitter', Instagram='$Instagram', Youtube='$Youtube', Whatsapp='$Whatsapp', Playstore='$Playstore', enlace='$enlace', Winamp='$Winamp' WHERE ID='$id'") or die(mysqli_error());
		mysqli_query($conn,"SET CHARACTER SET 'utf8'");
		if($update){
			$AlertaGenera='<div class="col-xs-12 alert alert-success text-center"><b>Reproductor generado correctamente. Copie y pegue el código de inserción que se encuentra debajo</b></div><script>window.location = "../panel-control/editar.php?id=$id";</script>';
			
			echo "<script>window.location = '../panel-control/editar.php?id=$id'; document.getElementById('mensajeact').innerText = 'Actualizado';</script>";
		}else{
			$AlertaGenera='<div class="col-xs-12 alert alert-danger text-center"><b> Error al generar el reproductor. Favor de notificar al Administrador</b></div><script>alert("Error, no se pudo actualizar los datos"); window.location = "../panel-control/index.php"</script>';
			echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = '../panel-control/index.php'</script>";
		    
		}
		
		
	}
  ?>