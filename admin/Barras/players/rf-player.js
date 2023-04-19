var RFGeneralPlayer = (function(argument) {
    var playerInitialized = false;
    var playerOffline = false;

    var playingSchedules = [];

    var actualSchedule = null;
    var actualScheduleValue = '';
    var actualPlayingTrack = false;
    var actualPlayingTrackSanitized = false;
    var lastValidPlayingTrackSanitized = false;

    var sanitizedTrackValues = {};
    var trackImageList = {};
    var lastTrackSearchValue = null;
    var retrySearchTrackTimer = null;

    function searchCoverForCurrentTrack() {
        if (retrySearchTrackTimer) {
            clearTimeout(retrySearchTrackTimer);
            retrySearchTrackTimer = null;
        }

        if (actualPlayingTrackSanitized && typeof trackImageList[actualPlayingTrackSanitized] != 'undefined') {
            lastValidPlayingTrackSanitized = actualPlayingTrackSanitized;
            return false;
        }

        if (!actualPlayingTrackSanitized || actualPlayingTrackSanitized == lastTrackSearchValue) {
            return false;
        }

        lastTrackSearchValue = actualPlayingTrackSanitized;

        $.ajax({
            url: RF3_COVER_API_HOST + '/api/streaming/song-cover?q=' + encodeURIComponent(actualPlayingTrackSanitized) + '&base-date=' + RF3_COVER_BASE_DATE + '&hash=' + RF3_COVER_HASH,
            dataType: 'json',
            success: function(data) {
                if (data.cover == null) {
                    lastValidPlayingTrackSanitized = false;
                    retrySearchTrackTimer = window.setTimeout(searchCoverForCurrentTrack, 30000);
                } else {
                    trackImageList[actualPlayingTrackSanitized] = data.cover;
                    lastValidPlayingTrackSanitized = actualPlayingTrackSanitized;
                }

                RFGeneralPlayer.updatePlayerData();
            },
            error: function() {
                lastValidPlayingTrackSanitized = false;
                RFGeneralPlayer.updatePlayerData();

                retrySearchTrackTimer = window.setTimeout(searchCoverForCurrentTrack, 30000);
            }
        });
    }

    function RFGeneralPlayerConstruct() {
        var $this = this;

        this.config = {
            streamingAddress: '',
            streamingPort: '',
            providerType: 1, /*rf = 1, externo = 2, brcast = 3*/
            useProxy: false,
            showMusicName: true,
            nextSchedules: [],
            defaultRefreshInterval: 30000,
            refreshDataUrl: '',
            splitPlayerData: false,
            searchForCover: false,
        };

        this.listen = {
            initialized: function(online) {},
            updatePlayerData: function(playing) {},
            updateActiveSchedule: function(schedule) {},
            offline: function() {},
            canRefreshPlayerData: function() { return true; }
        };

        this.initialize = function(config) {
            $this.config = $.extend(true, $this.config, config);

            $.each($this.config.nextSchedules, function (i, e) {
                setTimeout(function() {
                    playingSchedules.push(e);
                    $this.updatePlayerData();
                    $this.listen.updateActiveSchedule(e);
                }, e.start * 1000);

                setTimeout(function() {
                    $.each(playingSchedules, function(j, r) {
                        if (typeof r !== 'undefined' && r.id == e.id) {
                            playingSchedules.splice(j, 1);
                        }
                    });

                    $this.updatePlayerData();
                    $this.listen.updateActiveSchedule(playingSchedules.slice(-1).pop());
                }, e.end * 1000);
            });

            //quando for externo não faz a verificação
            if ($this.config.providerType == 2) {
                playerInitialized = true;
                $this.listen.initialized(true);
            } else {
                $this.refreshPlayerData();
            }

            setTimeout(function() {
                if (!$this.getActiveSchedule()) {
                    $this.listen.updateActiveSchedule(null);
                }
            }, 100)
        }

        this.on = function(on, then) {
            if (typeof $this.listen[on] != 'undefined') {
                $this.listen[on] = then;
            }

            return $this;
        }

        this.refreshPlayerData = function() {
            if ($this.config.providerType != 2 && !playerOffline && $this.listen.canRefreshPlayerData()) {
                var refreshInterval = $this.config.defaultRefreshInterval;

                var targetUrl = $this.config.refreshDataUrl;

                $.ajax({
                    url: targetUrl,
                    dataType: 'json',
                    success: function(data) {
                        if (typeof data.streamingType != 'undefined' && typeof STREAMING_TYPE != 'undefined') {
                            STREAMING_TYPE = data.streamingType;
                        }

                        if (typeof IS_MOBILE != 'undefined') {
                            IS_MOBILE = data.isMobile;
                        }

                        if (!playerInitialized) {
                            playerInitialized = true;
                            $this.listen.initialized(data.streamingStatus != 0);
                        }

                        if (data.streamingStatus == 0) {
                            playerOffline = true;
                            actualPlayingTrackSanitized = false;
                            $this.listen.offline();
                        } else {
                            actualPlayingTrack = data.currentTrack;

                            if ($this.config.searchForCover && $this.config.showMusicName) {
                                if (actualPlayingTrack) {
                                    actualPlayingTrackSanitized = $this.sanitizedTrackName(actualPlayingTrack)

                                    if (actualPlayingTrackSanitized.length < 5) {
                                        actualPlayingTrackSanitized = false;
                                        lastValidPlayingTrackSanitized = false;
                                    } else {
                                        searchCoverForCurrentTrack();
                                    }
                                } else {
                                    actualPlayingTrackSanitized = false;
                                    lastValidPlayingTrackSanitized = false;
                                }
                            }

                            // no brcast já vem com o htmlentities, nos demais é preciso dar o htmlentities
                            /*
                            if (actualPlayingTrack !== false && $this.config.providerType != 3) {
                                actualPlayingTrack = $('<div/>').text(actualPlayingTrack).html()
                            }
                            */

                            if (!$this.config.showMusicName) {
                                refreshInterval = 600000;
                            }

                            $this.updatePlayerData();
                            setTimeout($this.refreshPlayerData, refreshInterval);
                        }

                        if (!actualPlayingTrackSanitized) {
                            // pode ocorrer de ter que esperar pra tentar novamente, mas nesse meio tempo trocou de música ou ficou offline
                            if (retrySearchTrackTimer) {
                                clearTimeout(retrySearchTrackTimer);
                                retrySearchTrackTimer = null;
                            }
                        }
                    },
                    error: function() {
                        setTimeout($this.refreshPlayerData, refreshInterval);
                    }
                });
            }
        }

        this.updatePlayerData = function() {
            var playing;
            var preparedActualPlayingTrack = actualPlayingTrack ? escapeHtml(actualPlayingTrack) : false;

            actualSchedule = playingSchedules.slice(-1).pop();

            if ($this.config.splitPlayerData) {
                actualScheduleValue = '';

                playing = {
                    image: ($this.config.showMusicName ? $this.getActualPlayingTrackImage() : false) || $this.getActiveScheduleImage(),
                    nowParts: [],
                };

                if (actualSchedule) {
                    var tlPartialKey = 'program';
                    var tlData = {
                        program: actualSchedule.program_info.program_name,
                    };

                    if (actualSchedule.program_info.broadcaster_name) {
                        tlPartialKey = 'program-with-broadcaster';
                        tlData.broadcaster = actualSchedule.program_info.broadcaster_name;
                    }

                    actualScheduleValue = __tl('component.player.split.label.' + tlPartialKey, tlData);

                    playing.nowParts.push({
                        type: 'schedule',
                        // horario ex: 13:00 - 14:30
                        label: __tl(
                            'component.player.split.label.schedule-period',
                            {
                                start: parseAbsTimeToHuman(actualSchedule.program_info.start_time),
                                end: parseAbsTimeToHuman(actualSchedule.program_info.end_time),
                            }
                        ),
                        value: actualScheduleValue,
                    });
                }

                if ($this.config.showMusicName && preparedActualPlayingTrack) {
                    playing.nowParts.push({
                        type: 'track',
                        label: __tl('component.player.split.label.playing-now'),
                        value: preparedActualPlayingTrack,
                    });
                }
            } else {
                if (actualSchedule) {
                    var tlPartialKey = 'program';
                    var tlData = {
                        program: actualSchedule.program_info.program_name,
                        start: parseAbsTimeToHuman(actualSchedule.program_info.start_time),
                        end: parseAbsTimeToHuman(actualSchedule.program_info.end_time),
                    };

                    if (actualSchedule.program_info.broadcaster_name) {
                        tlPartialKey = 'program-with-broadcaster';
                        tlData.broadcaster = actualSchedule.program_info.broadcaster_name;
                    }

                    actualScheduleValue = __tl('component.player.unified.label.' + tlPartialKey, tlData);
                } else {
                    actualScheduleValue = '';
                }

                playing = actualScheduleValue;

                if ($this.config.showMusicName) {
                    if (preparedActualPlayingTrack) {
                        if (playing != '') {
                            playing = __tl('component.player.unified.label.schedule-with-track', { track: preparedActualPlayingTrack, schedule: actualScheduleValue });
                        } else {
                            playing = __tl('component.player.unified.label.track', { track: preparedActualPlayingTrack });
                        }
                    }
                }
            }

            $this.listen.updatePlayerData(playing);
        }

        this.getActualPlayingTrack = function() {
            return actualPlayingTrack;
        };

        this.getActiveSchedule = function() {
            return actualSchedule;
        }

        this.getActiveScheduleImage = function() {
            if (!actualSchedule) {
                return false;
            }

            if (actualSchedule.program_info.program_image) {
                return UPLOAD_BASE_URL + 'program/' + actualSchedule.program_info.program_image;
            } else if(actualSchedule.program_info.broadcaster_image) {
                return UPLOAD_BASE_URL + 'broadcaster/' + actualSchedule.program_info.broadcaster_image;
            }

            return false;
        }

        this.getActualPlayingTrackImage = function(onlyCoverPath) {
            if (!lastValidPlayingTrackSanitized || !trackImageList[lastValidPlayingTrackSanitized]) {
                return false;
            }

            return (onlyCoverPath ? '' : BASE_URL_SONG_COVER) + trackImageList[lastValidPlayingTrackSanitized];
        }

        this.getTrackImageByName = function(trackName, onlyCoverPath) {
            trackName = $this.sanitizedTrackName(trackName);

            if (!trackName || !trackImageList[trackName]) {
                return false;
            }

            return (onlyCoverPath ? '' : BASE_URL_SONG_COVER) + trackImageList[trackName];
        }

        this.sanitizedTrackName = function(trackName) {
            if (!trackName) {
                return false;
            }

            if (typeof sanitizedTrackValues[trackName] != 'undefined') {
                return sanitizedTrackValues[trackName];
            }

            var diacritics = [
                {char: 'A', base: /[\300-\306]/g},
                {char: 'a', base: /[\340-\346]/g},
                {char: 'E', base: /[\310-\313]/g},
                {char: 'e', base: /[\350-\353]/g},
                {char: 'I', base: /[\314-\317]/g},
                {char: 'i', base: /[\354-\357]/g},
                {char: 'O', base: /[\322-\330]/g},
                {char: 'o', base: /[\362-\370]/g},
                {char: 'U', base: /[\331-\334]/g},
                {char: 'u', base: /[\371-\374]/g},
                {char: 'C', base: /[\307]/g},
                {char: 'c', base: /[\347]/g}
            ]

            $.each(diacritics, function(i,v) {
                trackName = trackName.replace(v.base, v.char);
            });

            trackName = trackName.toLowerCase()
                .replace(/\sfeat\.\s|\sft\.\s|[\)\}\}][\(\{\[]|[\,\:\;\"\/\\\_\-]/g, ' ')
                .replace(/[\.\(\)\[\]\{\}\'\`\´]/g, '')
                .replace(/^[\d]+\s/g, '');

            sanitizedTrackValues[trackName] = $.trim(trackName).replace(/\s[\s]+/g, ' ').substr(0, 200)

            return sanitizedTrackValues[trackName];
        }
    }

    return new RFGeneralPlayerConstruct();
})();
