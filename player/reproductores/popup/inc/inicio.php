<style>
@keyframes latidos {
    from { transform: none; }
    50% { transform: scale(1.2); }
    to { transform: none; }
}
body { margin: 0px!important;}
    #contextmenu{
      background-color: rgba(12, 12, 12, 0.83);
      color: white;
      font-size:0.8em;
      transition-duration:0.1s;
      border-radius: 4px;
      margin-bottom: 10px;
      border: solid 2px #1b1717;
      position:fixed;z-index:10000000;
    }
    #contextmenu li>a{
      padding: 0.5em 0.8em;
      white-space: nowrap;
    }
	.dropdown-menu {
  display: none;
  position: absolute;
  z-index: 4;
  min-width: 160px;
  font-weight: 400;
  padding: 0 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 15px;
  text-align: left;
  background-color: white;
  color: #00796b;
  left: 0;
  top: 100%;
  clear: both;
  line-height: 1.3em;
}
.dropdown-menu.to-left {
  right: 10px;
  left: initial;
}
.dropdown-menu.to-top {
  bottom: 104%;
  top: initial;
}
.dropdown-menu > li > a {
  color: inherit;
}
.dropdown-menu.default > li > a:hover {
  background-color: #eceff1;
}
.dropdown {
  position: relative;
}
.dropdown.open > .dropdown-menu {
  display: block;
}
.dropdown-menu > li,
.nav .dropdown-menu > li {
  float: none;
}
.dropdown-menu > li a,
.nav .dropdown-menu > li a {
  display: block;
  padding: 0.7em 0.8em;
  width: 100%;
  clear: both;
}
a {
  background: transparent;
}
a:active,
a:hover {
  outline: 0;
}

a {
  text-decoration: none;
  color: inherit;
}
* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}
</style>

<title><?php echo $TituloEmisora; ?> | STREAMING SSL</title>
<meta property="og:title" content=":: <?php echo $TituloEmisora; ?> - STREAMING SSL ::"/>
<meta property="og:url" content="https://www.html5player.evolucionstreaming.com/reproductores/?idr=<?php echo base64_encode($IDR); ?>"/>

<ul id="contextmenu" class="dropdown-menu">
        <li style="
      border.bot: solid 3px black;
      border-top-left-radius: 6px;
      border-top-right-radius: 6px;
      border-bottom: solid 3px #1b1717;
        ">
          <a id="a01" target="_blank" >Player HTML5v2 by EVOLUCION STREAMING</a>
        </li>
        <li><a id="a02" target="_blank" >Streaming for Radio Stations?</a></li>
      </ul>

<a href="<?php echo $enlace;?>" target="_blank" class="ssll" id="ssll"><?php echo $TituloEmisora; ?> | STREAMING SSL</a>


			<div class="<?php echo $Tema;?>" id="<?php echo $Tema;?>"></div>
			

			<script src="../../js/jquery-3.5.1.min.js"></script>
			<script src="../popup/<?php echo $Tema;?>.js?<?php echo base64_encode($IDR); ?>=<?php echo base64_encode($IDR); ?>"></script>
<script>		
$("#<?php echo $Tema;?>").<?php echo $Tema;?>({
	    URL: "<?php echo 'https://'.$IP.':'.$Puerto; ?>",
		version: "2", 
		vertical_layout: <?php echo $vrt; ?>,
	    bg: "<?php echo $btn;?>",
		accent: "<?php echo $abtn;?>",
		logo: "<?php
		if(!empty($Logo)){
			$cover=$Logo;
		}else{
			$cover='../img/default.jpg';
		}
		echo $cover; ?>",
		blur: <?php echo $Blur;?>,
		autoplay:<?php echo $play;?>,
		volume:1,
		enable_cors: false,
    });
document.getElementById("botonMio").style.visibility = "<?php echo $Mampara;?>";
document.getElementById("latido").style.color = "<?php echo $Color;?>";
document.getElementById("latido").innerHTML = "<?php echo $Late;?>";
document.getElementById("titulo1").innerHTML = "<?php echo $Cancion;?>";
document.getElementById("titulo2").innerHTML = "<?php echo $Artista;?>";

$('#titulo1').titulo1();

		        $('#titulo1').on("change",function(){
		        	 $('#titulo1 input').attr('value',$('#titulo1').Cancion('getValue','<?php echo $Cancion;?>'));
		        });
</script>
<script>
$(function(){
          
          if(window.location.href.indexOf("EvolucionStreaming")<0){
            $("#a01").text("Player HTML5v2 by EVOLUCION STREAMING")
            $("#a01").attr("href","https://www.evolucionstreaming.com")
            $("#a02").text("Necesitas streaming HD para tu emisora de radio?")
            $("#a02").attr("href","https://www.clientes.evolucionstreaming.com/cart.php?gid=2")
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
$('#icon-download').hover(function () {
            $('#titulo1').toggleClass('nd');
            $('#titulo2').toggleClass('nd');
            $('#info-text').toggleClass('yd');
            $('#info-text').text('Envianos un WhatsApp');
            $("#cancion").attr("href","https://wa.me/<?php echo $Whatsapp;?>")
        });
$('#icon-popup').hover(function () {
            $('#titulo1').toggleClass('nd');
            $('#titulo2').toggleClass('nd');
            $('#info-text').toggleClass('yd');
            $('#info-text').text('Cerrar ventana')
        });
        $('#icon-popup').click(function (event) {
            event.preventDefault();
           window.close();
        })
	
</script>