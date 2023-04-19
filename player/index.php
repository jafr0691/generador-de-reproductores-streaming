<?php
	$UsuarioDB='ppsltots_crm';
	$PasswdDB='e!cOezk#A5eS';
	$HostDB='localhost';
	$NombreDB='ppsltots_crm';
	$ConsultaDB = new mysqli($HostDB,$UsuarioDB,$PasswdDB,$NombreDB);
	$ConsultaDB->set_charset("utf8");
	$InsertaSuccess=false;
	$crear = true;
	if($_SESSION['user_roles']=='vendedor'){
        $cre = mysqli_query($ConsultaDB, "SELECT crear FROM user WHERE id=".$_SESSION['user_id']);
        $num = mysqli_query($ConsultaDB, "SELECT * FROM reproductores WHERE user_id=".$_SESSION['user_id']);
        $dispo = mysqli_fetch_assoc($cre)['crear'];
        $usados = $num->num_rows;
        $restant = $dispo - $usados;
        if($usados>=$dispo){
            $AlertaGenera='<div class="col-xs-12 alert alert-danger text-center"><b> "Te quedan 0 reproductores disponibles! Contacta con tu proveedor para aumentar el plan!"</b></div>';
            $crear = false;
        }
    }
	
	if (isset($_POST) AND $crear) {
	    
		$Tema=trim(addslashes(htmlentities(strip_tags($_POST['theme']))));
		$Color=trim(addslashes(htmlentities(strip_tags($_POST['color']))));
		$Montaje=addslashes(htmlentities(strip_tags($_POST['montaje'])));

		if($Tema=='uno' AND $_POST['vrt']=='false'){$dimensiones="width: 100%; height: 117px;";}
		if($Tema=='uno' AND $_POST['vrt']=='true'){$dimensiones="width: 100%; height: 497px;";}
		if($Tema=='dos'){$dimensiones="width: 100%; height: 447px;";}
		if($Tema=='tres'){$dimensiones="width: 100%; height: 400px;";}
		
		if($Montaje=='/;stream'){$SVersion="1";}
		if($Montaje=='stream'){$SVersion="2";}
		if($Montaje=='/stream'){$SVersion="icecast";}

		if($Tema=='uno' AND $_POST['vrt']=='false'){$dimensiones2="width=326,height=117";}
		if($Tema=='uno' AND $_POST['vrt']=='true'){$dimensiones2="width=326,height=497";}
		if($Tema=='dos'){$dimensiones2="width=326,height=447";}
		if($Tema=='tres'){$dimensiones2="width=330,height=300";}
		
		function subirimg($img,$var_img_dir){
		    $filename = "";
    		if(!empty($img)){
          	    $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'ico');
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
		    $Logo  = addslashes(htmlentities(strip_tags($_POST['imglogo'])));

        }else{
  		    $img = $_FILES['filelogo'];
  		    $var_img_dir = '/img/portadas/';
  		    $Logo  = addslashes(htmlentities(strip_tags(subirimg($img,$var_img_dir), ENT_QUOTES)));
		}
		
		if(filter_var($_POST['imgfacebook'], FILTER_VALIDATE_URL)){
            $Logo2 = addslashes(htmlentities(strip_tags($_POST['imgfacebook'])));
        }else{
  		    $img2 = $_FILES['filefacebook'];
  		    $var_img_dir2 = '/img/fb/';
  		    $Logo2 = addslashes(htmlentities(strip_tags(subirimg($img2,$var_img_dir2), ENT_QUOTES)));
		}
		
  		if(filter_var($_POST['imgcover'], FILTER_VALIDATE_URL)){
            $Cover2 = addslashes(htmlentities(strip_tags($_POST['imgcover'])));
        }else{
  		    $img3 = $_FILES['filecover'];
  		    $var_img_dir3 = '/img/cover/';
  		    $Cover2= addslashes(htmlentities(strip_tags(subirimg($img3,$var_img_dir3), ENT_QUOTES)));
		}
        

        $SVersion=addslashes(htmlentities(strip_tags($SVersion, ENT_QUOTES)));
		$Ventana=addslashes(htmlentities(strip_tags($dimensiones, ENT_QUOTES)));
		$IP=addslashes(htmlentities(strip_tags($_POST['ipemisora'])));
		$Puerto=addslashes(htmlentities(strip_tags($_POST['puerto'])));
		$Montaje=addslashes(htmlentities(strip_tags($_POST['montaje'])));
		$vrt=addslashes(htmlentities(strip_tags($_POST['vrt'])));
		$Mampara=addslashes(htmlentities(strip_tags($_POST['Mampara'])));
		$play=addslashes(htmlentities(strip_tags($_POST['autoplay'])));
		$Blur=addslashes(htmlentities(strip_tags($_POST['blur'])));
		$abtn=addslashes(htmlentities(strip_tags($_POST['abtn'])));
	    $enlace=addslashes(htmlentities(strip_tags($_POST['enlace'])));
		$TituloEmisora=addslashes(htmlentities(strip_tags($_POST['emisora'])));
		
		$btn=addslashes(htmlentities(strip_tags($_POST['btn'])));
		$Facebook=addslashes(htmlentities(strip_tags($_POST['facebook'])));
		$Twitter=addslashes(htmlentities(strip_tags($_POST['twitter'])));

		$Playstore=addslashes(htmlentities(strip_tags($_POST['playstore'])));
		$Winamp=addslashes(htmlentities(strip_tags($_POST['winamp'])));
		$Messenger=addslashes(htmlentities(strip_tags($_POST['messenger'])));
		$Whatsapp=addslashes(htmlentities(strip_tags($_POST['Whatsapp'])));
		$Instagram=addslashes(htmlentities(strip_tags($_POST['instagram'])));

		$Late=addslashes(htmlentities(strip_tags($_POST['latidos'])));
		$Artista=addslashes(htmlentities(strip_tags($_POST['artista'])));
		$Cancion=addslashes(htmlentities(strip_tags($_POST['cancion'])));
		$Artwork=addslashes(htmlentities(strip_tags($_POST['caratulas'])));
		$Listeners=addslashes(htmlentities(strip_tags($_POST['Listeners'])));
		

		//Verifico que los campos básicos no estén vacios.
		if(!empty($IP) AND !empty($Puerto) AND !empty($Montaje)){
		    
            $id_user = $_SESSION['user_id'];
			if(!isset($Tema) || empty($Tema)) $Tema='uno';
			//Inserto en la DB
			if($ConsultaDB->query("INSERT INTO reproductores (
			user_id,
				Tema,
				SVersion,
				Color,
				Servidor,
				Puerto,
				Montaje,
				Autoplay,
				Blur,
				vertical,
				Mampara,
				TituloEmisora,
				Logo,
				Logo2,
				Cover2,
				Artwork,
				btn,
				Facebook,
				Twitter,
				Playstore,
				enlace,
				Winamp,
				Messenger,
				Whatsapp,
				Instagram,
				Latido,
				Cancion,
				Artista,
				ventana,
				abtn,
				Listeners
			) VALUES (
			'$id_user',
				'$Tema',
				'$SVersion',
				'$Color',
				'$IP',
				'$Puerto',
				'$Montaje',
				'$play',
				'$Blur',
				'$vrt',
				'$Mampara',
				'$TituloEmisora',
				'$Logo',
				'$Logo2',
				'$Cover2',
				'$Artwork',
				'$btn',
				'$Facebook',
				'$Twitter',
				'$Playstore',
				'$enlace',
				'$Winamp',
				'$Messenger',
				'$Whatsapp',
				'$Instagram',
				'$Late',
				'$Cancion',
				'$Artista',
				'$Ventana',
				'$abtn',
				'$Listeners'
			)")){
				$id_rep = $ConsultaDB->insert_id;
				$AlertaGenera='<div class="col-xs-12 alert alert-success text-center"><b>Reproductor generado correctamente. Copie y pegue el código de inserción que se encuentra debajo</b></div>';
				$InsertaSuccess=true;
				if($_SESSION['user_roles']=='vendedor'){
                    $cre = mysqli_query($ConsultaDB, "SELECT crear FROM user WHERE id=".$_SESSION['user_id']);
                    $num = mysqli_query($ConsultaDB, "SELECT * FROM reproductores WHERE user_id=".$_SESSION['user_id']);
                    $dispo = mysqli_fetch_assoc($cre)['crear'];
                    $usados = $num->num_rows;

                    $restant = $dispo - $usados;
                }
			}else{
				$AlertaGenera='<div class="col-xs-12 alert alert-danger text-center"><b> Error al generar el reproductor. Favor de notificar al Administrador</b></div>';
			}
		}
	}
?>

   <script>
	  function resizeIframe(obj) {
				obj.style.height = 0;
                obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			}
	</script>
<style>
.topList {
    margin-bottom: 0 !important;
    margin-top: 15px !important;
    margin: 0 !important;
    background: #f3f3f3 !important;
    padding: 7px !important;
    border-top: 1px solid #e6e6e6 !important;
    background: transparent !important;
}
.topList button {
    background: transparent;
    text-decoration: none;
    height: 40px;
    line-height: 40px;
    display: inline-block;
    padding: 0 15px;
    box-sizing: border-box;
    vertical-align: middle;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: bir;
    transition: all .3s;
    background: #ffffff;
    color: #0091ec;
    border-radius: 2px;
    border: 0px;
}
.topList button:hover {
    background:#1a73e8;
    color:#ffffff;
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

</style>
<div  ng-app="EVOLUCIONSTREAM">
    <div ng-controller="Reproductor">

      <!--form-->
      <div class="col-md-8 MB10" style="padding-left: 0px;">
<?php if(isset($AlertaGenera)){echo $AlertaGenera;} ?>

<!--codigo-->
      <?php
      	if($InsertaSuccess){
      ?>
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
      <div class="col-xs-12 laterales" style="padding:15px; word-break: break-all;">
		<h4 class="pull-left">Código HTML</h4>
		<div class="topList">
		<button class="btn btn-default btn-sm pull-right tooltip" id="copyClip" data-clipboard-target="#codhtml" onclick="copyClip2()" onmouseout="outFunc()"><i class="fa fa-copy"></i><span class="tooltiptext" id="myTooltip">Copiar código al portapapeles</span>
  Copiar Código 
  </button></div>
		<textarea disabled class="form-control" height="150" style="resize: vertical; min-height:80px;" id="codhtml"><iframe frameborder="0" scrolling="no" style="<?php echo $Ventana; ?>" src="https://player.mediapanel.app/?idr=<?php echo base64_encode($id_rep); ?>"></iframe></textarea>
      </div><div class="clearfix"></div>
      <?php
      	}
      ?>
      <!--/codigo-->

		<form action="" method="POST" id="form-principal" enctype="multipart/form-data">
            <?php if(!empty($dispo)){ ?>
		  <div class="col-xs-12"><h4>Generador <?php echo 'Le quedan: '.$restant.' de '.$dispo; ?></h4></div>
		  <?php } ?>

		   <div class="form-group col-sm-3 col-md-3 MB10 ">
		    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gear"></i></span>
		      <select name="tiporadio" class="form-control select-abajo" ng-model="versionSC" style="color:#999;" required="required">
		          <option value="">Tipo Radio</option>
		          <option value="/;stream">ShoutCast v1</option>
		      	<option value="stream" ng-init="versionSC='stream'">ShoutCast v2</option>
		      	<option value="/stream" placeholder="Nombre de la Emisora" >IceCast v2</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group col-md-9 col-sm-9 MB10 ">
		    <div class="input-group col-md-12" ng-show="versionSC">
		        <?php
                        $servidores = json_decode($perfil['servidores']); ?>
                <div class="input-group col-md-6 col-sm-4 MB10 " style="float: left;">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-server"></i></span>
		    	<select class="form-control select-abajo" name="ipemisora" id="ipemisora" ng-model="ipemisora" ng-init="ipemisora='<?php echo $servidores[0]; ?>'" required="required">
		    	    <?php
		    	        if(!empty($servidores)){
                            foreach($servidores as $serv){ 
                                    echo "<option value='{$serv}'>$serv</option>";
                            }
                        }
                    ?>
		    	</select></div>
		    	<div class="input-group col-md-3 col-sm-4 MB10 " style="float: left;">
		    	<span class="input-group-addon" style="width: 0.1px"></span>
		      		<input type="text" class="form-control text-center SinPadding" ng-model="puerto" maxlength="5" name="puerto" placeholder="Puerto" style="border-left:0px;" ng-init="puerto='10965'"></div>
		      		<div class="input-group col-md-3 col-sm-4 MB10 " style="float: left;">
		      		<span class="input-group-addon"></span>
	    		<!--<input type="hidden" name="asd">-->
		      		<!--<input type="text" class="form-control text-center SinPadding" maxlength="15" name="montaje" placeholder="Montaje" ng-model="montaje" ng-init="montaje='/stream'" disable></div>-->
		        <input type="text" class="form-control text-center SinPadding"   maxlength="15" name="montaje" placeholder="Montaje" ng-model="versionSC"></div>
		    </div>
		  </div>
		  


		  <div class="form-group col-sm-12 col-md-6 col-xs-6 MB10 ">
		    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-microphone"></i></span>
		      <input type="text" maxlength="30" class="form-control" id="emisora" name="emisora" ng-model="emisora" placeholder="Nombre de la Emisora" onkeyup="mayus(this);countChars5(this);" required="required">
		      <span class="input-group-addon" id="charNum5">0 / 30</span>
		    </div>
		  </div>
		  
		  <div class="form-group col-sm-12 col-md-6 col-xs-6 MB10">
		    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-link"></i></span>
		      <input type="text" maxlength="50" class="form-control" id="enlace" name="enlace" ng-model="enlace" ng-init="enlace='<?php echo $perfil['web']; ?>'" placeholder="URL Sitio Web" <?php if(!is_null($perfil['web'])){ echo "value='{$perfil['web']}'"; } ?> onkeyup="countChars6(this);">
		      <span class="input-group-addon" id="charNum6">34 / 50</span>
		    </div>
		  </div>

		  <div class="form-group col-md-12 MB10 ">
		    <div class="input-group col-xs-12">
		        <span class="input-group-addon" id="vista-img-logo">
		            <i class="fa fa-image"></i>
		        </span>
		        <input type="text" class="form-control col-xs-12" name="imglogo" id="imglogo" ng-model="imglogo" placeholder="Link del Logo Emisora" style="padding:20px;" autocomplete="off">
    		    <span class="input-group-addon btn" id="filelogo">
                    <i class="align-middle" data-feather="folder"></i>
                    <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" ng-model="filelogo" name="filelogo" id="input-subir-img-logo">
                </span>
		    </div>
		    <!--<div class="input-group col-xs-12">-->
		    <!--  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-photo"></i></span>-->
		    <!--  <input type="text" maxlength="255" class="form-control" id="imglogo" name="logo" ng-model="logo" placeholder="Link del Logo Emisora" onkeyup="countChars7(this);">-->
		    <!--  <span class="input-group-addon" id="charNum7">0 / 255</span>-->
		    <!--</div>-->
		  </div>

		  

		  <div class="form-group col-md-12 MB10 ">
		    <div class="input-group col-xs-12">
		        <span class="input-group-addon" id="vista-img-facebook">
		            <i class="fa fa-image"></i>
		        </span>
		        <input type="text" class="form-control col-xs-12" name="imgfacebook" id="imgfacebook" ng-model="imgfacebook" placeholder="Link Imagen Facebook" style="padding:20px;" autocomplete="off">
    		    <span class="input-group-addon btn" id="filefacebook">
                    <i class="align-middle" data-feather="folder"></i>
                    <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" name="filefacebook" id="input-subir-img-facebook">
                </span>
		    </div>
		    <!--<div class="input-group col-xs-12">-->
		    <!--  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-photo"></i></span>-->
		    <!--  <input type="text" maxlength="255" class="form-control" id="imgfacebook" name="imgfacebook" ng-model="imgfacebook" placeholder="Link Imagen Facebook" ng-init="imgfacebook='../player/reproductores/img/fb.png" onkeyup="countChars4(this);">-->
		    <!--  <span class="input-group-addon" id="charNum4">32 / 255</span>-->
		    <!--</div>-->
		  </div>
		    <div class="form-group col-md-12 MB10 ">
                <div class="input-group col-xs-12">
    		        <span class="input-group-addon" id="vista-img-cover">
    		            <i class="fa fa-image"></i>
    		        </span>
    		        <input type="text" class="form-control col-xs-12" name="imgcover" id="imgcover" ng-model="cover2" placeholder="Link Imagen Banner" style="padding:20px;" autocomplete="off">
        		    <span class="input-group-addon btn" id="filecover">
                        <i class="align-middle" data-feather="folder"></i>
                        <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" name="filecover" id="input-subir-img-cover">
                    </span>
    		    </div>
            </div>
            
		  <!--redes sociales-->
		  <div class="form-group col-sm-6 MB10" style="display: none;">
		    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-facebook"></i></span>
		      <input type="text" class="form-control" name="facebook" ng-model="facebook" placeholder="https://www.facebook.com/usuario">
		    </div>
		  </div>
		  <div class="form-group col-sm-6 MB10" style="display: none;">
		    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-twitter"></i></span>
		      <input type="text" class="form-control" name="twitter" ng-model="twitter" placeholder="https://www.twitter.com/usuario">
		    </div>
		  </div>
		  <div class="form-group col-sm-6 MB10" style="display: none;">
		    <div class="input-group col-xs-12">
		      <span class="input-group-addon" id="basic-addon1"><i class="fab fa-instagram"></i></span>
		      <input type="text" class="form-control" name="instagram" ng-model="instagram" placeholder="https://www.instagram.com/usuario">
		    </div>
		  </div>
		  <!--redes sociales-->

		  <div class="form-group col-sm-6 MB10" style="display: none;">
		    <div class="input-group col-xs-12	">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-android"></i></span>
		      <input type="text" class="form-control" name="playstore" ng-model="playstore"  placeholder="Link PlayStore">
		    </div>
		  </div>
		  <div class="form-group col-sm-6 MB10" style="display: none;">
		    <div class="input-group col-xs-12	">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-windows"></i></span>
		      <input type="text" class="form-control" name="windows" ng-model="windows" placeholder="Link Windows Phone">
		    </div>
		  </div>

		  <div class="form-group col-sm-6 MB10" style="display: none;">
		    <div class="input-group col-xs-12	">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-apple"></i></span>
		      <input type="text" class="form-control" name="iphone" ng-model="iphone" placeholder="Link Iphone">
		    </div>
		  </div>

		  <br><br>
         <div class="col-xs-12 form-group MB10">
             <div class="preview-content">
		  <label style="display: block;text-align: center;line-height: 150%;font-size: 1.25em;" >Configuraciónes del Reproductor<br></label>
		  </div>
    </div>
		  <div class="form-group col-sm-6 MB10">
		      <label>Color Fondo:</label>
		      <br>
		      <div id="btncb" class="col-xs-12 SinPadding">
		    <select class="form-control select-abajo" ng-model="btn" name="btn" id="btn">
				<option value="red" class="btn-red">Red</option>
		    		<option value="pink" class="btn-pink">Pink</option>
		    		<option value="purple" class="btn-purple">Purple</option>
		    		<option value="deeppurple" class="btn-deeppurple">Deeppurple</option>
		    		<option value="indigo" class="btn-indigo">Indigo</option>
		    		<option value="blue" class="btn-blue">Blue</option>
		    		<option value="lightblue" class="btn-lightblue">LightBlue</option>
		    		<option value="cyan" class="btn-cyan">Cyan</option>
		    		<option value="teal" class="btn-teal">Teal</option>
		    		<option value="green" class="btn-green">Green</option>
		    		<option value="lightgreen" class="btn-lightgreen">LightGreen</option>
		    		<option value="lime" class="btn-lime">Lime</option>
		    		<option value="yellow" class="btn-yellow">Yellow</option>
		    		<option value="amber" class="btn-amber">Amber</option>
		    		<option value="orange" class="btn-orange">Orange</option>
		    		<option value="deeporange" class="btn-deeporange">Deeporange</option>
		    		<option value="brown" class="btn-brown">Brown</option>
		    		<option value="grey" class="btn-grey">Grey</option>
		    		<option value="bluegrey" class="btn-bluegrey">BlueGrey</option>
		    		<option value="darkblue" class="btn-darkblue">DarkBlue</option>
		    		<option value="black" class="btn-black" ng-init="btn='black'">Black</option>
		    		<option value="white" class="btn-white">White</option>
		    		</select>
		    </div>
		  </div>
		  <div class="form-group col-sm-6 MB10">
		      <label>Color Botones:</label>
		      <br>
		      <div id="abtncb" class="col-xs-12 SinPadding">
		    <select class="form-control select-abajo" ng-model="abtn" name="abtn" id="abtn">
		    		<option value="red" class="abtn-red"><font color="#FFF">Red</font></option>
		    		<option value="pink" class="abtn-pink" ng-init="abtn='pink'">Pink</option>
		    		<option value="purple" class="abtn-purple">Purple</option>
		    		<option value="deeppurple" class="abtn-deeppurple">Deeppurple</option>
		    		<option value="indigo" class="abtn-indigo">Indigo</option>
		    		<option value="blue" class="abtn-blue">Blue</option>
		    		<option value="lightblue" class="abtn-lightblue">LightBlue</option>
		    		<option value="cyan" class="abtn-cyan">Cyan</option>
		    		<option value="teal" class="abtn-teal">Teal</option>
		    		<option value="green" class="abtn-green">Green</option>
		    		<option value="lightgreen" class="abtn-lightgreen">LightGreen</option>
		    		<option value="lime" class="abtn-lime">Lime</option>
		    		<option value="yellow" class="abtn-yellow">Yellow</option>
		    		<option value="amber" class="abtn-amber">Amber</option>
		    		<option value="orange" class="abtn-orange">Orange</option>
		    		<option value="deeporange" class="abtn-deeporange">Deeporange</option>
		    		<option value="brown" class="abtn-brown">Brown</option>
		    		<option value="grey" class="abtn-grey">Grey</option>
		    		<option value="bluegrey" class="abtn-bluegrey">BlueGrey</option>
		    		<option value="darkblue" class="abtn-darkblue">DarkBlue</option>
		    		<option value="black" class="abtn-black">Black</option>
		    		</select>
		    </div>
		  </div>

		  <div class="col-xs-12 form-group MB10">
             <div class="preview-content">
		  <label style="display: block;text-align: center;line-height: 150%;font-size: 1.25em;">Texto que reemplazara la metadata cuando no se encuentre<br></label>
		  </div>
    </div> 
    
		  <div class="form-group col-sm-6 MB10">
		    <div id="Artista" class="input-group col-xs-12	">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-font"></i></span>
		      <input type="text" maxlength="30" class="form-control" name="artista" ng-model="artista" placeholder="Artista" ng-init="artista='En vivo'" onkeyup="countChars(this);" >
		      <span class="input-group-addon" id="charNum">7 / 30</span>
		    </div>
		  </div>

		  <div class="form-group col-sm-6 MB10">
		    <div id="Cancion" class="input-group col-xs-12	">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-font"></i></span>
		      <input  type="text" maxlength="50" class="form-control" name="cancion"  ng-model="cancion" placeholder="Canción" ng-init="cancion='Buena Música las 24 horas!'" onkeyup="countChars2(this);" >
		      <span class="input-group-addon" id="charNum2">26 / 50</span>
		    </div>
		  </div>



		  <!--Pantalla latidos-->
         <br><br>
         <div class="col-xs-12 form-group MB10">
             <div class="preview-content">
		  <label style="display: block;text-align: center;line-height: 150%;font-size: 1.25em;" >Configuración de la pantalla del Reproductor<br></label>
		  </div>
    </div>
         <div class="form-group col-sm-6 MB10">
             <label>Texto Pantalla: </label>
		    <div id="Latidosid" class="input-group col-xs-12	">
		      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-font"></i></span>
		      <input type="text" maxlength="40" class="form-control" id="latidos" name="latidos" ng-model="latidos" placeholder="Texto de Play" ng-init="latidos='Haga click para comenzar a reproducir'" onkeyup="countChars3(this);">
		      <span class="input-group-addon" id="charNum3">37 / 40</span>
		    </div>
		  </div>

         <div class="col-xs-6">
		    <label>Seleccionar Color: </label>
		    <div class="col-xs-12 SinPadding">
		    <div id="colorpicker" class="input-group colorpicker-component">
			    <input type="text" class="form-control" ng-model="color" name="color" class="campo-color" />
			    <span class="input-group-addon desplegable"><i style="background-color: rgb(255,255,255);"></i></span>
			    <span class="input-group-addon"><span class="fa fa-refresh" ng-click="CambiarColor()" ng-init="color='ffffff'" style="cursor: pointer;"></span></span>
			</div>

		    </div>
		  </div>

         <!--Pantalla latidos-->

         <div class="form-group col-sm-6 MB10" style="visibility: hidden;">
		    <div class="input-group col-xs-12	">
		      <span class="input-group-addon" ><i class="fa fa-apple"></i></span>
		      <input type="text" class="form-control" >
		    </div>
		  </div>

		  <div class="col-xs-3 form-group MB10">
		    <label>Seleccionar Tema: </label>
		    <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-paint-brush"></i></span>
		    	<select class="form-control select-abajo" ng-model="TemaRep" ng-change="CambiarTema(TemaRep)" name="theme" id="theme" onChange="mostrar(this.value);" required="required" />
		    		<option value="uno">THEME 1</option>
		    		<option value="dos">THEME 2</option>
		    		<option value="tres">THEME 3</option>
		    		<option value="cuatro">THEME 4</option>
		    		<option value="cinco">THEME 5</option>
		    		<option value="seis">THEME 6</option>
		    	</select>


	    		</div>
		  </div>

		

		  


		  <div class="form-group col-sm-9 MB10">

           <div class="col-xs-3 text-center">
		      <label>Pantalla:</label>
		      <br>
		      <div id="Mamparacb" class="col-xs-12 SinPadding">
		    <select class="form-control select-abajo" ng-init="Mampara='visible'" ng-model="Mampara" name="Mampara" id="Mampara">
				<option value='visible' class="btn-green">Si</option>
		    	<option value='hidden' class="btn-red">No</option>

		    		</select>
		    </div>
		  </div>


		  <div class="col-xs-3 text-center">
		    <label>AutoPlay: </label><br>
		    <div id="autoplayid" class="col-xs-12 SinPadding" >
		    <select class="form-control select-abajo" ng-model="autoplay" name="autoplay" id="autoplay">
				<option value='true' ng-init="autoplay='true'" class="btn-green">Si</option>
		    	<option value='false' class="btn-red">No</option>

		    		</select>
		    </div>
		  </div>
		  
		  <div class="col-xs-3 text-center" style="display: none;">
		    <label>SVersion: </label><br>
		    <div id="SVersionid" class="col-xs-12 SinPadding" >
		    <select class="form-control select-abajo" ng-model="SVersion" name="SVersion" id="SVersion">
         <option value='<?php if($Montaje=='/;stream'){$SVersion="1";}
		if($Montaje=='stream'){$SVersion="2";}
		if($Montaje=='/stream'){$SVersion="icecast";} ?>'  ng-init="SVersion='<?php if($Montaje=='/;stream'){$SVersion="1";}
		if($Montaje=='stream'){$SVersion="2";}
		if($Montaje=='/stream'){$SVersion="icecast";} ?>'"</option>
		    		</select>
		    </div>
		  </div>
		  
		  <div class="col-xs-3 text-center">
		    <label>Oyentes: </label><br>
		    <div id="Listenersid" class="col-xs-12 SinPadding" >
		    <select class="form-control select-abajo" ng-model="Listeners" name="Listeners" id="Listeners">
				<option value='true' ng-init="Listeners='true'" class="btn-green">Si</option>
		    	<option value='false' class="btn-red">No</option>

		    		</select>
		    </div>
		  </div>

		  <div class="col-xs-3 text-center">
		   <label>Blur Effect:</label><br>
		   <div id="blurid" class="col-xs-12 SinPadding" >
		    <select class="form-control select-abajo" ng-model="blur" name="blur" id="blur">
				<option value='true' ng-init="blur='true'" class="btn-green">Si</option>
		    	<option value='false' class="btn-red">No</option>

		    		</select>
		    </div>
		  </div>
		  <div class="col-xs-3 text-center">
		   <label>Caratulas:</label><br>
		   <div id="caratulasid" class="col-xs-12 SinPadding" >
		    <select class="form-control select-abajo" ng-model="caratulas" name="caratulas" id="caratulas">
				<option value='true' ng-init="caratulas='true'" class="btn-green">Si</option>
		    	<option value='false' class="btn-red">No</option>

		    		</select>
		    </div>
		  </div>
		  
		  
		  </div>
        <div id="uno" class="form-group col-sm-3 MB10" style="display: none;">
		      <label>Posición </label>
		      <div class="input-group col-xs-12">
		    	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-gear"></i></span>
		    <div id="vrtcb" class="input-group col-xs-12">
		        <select class="form-control select-abajo" ng-model="vrt" name="vrt" id="vrt">
		    		<option value="true">Vertical</option>
					<option value="false" ng-init="vrt='false'">Horizontal</option>
		        </select>
		    </div></div>
		  </div>
		  
		   <div class="col-xs-12 form-group MB10" style="margin-top: 15px;">
		    <input class="form-control btn btn-success text-left" type="submit" name="generar" value="Generar Código Reproductor HTML5" style=" width:100%;">
		   </div>


		  <div class="clearfix"></div>
		</form>

      </div>
      <!--/form-->

      <!--preview-->
      <div class="col-md-4 laterales MB10" style="padding:15px;">
         <div class="preview-content" style="width:100%;" onload="resizeIframe(this)"> 
		<h4 style="text-align: center;padding: 7px;margin: -15px;">Vista Previa</h4>
		<div class="col-xs-12 vista-previa SinPadding" ng-class="" ng-show="TemaRep" style="padding-top: 30px;">
			<!--REPRODUCTOR-->
			<iframe frameborder="0" scrolling="no" style="width:100%;" onload="resizeIframe(this)" ng-src="{{'../player/reproductores/?&ip='+ipemisora+'&puerto='+puerto+'&montaje='+versionSC+'&SVersion='+SVersion+'&titulo='+emisora+'&autoplay='+autoplay+'&Listeners='+Listeners+'&Artwork='+caratulas+'&blur='+blur+'&Mampara='+Mampara+'&vrt='+vrt+'&tema='+tema+'&abtn='+abtn+'&btn='+btn+'&facebook='+facebook+'&twitter='+twitter+'&instagram='+instagram+'&playstore='+playstore+'&messenger='+messenger+'&Whatsapp='+Whatsapp+'&enlace='+enlace+'&winamp='+winamp+'&color='+color+'&latidos='+latidos+'&artista='+artista+'&cancion='+cancion+'&logo='+imglogo+'&imgfacebook='+imgfacebook}}"></iframe>
			<!--FIN REPRODUCTOR-->
		</div>
		</div><div class="clearfix"></div>
      </div>
      <!--/preview-->

    </div>

    <!--Libs-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>

    <script src="../player/js/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--<script src="../player/js/bootstrap.min.js"></script>-->
    <script src="../player/js/bootstrap-colorpicker.min.js"></script>
    <script src="../player/js/app.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
			function resizeIframe(obj) {
				obj.style.height = 0;
                obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			}
			$(function() {
			    $('#colorpicker').colorpicker();

		        $('#colorpicker').on("change",function(){
		        	 $('#colorpicker input').attr('value',$('#colorpicker').colorpicker('getValue','ffffff'));
		        });

		        $('#Latidosid').on("change",function(){
		        	 $('#Latidosid input').attr('value',$('#Latidosid').Latidosid('getValue','Haga click para comenzar a reproducir'));
		        });

		        $('#Artista').on("change",function(){
		        	 $('#Artista input').attr('value',$('#Artista').Artista('getValue','En vivo'));
		        });

		        $('#Cancion').on("change",function(){
		        	 $('#Cancion input').attr('value',$('#Cancion').Cancion('getValue','Buena Música las 24 horas!'));
		        });

		        $('#imgfacebook').on("change",function(){
		        	 $('#imgfacebook input').attr('value',$('#imgfacebook').imgfacebook('getValue','../player/reproductores/img/fb.png'));
		        });

		        $('#abtncb').on("change",function(){
		        	 $('#abtncb select').attr('value',$('#abtncb').abtncb('getValue','pink'));
		        });

		        $('#vrtcb').on("change",function(){
		            vrt = document.getElementById('vrt').value;
		        	 $('#vrtcb select').attr('value',$('#vrtcb').vrtcb('getValue','false'));
		        });

		        $('#blurid').on("change",function(){
		            blur = document.getElementById('blur').value;
		        	 $('#blurid select').attr('value',$('#blurid').blurid('getValue','false'));
		        });

		        $('#btncb').on("change",function(){
		        	 $('#btncb select:text').attr('value',$('#btncb').btncb('getValue','black'));
		        });

		        $('#autoplayid').on("change",function(){
		            autoplay = document.getElementById('autoplay').value;
		        	 $('#autoplayid select').attr('value',$('#autoplayid').autoplayid('getValue','true'));
		        });
		        
		        $('#Listenersid').on("change",function(){
		            Listeners = document.getElementById('Listeners').value;
		        	 $('#Listenersid select').attr('value',$('#Listenersid').Listenersid('getValue','true'));
		        });

		        $('#Mampara').on("change",function(){
		            Mampara = document.getElementById('Mampara').value;
		        	 $('#Mampara select').attr('value',$('#Mampara').Mampara('getValue','hidden'));
		        });

			});
        });

		function countChars(obj){
		    var maxLength = 30;
		    var strLength = obj.value.length;
		    var charRemain = ( + strLength);

		    if(charRemain == 30){
		        document.getElementById("charNum").innerHTML = '<span style="color: red;">30 / '+maxLength+'</span>';
		    }else{
		        document.getElementById("charNum").innerHTML = charRemain+' / 30';
		    }
		}
		function countChars2(obj){
		    var maxLength = 50;
		    var strLength = obj.value.length;
		    var charRemain = ( + strLength);

		    if(charRemain == 50){
		        document.getElementById("charNum2").innerHTML = '<span style="color: red;">50 / '+maxLength+'</span>';
		    }else{
		        document.getElementById("charNum2").innerHTML = charRemain+' / 50';
		    }
		}
		function countChars3(obj){
		    var maxLength = 40;
		    var strLength = obj.value.length;
		    var charRemain = ( + strLength);

		    if(charRemain == 40){
		        document.getElementById("charNum3").innerHTML = '<span style="color: red;">40 / '+maxLength+'</span>';
		    }else{
		        document.getElementById("charNum3").innerHTML = charRemain+' / 40';
		    }
		}
		function countChars4(obj){
		    var maxLength = 255;
		    var strLength = obj.value.length;
		    var charRemain = ( + strLength);

		    if(charRemain == 255){
		        document.getElementById("charNum4").innerHTML = '<span style="color: red;">255 / '+maxLength+'</span>';
		    }else{
		        document.getElementById("charNum4").innerHTML = charRemain+' / 255';
		    }
		}
		function countChars5(obj){
		    var maxLength = 30;
		    var strLength = obj.value.length;
		    var charRemain = ( + strLength);

		    if(charRemain == 30){
		        document.getElementById("charNum5").innerHTML = '<span style="color: red;">30 / '+maxLength+'</span>';
		    }else{
		        document.getElementById("charNum5").innerHTML = charRemain+' / 30';
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
		function countChars7(obj){
		    var maxLength = 255;
		    var strLength = obj.value.length;
		    var charRemain = ( + strLength);

		    if(charRemain == 255){
		        document.getElementById("charNum7").innerHTML = '<span style="color: red;">255 / '+maxLength+'</span>';
		    }else{

		        document.getElementById("charNum7").innerHTML = charRemain+' / 255';
		    }
		}
        const r = /^https/i;
        function previewImage(img) {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById("input-subir-img-"+img).files[0]);
            reader.onload = function(e) {
                $("#vista-img-"+img).html("<img src='"+e.target.result+"' width='50' height='26'>");
            };
            
        }
        
        const inputTexto = (img,tag) =>{
            const r = /^https/i;
		    if(r.test(img)){
                $.get(img)
                .done(function() { 
                    $("#vista-img-"+tag).html("<img src='"+img+"' width='50' height='26'>");
            
                }).fail(function() { 
                    $("#vista-img-"+tag).html("<i class='fa fa-image'></i>");
            
                })
		    }
        }
        
        $("#filelogo").click(()=>{
           document.getElementById("input-subir-img-logo").click();
        })

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

		
		$("#input-subir-img-facebook").change(function () {
		    $("#imgfacebook").val($(this).val());
		    previewImage("facebook");
		})
		$("#imgfacebook").keyup(()=>{
		    let img = $("#imgfacebook").val();
		    inputTexto(img,"facebook");
		})
		
		$("#filecover").click(()=>{
           document.getElementById("input-subir-img-cover").click();
        })

		$("#input-subir-img-cover").change(function () {
		    $("#imgcover").val($(this).val());
		    previewImage("cover");
		})
		$("#imgcover").keyup(()=>{
		    let img = $("#imgcover").val();
		    const r = /^https/i;
		    inputTexto(img,"cover");
		})
	</script>

	<script type="text/javascript">
		function mostrar(id) {
		    if (id == "uno") {
		        $("#uno").show();
		        $("#dos").hide();
		    }

		    if (id == "dos") {
		        $("#uno").hide();
		        $("#dos").show();
		    }
		}
		function mayus(e) {
		    e.value = e.value.toUpperCase();
		}
	</script>
</div>
  </body>
</html>