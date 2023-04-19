/*  Description: Web Player v3.2 - Evolucion Streaming - Servicios Informáticos
    Author: Evolucion Streaming
    Author URI: evolucionstreaming.com 
*/
(function ($) {
    "use strict";
    $(".uno").append('<div class="player-wpr" style="margin: 0px auto;"><a id="botonMio" style="cursor:pointer"><div id="pantalla" class="pantalla"><p id="latido" class="latido">Haga click para comenzar a reproducir</p></div></a><div class="bg-wpr"> <a class="abuy" id="cancion" target="_blank" href=""><div class="icons fab fa-whatsapp" id="icon-download" target="_blank"></div></a><div class="icons fas fa-window-restore" id="icon-popup" target="_blank" href=""></div> <div class="ppBtn play-btn"></div><div class="blur"></div><div class="data-panel animated"> <div class="data-panel-row">  <div class="data-panel-info"><span class="listenersTxt"></span><span class="qualityTxt"></span><span class="genreTxt"></span></div><div class="data-panel-r-icon"><i class="fa fa-bolt" aria-hidden="true" style="padding-top:6px;"></i></div></div><div class="data-panel-row"> <div class="data-panel-info"> <div class="history"> <ul></ul> </div></div><div class="data-panel-r-icon"><i class="fa fa-history" aria-hidden="true" style="padding-top:6px;"></i></div></div><div class="data-panel-row"> <div class="data-panel-info"> <div class="share"> <ul> <li class="afacebook"><i class="fab fa-facebook-f facebook" aria-hidden="true"></i><a target="_blank" href="#">Facebook</a></li><li class="atwitter"><i class="fab fa-twitter twitter" aria-hidden="true"></i><a target="_blank" href="#">Twitter</a></li><li class="awhatsapp"><i class="fab fa-whatsapp whatsapp" aria-hidden="true"></i><a target="_blank" href="#">Whatsapp</a></li></div></div><div class="data-panel-r-icon"><i class="fa fa-share-alt" aria-hidden="true" style="padding-top:6px;"></i></div></div></div><div class="more fa"></div><div class="player-ctr"><div class="album-cover-wpr"> <div class="album-cover animated"></div></div><div class="album-cover-wpr2"> <div class="album-cover2 animated"></div></div><div class="track-info">  <span id="info-text" class="nd"> </span> <div class="marquee"> <div id="titulo2" class="track-title"> En vivo </div><div id="titulo1" class="artist-name"> Buena Música! </div></div></div><div class="controls-wpr animated"> <div class="vol-icon fa"></div><div class="volume-slider-wpr"> <input class="volume-slider" type="range" min="0" max="100" step="0.10" value="" autocomplete="off"><span class="vol-value"></span></div></div></div></div></div>');
    $.fn.uno = function (options) {
        
        var settings = $.extend({
            // Default Settings
            URL: "",
            version: "2",
            stream_id: 1,
            mount_point: "", //For Icecast
            type: "/;type=mp3",
            streampath: "/stream?icy=http",
            enable_cors: false,
            cors: "https://shoutcastapps.herokuapp.com",
            artwork: true,
            logo: "img/default.jpg",
            vertical_layout: false,
            bg: "grey",
            accent: "deeporange",
            blur: false,
            blur_opacity: 0.16,
            lang: "es",            
            src: "",
            volume: 0.75,           
            autoplay: true
        }, options);
        var thisObj;
        thisObj = this;
        var audio;
        var cBGwpr = $(".bg-wpr", thisObj);
        var ppBtn = $(".ppBtn", thisObj);       
        var cVolumeSlider = $(".volume-slider", thisObj);
        var cVolumeIcon = $(".vol-icon", thisObj);      
        audio = new Audio();
        audio.volume = settings.volume;
        audio.preload = "auto";
        $(".album-cover, .album-cover2", thisObj).css({'background-image': 'url('+ settings.logo +')', 'background-size': '100% 100%', 'border-radius': '5px'});
        $(".blur", thisObj).css({'background-image': 'url('+ settings.logo +')', 'background-position': 'center center', 'opacity': + settings.blur_opacity, 'filter': 'blur(5px)', '-ms-filter': 'blur(5px)', '-webkit-filter': 'blur(5px)', 'transition': 'opacity 1s ease-in', 'transition-delay': '1.5s'});
        
        thisObj.each(function () {
            if(settings.bg.length > 0){
                $(cBGwpr).addClass('bg-' + settings.bg);                
            }
            if(settings.accent.length > 0){              
                $(cBGwpr).addClass("accent-" + settings.accent);                
            }
            if(settings.blur == true){
                $(".blur", thisObj).css('display', 'block');
            }
            if (settings.autoplay == true){
                audio.autoplay = true;
            }
            if (settings.vertical_layout == true){
                $(".player-wpr", thisObj).addClass("vertical");
                $(".pantalla", thisObj).addClass("vertical");
                $(".latido", thisObj).addClass("vertical");
                $("#ssll").removeClass("ssll");
                $("#ssll").addClass("ssll2");
                $(".album-cover-wpr", thisObj).addClass("hidden");
            }
            ShareButtons();
            if(settings.version == 1) {
                audio.src = settings.URL + "/;type=mp3";
                settings.src = audio.src;               
                var dataURL = settings.URL + "/7.html";
                var hisURL = settings.URL + "/played.html";
                getRepro(dataURL, hisURL);
            }else if(settings.version == 2) {
                audio.src = settings.URL + settings.streampath;
                settings.src = audio.src;
                var dataURL = settings.URL + "/stats?json=1";
                if(settings.enable_cors == true) {
                    var dataURL = settings.cors + "?q=" + settings.URL + "/stats?json=1";
                    var hisURL = settings.cors + "?q=" + settings.URL + "/played?type=json";
                }else {
                    var dataURL = settings.URL+"/stats?json=1";
                    var hisURL = settings.URL+"/played?type=json";
                }
                getRepro(dataURL, hisURL); 
            }

            else if(settings.version == "icecast") {
                audio.src = settings.URL + "/" + settings.mount_point;
                settings.src = audio.src;
                var dataURL = settings.cors + "?q=" + settings.URL + "/status-json.xsl";
                getRepro(dataURL);             
            }else if(settings.version == "apagado"){

            }

        });
        
        //Play/Pause Handling
        function togglePlying(tog, bool) {
            $(tog).toggleClass("playing", bool);
        }

        function playHandling() {
            if (audio.paused) {
                audio.src = settings.src;
                audio.play();
                var $playing = $('.ppBtn.playing');
                if ($(thisObj).find($playing).length === 0) {
                    $playing.click();
                }
            }
            else {
                audio.pause();
            }
        }
        
        $(audio).on("playing", function () {
            togglePlying(ppBtn, true);
            $(ppBtn).addClass("stop-btn");
            $(ppBtn).removeClass("play-btn");
            $("#pantalla").addClass("desaparece");
            
        });
        $(audio).on("pause", function () {
            togglePlying(ppBtn, false);
            $(ppBtn).removeClass("stop-btn");
            $(ppBtn).addClass("play-btn");
            $("#pantalla").removeClass("desaparece");
            
        });
        $(ppBtn, thisObj).on("click tap", function () {
            playHandling();
        });
        $("#botonMio").on("click tap", function () {
            playHandling();
        });
        $("#icon-popup").on("click tap", function () {
            playHandling();
        });
        
        //Initial Visual Volume
        var volVal = audio.volume * 100;
        $(cVolumeSlider).val(volVal);
        $(".vol-value", thisObj).text(volVal +'%');
        volumeIcon();

        //Volume Icon Handling
        function volumeIcon() {
            if($(cVolumeSlider).val() < 55 && $(cVolumeSlider).val() > 0){
                $(cVolumeIcon).removeClass("vol-icon3 vol-icon1");
                $(cVolumeIcon).addClass("vol-icon2");               
            }
            if($(cVolumeSlider).val() == 0){
                $(cVolumeIcon).removeClass("vol-icon2 vol-icon3");
                $(cVolumeIcon).addClass("vol-icon1");               
            }
            else if($(cVolumeSlider).val() > 55){
                $(cVolumeIcon).removeClass("vol-icon1 vol-icon2");
                $(cVolumeIcon).addClass("vol-icon3");
            }
        }
        
        //Volume Slider Handling            
        if (navigator.appName == 'Microsoft Internet Explorer' ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1))
            {
            cVolumeSlider.change('input', function(){
            audio.volume = parseInt(this.value, 10)/100;
            var volumeVal = audio.volume * 100;
            var volumeVal = Math.round(volumeVal);
            $(".vol-value", thisObj).text(volumeVal + '%');
            volumeIcon();
            
            }, false);
        
            }
        
        else {
            cVolumeSlider.on('input',  function () {
            var volumeVal = $(cVolumeSlider).val();
            audio.volume = volumeVal/100;       
            var volumeVal = Math.round(volumeVal);
            $(".vol-value", thisObj).text(volumeVal +'%')       
            volumeIcon();           

            });         
        }

         //Update Track Info    
        function getTag() {
            return $(thisObj).attr("data-tag");
        }
        function formatArtist(artist){
            artist = artist.toLowerCase();          
            artist = $.trim(artist);
            if (artist.includes("&")) {
                 artist = artist.substr(0, artist.indexOf(' &'));               
            }
            else if(artist.includes("feat")) {
                artist = artist.substr(0, artist.indexOf(' feat'));
            } else if (artist.includes("ft.")) {
                artist = artist.substr(0, artist.indexOf(' ft.'));
            }

            return artist;
        }
        
        function formatTitle(title){
            if(title){
                title = title.toLowerCase();            
                title = $.trim(title);
                if (title.includes("&")) {
                    title = title.replace('&', 'and');              
                }
                else if(title.includes("(")) {
                    title = title.substr(0, title.indexOf(' ('));
                } else if (title.includes("ft")) {
                    title = title.substr(0, title.indexOf(' ft'));
                }
                return title;
            }
        }
        function getRepro(url, sHistory = "") {
                
                function programa(){
                    var id_reproductor = location.search;
                    $.ajax ({
                        url: './validarhorarioprograma.php'+id_reproductor,
                        success: 
                            function(result) {
                                var res = JSON.parse(result);
                                if (res.prograif) {
                                    if (res.programa != getTag()) {
                                        updateTag(res.programa);
                                        updateArtist(res.locutor);
                                        updateTitle(res.programa);
                                        if (res.url_portada){                           
                                            cover = res.url_portada;
                                            cover = cover.replace('100x100', '300x300');
                                        }
                                        else {
                                            var cover = settings.logo;
                                            var cover1 = 'Unknown';
                                            var cover2 = 'https://music.apple.com/us/album/unknown'
                                        }
                                        var blur_opacity = settings.blur_opacity;
                                        if (settings.blur_opacity < 0.31){
                                           var blur_level = "5px";
                                        }
                                        else {
                                           var blur_level ="18px";
                                        }
                                        $(".album-cover, .album-cover2", thisObj).css({'background-image': 'url('+ cover +')', 'background-size': '100% 100%', 'border-radius': '5px'}); 
                                        $(".album-cover, .album-cover2", thisObj).addClass("fadeIn");
                                        setTimeout( function(){ 
                                           $(".album-cover, .album-cover2", thisObj).removeClass("fadeIn");
                                        }, 5000 );
                                        $(".blur", thisObj).css({'background-image': 'url('+ cover +')', 'background-position': 'center center', 'opacity': + blur_opacity, 'filter': 'blur(' + blur_level +')', '-ms-filter': 'blur(' + blur_level +')', '-webkit-filter': 'blur(' + blur_level +')', 'transition': 'opacity 1s ease-in', 'transition-delay': '1.5s'});
                                        $('.abuy', thisObj).attr('href', '#'); 
                                    }
                                    $("#latido").text("Haga click para comenzar a reproducir");
                                }else{
                                    if (settings.version == 1) {
                                        let dtype = 'html';
                                    }else if (settings.version == "icecast"){
                                        var dtype = 'json';
                                    }else{   
                                        var dtype = 'jsonp';
                                    }
                                    $.ajax ({
                                        dataType: dtype,
                                        url: url,
                                        success: 
                                            function(datos) {
                                                if (settings.version == 1) {
                                                    var result = $.parseHTML(datos)[1].data;
                                                    var songtitle = result.split(",")[6];
                                                    var songtitleSplit = songtitle.split('-');
                                                    result.streamstatus = 1;
                                                } else if (settings.version == 2) {
                                                    var result = datos;
                                                    var songtitle = datos.songtitle;
                                                    var songtitleSplit = songtitle.split('-');
                                                } else if (settings.version == "icecast") {
                                                    var result = findMPData(datos);
                                                    var songtitle = result.title;
                                                    var songtitleSplit = songtitle.split('-');
                                                    result.streamstatus = 1;
                                                }
                                                if(result.streamstatus !== 0){
                                                    if (result.songtitle != getTag()) {
                                                        updateTag(result.songtitle);
                                                        var songtitle = result.songtitle;
                                                        var songtitleSplit = songtitle.split('-');
                                                        var artist = songtitleSplit[0];
                                                        var title = songtitleSplit[1];
                                                        if(artist){
                                                            updateArtist(artist);
                                                        }
                                                        if(title){
                                                            updateTitle(title);
                                                        }else{
                                                            title = '';
                                                        }
                                                        updateServerInfo(result);
                                                        updateHistory(sHistory);
                                                        if(title && artist){
                                                            getCover(artist, title);
                                                            getCancion(artist, title);
                                                        }
                                                        
                                                    }
                                                    $("#latido").text("Haga click para comenzar a reproducir");
                                                }else{
                                                    updateTag('Radio Apagada');
                                                    updateTitle('Radio Apagada');
                                                    updateArtist('');
                                                    $("#pantalla").removeClass("desaparece");
                                                    $("#latido").text("Radio Apagada");
                                                    audio.pause();
                                                }
                                            },
                                        error: 
                                            function(res) { 
                                                    if(res.status == 404){
                                                        if('Radio Fuera de Servicio' != getTag()) {
                                                            getCover('', '');
                                                        }
                                                        updateTag('Radio Fuera de Servicio');
                                                        updateTitle('Radio Fuera de Servicio');
                                                        $("#pantalla").removeClass("desaparece");
                                                        $("#latido").text("Radio Fuera de Servicio");
                                                        audio.pause();
                                                    }
                                                }
                                        })
                                }
                            },
                        error: 
                            function(res) { 
                                console.log(res);
                                if(res.status == 404){
                                    if('Programa Fuera de Servicio' != getTag()) {
                                        getCover('', '');
                                    }
                                    updateTag('Programa Fuera de Servicio');
                                    updateTitle('Programa Fuera de Servicio');
                                    $("#pantalla").removeClass("desaparece");
                                    $("#latido").text("Programa Fuera de Servicio");
                                    audio.pause();
                                }
                                }
                        })
                }
                
                programa();
                setInterval(programa, 20000); 
            }
            
            
        
        
    
        
        var icHis = new Array();
        
        function findMPData(data) {
            if (data.icestats.source.length === undefined){
                return data.icestats.source;
            }
            else{
                for (var i = 0; i < data.icestats.source.length; i++) {
                    var str = data.icestats.source[i].listenurl;

                    if (str.indexOf(settings.mount_point) >= 0) {
                        return data.icestats.source[i];
                    }
                }
            }
        }
        
        function updateArtist(name) {
            $(".artist-name", thisObj).text(name);
            $(".artist-name", thisObj).addClass("lightSpeedIn");
            setTimeout( function(){ 
                $(".artist-name", thisObj).removeClass("lightSpeedIn"); 
            }, 1000 );
        }

        function updateTitle(name) {
            $(".track-title", thisObj).text(name);
            $(".track-title", thisObj).addClass("lightSpeedIn");            
            setTimeout( function(){ 
                $(".track-title", thisObj).removeClass("lightSpeedIn"); 
            }, 1000 );
        }
        
        function updateTag(data) {
            $(thisObj).attr("data-tag", data);
        }
        
        //Album Cover Handling
        function getCover(artist, title) {      
            artist = formatArtist(artist);
            title = formatTitle(title);
            artist = encodeURI(artist);
            title = encodeURI(title);
            var url = "https://itunes.apple.com/search?term==" + artist + "-" + title + "&media=music&limit=1";
            $.ajax ({
                dataType: 'jsonp',
                url: url,
                success:
                    function(data) {
                        if (data.results.length == 1){                          
                            cover = data.results[0].artworkUrl100;
                            cover = cover.replace('100x100', '300x300');
                            cover1 = data.results[0].collectionName;
                            cover2 = data.results[0].collectionViewUrl;
                        }
                        else {
                            var cover = settings.logo;
                            var cover1 = 'Unknown';
                            var cover2 = 'https://music.apple.com/us/album/unknown'
                        }
                        var blur_opacity = settings.blur_opacity;
                        if (settings.blur_opacity < 0.31){
                           var blur_level = "5px";
                        }
                        else {
                           var blur_level ="18px";
                        }
                        $(".album-cover, .album-cover2", thisObj).css({'background-image': 'url('+ cover +')', 'background-size': '100% 100%', 'border-radius': '5px'}); 
                        $(".album-cover, .album-cover2", thisObj).addClass("fadeIn");
                        setTimeout( function(){ 
                           $(".album-cover, .album-cover2", thisObj).removeClass("fadeIn");
                        }, 5000 );
                        $(".blur", thisObj).css({'background-image': 'url('+ cover +')', 'background-position': 'center center', 'opacity': + blur_opacity, 'filter': 'blur(' + blur_level +')', '-ms-filter': 'blur(' + blur_level +')', '-webkit-filter': 'blur(' + blur_level +')', 'transition': 'opacity 1s ease-in', 'transition-delay': '1.5s'});
                        $('.abuy', thisObj).attr('href', cover2);
                        
                    },              
                error: 
                    function() {
                        console.log("Error on track title " + encodeURI(title));
                    }
            })
        }
        
        //Descagar Cancion 
        function getCancion(artist, title) {        
            artist = formatArtist(artist);
            title = formatTitle(title);
            artist = encodeURI(artist);
            title = encodeURI(title);   
            var url = "https://itunes.apple.com/search?term==" + artist + "-" + title + "&media=music&limit=1";
            $.ajax ({
                dataType: 'jsonp',
                url: url,
                success:
                    function(data) {                        
                        if (data.results.length == 1){                          
                            cancion = data.results[0].artworkUrl100;
                            cancion = cancion.replace('100x100', '300x300');
                        }
                        else {
                            var cover = settings.logo;
                        }
                        var blur_opacity = settings.blur_opacity;
                        if (settings.blur_opacity < 0.31){
                            var blur_level = "5px";
                        }
                        else {
                            var blur_level ="18px";
                        }
                        $(".abuy", thisObj).css({'background-image': 'url('+ cancion +')', 'background-size': '100% 100%', 'border-radius': '5px'}); 
                        $(".abuy", thisObj).addClass("fadeIn");
                        setTimeout( function(){ 
                           $(".abuy", thisObj).removeClass("fadeIn");
                        }, 5000 );
                        $(".blur", thisObj).css({'background-image': 'url('+ cancion +')', 'background-position': 'center center', 'opacity': + blur_opacity, 'filter': 'blur(' + blur_level +')', '-ms-filter': 'blur(' + blur_level +')', '-webkit-filter': 'blur(' + blur_level +')', 'transition': 'opacity 1s ease-in', 'transition-delay': '1.5s'});
                    },              
                error: 
                    function() {
                        console.log("Error on track title " + encodeURI(title));
                    }
            })
        }
        
        //Update Server Info        
        function updateServerInfo(result) {
            if(settings.version == 1) {
                $(".listenersTxt", thisObj).text(listenersTxt + ": " + result.split(",")[0]);
                $(".qualityTxt", thisObj).text(qualityTxt + ": " + result.split(",")[5] + "kbps");
            }
            
            else if(settings.version == 2) {
                $(".listenersTxt", thisObj).text(listenersTxt + ": " + result.currentlisteners);
                $(".qualityTxt", thisObj).text(qualityTxt + ": " + result.bitrate + "kbps");
                $(".genreTxt", thisObj).text(genreTxt + ": " + result.servergenre);
            }
        }
        
        //Update Song History
        function updateHistory(url) {
            $(".history ul li", thisObj).remove();          
            if(settings.version == 1){
                $.ajax({
                    type: 'GET', 
                    url: url,
                    dataType: 'html',
                    success: function(data) {
                        var result = $(data).find("table")[2];
                        var table = $(result);
                        var tbody = $(result).find("tbody");
                        var tr = $(tbody).find("tr");
                        var td = $(tr).find("td");
                            $(".history ul", thisObj).append(
                                "<li class='list' id='row" +  "'>" + "1 - "  + td[3].innerHTML + "</li>" +
                                "<li class='list' id='row" +  "'>" + "2 - "  + td[6].innerHTML + "</li>" +
                                "<li class='list' id='row" +  "'>" + "3 - "  + td[8].innerHTML + "</li>" +
                                "<li class='list' id='row" +  "'>" + "4 - "  + td[10].innerHTML + "</li>" + 
                                "<li class='list' id='row" +  "'>" + "5 - "  + td[12].innerHTML + "</li>" + 
                                "<li class='list' id='row" +  "'>" + "6 - "  + td[14].innerHTML + "</li>" + 
                                "<li class='list' id='row" +  "'>" + "7 - "  + td[16].innerHTML + "</li>"
                                
                            );
                            
                    }
                })
            }
            
            else if(settings.version == 2){
                $.ajax ({
                dataType: 'jsonp',
                url: url,
                success: 
                    function(data) {
                        for (var i = 1; i < data.length; i++) {
                            var rows = i;
                            var title = data[i].title;
                            $(".history ul", thisObj).append(
                                "<li class='list' id='row" +  "'>" + rows + " - " + title + "</li>"
                            );
                            
                        }
                    }
                })
            }           
        }
        
        function updateHistoryIC(artist, title) {
            addToArray(title, artist);
            createHisList();
        }

        function addToArray(title, artist) {
            icHis.unshift({ar: artist, tt: title});
        }
        
        function createHisList(){
            $(".history ul li", thisObj).remove();

            for(var i = 0; i < icHis.length; i++){
                var rows = i;
                var artist = icHis[i].ar;
                var title = icHis[i].tt;
                $(".history ul", thisObj).append(
                    "<li class='list' id='row" +  "'>" + rows + " - " + title + " - " + artist + "</li>"
                );
            }
        }
        
        function updateServerInfoIC(data) {            
            $(".listenersTxt", thisObj).text(listenersTxt + ": " + data.listeners);
            $(".qualityTxt", thisObj).text(qualityTxt + ": " + data.bitrate + "k");
            $(".genreTxt", thisObj).text(genreTxt + ": " + data.genre);
        }

        // Data Panel Handling
        $('.more', thisObj).on("click tap", function() {
            if (!$(".more", thisObj).hasClass("morert")) {
                $(".more", thisObj).addClass("morert");
                $(".controls-wpr, .track-info, .album-cover-wpr", thisObj).fadeOut("slow");         
                $(".data-panel", thisObj).delay(600).fadeIn(400);
            }
            else if($(".more", thisObj).hasClass("morert")){
                $(".more", thisObj).removeClass("morert");
                $(".data-panel", thisObj).fadeOut(400);
                $(".controls-wpr, .track-info, .album-cover-wpr", thisObj).delay(600).fadeIn(400);
            }           
        });
        
         
        // Share
        function ShareButtons() {
            setTimeout(function(){
                "use strict";
                var trackURL = window.location.href;
                FBShareLink(trackURL);
                TWShareLink(trackURL);
                GPShareLink(trackURL);
                
            }, 3500);
        }
         
        function FBShareLink(siteURL) {
            var url = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(siteURL) + "&quote=Escuchanos%20en%20vivo%20";
            $("li.afacebook", thisObj).find("a").attr("href", url);
        }

        function TWShareLink(siteURL) {
            var url = "https://twitter.com/intent/tweet?text=Escuchanos%20en%20vivo%20-%20%20%F0%9F%91%89%20"  + encodeURIComponent(siteURL);
            $("li.atwitter", thisObj).find("a").attr("href", url);
        }

        function GPShareLink(siteURL) {
            var siteURL = window.location.href;
            var url = "https://api.whatsapp.com/send?text=Escuchanos%20en%20vivo%20-%20%20%F0%9F%91%89%20" + encodeURIComponent(siteURL);
            $("li.awhatsapp", thisObj).find("a").attr("href", url);
           
           
        }
        //Mobile Volume Classes
        if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) {
            $(cVolumeSlider).addClass("dis-none");
            $(".vol-value").addClass("dis-none");
            $(cVolumeIcon).addClass("vol-dis");
            }

        //Language
        if (settings.lang == "en") {
                var listenersTxt = "En Linea";
                var qualityTxt = "Calidad";
                var genreTxt = "Genero";
        }
            
        if (settings.lang == "es") {
                var listenersTxt = "En Linea";
                var qualityTxt = "Calidad";
                var genreTxt = "Genero";
        }
        
        if (settings.lang == "pt") {
                var listenersTxt = "Conectados";
                var qualityTxt = "Qualidade";
                var genreTxt = "Gênero";
        }
        
        if (settings.lang == "fr") {
                var listenersTxt = "En Ligne";
                var qualityTxt = "Qualité";
                var genreTxt = "Genre";
        }
        
        if (settings.lang == "it") {
                var listenersTxt = "In Linea";
                var qualityTxt = "Qualità";
                var genreTxt = "Genere";
        }
    };

})(jQuery);

