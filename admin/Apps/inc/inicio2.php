<title><?php echo $TituloEmisora; ?></title>
<link href="https://clientes.evolucionstreaming.com/templates/templates-six-master/img/FAVICON_64X64-1-1.ico" rel="icon" title="Evolución Streaming - Servicios Informáticos" type="image/x-icon" />
<div class="container SinPadding" ng-controller="Reproductor">
   
    <div class="col-xs-12 SinPadding">
	    <div class="reproductor ">

			<div class="audio-player" controls="controls">
				<div class="cover-cont"><img class="cover" id="portada" src="" alt=""></div>

				<div class="bloque-redes">
					<?php
						if(!empty($Email))
							echo '<a href=mailto:'.$Email.'  target="_blank" class="btn btn-mail btn-sm pull-right text-center SocialColor" style="width:28px; margin:0px 2px; color:#fff; border: 1px solid #fff;"><i class="fa fa-envelope"></i></a>';
						if(!empty($Instagram))
							echo '<a href="'.$Instagram.'" class="btn btn-instagram btn-default btn-sm pull-right text-center SocialColor" target="_blank" style="width:28px; margin:0px 2px; color:#fff; border: 1px solid #fff;"><i class="fab fa-instagram"></i></a>';	
						if(!empty($Twitter))
							echo '<a href="'.$Twitter.'" class="btn btn-twitter btn-default btn-sm pull-right text-center SocialColor" target="_blank" style="width:28px; margin:0px 2px; color:#fff; border: 1px solid #fff;"><i class="fa fa-twitter"></i></a>';
						if(!empty($Facebook))
							echo '<a href="'.$Facebook.'" class="btn btn-facebook btn-sm pull-right text-center SocialColor" target="_blank" style="width:28px; margin:0px 2px; color:#fff; border: 1px solid #fff;"><i class="fa fa-facebook"></i></a>';
						if(!empty($Whatsapp))
							echo '<a href="https://wa.me/'.$Whatsapp.'" class="btn btn-whatsapp btn-sm pull-right text-center SocialColor" target="_blank" style="width:28px; margin:0px 2px; color:#fff; border: 1px solid #fff;"><i class="fa fa-whatsapp"></i></a>';
						if(!empty($Messenger))
							echo '<a href="https://fb.me/msg/'.$Messenger.'" class="btn btn-messenger btn-sm pull-right text-center SocialColor" target="_blank" style="width:28px; margin:0px 2px; color:#fff; border: 1px solid #fff;"><i class="fab fa-facebook-messenger"></i></a>';
							
					?>
				</div>
				<div class="bloque-links animacion-links">
		 			<?php
						if(!empty($Playstore))
							echo '<a href="'.$Playstore.'" class="text-center" target="_blank"><i class="link-externo android" style="font-size:20px;"></i></a>';
						if(!empty($Windows))
							echo '<a href="'.$Windows.'" class=" text-center" target="_blank" ><i class="link-externo windows" style="font-size:20px;"></i></a>';
						if(!empty($Iphone))
							echo '<a href="'.$Iphone.'" class="text-center" target="_blank" ><i class="link-externo iphone" style="font-size:20px;"></i></a>';
						if(!empty($Winamp))
							echo '<a href="'.$Winamp.'" class=" text-center" target="_blank" ><i class="link-externo winamp" style="font-size:20px;"></i></a>';
					?>
		 		</div>
				<h1 id="nombre-radio"><?php echo $TituloEmisora; ?></h1>
				<h1 id="artista">Cargando...</h1>
				<audio id="audio-player" preload="none" <?php echo $Autoplay; ?> controls="controls">
					<source src="<?php echo 'http://'.$IP.':'.$Puerto.$Montaje; ?>" type="audio/mp4">
					<source class="fuente" src="<?php echo 'http://'.$IP.':'.$Puerto.$Montaje; ?>" type="audio/aac">
					<source src="<?php echo 'http://'.$IP.':'.$Puerto.$Montaje; ?>" type="audio/mpeg">
				</audio>

				<div class="msie">
					<p>Internet Explorer no es compatible.</p>
					<p>Descargue Chrome o Firefox para disfrutar el servicio.</p>
				</div>

			</div>
			<div class="clearfix"></div>

	    </div>
    </div>

	<input type="hidden" id="url" value="<?php echo 'http://'.$IP.':'.$Puerto.$Montaje; ?>"/>
	<input type="hidden" id="ip" value="<?php echo $IP;?>"/>
	<input type="hidden" id="autoplay" value="<?php echo $Autoplay; ?>"/>
	<input type="hidden" id="mostrar_portada" value="<?php echo $Portada; ?>"/>
	<input type="hidden" id="puerto" value="<?php echo $Puerto; ?>"/>
	<input type="hidden" id="logo" value="<?php echo $Logo; ?>"/>

</div>

<!--Libs-->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/mediaelement-and-player.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/marquee.js"></script>

<script type="text/javascript">
	if (document.documentMode || /Edge/.test(navigator.userAgent)) {
	    $('.msie').css('display','block !imporant');
	}
	$(document).ready(function(){
		var tiempo_refresco_ms = 1000*60*3; //cada 3 min
		var refresco = null;//clear setInterval
		var mostrar_portada = $("#mostrar_portada").val();
		var autoplay = $("#autoplay").val();
		var actual;
		
		/*Actualizar datos visor*/
		ActualizaDatos();
		function ActualizaDatos(){
			$.ajax({
				url: 'datos-reproduciendo.php?ip='+$("#ip").val()+'&puerto='+$("#puerto").val()+'&portada='+mostrar_portada+'&logo='+$("#logo").val(),
				method: 'POST',
				dataType: 'json',
				success: function(datos){
					console.log("actualiza");
					if(datos.tema != actual){
					    	$("#portada").attr("src",datos.portada).fadeIn();

					    	if(datos.tema || datos.artista){
					    		/*var con_tema ='';
					    		if(datos.tema)
					    			con_tema = datos.artista+" - "+datos.tema;*/
					    		$("#artista").html(" ");
					    		$("#artista").append('<marquee behavior="scroll" scrollamount="4" direction="left" width="95%">'+datos.tema+'</marquee>');
					    		
					    	}
				 		actual = datos.tema;
					}
				}
			});
		}

		$(function(){
			var fuente=$('.fuente').attr("src");
			$('#audio-player').mediaelementplayer({
			    alwaysShowControls: true,
			    features: ['playpause','volume','flash','silverlight'],
			    audioVolume: 'horizontal',
			    iPadUseNativeControls: false,
			    iPhoneUseNativeControls: false,
			    AndroidUseNativeControls: false,
			    success: function (mediaElement, domObject) {   
				    if (autoplay == 'autoplay') {
			            mediaElement.addEventListener('canplay', function() {
			                mediaElement.play();
			            }, false);
			        }
			        mediaElement.addEventListener('pause', function(e) {
			           mediaElement.setSrc('');
			           clearInterval(refresco);
			           $("#artista").fadeOut();
			           $('.audio-player .bloque-links.animacion-links').removeClass( "activa", 1000, "easeOutBounce" );
			        }, false);
			        mediaElement.addEventListener('play', function(e) {
			        	$("#artista").fadeIn();				           
			            $('.audio-player .bloque-links.animacion-links').addClass( "activa", 1000, "easeOutBounce" );
			        }, false);
			        mediaElement.addEventListener('playing', function(e) {
			        	refresco = setInterval(ActualizaDatos,tiempo_refresco_ms);
			        	console.log("playing");
			        }, false);
			    }
			});
		});
		$('#artista marquee').marquee();
	});
</script>