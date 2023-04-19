<html lang="es">
 <head>   
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link <?php if(!empty($perfil['favicon'])){ echo "href='https://dashboard.mediapanel.app/panel-control{$perfil['favicon']}'"; }else{ echo "href='https://dashboard.mediapanel.app/panel-control/img/ingre_img.jpg'";} ?> rel="shortcut icon" title="<?php echo $perfil['text_footer']; ?>" type="image/x-icon" />
        <title><?php echo $TituloEmisora; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:url" content="https://site.mediapanel.app//?idr=<?php echo base64_encode($IDR); ?>">
        <meta property="og:title" content="<?php echo $TituloEmisora; ?>">
        <meta property="og:description" content="Servicio provisto por <?php echo $perfil['text_footer']; ?>">
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:url" content="https://site.mediapanel.app//?idr=<?php echo base64_encode($IDR); ?>"/>
        <meta name="twitter:title" content="<?php echo $TituloEmisora; ?>" />
        <meta name="twitter:description" content="Servicio provisto por <?php echo $perfil['text_footer']; ?>" />
        <meta property="og:image" content="https://site.mediapanel.app/cover/fb_<?php echo (!empty($Cover2))? $Cover2 : '8362.jpg'; ?>">
        <meta property="og:image:width"      content="500">
        <meta property="og:image:height"     content="250">

        <meta property="twitter:image" content="https://site.mediapanel.app/cover/fb_<?php echo (!empty($Cover2))? $Cover2 : '8362.jpg'; ?>">
       
        <link rel="canonical" href="https://site.mediapanel.app//?idr=<?php echo base64_encode($IDR); ?>" />
        <style>
 @font-face {
            font-family: Uni-Sans-Thin;
            src: url(../fonts/Uni%20Sans%20Heavy%20Italic.otf),
			url(../fonts/Uni%20Sans%20Heavy.otf),
			url(../fonts/Uni%20Sans%20Thin%20Italic.otf),
			url(../fonts/Uni%20Sans%20Thin.otf);
        }
.ss-container:hover .ss-scroll { opacity: 0; }
::-webkit-scrollbar {
    width: 8px;
    margin: 2px;
    background: transparent;
}
::-webkit-scrollbar-thumb {
    border-radius: 10px !important;
    -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 20%);
    background-color: #162029;
}
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 30%);
    border-radius: 10px !important;
    background: transparent;
}
</style>
        
        <link rel="stylesheet" href="../css/website/bootstrap.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/v4-shims.css">

<link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

        <link href="../css/website/hotsite04ce.css?_t=<?php echo base64_encode($IDR); ?>" media="screen" rel="stylesheet" type="text/css" />
        <link href="../players/player04ce.css?_t=<?php echo base64_encode($IDR); ?>" media="screen" rel="stylesheet" type="text/css" />
        <link href="../players/1/player04ce.css?_t=<?php echo base64_encode($IDR); ?>" media="screen" rel="stylesheet" type="text/css" />
      
<script type="text/javascript">
            var UPLOAD_BASE_URL = 'https://site.mediapanel.app';
            var BASE_ASSETS = 'https://site.mediapanel.app';
            var ASSETS_CONSTANT = '<?php echo base64_encode($IDR); ?>';
            var IS_MOBILE = false;
        </script>


        <script type="text/javascript" src="../js/jquery-1.11.3.min04ce.js?_t=<?php echo base64_encode($IDR); ?>"></script>
        
        <script type="text/javascript" src="../js/utils04ce.js?_t=<?php echo base64_encode($IDR); ?>"></script>
        <script type="text/javascript" src="../players/rf-player04ce.js?_t=<?php echo base64_encode($IDR); ?>"></script>
        <script type="text/javascript" src="../players/player-2017092104ce.js?_t=<?php echo base64_encode($IDR); ?>"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.nav-option-music, .nav-option-message').on('click', function() {
                    $(this).toggleClass('selected');
                    $('.nav-option').not($(this)).removeClass('selected');

                    $('#tabs #success-message').html('').hide();
                    refreshSelectedTab();
                });

                $('#tabs form').on('submit', function() {
                    var $this = $(this);
                    var action = $this.attr('action');
                    var data = $this.serialize();

                    if (!$this.hasClass('disabled')) {
                        $this.addClass('disabled');

                        $.post(action, data, function(result) {
                            console.log(result);
                            $this.removeClass('disabled');
                            $this.find('.error-message').html('').hide();
                            resetRecaptcha();

                            if (result.error != false) {
                                if (typeof result.error == 'string') {
                                    alert(result.error);
                                } else {
                                    $.each(result.error, function(i, item) {
                                        var errorMessage = '';
                                        $.each(item, function(j, error) {
                                            if (errorMessage != '') {
                                                errorMessage += '<br />';
                                            }
                                            errorMessage += error;
                                        });

                                        $this.find('label[id=element-' + i + ']').find('.error-message').show().html(errorMessage);
                                    });
                                }
                            } else {
                                $this.find('input[type=text], input[type=email], select, textarea').val('');

                                if ($this.closest('.tab').attr('id') == 'tab-music') {
                                    displaySuccessMessage('Pedido de música enviado com sucesso!');
                                } else {
                                    displaySuccessMessage('Recado enviado com sucesso!');
                                }
                            }

                        }, 'json');
                    }

                    return false;
                });
            });

            function displaySuccessMessage(message) {
                $('#tabs #success-message').html(message).show();
                $('.nav-option').removeClass('selected');
                refreshSelectedTab();
            }

            function resetRecaptcha() {
                grecaptcha.reset();
            }

            function refreshSelectedTab() {
                $('#tabs .tab').hide();
                var selected = $('.nav-option.selected');

                if (selected.length) {
                    var target = selected.data('target');
                    $('#' + target).show().find('input').first().focus();

                    var captcha = $('#' + target).find('.recaptcha');
                    if (captcha.html() == '') {
                        grecaptcha.render(
                            captcha[0],
                            {
                                'sitekey': '6LeQuSYTAAAAACseyzlRv9eKeY-nengEFzOF_JZv',
                                'expired-callback': function() {
                                    resetRecaptcha();
                                }
                            }
                        );
                    }
                }
            }

            Translator.addContent('component.player', {"split":{"label":{"program":"{program}","program-with-broadcaster":"{program} com {broadcaster}","schedule-period":"{start} - {end}","playing-now":"TOCANDO AGORA"}},"unified":{"label":{"program":"{program} ","program-with-broadcaster":"{program} com {broadcaster} de ","track":"Sonando Ahora : {track}","schedule-with-track" : "{schedule} - <strong>Sonando Ahora : &nbsp;{track}<\/strong>"}}});
        </script>
    </head>
    <body>
        <div id="content">
            
        <marquee style="color:#FFF;font-family:Uni-Sans-Thin;" ><h1><img style="margin:0px;" src="../img/ecualizador.gif" width="20">Bienvenidos a <strong><?php echo $TituloEmisora; ?></strong>
        <img style="margin:0px;" src="../img/ecualizador.gif" width="20"></h1></marquee>
        <div id="cover"><img src="https://site.mediapanel.app/./cover/<?php echo (!empty($Cover2))? $Cover2 : '8362.jpg'; ?>" /></div>
        
                        <div id="nav">
                <div id="player" class="bg-gray">
                    
<script type="text/javascript">
    var STREAMING_ADDRESS = '<?php echo $IP;?>';
    var STREAMING_PORT = '<?php echo $Puerto; ?>';
    var STREAMING_PROVIDER = 1;
    var MAIN_STREAM_URL = '<?php echo 'https://'.$IP.'/'.$CPuerto.'/stream'; ?>';
    var STREAMING_REFRESH_DATA_URL = 'https://site.mediapanel.app/?currentsong&idr=<?php echo base64_encode($IDR); ?>';
    var PLAYER_SHOW_MUSIC_NAME = true;
    var NEXT_SCHEDULES = {"19":{"id":"19","start":9253,"end":30853,"program_info":{"program_id":"2","program_name":"<?php echo $TituloEmisora; ?>"}},"4":{"id":4,"start":0,"end":9253,"program_info":{"program_id":1,"program_name":"<?php echo $TituloEmisora; ?>","start_time":4680,"end_time":5040}}};

    var PLAYER_ID = '1';
    var PLAYER_VERSION = 1;
    var PLAYER_POSITION = 1;
    var PLAYER_AUTOSTART = true;
    var PLAYER_SPLIT_DATA = false;

    var USE_PLAYER_PROXY = false;
    var USE_PLAYER = false;
    var STREAMING_TYPE = false;

    var RF3_SEARCH_FOR_COVER = false;

    </script>


<div class="rf-player player-version-1 player-1 player-position-top player-online">
    <div class="rf-width-control" style="">
        <div class="rf-padding-control">
            <div class="rf-player-container">
                <div class="rf-player-container-block" style="position: absolute;margin-top: -3000px;">
                    <div id="muses_container_"> </div>
                </div>
                <div class="rf-player-container-block" id="rf-player-container">
                    <div class="rf-player-background"></div>
                    <div id="rf-player-play" class="rf-player-play-pause rf-player-play active"></div>
                    <div id="rf-player-pause" class="rf-player-play-pause rf-player-pause"></div>

                                            <div class="rf-player-volume rf-player-volume-background"></div>
                        <div id="rf-player-volume-meter" class="rf-player-volume rf-player-volume-meter"></div>
                        <div id="rf-player-volume-area" class="rf-player-volume rf-player-volume-area"></div>
                    
                    <audio id="rf-player" style="width: 0; height: 0;">
                        <source></source>
                    </audio>
                </div>
                                    <img class="offline-image" src="../img/website/streaming-offline04ce.png?_t=<?php echo base64_encode($IDR); ?>" />
                            </div>

                            
                <div class="rf-playing-now" style="font-family:Uni-Sans-Thin; font-size:14px; color:#333; background: url(../img/repro.png)"></div>
            
                    </div>
    </div>
</div>
                </div>
<div id="nav-options">
<div class="responsive-item">
    <a class="nav-option nav-option-message bg-gray with-hover selected" data-target="tab-message">
<i class="fa fa-weixin" style="color:#FFF"></i>
<span style="font-family:Uni-Sans-Thin;">MENSAJES</span></a>
</div>

<div class="responsive-item">
<a class="nav-option nav-option-site bg-gray with-hover" href="<?php echo $Whatsapp; ?>" target="_top">
<i class="fab fa-whatsapp" style="color:#FFF"></i>
<span style="font-family:Uni-Sans-Thin;">WHATSAPP</span></a>
</div>

<div class="responsive-item">
<a class="nav-option nav-option-site bg-gray with-hover" href="<?php echo $Messenger; ?>" target="_top">
<i class="fab fa-facebook-messenger" style="color:#FFF"></i>
<span style="font-family:Uni-Sans-Thin;">MESSENGER</span>
</a>
</div></div></div>



<div id="tabs">
<div id="tab-message" class="tab" style="background: rgb(110, 116, 123); min-height: 300px; display: block; border-radius: 5px;">
<CENTER><h3><b style="color:#FFF ;font-family:Uni-Sans-Thin; "><i class="fa fa-weixin;"></i> Dejanos tu mensaje</b></h3>
<iframe border="0" frameborder="NO" width="100%" height="274px" scrolling="si" marginheight="0px" ss-container src="https://site.mediapanel.app/?comentarios&idr=<?php echo base64_encode($IDR); ?>"></iframe></CENTER></div>
<?php
if(!empty($Facebook) || !empty($Twitter) || !empty($Instagram) || !empty($Youtube)) 
echo  '<div id="social-medias">               <div class="socials">
                                <style> #link{ text-decoration:none;} #link a:hover{ text-decoration:none; }
       .blue a:hover{color:#3b5998}
       .c-menssenger a:hover{color:#0d6efd}
	   .cyan a:hover{color:#55acee}
	   .purple a:hover{color:#bc2a8d}
	   .red a:hover{color:#bb0000}
	   .c-Whatsapp a:hover{background:#25D366}
       </style>


<span class="counter justify-content-center align-items-center" style="color:#cacaca;
margin-top:10px;margin-right:10px; font-size:15px;text-align:left;font-family:Uni-Sans-Thin;">NUESTRAS REDES SOCIALES</span>'
;
?>
<?php
if(!empty($Facebook))
echo '
<button type="button" class="btn btn-fb blue"  id="link"><a href="'.$Facebook.'">
<i class="fa fa-facebook pr-1"></i>
</a>
</button>';

if(!empty($Messenger))
echo '
<button type="button" class="btn btn-fb c-menssenger"  id="link"><a href="'.$Messenger.'">
<i class="fab fa-facebook-messenger pr-1"></i>
</a>
</button>';

if(!empty($Twitter))
echo '
<button type="button" class="btn btn-tw cyan"  id="link"><a href="'.$Twitter.'">
<i class="fa fa-twitter pr-1"></i>
</a>
</button>';

if(!empty($Instagram))
echo '
<button type="button" class="btn btn-ins purple"  id="link"><a href="'.$Instagram.'">
<i class="fa fa-instagram pr-1"></i>
</a>
</button>';

if(!empty($Youtube))
echo '
<button type="button" class="btn btn-yt red"  id="link"><a href="'.$Youtube.'">
<i class="fa fa-youtube pr-1"></i>
</a>
</button>';

if(!empty($Whatsapp))
echo '
<button type="button" class="btn c-Whatsapp"  id="link"><a href="'.$Whatsapp.'">
<i class="fab fa-whatsapp pr-1" style="color:#fff"></i>
</a>
</button>';

?>
            <?php
if(!empty($Facebook) || !empty($Twitter) || !empty($Instagram) || !empty($Youtube)) 
echo  '</div>';
?>
</div>                                            <div class="footer-retailer">
                    <div style="color:rgb(202, 202, 202);font-family:Uni-Sans-Thin;" >App para Páginas de Facebook by <a class="text-muted" href="<?php echo $perfil['web']; ?>" target="_blank"><strong><?php echo $perfil['text_footer']; ?></strong></a></div>
                    <div>
                                            </div>
                </div>
                    </div>
    </div></body>
</html>