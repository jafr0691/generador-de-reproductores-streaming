<?php
include "conn.php";
$idrepro = $_POST['id'];
$userid = $_POST['user'];



$repro = mysqli_query($conn, "SELECT * FROM reproductores WHERE id='$idrepro'");
    $reproData = mysqli_fetch_assoc($repro);

$TituloWeb = $reproData['TituloWeb'];
$WebDescription = $reproData['WebDescription'];
$UserDominio = $reproData['UserDominio'];
$Logo2 = $reproData['Logo2'];

if($_SESSION['user_roles']=='usuario'){
            $use = mysqli_query($conn, "SELECT userid FROM user WHERE id='$userid'");
            $idu = mysqli_fetch_assoc($use);
            $idus = $idu['userid'];
        }else{
            $idus = $userid;
        }
        $per = mysqli_query($conn, "SELECT * FROM perfil WHERE id_user='$idus'");
        $perfil = mysqli_fetch_assoc($per);

echo '<div class="col-md-12 alert alert-success text-center" style="padding-left: 0px;padding-right: 0px;">
    			<div class="col-xs-12 laterales" style="padding:15px;word-break: break-all;color: black;">
    		        <div class="topList">
    		            <button class="btn btn-default btn-sm pull-right tooltip" id="copyClip" data-clipboard-target="#codhtml" onclick="copyClip2()" onmouseout="outFunc()">
    		                <i class="fa fa-copy"></i>
    		                <span class="tooltiptext" id="myTooltip">Copiar código al portapapeles
    		                </span>
                            Copiar Código 
                        </button>
                    </div>
  <h4 class="pull-left">Código HTML</h4>
  <br> 
  <span class="pull-left">
  <h4>WebSite '.$TituloWeb.'.</h4>
  </span>
		<textarea  disabled class="form-control fondo" height="450" style="resize: vertical; min-height:380px;" id="codhtml"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>'.$TituloWeb.'</title>

<!-- DATOS DE EMPRESA-->
<meta name="author" content="'.$perfil['text_footer'].'">
<meta property="fb:app_id" content="799268223443878" />
<meta property="fb:admins" content="100007529224026" />
<meta name="keywords" content="radio en vivo, radio online">

<!-- REDES SOCIALES-->
<meta property="og:title" content="'.$TituloWeb.'">
<meta property="og:description" content="'.$WebDescription.'">';
if(filter_var($Logo2, FILTER_VALIDATE_URL)){
        echo '
        <meta property="og:image" content="https://mediapanel.app/dashboard/player/reproductores/img/cover/'.$Logo2.'">';
    }else if(empty($Logo2)){
        echo '
        <meta property="og:image" content="https://mediapanel.app/dashboard/player/reproductores/img/fb.png">';
    }else{
        
        echo '
        <meta property="og:image" content="https://mediapanel.app/dashboard/player/reproductores/img/fb/'.$Logo2.'">';
    }
echo '<meta property="og:url" content="https://site.mediapanel.app/?idr='.base64_encode($idrepro).'">
<meta name="twitter:site" content="@'.$perfil['twitter'].'" />
<meta name="twitter:creator" content="@'.$perfil['twitter'].'" />
<meta name="twitter:domain" content="'.$UserDominio.'">
<meta name="twitter:url" content="'.$UserDominio.'">
<meta name="twitter:title" content="'.$TituloWeb.'">
<meta name="twitter:description" content="'.$WebDescription.'">';
    if(filter_var($Logo2, FILTER_VALIDATE_URL)){
        echo "
        <meta name='twitter:image:src' content='".$Logo2."'>";
    }else if(empty($Logo2)){
        
        echo"
        <meta name='twitter:image:src' content='https://mediapanel.app/dashboard/player/reproductores/img/fb.png'>";
    }else{
        
        echo "
        <meta name='twitter:image:src' content='https://mediapanel.app/dashboard/player/reproductores/img/fb/".$Logo2."'>";
    }

echo '<!-- ICONOS-->';
if(filter_var($Logo2, FILTER_VALIDATE_URL)){
        echo "
        <link rel='icon' href='".$Logo2."' sizes='2x32' />
        <link rel='icon' href='".$Logo2."' sizes='192x192' />
        <link rel='apple-touch-icon-precomposed' href='".$Logo2."' />";
    }else if(empty($Logo2)){
        
        echo "
        <link rel='icon' href='https://mediapanel.app/dashboard/player/reproductores/img/fb.png' sizes='2x32' />
            <link rel='icon' href='https://mediapanel.app/dashboard/player/reproductores/img/fb.png' sizes='192x192' />
            <link rel='apple-touch-icon-precomposed' href='https://mediapanel.app/dashboard/player/reproductores/img/fb.png' />";
    }else{
        
        echo "
        <link rel='icon' href='https://mediapanel.app/dashboard/player/reproductores/img/fb/".$Logo2."' sizes='2x32' />
        <link rel='icon' href='https://mediapanel.app/dashboard/player/reproductores/img/fb/".$Logo2."' sizes='192x192' />
        <link rel='apple-touch-icon-precomposed' href='https://mediapanel.app/dashboard/player/reproductores/img/fb/".$Logo2."' />";
    }

echo '</head>

<frameset rows="0," cols="" framespacing="1" frameborder="yes" border="1">
  <frame src="" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
  <frame src="https://site.mediapanel.app/?idr='.base64_encode($idrepro).'" name="mainFrame" id="mainFrame" />
</frameset>
<noframes><body>
</body>
</noframes></textarea>
      </div>
			</div>
			<div class="col-md-12" style="background: #009dff;color: #ffffff;border-radius: 5px;direction: ltr;flex: 1;max-width: 100vw;padding: 1.5rem 1.5rem 1.75rem;"> 
		<h4 style="text-align: center;padding: 7px;margin: -15px;">Vista Previa</h4></div>
			<div class="col-md-12 alert text-center" style="padding-left: 0px;padding-right: 0px;background-color: transparent;border-color: transparent;">
			<div class="col-xs-12 laterales" style="padding:15px;word-break: break-all;color: black;">
		
		<iframe frameborder="0" scrolling="si" style="width: 100%; height: 450px;" src="https://site.mediapanel.app/?idr='.base64_encode($idrepro).'"></iframe>
      </div>
			</div>
			<br>
		<div class="control-group"><br><br><br><br><br><br><br><br><br><br><br>
			<b>URL directa del web site</b>
			<hr style="margin-top: 5px; margin-bottom: 20px">
    <div class="input-group col-xs-12">
    <span class="input-group-addon">
                		            <i class="fa fa-arrow-circle-right"></i>
                		        </span>
    
    <input type="text" class="form-control input-lg fondo" value="https:/site.mediapanel.app/?idr='.base64_encode($idrepro).'" style="font-weight: bold; font-size: 17px; color:#104b5e;"></div>
			</div><br><script>
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
	</script>';