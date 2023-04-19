<?php
	if (isset($_SESSION['username']));
	include "conn.php";
    if(isset($_POST['update'])){
		$id			= intval($_POST['id']);

		$Tema	= mysqli_real_escape_string($conn,(strip_tags($_POST['Tema'], ENT_QUOTES)));

		if($_POST['Tema']=='uno' AND $_POST['vertical']=='false'){$dimensiones="width: 100%; height: 117px;";}
		if($_POST['Tema']=='uno' AND $_POST['vertical']=='true'){$dimensiones="width: 100%; height: 497px;";}
		if($_POST['Tema']=='dos'){$dimensiones="width: 100%; height: 447px;";};
		if($_POST['Tema']=='tres'){$dimensiones="width: 100%; height: 400px;";};
		
		if($_POST['Tema']=='uno' AND $_POST['vertical']=='false'){$dimensiones2="width=326,height=117";}
		if($_POST['Tema']=='uno' AND $_POST['vertical']=='true'){$dimensiones2="width=326,height=497";}
		if($_POST['Tema']=='dos'){$dimensiones2="width=326,height=447";}
		if($_POST['Tema']=='tres'){$dimensiones2="width=360,height=300";}
		function subirimg($img,$var_img_dir){
		    $filename = "";
    		if(!empty($img)){
          	    $allowedfileExtensions = array('jpg','jpeg', 'gif', 'png', 'ico');
          		$file_parts = $img['name'];
        		$fileNameCmps = explode(".", $file_parts);
                $fileExtension = strtolower(end($fileNameCmps));
                if (in_array($fileExtension, $allowedfileExtensions)) {
    				$temp = explode(".", $img["name"]);
    				$newfilename = substr(rand(),0,4). '.' . end($temp);
    				if (move_uploaded_file($img["tmp_name"], '../player/reproductores'.$var_img_dir . $newfilename)){
    					$filename = $newfilename;
    				}
                }
        	}
        	return $var_img_dir.$filename;
		}
				
				
		if(filter_var($_POST['imglogo'], FILTER_VALIDATE_URL)){
		    $Logo  = mysqli_real_escape_string($conn,(strip_tags($_POST['imglogo'], ENT_QUOTES)));
		    mysqli_query($conn, "UPDATE reproductores SET Logo='$Logo' WHERE ID='$id'") or die(mysqli_error());
        }
        else if($_FILES['filelogo']['name'] != null){
  		    $img = $_FILES['filelogo'];
  		    $var_img_dir = '/img/portadas/';
  		    $Logo  = mysqli_real_escape_string($conn,(strip_tags(subirimg($img,$var_img_dir), ENT_QUOTES)));
  		    mysqli_query($conn, "UPDATE reproductores SET Logo='$Logo' WHERE ID='$id'") or die(mysqli_error());
		}
		
		if(filter_var($_POST['imgfacebook'], FILTER_VALIDATE_URL)){
            $Logo2 = $_POST['imgfacebook'];
            mysqli_query($conn, "UPDATE reproductores SET Logo2='$Logo2' WHERE ID='$id'") or die(mysqli_error());
        }
        else if($_FILES['filefacebook']['name'] != null){
  		    $img2 = $_FILES['filefacebook'];
  		    $var_img_dir2 = '/img/fb/';
  		    $Logo2  = mysqli_real_escape_string($conn,(strip_tags(subirimg($img2,$var_img_dir2), ENT_QUOTES)));
  		    mysqli_query($conn, "UPDATE reproductores SET Logo2='$Logo2' WHERE ID='$id'") or die(mysqli_error());
		}
		
  		if(filter_var($_POST['imgcover'], FILTER_VALIDATE_URL)){
            $cover2 = $_POST['imgcover'];
            mysqli_query($conn, "UPDATE reproductores SET cover2='$cover2' WHERE ID='$id'") or die(mysqli_error());
        }
        else if($_FILES['filecover']['name'] != null){
  		    $img3 = $_FILES['filecover'];
  		    $var_img_dir3 = '/img/cover/';
  		    $cover2  = mysqli_real_escape_string($conn,(strip_tags(subirimg($img3,$var_img_dir3), ENT_QUOTES)));
  		    mysqli_query($conn, "UPDATE reproductores SET cover2='$cover2' WHERE ID='$id'") or die(mysqli_error());
		}
		


		$Ventana	= mysqli_real_escape_string($conn,(strip_tags($dimensiones, ENT_QUOTES)));
		$Ventana2	= mysqli_real_escape_string($conn,(strip_tags($dimensiones2, ENT_QUOTES)));
		$Enlace 		= mysqli_real_escape_string($conn,(strip_tags($_POST['enlace'], ENT_QUOTES)));
		$Servidor		= $_POST['Servidor'];
		$Puerto  = mysqli_real_escape_string($conn,(strip_tags($_POST['Puerto'], ENT_QUOTES)));
		$CPuerto  = mysqli_real_escape_string($conn,(strip_tags($_POST['CPuerto'], ENT_QUOTES)));
		$BPuerto  = mysqli_real_escape_string($conn,(strip_tags($_POST['BPuerto'], ENT_QUOTES)));
		$TituloEmisora  = mysqli_real_escape_string($conn,(strip_tags($_POST['TituloEmisora'], ENT_QUOTES)));
		$Autoplay  = mysqli_real_escape_string($conn,(strip_tags($_POST['Autoplay'], ENT_QUOTES)));
		$Blur  = mysqli_real_escape_string($conn,(strip_tags($_POST['Blur'], ENT_QUOTES)));
		$Mampara  = mysqli_real_escape_string($conn,(strip_tags($_POST['Mampara'], ENT_QUOTES)));
		$abtn  = mysqli_real_escape_string($conn,(strip_tags($_POST['abtn'], ENT_QUOTES)));
		$btn  = mysqli_real_escape_string($conn,(strip_tags($_POST['btn'], ENT_QUOTES)));
		$Artista  = mysqli_real_escape_string($conn,(strip_tags($_POST['Artista'], ENT_QUOTES)));
		$Artwork  = mysqli_real_escape_string($conn,(strip_tags($_POST['Artwork'], ENT_QUOTES)));
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

		$update = mysqli_query($conn, "UPDATE reproductores SET Tema='$Tema',ventana='$Ventana',ventana2='$Ventana2',vertical='$vertical', Servidor='$Servidor', enlace='$Enlace',Puerto='$Puerto', CPuerto='$CPuerto', BPuerto='$BPuerto', TituloEmisora='$TituloEmisora', Autoplay='$Autoplay', Blur='$Blur', abtn='$abtn', Artista='$Artista', Artwork='$Artwork', Cancion='$Cancion', Color='$Color', btn='$btn', Facebook='$Facebook', Messenger='$Messenger', Twitter='$Twitter', Instagram='$Instagram', Youtube='$Youtube', Whatsapp='$Whatsapp', Playstore='$Playstore', enlace='$enlace', Winamp='$Winamp', Mampara='$Mampara' WHERE ID='$id'") or die(mysqli_error());
		mysqli_query($conn,"SET CHARACTER SET 'utf8'");
		if($update){
			$AlertaGenera='
			
			<div class="col-xs-6 alert alert-success text-center" style="padding-left: 0px;padding-right: 0px;">
			<div class="col-xs-12 laterales" style="padding:15px;word-break: break-all;color: black;">
		<div class="topList">
		<button class="btn btn-default btn-sm pull-right tooltip" id="copyClip" data-clipboard-target="#codhtml" onclick="copyClip2()" onmouseout="outFunc()"><i class="fa fa-copy"></i><span class="tooltiptext" id="myTooltip">Copiar código al portapapeles</span>
  Copiar Código 
  </button></div><h4 class="pull-left">Código HTML</h4><br> <span class="pull-left"><h4>Reproductor '.$TituloEmisora.' actualizado correctamente.</h4></span>
		<textarea  disabled class="form-control fondo" height="150" style="resize: vertical; min-height:80px;" id="codhtml"><iframe frameborder="0" scrolling="no" style="'.$Ventana.'" src="https://player.mediapanel.app/?idr='.base64_encode($id).'"></iframe></textarea>
      </div>
			</div>
			<div class="col-xs-6" style="width: 45%;background: #009dff;color: #ffffff;border-radius: 5px;direction: ltr;flex: 1;max-width: 100vw;padding: 1.5rem 1.5rem 1.75rem;margin-left: 45px;"> 
		<h4 style="text-align: center;padding: 7px;margin: -15px;">Vista Previa</h4></div>
			<div class="col-xs-6 alert text-center" style="padding-left: 0px;padding-right: 0px;background-color: transparent;border-color: transparent;">
			<div class="col-xs-12 laterales" style="padding:15px;word-break: break-all;color: black;">
		
		<iframe frameborder="0" scrolling="no" style="'.$Ventana.'" src="https://player.mediapanel.app/?idr='.base64_encode($id).'"></iframe>
      </div>
			</div>
			<br>
		<div class="control-group"><br><br><br><br><br><br><br><br><br><br><br>
			<b>URL directa del reproductor</b>
			<hr style="margin-top: 5px; margin-bottom: 20px">
    <div class="input-group col-xs-12">
    <span class="input-group-addon">
                		            <i class="fa fa-arrow-circle-right"></i>
                		        </span>
    
    <input type="text" class="form-control input-lg fondo" value="https://player.mediapanel.app/?idr='.base64_encode($id).'" style="font-weight: bold; font-size: 17px; color:#104b5e;">
    
                		    </div>
						</div><br>';
			
		}else{
			$AlertaGenera='<div class="col-xs-12 alert alert-danger text-center"><b> Error al generar el reproductor. Favor de notificar al Administrador</b></div><script>alert("Error, no se pudo actualizar los datos"); window.location = "../panel-control/index.php"</script>';
			echo "<script>alert('Error, no se pudo actualizar los datos'); window.location = '../panel-control/index.php'</script>";
		    
		}
		
		
	}
  ?>


    <style>
    .ColortxtPantalla {
        padding-left: 0px;
    }
		.mat-drawer-container {
		    background-color: #fafafa;
		    color: rgba(0, 0, 0, 0.87);
		}
		.mat-card:not([class*='mat-elevation-z']) {
		    box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);
		}
		.mat-card {
		    transition: box-shadow 280ms cubic-bezier(.4,0,.2,1);
		    display: block;
		    position: relative;
		    padding: 16px;
		    border-radius: 4px;
		}
		.btn-subir-img{
	width: 100%;
	text-transform: uppercase;
	font-size: 12px;
	color:#FFFFFF;
	background-color: #333333;
	float: right;
	clear: right;
	border:0px;
	padding:5px 5px;
	cursor: pointer;
}
/***************  EXTRAS  ***************/
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 15px 0px 0px 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.input-subir-img{
	border: 0px;
    background: transparent;
    padding: 0px;
}
.uploadFile-subir-img{
	margin:15px 0px 0px 0px;
	border-radius: 5px !important;
}
.guardar{
	margin-top: 15px;
}
.tooltip {
  position: relative;
  display: inline-block;
  opacity: 1 !important;
}

.tooltip .tooltiptext {
  visibility: hidden;
  font-size: 10px;
  height: auto;
  width: 260px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 7px;
  padding: 3px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 0;
  margin-left: -75px;
  opacity: 1 !important;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  font-size: 12px;
  position: absolute;
  top: 100%;
  left: 35%;
  margin-left: 50px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1 !important;
}
.topList button {
     top: -20px !important;
     border-radius: 7px !important;
}
.topList {
    margin-bottom: 0;
    background: transparent;
}
.alert {
    border-radius: 10px;
}
select.input-lg {
    height: 46px;
    line-height: 25px;
}
.input-lg {
    padding: 2px 8px;
    font-size: 19px;
    border-radius: 12px;
}
  </style>

    <div class="row">
        <div class="span12">
            <div style="padding: 0px;">
	            <?php
					$id  = intval($_GET['id']);
					$sql = mysqli_query($conn, "SELECT * FROM reproductores WHERE id='$id'");
					if (mysqli_num_rows($sql) == 0) {
					    header("Location: index.php");
					} else {
					    $row = mysqli_fetch_assoc($sql);
					}
				?>
                <?php echo $AlertaGenera; ?>
	            <h3 style="font-size: 20px;margin-top: 0px;margin-bottom: 30px;text-align: center;">
	            ACTUALIZAR INFORMACION DE REPRODUCTOR: <?php echo $row['TituloEmisora']; ?>
	            </h3>
                <form name="form1" id="form1" style="padding-left: 0px;" action="" method="POST" enctype="multipart/form-data">
                 	<div class="col-md-6 col-sm-12">
                        
						<div class="control-group" style="display:none">
							<label class="control-label" for="basicinput">ID</label>
							<div class="controls">
								<input type="text" name="id" id="id" value="<?php echo $row['ID']; ?>" placeholder="Tidak perlu di isi" class="input-group col-xs-12" readonly>
							</div>
						</div>

                        <div class="control-group">
							<label class="control-label" for="basicinput">Titulo Emisora <span id="charNum3"></span></label>
							<div class="controls">
							    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-font"></i></span>
								<input maxlength="30" name="TituloEmisora" id="TituloEmisora" value="<?php echo $row['TituloEmisora']; ?>" class="form-control input-lg fondo" type="text" autocomplete="off" onkeyup="mayus(this);countChars3(this);" required="required"/>
							</div>
							  </div>
						</div>

                        <div class="control-group">
							<label class="control-label" for="imglogo">Logo</label>
							<div class="input-group col-xs-12">
                		        <span class="input-group-addon" id="vista-img-logo">
                		            <i class="fa fa-image"></i>
                		        </span>
                		        <input type="text" class="form-control input-lg fondo" name="imglogo" id="imglogo" value="<?php echo $row['Logo']; ?>" placeholder="Link o imagen subida" autocomplete="off">
                    		    <span class="input-group-addon btn" id="filelogo">
                                    <i class="align-middle" data-feather="folder"></i>
                                    <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" name="filelogo" id="input-subir-img-logo">
                                </span>
                		    </div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="imgfacebook">Facebook</label>
							<div class="input-group col-xs-12">
                		        <span class="input-group-addon" id="vista-img-facebook">
                		            <i class="fa fa-image"></i>
                		        </span>
                		        <input type="text" class="form-control input-lg fondo" name="imgfacebook" id="imgfacebook" value="<?php echo $row['Logo2']; ?>" placeholder="Link o imagen subida" autocomplete="off">
                    		    <span class="input-group-addon btn" id="filefacebook">
                                    <i class="align-middle" data-feather="folder"></i>
                                    <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" name="filefacebook" id="input-subir-img-facebook">
                                </span>
                		    </div>
						</div>
						
                        <div class="control-group">
							<label class="control-label" for="imgcover">Banner</label>
							<div class="input-group col-xs-12">
                		        <span class="input-group-addon" id="vista-img-cover">
                		            <i class="fa fa-image"></i>
                		        </span>
                		        <input type="text" class="form-control input-lg fondo" name="imgcover" id="imgcover" value="<?php echo $row['Cover2']; ?>" placeholder="Link o imagen subida" autocomplete="off">
                    		    <span class="input-group-addon btn" id="filecover">
                                    <i class="align-middle" data-feather="folder"></i>
                                    <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" name="filecover" id="input-subir-img-cover">
                                </span>
                		    </div>
						</div>

						<label class="control-label" for="basicinput">Puertos</label>
						<div class="col-md-6 col-sm-12 input-group input-group-lg-10">
							<span class="input-group-addon" for="basicinput" style="height:auto;">Puerto SSL</span>
							<input name="Puerto" id="Puerto" value="<?php echo $row['Puerto']; ?>" type="text" class="form-control input-lg fondo" style="width: 90px;margin: 0px;" required />
							<span class="input-group-addon" for="basicinput">Puerto Com&uacute;n</span>
							<input name="CPuerto" id="CPuerto" value="<?php echo $row['CPuerto']; ?>" type="text" class="form-control input-lg fondo" style="width: 90px;margin: 0px;" required />
							<span class="input-group-addon">Barra</span>
							<input name="BPuerto" id="BPuerto" value="<?php echo $row['BPuerto']; ?>" type="text" class="form-control input-lg fondo" style="width: 90px;margin: 0px;" required />
						</div>

						<?php if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){?>
						<div class="control-group">
						    
							<label class="control-label" for="basicinput">Servidor</label>
							<div class="controls">
							    <div class="input-group col-xs-12">
                		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-server"></i></span>

								<select class="form-control input-lg select-abajo" name="Servidor" id="Servidor" required="required">
								    <option value="<?php echo $row['Servidor']; ?>" selected><?php echo $row["Servidor"]; ?></option>
                		    	    <?php
                                        $servidores = json_decode($perfil['servidores']);
                                        foreach($servidores as $serv){ 
                                            if($row['Servidor']!=$serv){
                                                echo "<option value='{$serv}'>$serv</option>";
                                            }
                                                
                                    } ?>
                		    	</select>
							</div>
							</div>
						</div>
						<?php }else{ ?>
						    <input type='hidden' name='Servidor' value='<?php echo $row["Servidor"]; ?>'>
						<?php } ?>
						<div class="control-group">
						    <label class="control-label" for="basicinput">Enlace</label>
                		    <div class="input-group col-xs-12">
                		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-link"></i></span>
                		      <input type="text" maxlength="50" class="form-control input-lg fondo" id="enlace" name="enlace" placeholder="URL Sitio Web" <?php if(!is_null($row['enlace'])){ echo "value='{$row['enlace']}'"; } ?> onkeyup="countChars6(this);">
                		      <span class="input-group-addon" id="charNum6">34 / 50</span>
                		    </div>
                		  </div>
                        
                        <div class="control-group col-xs-6" style="padding-left: 0px;">
						<div id="temacamb" class="control-group col-xs-8" style="padding-left: 0px;">
                        	<?php
								$opciones = array(
								    'uno' => 'THEME 1',
								    'dos' => 'THEME 2',
								    'tres' => 'THEME 3',
								    'cuatro' => 'THEME 4',
								    'cinco' => 'THEME 5',
								    'seis' => 'THEME 6',
								);
								$seleccionado = $row['Tema'];
							?>
							<label class="control-label" for="basicinput">Tema</label>
							<div class="controls">
							    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-paint-brush"></i></span>
								<select class="form-control input-lg select-abajo" name="Tema" id="form1" onChange="mostrar(this.value);">
		                            <?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
							</div>
							</div>
							
						</div>
						<div id="Mampara" class="control-group col-xs-5" style="padding-left: 0;margin-right: -40px;width: 45%;">
						    <?php
								$opciones = array(
								    'visible' => 'SI',
								    'hidden' => 'NO',
								);
								$seleccionado = $row['Mampara'];
							?>
							<label class="control-label" for="basicinput">Pantalla</label>
							<div class="controls">
							    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-paint-brush"></i></span>
								<select class="form-control input-lg select-abajo" name="Mampara" id="form1" onChange="mostrar(this.value);">
		                            <?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
							</div>
							</div></div>
							</div>
						<div class="control-group col-xs-3">
                            <?php
								$opciones = array(
								    'true'  => 'Si',
								    'false' => 'No',
								);
								$seleccionado = $row['Autoplay'];
							?>
							<label class="control-label" for="basicinput">Autoplay</label>
							<div class="controls">
							    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gear"></i></span>
								<select class="form-control input-lg select-abajo" name="Autoplay" id="form1">
									<?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
          					</div>
          					</div>
						</div>
						<div class="control-group col-xs-3">
                            <?php
								$opciones = array(
								    'true'  => 'Si',
								    'false' => 'No',
								);
								$seleccionado = $row['Artwork'];
							?>
							<label class="control-label" for="basicinput">Caratulas</label>
							<div class="controls">
							    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gear"></i></span>
								<select class="form-control input-lg select-abajo" name="Artwork" id="form1">
									<?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
          					</div>
          					</div>
						</div>
						<div id="ColortxtPantalla" class="control-group col-xs-5" style="padding-left: 0px;">
          				<label class="control-label" for="basicinput">Color de texto pantalla</label>
          				<div class="controls">
						<div id="colorpicker" class="col-xs-6 col-md-6 input-group input-group-lg">
  							<span class="input-group-addon" for="basicinput"><i class="fas fa-palette"></i></span>
							<input style="color:#<?php echo $row['Color']; ?>;height: 35px;padding: 1px;margin-bottom: auto;display:none" type="hidden" name="Color" id="colore" value="#<?php echo $row['Color']; ?>" />
							<input type="text" style="width:120px;" class="form-control input-lg" ng-model="color" name="color" id="colore3" type="hidden" class="campo-color" />
							<span class="input-group-addon desplegable"><i style="background-color: rgb(255,255,255);"></i></span>
							<span class="input-group-addon" style="display:none"><span id="borrar" class="fa fa-refresh" style="cursor: pointer;"></span></span>
						</div>
                    </div>
                    </div>
						<div id="uno" class="control-group col-xs-4" style="padding-left: 0px;">
                            <?php
								$opciones = array(
								    'true'  => 'Vertical',
								    'false' => 'Horizontal',
								);
								$seleccionado = $row['vertical'];
							?>
							<label class="control-label" for="basicinput">Posición</label>
							<div class="controls">
							    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gear"></i></span>
								<select class="form-control input-lg select-abajo" name="vertical" id="form1">
									<?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
      						</div>
      						</div>
						</div>
						<div class="control-group col-xs-3">
                            <?php
								$opciones = array(
								    'true'  => 'Si',
								    'false' => 'No',
								);
								$seleccionado = $row['Blur'];
							?>
							<label class="control-label" for="basicinput">Blur Effect</label>
							<div class="controls">
							    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gear"></i></span>
								<select class="form-control input-lg select-abajo" name="Blur" id="form1">
									<?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
          					</div>
          					</div>
						</div>
                    </div>
					<div class="col-md-6 col-sm-12 laterales" style="padding:-25px;">
						<div class="col-xs-12 vista-previa SinPadding" >
				            <div class="control-group">
	                        	<?php
									$opciones = array(
									    'red'        => 'Color Red',
									    'pink'       => 'Color Pink',
									    'purple'     => 'Color Purple',
									    'deeppurple' => 'Color DeepPurple',
									    'indigo'     => 'Color Indigo',
									    'blue'       => 'Color Blue',
									    'lightblue'  => 'Color LightBlue',
									    'cyan'       => 'Color Cyan',
									    'teal'       => 'Color Teal',
									    'green'      => 'Color Green',
									    'lightgreen' => 'Color LightGreen',
									    'lime'       => 'Color Lime',
									    'yellow'     => 'Color Yellow',
									    'amber'      => 'Color Amber',
									    'orange'     => 'Color Orange',
									    'deeporange' => 'Color DeepOrange',
									    'brown'      => 'Color Brown',
									    'grey'       => 'Color Grey',
									    'bluegrey'   => 'Color BlueGrey',
									    'darkblue'   => 'Color DarkBlue',
									    'black'      => 'Color Black',
									);
									$seleccionado = $row['abtn'];
								?>
								<label class="control-label" for="basicinput">Color Botones</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-paint-brush"></i></span>
									<select class="form-control input-lg select-abajo" name="abtn" id="form1">
	                                    <?php foreach ($opciones as $key => $opcion) {
											if ($key == $seleccionado) {
											    echo ' <option class="abtn-' . $key . '" value="' . $key . '"  selected>' . $opcion . '</option>';
											} else {
											    echo ' <option class="abtn-' . $key . '" value="' . $key . '" >' . $opcion . '</option>';
											}
										}?>
									</select>
								</div>
								</div>
							</div>
							<div class="control-group">
	                            <?php
									$opciones = array(
									    'red'        => 'Color Red',
									    'pink'       => 'Color Pink',
									    'purple'     => 'Color Purple',
									    'deeppurple' => 'Color DeepPurple',
									    'indigo'     => 'Color Indigo',
									    'blue'       => 'Color Blue',
									    'lightblue'  => 'Color LightBlue',
									    'cyan'       => 'Color Cyan',
									    'teal'       => 'Color Teal',
									    'green'      => 'Color Green',
									    'lightgreen' => 'Color LightGreen',
									    'lime'       => 'Color Lime',
									    'yellow'     => 'Color Yellow',
									    'amber'      => 'Color Amber',
									    'orange'     => 'Color Orange',
									    'deeporange' => 'Color DeepOrange',
									    'brown'      => 'Color Brown',
									    'grey'       => 'Color Grey',
									    'bluegrey'   => 'Color BlueGrey',
									    'darkblue'   => 'Color DarkBlue',
									    'black'      => 'Color Black',
									);
									$seleccionado = $row['btn'];
								?>
								<label class="control-label" for="basicinput">Color Fondo</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-paint-brush"></i></span>
									<select class="form-control input-lg select-abajo" name="btn" id="form1">
	                                    <?php foreach ($opciones as $key => $opcion) {
										    if ($key == $seleccionado) {
										        echo ' <option class="btn-' . $key . '" value="' . $key . '"  selected>' . $opcion . '</option>';
										    } else {
										        echo ' <option class="btn-' . $key . '" value="' . $key . '" >' . $opcion . '</option>';
										    }
										}?>
	          						</select>
								</div>
								</div>
							</div>
			                <div class="control-group">
			                    
								<label class="control-label" for="basicinput">Facebook</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-facebook"></i></span>
									<input type="text" name="Facebook" id="Facebook" value="<?php echo $row['Facebook']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off">
								</div>
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Messenger</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fab fa-facebook-messenger"></i></span>
									<input type="text" name="Messenger" id="Messenger" value="<?php echo $row['Messenger']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off">
								</div>
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Twitter</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fab fa-twitter"></i></span>
									<input type="text" name="Twitter" id="Twitter" value="<?php echo $row['Twitter']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off">
								</div>
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Instagram</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fab fa-instagram"></i></span>
									<input type="text" name="Instagram" id="Instagram" value="<?php echo $row['Instagram']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off">
								</div>
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Youtube</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fab fa-youtube"></i></span>
									<input type="text" name="Youtube" id="Youtube" value="<?php echo $row['Youtube']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off">
								</div>
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">WhatsApp</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fab fa-whatsapp"></i></span>
									<input type="text" name="Whatsapp" id="Whatsapp" value="<?php echo $row['Whatsapp']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off">
								</div>
								</div>
							</div>
							<div class="control-group" style="display:none">
								<label class="control-label" for="basicinput">Ventana</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fas fa-window-restore"></i></span>
									<input type="text" name="ventana" id="ventana" value="<?php echo $row['ventana']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off">
								</div>
								</div>
							</div>
						</div>
	      			</div>
      				<div class="col-sm-12 laterales MB10">
						<h4>Texto que reemplazara la metadata cuando no se encuentre</h4>
						<div class="col-xs-12 " >
							<!--REPRODUCTOR-->
                            <div class="control-group">
								<label class="control-label" for="basicinput">Artista: <span id="charNum"></span>
								</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-font"></i></span>
									<input type="text" maxlength="30" name="Artista" id="Artista" value="<?php echo $row['Artista']; ?>" placeholder="" class="form-control input-lg fondo" onkeyup="countChars(this);" />
								</div></div>
							</div>
                            <div class="control-group" style="padding-left: 0px;">
								<label class="control-label" for="basicinput">Canción: <span id="charNum2"></span>
								</label>
								<div class="controls">
								    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-font"></i></span>
									<input type="text" maxlength="50" name="Cancion" id="Cancion" value="<?php echo $row['Cancion']; ?>" placeholder="" class="form-control input-lg fondo" autocomplete="off" onkeyup="countChars2(this);" />
								</div></div>
							</div>
							<br>
							<div class="col-xs-12 form-gr oup MB10">
								<center>
								     
									<div class="controls">
									    <div style=""><label id="mensajeact" class="control-label" for="basicinput"></label><br><br></div>
										<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-success pull-left" style=" width:79%; padding:10px;">
                                   		<a href="index.php" class="btn btn-sm btn-danger pull-right" style="width:20%; margin-bottom:0px;margin-top:0px;padding:10px; border-radius: 5px;" >Cancelar</a>
									</div>
								</center>
                    		</div>
	                	</div>
	                </div>
				</form>
	      	</div>
	    </div>
	</div>

        <script src="../player/js/angular.min.js"></script>
        <!--<script src="../admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
        <script src="../admin/scripts/bootstrap-colorpicker.min.js"></script>

   <script>

        const r = /^https/i;
        function previewImage(img) {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById("input-subir-img-"+img).files[0]);
            reader.onload = function(e) {
                $("#vista-img-"+img).html("<img src='"+e.target.result+"' width='50' height='33'>");
            };
            
        }
        
        const inputTexto = (img,tag) =>{
            const r = /^https/i;
		    if(r.test(img)){
                $.get(img)
                .done(function() { 
                    $("#vista-img-"+tag).html("<img src='"+img+"' width='50' height='33'>");
            
                }).fail(function() { 
                    $("#vista-img-"+tag).html("<i class='fa fa-image'></i>");
            
                })
		    }
        }
        
        $("#filelogo").click(()=>{
           document.getElementById("input-subir-img-logo").click();
        })
        if($("#imglogo").val()!=""){
            if(r.test($("#imglogo").val())){
                $("#vista-img-logo").html("<img src='"+$("#imglogo").val()+"' width='50' height='33'>");
            }else{
                $("#vista-img-logo").html("<img src='../player/reproductores"+$("#imglogo").val()+"' width='50' height='33'>");
            }
        }
        $("#input-subir-img-logo").change(function () {
		    $("#imglogo").val($(this).val());
		    previewImage("logo");
		})
		$("#imglogo").keyup(()=>{
		    let img = $("#imglogo").val();
		    inputTexto(img,"logo");
		})
		
		$("#filefacebook").click(()=>{
           document.getElementById("input-subir-img-facebook").click();
        })
		if($("#imgfacebook").val()!=""){
		    if(r.test($("#imgfacebook").val())){
                $("#vista-img-facebook").html("<img src='"+$("#imgfacebook").val()+"' width='50' height='33'>");
            }else{
                $("#vista-img-facebook").html("<img src='../player/reproductores"+$("#imgfacebook").val()+"' width='50' height='33'>");
            }
		}
		
		$("#input-subir-img-facebook").change(function () {
		    $("#imgfacebook").val($(this).val());
		    previewImage("facebook");
		})
		$("#imgfacebook").keyup(()=>{
		    let img = $("#imgfacebook").val();
		    const r = /^https/i;
		    inputTexto(img,"facebook");
		})

		
		$("#filecover").click(()=>{
           document.getElementById("input-subir-img-cover").click();
        })
		if($("#imgcover").val()!=""){
		    if(r.test($("#imgcover").val())){
                $("#vista-img-cover").html("<img src='"+$("#imgcover").val()+"' width='50' height='33'>");
            }else{
                $("#vista-img-cover").html("<img src='../player/reproductores"+$("#imgcover").val()+"' width='50' height='33'>");
            }
		}
		$("#input-subir-img-cover").change(function () {
		    $("#imgcover").val($(this).val());
		    previewImage("cover");
		})
		$("#imgcover").keyup(()=>{
		    let img = $("#imgcover").val();
		    const r = /^https/i;
		    inputTexto(img,"cover");
		})
        
        function mostrar(id) {
            if (id == "uno") {
                
                $("#uno").show();
                $("#dos").hide();
                $('#ColortxtPantalla').removeClass('ColortxtPantalla');
            }
        
            if (id == "dos") {
                
                $("#uno").hide();
                $("#dos").show();
                $('#ColortxtPantalla').addClass('ColortxtPantalla'); 
                
            }
        }
        function countChars(obj){
            var maxLength = 30;
            var strLength = obj.value.length;
            var charRemain = (maxLength - strLength);
        
            if(charRemain == 0){
                document.getElementById("charNum").innerHTML = '<span style="color: green;">Has llegado al límite de '+maxLength+' caracteres</span>';
            }else{
                document.getElementById("charNum").innerHTML = charRemain+' caracteres restantes';
            }
        }
        
        function countChars2(obj){
            var maxLength = 50;
            var strLength = obj.value.length;
            var charRemain = (maxLength - strLength);
        
            if(charRemain == 0){
                document.getElementById("charNum2").innerHTML = '<span style="color: green;">Has llegado al límite de '+maxLength+' caracteres</span>';
            }else{
                document.getElementById("charNum2").innerHTML = charRemain+' caracteres restantes';
            }
        }
        function countChars3(obj){
            var maxLength = 30;
            var strLength = obj.value.length;
            var charRemain = (maxLength - strLength);
        
            if(charRemain == 0){
                document.getElementById("charNum3").innerHTML = '<span style="color: green;">Has llegado al límite de '+maxLength+' caracteres</span>';
            }else{
                document.getElementById("charNum3").innerHTML = charRemain+' caracteres restantes';
            }
        }
        function countChars6(obj){
        		    var maxLength = 50;
        		    var strLength = obj.value.length;
        		    var charRemain = ( + strLength);
        
        		    if(charRemain == 50){
        		        document.getElementById("charNum6").innerHTML = '<span style="color: red;">50 / '+maxLength+'</span>';
        		    }else{
        
        		        document.getElementById("charNum6").innerHTML = charRemain+' / 50';
        		    }
        		}
        $(function() {
            $('#colorpicker').colorpicker();
        
            $('#colorpicker').on("change",function(){
            	 $('#colorpicker input').attr('value',$('#colorpicker').colorpicker('getValue','ffffff'));
            });
        });
        
        
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

    </script>
    <script>
		function copyClip2() {
          var copyText = document.getElementById("codhtml");
          copyText.select();
          copyText.setSelectionRange(0, 99999);
          navigator.clipboard.writeText(copyText.value);
			var tooltip = document.getElementById("myTooltip");
			tooltip.innerHTML = "Código copiado correctamente";
		}

		function outFunc() {
			var tooltip = document.getElementById("myTooltip");
			tooltip.innerHTML = "Copiar código al portapapeles";
		}
	</script>
