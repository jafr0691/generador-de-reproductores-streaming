<?php
	session_start();

	$sesion_caverna_user=$_SESSION['username'];


  	if(!empty($sesion_caverna_user)){

  		/*ACTION UPLOAD*/
  		if(isset($_FILES['imglogo'])){
  		    $img = $_FILES['imglogo'];
  		    $text = "logo";
  		    $var_img_dir = './reproductores/img/portadas/';
  		}else if(isset($_FILES['imgfacebook'])){
  		    $img = $_FILES['imgfacebook'];
  		    $text = "facebook";
  		    $var_img_dir = './reproductores/img/fb/';
  		}else if(isset($_FILES['imgcover'])){
  		    $img = $_FILES['imgcover'];
  		    $text = "cover";
  		    $var_img_dir = './reproductores/img/fb/';
  		}
  		
      	if(!empty($img['name'])){
      	    $allowedfileExtensions = array('jpg', 'gif', 'png', 'ico');
      		$file_parts = $img['name'];
    		$fileNameCmps = explode(".", $file_parts);
            $fileExtension = strtolower(end($fileNameCmps));
            if (in_array($fileExtension, $allowedfileExtensions)) {
        		if ($img["error"] > 0){ //Si hay error en la imagen
        			$AlertaModificados= '<div class="alert alert-danger AlertasPanel"> Hubo un error en la Imagen Facebook.</div>';;
        		}else{ //sino
        			try{
        				$temp = explode(".", $img["name"]);
        				$newfilename = substr(rand(),0,4). '.' . end($temp);
        				if (in_array($fileExtension, $allowedfileExtensions)) {
            				if (move_uploaded_file($img["tmp_name"], $var_img_dir . $newfilename)){
            					$AlertaModificados="<div class='alert alert-success AlertasPanel'> Imagen $text a subido correctamente al servidor: <br/> <b>$newfilename</b></div>";
            				}else{
            				    $AlertaModificados="<div class='alert alert-danger AlertasPanel'> Hubo un error al subir la Imagen $text.</div>";
            				}
        				}
        			}catch(Error $e){
        				$AlertaModificados="<div class='alert alert-danger AlertasPanel'> Fallo el codigo.</div>";
        			}
        		}
            }else{
                $AlertaModificados="<div class='alert alert-danger AlertasPanel'> Formato de la imagen $text no permitido.</div>";
            }

    	}else{
    	    $AlertaModificados="<div class='alert alert-danger AlertasPanel'> El campo de la imagen $text esta vacio.</div>";
    	}
  	}
  	
  	$data = array('rutaimg'=> $newfilename, 'alert'=> $AlertaModificados,'url'=>$carp);
  	exit(json_encode($data));