<!--<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<div id="contenedor_contacto">
	
	<div class="header_contacto">
		<h1>Formulario de Contacto <span>&lt;<?php echo $TituloEmisora; ?>&gt;</span></h1>
	</div>
	<div class="cuerpo_contacto">
		<form action="" method="POST">
			<label for="nombre">Nombre y Apellido</label>
			<input type="text" name="nombre" id="nombre" required="required">
			<label for="email">E-Mail</label>
			<input type="text" name="email" id="email" required="required">
			<label for="telefono">Teléfono (opcional)</label>
			<input type="text" name="telefono" id="telefono">
			<label for="mensaje">Mensaje:</label>
			<textarea required="required" name="mensaje" id="mensaje"></textarea>
			<input type="submit" value="Enviar Mensaje" class="enviar_mensaje">
			<div class="clear"></div>
		</form>
	</div>
	<p class="texto_footer">Desarrollo por <a href="https://www.evolucionstreaming.com/" target="_blank">Evolución Streaming</a></p>>
</div>-->

<!--
$Tema=$Datos['Tema'];

				$IP=$Datos['Servidor'];
				$Puerto=$Datos['Puerto'];
				$Montaje=$Datos['Montaje'];
				$Autoplay=$Datos['Autoplay'];
				$Portada=$Datos['Portada'];

				$TituloEmisora=$Datos['TituloEmisora'];
				$Logo=$Datos['Logo'];
				$Email=$Datos['Email'];
				$Facebook=$Datos['Facebook'];
				$Twitter=$Datos['Twitter'];

				$Playstore=$Datos['Playstore'];
				$Windows=$Datos['Windows'];
				$Iphone=$Datos['Iphone'];
				$Winamp=$Datos['Winamp'];
-->

<div class="container">  
  <form id="contact" action="" method="POST">
    <h3>Formulario de Contacto</h3>
    <h4><?php echo $TituloEmisora; ?></h4>
    <fieldset>
      <input placeholder="Nombre y Apellido" type="text" name="nombre" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="E-mail" type="email" tabindex="2" name="email" required>
    </fieldset>
    <fieldset>
      <input placeholder="Teléfono (opcional)" type="text" name="telefono" tabindex="3">
    </fieldset>
    <fieldset>
      <textarea placeholder="Mensaje" name="mensaje" tabindex="4" required></textarea>
    </fieldset>
    <?php echo $alerta_contacto;?>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Enviando">
      <span>Enviar Mensaje</span>
      <div class="spinner">
		  <div class="rect1"></div>
		  <div class="rect2"></div>
		  <div class="rect3"></div>
		  <div class="rect4"></div>
		  <div class="rect5"></div>
		</div>
      </button>
    </fieldset>
  </form>
  <p class="copy">Desarrollado por <a href="https://www.evolucionstreaming.com/" target="_blank"><img src="img/copy.png"></a></p>
</div>
<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#contact').on('submit',function(){
			$('#contact-submit span').hide();
			$('.spinner').show();
		});
	});
</script>