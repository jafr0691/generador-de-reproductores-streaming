<?php
$fechaActual = date('d-m-Y');
?>
<html lang="es">
 <head>   
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link href="https://clientes.evolucionstreaming.com/templates/templates-six-master/img/FAVICON_64X64-1-1.ico" rel="shortcut icon" title="Evolución Streaming - Servicios Informáticos" type="image/x-icon" />
        <title><?php echo $TituloEmisora; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:url" content="https://fb.evolucionstreaming.com/Apps//?idr=<?php echo base64_encode($IDR); ?>">
        <meta property="og:title" content="<?php echo $TituloEmisora; ?>">
        <meta property="og:description" content="Servicio provisto por Evolucion Streaming - Servicios Informáticos">
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:url" content="https://fb.evolucionstreaming.com/Apps//?idr=<?php echo base64_encode($IDR); ?>"/>
        <meta name="twitter:title" content="<?php echo $TituloEmisora; ?>" />
        <meta name="twitter:description" content="Servicio provisto por EvolucionStreaming - Servicios Informáticos" />
        <meta property="og:image" content="https://www.fb.evolucionstreaming.com/Apps/cover/fb_<?php echo (!empty($Cover2))? $Cover2 : '8362.jpg'; ?>">
        <meta property="og:image:width"      content="500">
        <meta property="og:image:height"     content="250">

        <meta property="twitter:image" content="https://www.fb.evolucionstreaming.com/Apps/cover/fb_<?php echo (!empty($Cover2))? $Cover2 : '8362.jpg'; ?>">
       
        <link rel="canonical" href="https://fb.evolucionstreaming.com/Apps//?idr=<?php echo base64_encode($IDR); ?>" />
<link href="../css/bootstrap.min1cd1.css?_t=<?php echo base64_encode($IDR); ?>" media="screen" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.min.css?_t=<?php echo base64_encode($IDR); ?>" media="screen" rel="stylesheet" type="text/css">
<link href="../players/player1cd1.css?_t=<?php echo base64_encode($IDR); ?>" media="screen" rel="stylesheet" type="text/css">
<link href="../players/17/player.css?_t=<?php echo base64_encode($IDR); ?>" media="screen" rel="stylesheet" type="text/css"><!--[if lt IE 9]><script type="text/javascript" src="https://public-rf-assets.minhawebradio.net/js/html5shiv.js?_t=66ae315ee5"></script><![endif]-->
<!--[if lt IE 9]><script type="text/javascript" src="https://public-rf-assets.minhawebradio.net/js/respond.min.js?_t=<?php echo base64_encode($IDR); ?>"></script><![endif]-->
<script type="text/javascript" src="../js/jquery-1.11.3.min1cd1.js?_t=<?php echo base64_encode($IDR); ?>"></script>
<script type="text/javascript" src="../js/utils1cd1.js?_t=<?php echo base64_encode($IDR); ?>"></script>
<script type="text/javascript" src="../players/rf-player.js?_t=<?php echo base64_encode($IDR); ?>"></script>
<script type="text/javascript" src="../players/player-20170921.js?_t=<?php echo base64_encode($IDR); ?>"></script>


      
<script type="text/javascript">
            var UPLOAD_BASE_URL = 'https://public-rf-upload.minhawebradio.net/159893/';
            var BASE_ASSETS = 'https://public-rf-assets.minhawebradio.net/';
            var ASSETS_CONSTANT = '14b62f8ca4';
            var IS_MOBILE = false;
            var G_RECAPTCHA_KEY = '6LeQuSYTAAAAACseyzlRv9eKeY-nengEFzOF_JZv';
            var DEFAULT_SITE_TAGS = [];
            var CONTENT_LOCALE = 'es-es';
            var CONTENT_DATE_FORMAT = 1;

            Translator.addContent('component.player', {"split":{"label":{"program":"{program}","program-with-broadcaster":"{program} com {broadcaster}","schedule-period":"{start} - {end}","playing-now":"<?php echo $TituloEmisora; ?>"}},"unified":{"label":{"program":"{program} ","program-with-broadcaster":"{program} com {broadcaster} de ","track":"Sonando Ahora: {track}","schedule-with-track":"{schedule} <strong> {track}<\/strong>"}}});
        </script>
    </head>
    <body>

                <div id="wrapper">
            
<script type="text/javascript">
    var STREAMING_ADDRESS = '<?php echo $IP;?>';
    var STREAMING_PORT = '<?php echo $Puerto; ?>';
    var STREAMING_PROVIDER = 1;
    var MAIN_STREAM_URL = '<?php echo 'https://'.$IP.'/'.$BPuerto.'/stream'; ?>';
    var STREAMING_REFRESH_DATA_URL = 'https://suemisora.com.ar/admin/Barras/?currentsong&idr=<?php echo base64_encode($IDR); ?>';
    var PLAYER_SHOW_MUSIC_NAME = true;
    var NEXT_SCHEDULES = {"1":{"id":"1","start":0,"end":0,"program_info":{"program_id":"2","program_name":""}},"4":{"id":4,"start":0,"end":0,"program_info":{"program_id":1,"program_name":"","start_time":0,"end_time":0}}};

    var PLAYER_ID = '159893';
    var PLAYER_VERSION = 2;
    var PLAYER_POSITION = 1;
    var PLAYER_AUTOSTART = true;
    var PLAYER_SPLIT_DATA = true;

    var USE_PLAYER_PROXY = false;
    var USE_PLAYER = false;
    var STREAMING_TYPE = true;

    var RF3_SEARCH_FOR_COVER = true;

            var BASE_URL_SONG_COVER = 'https://public-rf-song-cover.minhawebradio.net/';
        var RF3_COVER_API_HOST = 'https://brlogic-api.minhawebradio.net';
        var RF3_COVER_BASE_DATE = '<?php echo $fechaActual; ?>';
        var RF3_COVER_HASH = 'bb7838904826aa93c231c375c3d91e33ceaaf94e';
       var logo = "<?php
            		if(!empty($Logo)){
            		    if(is_file("../../../player/reproductores/img/portadas/".$Logo)){
            		        $cover = "../../../player/reproductores/img/portadas/".$Logo;
            		    }else{
            		        $cover = $Logo;
            		    }
            			
            		}else if(!empty($Logo2)){
            		    if(is_file("../../../player/reproductores/img/fb/".$Logo2)){
            		        $cover = "../../../player/reproductores/img/fb/".$Logo2;
            		    }else{
            		        $cover = $Logo2;
            		    }
            			
            		}else{
            			$cover = '../../../player/reproductores/img/img/default.jpg';
            		}
            		echo $cover; ?>";

    </script>


<div class="rf-player player-version-2 player-17 player-position-bottom player-online rf-player-fixed with-social-networks with-app-links app-links-count-1">
    <div class="rf-width-control" style="width: 1100px">
        <div class="rf-padding-control">
            <div class="rf-player-container">
                <div class="rf-player-container-block" style="position: absolute;margin-top: -3000px;">
                    <div id="muses_container_"> </div>
                </div>
                <div class="rf-player-container-block" id="rf-player-container">
                    <div class="rf-player-background"></div>
                    <div id="rf-player-play" class="rf-player-play-pause rf-player-play active"></div>
                    <div id="rf-player-pause" class="rf-player-play-pause rf-player-pause"></div>

                                            <div class="rf-playing-now"></div>
                        <div class="rf-player-volume-container">
                            <div class="rf-player-volume-label">
                                <span class="rf-player-volume-label-content">Volumen</span>
                                <span class="rf-player-volume-icon"><i class="fa fa-volume-up"></i></span>
                            </div>
                            <div class="rf-player-volume-slider">
                                <div class="rf-player-volume rf-player-volume-background"></div>
                                <div id="rf-player-volume-meter" class="rf-player-volume rf-player-volume-meter"></div>
                                <div id="rf-player-volume-area" class="rf-player-volume rf-player-volume-area"></div>
                            </div>
                        </div>
                    
                    <audio id="rf-player" style="width: 0; height: 0;">
                        <source></source>
                    </audio>
                </div>
                                    <div class="player-offline">Rádio Offline</div>
                            </div>

                                                                    <div class="network-list">
                        <div class="network-list-container">
                            <div class="network-list-holder">
                                <?php
if(!empty($Facebook) || !empty($Twitter) || !empty($Instagram) || !empty($Youtube) || !empty($Whatsapp)) 
echo  '<div class="network-list-content">
                                    <div class="network-list-label">Redes<br>Sociales</div>';?>
                                    <?php
if(!empty($Facebook))
    echo '<a class="network-list-item net-type-fb" title="Facebook" href="'.$Facebook.'" target="_blank">
                                                                                            <i class="fa fa-facebook"></i>
                                                                                    </a>';
                                                                                    if(!empty($Twitter))
echo '<a class="network-list-item net-type-twitter" title="Twitter" href="'.$Twitter.'" target="_blank">
                                                                                            <i class="fa fa-twitter"></i>
                                                                                    </a>';
if(!empty($Instagram))
echo '<a class="network-list-item net-type-instagram" title="Instagram" href="'.$Instagram.'" target="_blank">
                                                                                            <i class="fa fa-instagram"></i>
                                                                                    </a>';
if(!empty($Youtube))
echo '<a class="network-list-item net-type-youtube" title="Youtube" href="'.$Youtube.'" target="_blank">
                                                                                            <i class="fa fa-youtube"></i>
                                                                                    </a>';
if(!empty($Whatsapp))
echo '<a class="network-list-item net-type-whatsapp" title="Whatsapp" href="https://api.whatsapp.com/send?phone='.$Whatsapp.'" target="_blank">
                                                                                            <i class="fa fa-whatsapp"></i>
                                                                                    </a>';                                                                                    
                                                                                    ?>
                                                                        <div class="network-secondary-list" style="display: none;">
                                        <i class="network-icon-open-menu fa fa-sort-asc"></i>
                                        <div class="network-secondary-list-container">
                                            <div class="network-secondary-list-content"></div>
                                            <div class="network-secondary-list-arrow"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php                            
if(!empty($Playstore))
echo '<div class="mobile-apps-store">
                    <div class="apps-store-content">
                                                    <div class="app-list-label">
                                Aplicación                            </div>

                            <div class="app-list">
                                                                    <a class="app-store-link app-store-1" title="Aplicativo Android" href="'.$Playstore.'" target="_blank">
                                        <i class="fa fa-android"></i>
                                    </a>
                                                            </div>
                                            </div></div>';?>
            
            </body>
</html>