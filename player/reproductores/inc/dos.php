<?php
$dos = "$Tema";
?>
 <?php  if($dos == "dos"){ ?>
<!DOCTYPE html>
    <html lang="es" >
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link <?php if(!empty($perfil['favicon'])){ echo "href='https://mediapanel.app/dashboard{$perfil['favicon']}'"; }else{ echo "href='https://player.mediapanel.app/img/ingre_img.jpg'";} ?> rel="shortcut icon" title="<?php echo $perfil['text_footer']; ?>" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Escucha las mejores radios en un solo lugar, ¡ingresa ahora y disfruta!">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $TituloEmisora; ?> | STREAMING SSL</title>
    <meta property="og:title" content=":: <?php echo $TituloEmisora; ?> - STREAMING SSL ::"/>
    <meta property="og:url" content="https://www.html5player.evolucionstreaming.com/reproductores/?idr=<?php echo base64_encode($IDR); ?>"/>
    <meta property="og:type" content="movie"/>
    <meta property="og:description" content="Escuchanos en vivo | <?php echo $perfil['text_footer']; ?>"/>
    <?php if(filter_var($Logo2, FILTER_VALIDATE_URL)){
        echo "<meta property='og:image' content='$Logo2'/>";
    }if ($Logo2 == "/img/fb/"){
        echo "<meta property='og:image' content='https://player.mediapanel.app/img/fb.png'/>";
    }else{
        echo "<meta property='og:image' content='https://player.mediapanel.app$Logo2'/>";
    }?>
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="250" />
    <meta property="fb:app_id" content="396838644238555" />
    <meta property="og:title" content=":: <?php echo $TituloEmisora; ?> - STREAMING SSL ::"/>
    <meta property="og:url" content="https://www.html5player.evolucionstreaming.com/reproductores/?idr=<?php echo base64_encode($IDR); ?>"/>
    <link href="css/tema-<?php echo $Tema;?>.css?<?php echo base64_encode($IDR); ?>=<?php echo base64_encode($IDR); ?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="css/general.css">
    </head>
      <body>
<a href="<?php echo $enlace;?>" target="_blank" class="ssll bg-<?php echo $btn;?>" id="ssll"><?php echo $TituloEmisora; ?> | STREAMING SSL</a>
<ul id="contextmenu" class="dropdown-menu">
        <li style="
      border.bot: solid 3px black;
      border-top-left-radius: 6px;
      border-top-right-radius: 6px;
      border-bottom: solid 3px #1b1717;
        ">
          <a id="a01" target="_blank" >Player HTML5v2 by <?php echo $perfil['text_footer']; ?></a>
        </li>
        <li><a id="a02" target="_blank" >Streaming for Radio Stations?</a></li>
      </ul>
     	
				<div class="<?php echo $Tema;?>" id="<?php echo $Tema;?>"></div>

<script src="https://mediapanel.app/dashboard/player/reproductores/js/jquery-3.5.1.min.js"></script>
<script src="https://mediapanel.app/dashboard/player/reproductores/<?php echo $Tema;?>.js?<?php echo base64_encode($IDR); ?>=<?php echo base64_encode($IDR); ?>"></script>

<script>
<?php if($uid['activ']==1 AND $ruactive['activ']==1){
?>
$("#<?php echo $Tema;?>").<?php echo $Tema;?>({
	    URL: "<?php echo 'https://'.$IP.':'.$Puerto; ?>",
		version: "2",
		logo: "<?php

		if(!empty($Logo)){
		    if(is_file("https://player.mediapanel.app/img/portadas/".$Logo)){
		        $cover = "https://player.mediapanel.app/img/portadas/".$Logo;
		    }else{
		        $cover = $Logo;
		    }
			
		}if ($Logo == "/img/portadas/"){
		   
			$cover = 'https://player.mediapanel.app/img/default.jpg';
		}
		echo $cover;?>",
		bg: "<?php echo $btn;?>",
		accent: "<?php echo $abtn;?>",
		artwork: <?php echo $Artwork; ?>,
		blur: <?php echo $Blur;?>,
		autoplay:<?php echo $play;?>,
		volume:1,
		show_listeners: <?php echo $Listeners;?>,
		enable_cors: false,
    });
     $(botonMio).addClass("<?php echo $Mampara;?>");
<?php }else{ ?>
        $("#<?php echo $Tema;?>").<?php echo $Tema;?>({
            URL: "<?php echo 'https://'.$IP.':'.$Puerto; ?>",
            version: "apagado",
    	    bg: "<?php echo $btn;?>",
    		logo: 'https://player.mediapanel.app/img/default.jpg'
        });
         $(botonMio).addClass("<?php echo $Mampara;?>");
    <?php } ?>
</script>
<script>
document.getElementById("latido").style.color = "<?php echo $Color;?>";

<?php if($uid['activ']==1 AND $ruactive['activ']==1){
?>
document.getElementById("latido").innerHTML = "<?php echo $Late;?>";
<?php if(empty($Cancion)){ ?>
    document.getElementById("titulo1").innerHTML = "En vivo";
<?php }else{ ?>
    document.getElementById("titulo1").innerHTML = "<?php echo $Cancion;?>";
<?php } ?>

<?php if(empty($Artista)){ ?>
    document.getElementById("titulo2").innerHTML = "Buenas Musicas las 24Horas!";
<?php }else{ ?>
    document.getElementById("titulo2").innerHTML = "<?php echo $Artista;?>";
<?php } 

}else{ ?>
    document.getElementById("latido").innerHTML = "Reproductor Apagado";
    document.getElementById("titulo1").innerHTML = "Reproductor Apagado";
    document.getElementById("titulo2").innerHTML = "Suspendido";
    
   <?php  }
    ?>
$(function(){
          
          if(window.location.href.indexOf("EvolucionStreaming")<0){
            $("#a01").text("Player HTML5v2 by | <?php echo $perfil['text_footer']; ?>")
            $("#a01").attr("href","<?php echo $perfil['web']; ?>")
            $("#a02").text("Necesitas streaming HD para tu emisora de radio?")
            $("#a02").attr("href","<?php echo $perfil['web']; ?>")
          }
          var context= $("#contextmenu")
          var contextc=false
          $(document).on("contextmenu", function(ev){
            ev.preventDefault()
            
            contextc= true
            var x= ev.pageX
            var y= ev.pageY
            var wo= $(window)
            var w= wo.outerWidth()
            var h= wo.outerHeight()
            var w1= context.outerWidth()
            var h1= context.outerHeight()
            context.css("left", Math.min(w-w1, x))
            context.css("top", Math.min(h-h1, y))
            context.removeClass("transitioned")
            context.show(300)
            setTimeout(function(){
              context.addClass("transitioned")
            },300)
            return false
          })
          
          $(document).click(function(){
            if(context.is(":visible"))
              context.hide()
          })

        })
</script> 
<script type="text/javascript">
function resizeIframe(obj) {
				obj.style.height = 0;
                obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			}
function resizeIframe2(obj) {
				obj.style.width = 0;
                obj.style.width = obj.contentWindow.document.body.scrollHeight + 'px';
			}
$('#icon-popup').hover(function () {
            $('#titulo1').toggleClass('nd');
            $('#titulo2').toggleClass('nd');
            $('#info-text').toggleClass('yd');
            $('#info-text').text('Abrir en una nueva ventana')
        });
$('#icon-download').hover(function () {
            $('#titulo1').toggleClass('nd');
            $('#titulo2').toggleClass('nd');
            $('#info-text').toggleClass('yd');
            $('#info-text').text('Envianos un WhatsApp');
            $("#cancion").attr("href","https://wa.me/<?php echo $Whatsapp;?>")
        });
        <?php if(empty($Whatsapp)){ ?>
$('#icon-download').css('display','none');
<?php } ?>
$('#icon-popup').attr('href','popup/?idr=<?php echo base64_encode($IDR); ?>', );
        $('#icon-popup').click(function (event) {
            event.preventDefault();
            window.open($(this).attr('href'), 'popupWindow', 'onload="resizeIframe2(this)",onload="resizeIframe(this)",scrollbars=no,<?=$Ventana2;?>')
        })
</script>

<?php	} ?>