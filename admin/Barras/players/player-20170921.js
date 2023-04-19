var RfPlayer = new function() {
    var $this = this;

    this.volume = 1.0;
    this.playing = false;
    this.audioSource = '';

    this.playerElement = null;
    this.playerSource = null;
    this.playButton = null;
    this.pauseButton = null;
    this.volumeAreaElement = null;
    this.volumeMeterElement = null;
    this.musesPlayer = null;

    this.initialize = function(params) {
        $this.audioSource = params.audioSource;

        if (!$this.hasAudioSupport()) {
            $this.musesFallback();
        }

        $this.playerElement = $('#rf-player');

        $this.playerSource = $this.playerElement.find('source').first();
        $this.playButton = $('#rf-player-play');
        $this.pauseButton = $('#rf-player-pause');
        $this.volumeAreaElement = $('#rf-player-volume-area');
        $this.volumeMeterElement = $('#rf-player-volume-meter');

        $this.volumeMeterElement.css({'width' : parseInt($this.volumeAreaElement[0].offsetWidth) + 'px'});

        $this.playButton.on('click', $this.play);
        $this.pauseButton.on('click', $this.pause);
        $this.volumeAreaElement.on('click', $this.changeVolumeByClicking);
        $this.playerSource.on('error', $this.audioSourceError);
        $this.playerElement.on('error', $this.audioSourceError);

        $this.playerSource[0].addEventListener('error', function () {
            if ($this.playing) {
                $this.pause();
            }
        }, false);

        $this.playerElement[0].addEventListener('ended', function () {
            if ($this.playing) {
                $this.pause();
            }
        }, false);

        if (PLAYER_AUTOSTART && !IS_MOBILE) {
            if (!$this.hasAudioSupport()) {
                $this.playing = true;
                $this.pauseButton.addClass('active');
                $this.playButton.removeClass('active');
            } else {
                $this.play();
            }
        }
    };

    this.play = function() {
        $this.playing = true;
        if ($this.musesPlayer) {
            $this.musesPlayer.playSound();
        } else {
            $this.playerSource[0].src = $this.audioSource;
            $this.playerElement[0].load();

            var playPromise = $this.playerElement[0].play();
            if (playPromise !== undefined) {
                playPromise.catch(
                    function(error) {
                        $this.pause();
                    }
                );
            }
        }
        console.log($this.audioSource);
        $this.pauseButton.addClass('active');
        $this.playButton.removeClass('active');
    };

    this.pause = function() {
        $this.playing = false;
        if ($this.musesPlayer) {
            $this.musesPlayer.stopSound();
        } else {
            $this.playerSource[0].src = '';
            $this.playerElement[0].load();
            $this.playerElement[0].pause();
        }
        $this.pauseButton.removeClass('active');
        $this.playButton.addClass('active');
    };

    this.changeVolumeByClicking = function(event) {
        var width = event.clientX - $this.volumeAreaElement.offset().left;
        if (width > 0) {
            $this.volumeMeterElement.css({'width' : width + 'px'});
            $this.volume = (width / $this.volumeAreaElement.width());

            $this.playerElement[0].volume = $this.volume;

            if ($this.musesPlayer) {
                $this.musesPlayer.setVolume($this.volume);
            }
        }
    };

    this.hasAudioSupport = function() {
        return !!(document.createElement('audio').canPlayType);
    };

    this.audioSourceError = function(e) {
        if ($this.playing) {
            $this.musesFallback(true);
        }
    }

    this.musesFallback = function(SHOULD_START) {
        musesFallbackDelayedStart(SHOULD_START, $this);
    };
};

function musesFallbackDelayedStart(SHOULD_START, playerContext) {
    if (!STREAMING_TYPE) {
        window.setTimeout(
            function() {
                musesFallbackDelayedStart(SHOULD_START, playerContext);
            },
            1000
        );
        return;
    } else {
        var AS = (typeof SHOULD_START != 'undefined' && SHOULD_START);
        var flashvars = {
            'url':playerContext.audioSource,
            'codec': STREAMING_TYPE == 'audio/mpeg' ? 'mp3' : 'aac',
            'volume':'100',
            'autoplay': AS || (PLAYER_AUTOSTART && !IS_MOBILE),
            'buffering': '5',
            'width':0,
            'height':0,
            'tracking':false
        };
        swfobject.embedSWF(BASE_ASSETS + 'players/muses.swf',
            'muses_container_',
            '100%',
            '100%',
            '9.0.115',
            'false',
            flashvars,
            { allowfullscreen: 'true', allowscriptaccess: 'always', wmode: 'transparent' },
            { id: 'musesplayer', name: 'musesplayer' },
            function (e) {
                if (!e.success) {
                    console.log('Não compatível');
                }
            }
        );
        playerContext.musesPlayer = document.getElementById('musesplayer');
    }
}

$(document).ready(function() {
    var playerContainer = $('.rf-player');
    var playingNowContainer = playerContainer.find('.rf-playing-now');
    var lastRequiredCover = null;

    RFGeneralPlayer.on('initialized', function (online) {
        if (!online && PLAYER_AUTOSTART) {
            PLAYER_AUTOSTART = false;
        }

        RfPlayer.initialize({
            'audioSource' : MAIN_STREAM_URL,
            // 'streamType' :
        });

        if (IS_MOBILE) {
            $('body').addClass('is-mobile');
        }
    }).on('updatePlayerData', function(playing) {
        if (PLAYER_SPLIT_DATA) {
            console.log('playingData', playing);

            if (playing.nowParts.length == 0) {
                // não deve ter nada tocando e nenhuma programação ativa
                playingNowContainer.html('');
            } else {
                var listedParts = playingNowContainer.find('.rf-playing-info-item');
                var changedListItems = false;

                if (listedParts.size() > 0) {
                    var listedPartsToRemove = listedParts;

                    for (var i = 0; i < playing.nowParts.length; i++) {
                        var partContainer = listedParts.filter('.item-type-' + playing.nowParts[i].type);

                        if (partContainer.size() == 1) {
                            playing.nowParts[i].container = partContainer;
                        }

                        listedPartsToRemove = listedPartsToRemove.filter(':not(.item-type-' + playing.nowParts[i].type + ')');
                    }

                    changedListItems = listedPartsToRemove.size() > 0;
                }

                if (!changedListItems) {
                    $.each(playing.nowParts, function(i, v) {
                        if (!v.container) {
                            changedListItems = true;
                            return false;
                        }
                    });
                }

                if (changedListItems) {
                    $.each(playing.nowParts, function(i, v) {
                        if (v.container) {
                            v.container.remove()
                            playing.nowParts[i].container = null;
                        }
                    });
                }

                for (var i = 0; i < playing.nowParts.length; i++) {
                    if (!playing.nowParts[i].container) {
                        playing.nowParts[i].container = $('<div class="rf-playing-info-item item-type-' + playing.nowParts[i].type + '"></div>').appendTo(playingNowContainer);
                    }

                    playing.nowParts[i].container.html(
                        '<div class="rf-playing-item-label">' +
                            playing.nowParts[i].label +
                        '</div>' +
                        '<div class="rf-playing-item-value">' +
                            // caso só tenha um item para exibir, deixa com o marquee pois não vai ficar transitando entre os itens
                            (playing.nowParts.length == 1 ? '<marquee behavior="scroll" scrolldelay="190" direction="left" width="95%">' + playing.nowParts[i].value + '</marquee>' : playing.nowParts[i].value) +
                        '</div>'
                    );
                }

                if (changedListItems) {
                    // caso a lista tenha mudado de quantidade de itens, pra evitar que gere algum problema no efeito de transição
                    playingNowContainer.removeClass('info-item-count-1 info-item-count-2 info-item-count-3');

                    playingNowContainer.find('.rf-playing-info-item').each(function(idx) {
                        $(this).addClass('item-sequence-' + idx);
                    });

                    playingNowContainer.addClass('info-item-count-' + playing.nowParts.length);
                }
            }

            var playerBgImg = new Image();
            playerBgImg.src = ( playing.image || logo);
            lastRequiredCover = playerBgImg.src;
            

            playerBgImg.onload = function() {
                if (lastRequiredCover == playerBgImg.src) {
                    playerContainer.find('.rf-player-background').css({'background-image': 'url(' + playerBgImg.src + ')'})
                }
            }
        } else {
            if (playingNowContainer.find('marquee').length == 0) {
                playingNowContainer.html('<marquee></marquee>');
            }

            playingNowContainer.find('marquee').html(playing);
        }

        // docCookies é definido no main.js carregado no site
        if (typeof docCookies !== 'undefined') {
            var lastPlayedTracks = [], lastTrack = false, lastCover = false;

            var currentTrack = RFGeneralPlayer.getActualPlayingTrack();
            var currentCover = RFGeneralPlayer.getTrackImageByName(currentTrack, true);

            if (docCookies.hasItem('last_song_cover_list')) {
                lastPlayedTracks = JSON.parse(docCookies.getItem('last_song_cover_list'));
            }

            // não esta tocando nada
            if (!currentTrack || currentTrack == '') {
                $(window).trigger('cover-list-updated', [lastPlayedTracks]);
            } else {
                lastTrack = (lastPlayedTracks[0] || {t: false}).t;
                lastCover = (lastPlayedTracks[0] || {c: false}).c;

                var hasChangedTrackList = false;

                if (lastTrack != currentTrack) {
                    lastPlayedTracks.unshift({
                        t: currentTrack,
                        c: currentCover
                    });

                    if (lastPlayedTracks.length == 11) {
                        lastPlayedTracks.pop();
                    }

                    hasChangedTrackList = true;
                } else if (lastCover != currentCover) {
                    lastPlayedTracks[0].c = currentCover
                    hasChangedTrackList = true;
                }

                if (hasChangedTrackList) {
                    docCookies.setItem('last_song_cover_list', JSON.stringify(lastPlayedTracks), 24 * 60 * 60);
                    $(window).trigger('cover-list-updated', [lastPlayedTracks]);
                }
            }
        }
    }).on('offline', function() {
        $('.rf-player').removeClass('player-online');
    }).on('canRefreshPlayerData', function() {
        return !!$('.rf-player').length;
    }).initialize({
        streamingAddress: STREAMING_ADDRESS,
        streamingPort: STREAMING_PORT,
        providerType: STREAMING_PROVIDER,
        useProxy: USE_PLAYER_PROXY,
        showMusicName: PLAYER_SHOW_MUSIC_NAME,
        refreshDataUrl: STREAMING_REFRESH_DATA_URL,
        nextSchedules: NEXT_SCHEDULES,
        splitPlayerData: PLAYER_SPLIT_DATA,
        searchForCover: RF3_SEARCH_FOR_COVER,
    });

    if (playerContainer.is('.with-social-networks')) {
        var timerResizeSocial = null;

        $(window).resize(function() {
            if (timerResizeSocial) {
                clearTimeout(timerResizeSocial);
            }

            timerResizeSocial = window.setTimeout(function() {
                timerResizeSocial = null;

                if ($(window).width() <= 720) {
                    return;
                }

                var networkList = playerContainer.find('.network-list .network-list-content');

                if (networkList.find('.network-list-item').size() < 2) {
                    return;
                }

                var secondaryList = playerContainer.find('.network-secondary-list');
                var secondaryListContent = secondaryList.find('.network-secondary-list-content');

                var firstListItemPosition = networkList.find('.network-list-item:first').position().top;

                secondaryListContent.find('.network-list-item').each(function() {
                    // muda todos os itens da lista secundaria pra principal
                    $(this).insertBefore(secondaryList);
                });

                if (firstListItemPosition != networkList.find('.network-list-item:last').position().top) {
                    // tem algum item que não cabe na lista principal
                    secondaryList.show();

                    $(networkList.find('> .network-list-item').get().reverse()).each(function() {
                        // joga o item pro começo da lista secundaria
                        $(this).prependTo(secondaryListContent);

                        firstListItemPosition = networkList.find('> .network-list-item:first').position().top;

                        if (firstListItemPosition == secondaryList.position().top) {
                            // a lista adicional não esta mais sendo jogada pra baixo
                            return false;
                        }
                    });

                } else {
                    secondaryList.hide();
                }
            }, 50);
        });

        $(window).resize();
    }
});
