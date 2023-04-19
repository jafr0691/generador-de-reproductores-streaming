<?php
$seis = "$Tema";
?>
<?php if($seis == "seis"){ ?>
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
    <meta property="og:url" content="https://player.mediapanel.app/?idr=<?php echo base64_encode($IDR); ?>"/>
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
    <meta property="og:url" content="https://player.mediapanel.app/?idr=<?php echo base64_encode($IDR); ?>"/>
    <link href="css/tema-<?php echo $Tema;?>.css?<?php echo base64_encode($IDR); ?>=<?php echo base64_encode($IDR); ?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="css/general.css">
    </head>
      <body>

<ul id="contextmenu" class="dropdown-menu">
    <li style="border-top-left-radius: 6px;border-top-right-radius: 6px;border-bottom: solid 3px #1b1717;">
         <a id="a01" target="_blank" >Player HTML5v2 by <?php echo $perfil['text_footer']; ?></a>
        </li>
        <li><a id="a02" target="_blank" >Streaming for Radio Stations?</a></li>
      </ul>



<link href="https://mediapanel.app/dashboard/player/reproductores/css/tema-seis.css?NDQx=NDQx" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<div class="<?php echo $Tema;?>" id="<?php echo $Tema;?>">
  <div class="player-ghp">
    <div class="blur"></div>
    <div class="player-ctr">
      <div class="listeners fal fa-users"></div>
      <div class="album-cover-ghp">
        <div class="social-share-ghp animated"> Redes Sociales: <br>
          <a href="" target="_blank" class="social-link social-link-facebook fab fa-facebook animated" id="aface"></a> <a href="" target="_blank" class="social-link social-link-twitter fab fa-twitter animated" id="atwitter"></a></div>
        <div class="album-cover animated" style="background-image: url(https://cdn.mexiserver.com/imagenes/caratula-sonido.gif?1);"></div>
        <div class="album-cover2 animated" style="background-image: url(https://cdn.mexiserver.com/imagenes/caratula-sonido.gif?1);"></div>
      </div>
      <div class="track-info-ghp">
        <div class="track-info-ctr">
          <div class="marquee"> <span class="artist-name animated"></span><span> - </span><span class="songtitle animated"></span></div>
        </div>
      </div>
      <div class="ppBtn playing stop-btn fal fa-circle"></div>
      <div class="servertitle"></div>
    </div>
    <div class="icons-left-ghp">
      <div class="icons-left icons-history fal fa-history"></div>
    </div>
    <div class="icons-right-ghp">
      <div class="icons-right icons-volume fal fa-volume-up icons-volume3"></div>
      <div class="icons-right icons-volumeM fal fa-volume"></div>
    </div>
    <input class="volume-slider" type="range" min="0" max="100" step="0.10" value="" autocomplete="off">
    <div class="history-ghp nodisplay">
      <div class="history-title">Ultimas Reproducciones:</div>
      <div class="row-ghp">
        <div class="history-cover" id="row1"></div>
        <div class="history-track-info">
          <div class="history-songtitle"></div>
          <div class="history-artist-name"></div>
        </div>
        <div class="rowNum">1</div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>  
<script type="text/javascript">
(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
    typeof define === 'function' && define.amd ? define(['jquery'], factory) :
    (factory(global.$));
}(this, (function ($) { 'use strict';

$ = $ && 'default' in $ ? $['default'] : $;

var gl;
var $window = $(window); // There is only one window, so why not cache the jQuery-wrapped window?

function isPercentage(str) {
    return str[str.length - 1] == '%';
}


function loadConfig() {
    var canvas = document.createElement('canvas');
    gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');

    if (!gl) {
        return null;
    }

    var extensions = {};
    [
        'OES_texture_float',
        'OES_texture_half_float',
        'OES_texture_float_linear',
        'OES_texture_half_float_linear'
    ].forEach(function(name) {
        var extension = gl.getExtension(name);
        if (extension) {
            extensions[name] = extension;
        }
    });

    if (!extensions.OES_texture_float) {
        return null;
    }

    var configs = [];

    function createConfig(type, glType, arrayType) {
        var name = 'OES_texture_' + type,
                nameLinear = name + '_linear',
                linearSupport = nameLinear in extensions,
                configExtensions = [name];

        if (linearSupport) {
            configExtensions.push(nameLinear);
        }

        return {
            type: glType,
            arrayType: arrayType,
            linearSupport: linearSupport,
            extensions: configExtensions
        };
    }

    configs.push(
        createConfig('float', gl.FLOAT, Float32Array)
    );

    if (extensions.OES_texture_half_float) {
        configs.push(

            createConfig('half_float', extensions.OES_texture_half_float.HALF_FLOAT_OES, null)
        );
    }

    var texture = gl.createTexture();
    var framebuffer = gl.createFramebuffer();

    gl.bindFramebuffer(gl.FRAMEBUFFER, framebuffer);
    gl.bindTexture(gl.TEXTURE_2D, texture);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.NEAREST);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.NEAREST);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);

    var config = null;

    for (var i = 0; i < configs.length; i++) {
        gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, 32, 32, 0, gl.RGBA, configs[i].type, null);

        gl.framebufferTexture2D(gl.FRAMEBUFFER, gl.COLOR_ATTACHMENT0, gl.TEXTURE_2D, texture, 0);
        if (gl.checkFramebufferStatus(gl.FRAMEBUFFER) === gl.FRAMEBUFFER_COMPLETE) {
            config = configs[i];
            break;
        }
    }

    return config;
}

function createImageData(width, height) {
    try {
        return new ImageData(width, height);
    }
    catch (e) {

        var canvas = document.createElement('canvas');
        return canvas.getContext('2d').createImageData(width, height);
    }
}

function translateBackgroundPosition(value) {
    var parts = value.split(' ');

    if (parts.length === 1) {
        switch (value) {
            case 'center':
                return ['50%', '50%'];
            case 'top':
                return ['50%', '0'];
            case 'bottom':
                return ['50%', '100%'];
            case 'left':
                return ['0', '50%'];
            case 'right':
                return ['100%', '50%'];
            default:
                return [value, '50%'];
        }
    }
    else {
        return parts.map(function(part) {
            switch (value) {
                case 'center':
                    return '50%';
                case 'top':
                case 'left':
                    return '0';
                case 'right':
                case 'bottom':
                    return '100%';
                default:
                    return part;
            }
        });
    }
}

function createProgram(vertexSource, fragmentSource, uniformValues) {
    function compileSource(type, source) {
        var shader = gl.createShader(type);
        gl.shaderSource(shader, source);
        gl.compileShader(shader);
        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
            throw new Error('compile error: ' + gl.getShaderInfoLog(shader));
        }
        return shader;
    }

    var program = {};

    program.id = gl.createProgram();
    gl.attachShader(program.id, compileSource(gl.VERTEX_SHADER, vertexSource));
    gl.attachShader(program.id, compileSource(gl.FRAGMENT_SHADER, fragmentSource));
    gl.linkProgram(program.id);
    if (!gl.getProgramParameter(program.id, gl.LINK_STATUS)) {
        throw new Error('link error: ' + gl.getProgramInfoLog(program.id));
    }

    program.uniforms = {};
    program.locations = {};
    gl.useProgram(program.id);
    gl.enableVertexAttribArray(0);
    var match, name, regex = /uniform (\w+) (\w+)/g, shaderCode = vertexSource + fragmentSource;
    while ((match = regex.exec(shaderCode)) != null) {
        name = match[2];
        program.locations[name] = gl.getUniformLocation(program.id, name);
    }

    return program;
}

function bindTexture(texture, unit) {
    gl.activeTexture(gl.TEXTURE0 + (unit || 0));
    gl.bindTexture(gl.TEXTURE_2D, texture);
}

function extractUrl(value) {
    var urlMatch = /url\(["']?([^"']*)["']?\)/.exec(value);
    if (urlMatch == null) {
        return null;
    }

    return urlMatch[1];
}

function isDataUri(url) {
    return url.match(/^data:/);
}

var config = loadConfig();
var transparentPixels = createImageData(32, 32);

$('head').prepend('<style>.jquery-ripples { position: relative; z-index: 0; }</style>');

var Ripples = function (el, options) {
    var that = this;

    this.$el = $(el);

    // Init properties from options
    this.interactive = options.interactive;
    this.resolution = options.resolution;
    this.textureDelta = new Float32Array([1 / this.resolution, 1 / this.resolution]);
    this.perturbance = options.perturbance;
    this.dropRadius = options.dropRadius;
    this.crossOrigin = options.crossOrigin;
    this.imageUrl = options.imageUrl;
    var canvas = document.createElement('canvas');
    canvas.width = this.$el.innerWidth();
    canvas.height = this.$el.innerHeight();
    this.canvas = canvas;
    this.$canvas = $(canvas);
    this.$canvas.css({
        position: 'absolute',
        left: 0,
        top: 0,
        right: 0,
        bottom: 0,
        zIndex: -1
    });
    this.$el.addClass('jquery-ripples').append(canvas);
    this.context = gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
    config.extensions.forEach(function(name) {
        gl.getExtension(name);
    });
    this.updateSize = this.updateSize.bind(this);
    $(window).on('resize', this.updateSize);
    this.textures = [];
    this.framebuffers = [];
    this.bufferWriteIndex = 0;
    this.bufferReadIndex = 1;
    var arrayType = config.arrayType;
    var textureData = arrayType ? new arrayType(this.resolution * this.resolution * 4) : null;
    for (var i = 0; i < 2; i++) {
        var texture = gl.createTexture();
        var framebuffer = gl.createFramebuffer();
        gl.bindFramebuffer(gl.FRAMEBUFFER, framebuffer);
        gl.bindTexture(gl.TEXTURE_2D, texture);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, config.linearSupport ? gl.LINEAR : gl.NEAREST);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, config.linearSupport ? gl.LINEAR : gl.NEAREST);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
        gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, this.resolution, this.resolution, 0, gl.RGBA, config.type, textureData);
        gl.framebufferTexture2D(gl.FRAMEBUFFER, gl.COLOR_ATTACHMENT0, gl.TEXTURE_2D, texture, 0);
        this.textures.push(texture);
        this.framebuffers.push(framebuffer);
    }
    this.quad = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, this.quad);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([
        -1, -1,
        +1, -1,
        +1, +1,
        -1, +1
    ]), gl.STATIC_DRAW);
    this.initShaders();
    this.initTexture();
    this.setTransparentTexture();
    this.loadImage();
    gl.clearColor(0, 0, 0, 0);
    gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
    this.visible = true;
    this.running = true;
    this.inited = true;
    this.destroyed = false;
    this.setupPointerEvents();
    function step() {
        if (!that.destroyed) {
            that.step();

            requestAnimationFrame(step);
        }
    }
    requestAnimationFrame(step);
};
Ripples.DEFAULTS = {
    imageUrl: null,
    resolution: 256,
    dropRadius: 20,
    perturbance: 0.03,
    interactive: true,
    crossOrigin: ''
};
Ripples.prototype = {
    setupPointerEvents: function() {
        var that = this;
        function pointerEventsEnabled() {
            return that.visible && that.running && that.interactive;
        }
        function dropAtPointer(pointer, big) {
            if (pointerEventsEnabled()) {
                that.dropAtPointer(
                    pointer,
                    that.dropRadius * (big ? 1.5 : 1),
                    (big ? 0.14 : 0.01)
                );
            }
        }
        this.$el
            .on('mousemove.ripples', function(e) {
                dropAtPointer(e);
            })
            .on('touchmove.ripples touchstart.ripples', function(e) {
                var touches = e.originalEvent.changedTouches;
                for (var i = 0; i < touches.length; i++) {
                    dropAtPointer(touches[i]);
                }
            })
            .on('mousedown.ripples', function(e) {
                dropAtPointer(e, true);
            });
    },
    loadImage: function() {
        var that = this;
        gl = this.context;
        var newImageSource = this.imageUrl ||
            extractUrl(this.originalCssBackgroundImage) ||
            extractUrl(this.$el.css('backgroundImage'));
        if (newImageSource == this.imageSource) {
            return;
        }
        this.imageSource = newImageSource;
        if (!this.imageSource) {
            this.setTransparentTexture();
            return;
        }
        var image = new Image;
        image.onload = function() {
            gl = that.context;
            function isPowerOfTwo(x) {
                return (x & (x - 1)) == 0;
            }
            var wrapping = (isPowerOfTwo(image.width) && isPowerOfTwo(image.height)) ? gl.REPEAT : gl.CLAMP_TO_EDGE;
            gl.bindTexture(gl.TEXTURE_2D, that.backgroundTexture);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, wrapping);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, wrapping);
            gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, image);
            that.backgroundWidth = image.width;
            that.backgroundHeight = image.height;
            that.hideCssBackground();
        };
        image.onerror = function() {
            gl = that.context;

            that.setTransparentTexture();
        };
        image.crossOrigin = isDataUri(this.imageSource) ? null : this.crossOrigin;
        image.src = this.imageSource;
    },
    step: function() {
        gl = this.context;
        if (!this.visible) {
            return;
        }
        this.computeTextureBoundaries();
        if (this.running) {
            this.update();
        }
        this.render();
    },
    drawQuad: function() {
        gl.bindBuffer(gl.ARRAY_BUFFER, this.quad);
        gl.vertexAttribPointer(0, 2, gl.FLOAT, false, 0, 0);
        gl.drawArrays(gl.TRIANGLE_FAN, 0, 4);
    },
    render: function() {
        gl.bindFramebuffer(gl.FRAMEBUFFER, null);
        gl.viewport(0, 0, this.canvas.width, this.canvas.height);
        gl.enable(gl.BLEND);
        gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
        gl.useProgram(this.renderProgram.id);
        bindTexture(this.backgroundTexture, 0);
        bindTexture(this.textures[0], 1);
        gl.uniform1f(this.renderProgram.locations.perturbance, this.perturbance);
        gl.uniform2fv(this.renderProgram.locations.topLeft, this.renderProgram.uniforms.topLeft);
        gl.uniform2fv(this.renderProgram.locations.bottomRight, this.renderProgram.uniforms.bottomRight);
        gl.uniform2fv(this.renderProgram.locations.containerRatio, this.renderProgram.uniforms.containerRatio);
        gl.uniform1i(this.renderProgram.locations.samplerBackground, 0);
        gl.uniform1i(this.renderProgram.locations.samplerRipples, 1);
        this.drawQuad();
        gl.disable(gl.BLEND);
    },
    update: function() {
        gl.viewport(0, 0, this.resolution, this.resolution);
        gl.bindFramebuffer(gl.FRAMEBUFFER, this.framebuffers[this.bufferWriteIndex]);
        bindTexture(this.textures[this.bufferReadIndex]);
        gl.useProgram(this.updateProgram.id);
        this.drawQuad();
        this.swapBufferIndices();
    },
    swapBufferIndices: function() {
        this.bufferWriteIndex = 1 - this.bufferWriteIndex;
        this.bufferReadIndex = 1 - this.bufferReadIndex;
    },
    computeTextureBoundaries: function() {
        var backgroundSize = this.$el.css('background-size');
        var backgroundAttachment = this.$el.css('background-attachment');
        var backgroundPosition = translateBackgroundPosition(this.$el.css('background-position'));
        var container;
        if (backgroundAttachment == 'fixed') {
            container = { left: window.pageXOffset, top: window.pageYOffset };
            container.width = $window.width();
            container.height = $window.height();
        }
        else {
            container = this.$el.offset();
            container.width = this.$el.innerWidth();
            container.height = this.$el.innerHeight();
        }
        if (backgroundSize == 'cover') {
            var scale = Math.max(container.width / this.backgroundWidth, container.height / this.backgroundHeight);

            var backgroundWidth = this.backgroundWidth * scale;
            var backgroundHeight = this.backgroundHeight * scale;
        }
        else if (backgroundSize == 'contain') {
            var scale = Math.min(container.width / this.backgroundWidth, container.height / this.backgroundHeight);

            var backgroundWidth = this.backgroundWidth * scale;
            var backgroundHeight = this.backgroundHeight * scale;
        }
        else {
            backgroundSize = backgroundSize.split(' ');
            var backgroundWidth = backgroundSize[0] || '';
            var backgroundHeight = backgroundSize[1] || backgroundWidth;

            if (isPercentage(backgroundWidth)) {
                backgroundWidth = container.width * parseFloat(backgroundWidth) / 100;
            }
            else if (backgroundWidth != 'auto') {
                backgroundWidth = parseFloat(backgroundWidth);
            }
            if (isPercentage(backgroundHeight)) {
                backgroundHeight = container.height * parseFloat(backgroundHeight) / 100;
            }
            else if (backgroundHeight != 'auto') {
                backgroundHeight = parseFloat(backgroundHeight);
            }
            if (backgroundWidth == 'auto' && backgroundHeight == 'auto') {
                backgroundWidth = this.backgroundWidth;
                backgroundHeight = this.backgroundHeight;
            }
            else {
                if (backgroundWidth == 'auto') {
                    backgroundWidth = this.backgroundWidth * (backgroundHeight / this.backgroundHeight);
                }

                if (backgroundHeight == 'auto') {
                    backgroundHeight = this.backgroundHeight * (backgroundWidth / this.backgroundWidth);
                }
            }
        }
        var backgroundX = backgroundPosition[0];
        var backgroundY = backgroundPosition[1];
        if (isPercentage(backgroundX)) {
            backgroundX = container.left + (container.width - backgroundWidth) * parseFloat(backgroundX) / 100;
        }
        else {
            backgroundX = container.left + parseFloat(backgroundX);
        }
        if (isPercentage(backgroundY)) {
            backgroundY = container.top + (container.height - backgroundHeight) * parseFloat(backgroundY) / 100;
        }
        else {
            backgroundY = container.top + parseFloat(backgroundY);
        }
        var elementOffset = this.$el.offset();
        this.renderProgram.uniforms.topLeft = new Float32Array([
            (elementOffset.left - backgroundX) / backgroundWidth,
            (elementOffset.top - backgroundY) / backgroundHeight
        ]);
        this.renderProgram.uniforms.bottomRight = new Float32Array([
            this.renderProgram.uniforms.topLeft[0] + this.$el.innerWidth() / backgroundWidth,
            this.renderProgram.uniforms.topLeft[1] + this.$el.innerHeight() / backgroundHeight
        ]);
        var maxSide = Math.max(this.canvas.width, this.canvas.height);
        this.renderProgram.uniforms.containerRatio = new Float32Array([
            this.canvas.width / maxSide,
            this.canvas.height / maxSide
        ]);
    },
    initShaders: function() {
        var vertexShader = [
            'attribute vec2 vertex;',
            'varying vec2 coord;',
            'void main() {',
                'coord = vertex * 0.5 + 0.5;',
                'gl_Position = vec4(vertex, 0.0, 1.0);',
            '}'
        ].join('\n');
        this.dropProgram = createProgram(vertexShader, [
            'precision highp float;',
            'const float PI = 3.141592653589793;',
            'uniform sampler2D texture;',
            'uniform vec2 center;',
            'uniform float radius;',
            'uniform float strength;',
            'varying vec2 coord;',
            'void main() {',
                'vec4 info = texture2D(texture, coord);',
                'float drop = max(0.0, 1.0 - length(center * 0.5 + 0.5 - coord) / radius);',
                'drop = 0.5 - cos(drop * PI) * 0.5;',
                'info.r += drop * strength;',
                'gl_FragColor = info;',
            '}'
        ].join('\n'));
        this.updateProgram = createProgram(vertexShader, [
            'precision highp float;',
            'uniform sampler2D texture;',
            'uniform vec2 delta;',
            'varying vec2 coord;',
            'void main() {',
                'vec4 info = texture2D(texture, coord);',
                'vec2 dx = vec2(delta.x, 0.0);',
                'vec2 dy = vec2(0.0, delta.y);',
                'float average = (',
                    'texture2D(texture, coord - dx).r +',
                    'texture2D(texture, coord - dy).r +',
                    'texture2D(texture, coord + dx).r +',
                    'texture2D(texture, coord + dy).r',
                ') * 0.25;',
                'info.g += (average - info.r) * 2.0;',
                'info.g *= 0.995;',
                'info.r += info.g;',

                'gl_FragColor = info;',
            '}'
        ].join('\n'));
        gl.uniform2fv(this.updateProgram.locations.delta, this.textureDelta);
        this.renderProgram = createProgram([
            'precision highp float;',

            'attribute vec2 vertex;',
            'uniform vec2 topLeft;',
            'uniform vec2 bottomRight;',
            'uniform vec2 containerRatio;',
            'varying vec2 ripplesCoord;',
            'varying vec2 backgroundCoord;',
            'void main() {',
                'backgroundCoord = mix(topLeft, bottomRight, vertex * 0.5 + 0.5);',
                'backgroundCoord.y = 1.0 - backgroundCoord.y;',
                'ripplesCoord = vec2(vertex.x, -vertex.y) * containerRatio * 0.5 + 0.5;',
                'gl_Position = vec4(vertex.x, -vertex.y, 0.0, 1.0);',
            '}'
        ].join('\n'), [
            'precision highp float;',

            'uniform sampler2D samplerBackground;',
            'uniform sampler2D samplerRipples;',
            'uniform vec2 delta;',

            'uniform float perturbance;',
            'varying vec2 ripplesCoord;',
            'varying vec2 backgroundCoord;',

            'void main() {',
                'float height = texture2D(samplerRipples, ripplesCoord).r;',
                'float heightX = texture2D(samplerRipples, vec2(ripplesCoord.x + delta.x, ripplesCoord.y)).r;',
                'float heightY = texture2D(samplerRipples, vec2(ripplesCoord.x, ripplesCoord.y + delta.y)).r;',
                'vec3 dx = vec3(delta.x, heightX - height, 0.0);',
                'vec3 dy = vec3(0.0, heightY - height, delta.y);',
                'vec2 offset = -normalize(cross(dy, dx)).xz;',
                'float specular = pow(max(0.0, dot(offset, normalize(vec2(-0.6, 1.0)))), 4.0);',
                'gl_FragColor = texture2D(samplerBackground, backgroundCoord + offset * perturbance) + specular;',
            '}'
        ].join('\n'));
        gl.uniform2fv(this.renderProgram.locations.delta, this.textureDelta);
    },
    initTexture: function() {
        this.backgroundTexture = gl.createTexture();
        gl.bindTexture(gl.TEXTURE_2D, this.backgroundTexture);
        gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, 1);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
    },
    setTransparentTexture: function() {
        gl.bindTexture(gl.TEXTURE_2D, this.backgroundTexture);
        gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, transparentPixels);
    },
    hideCssBackground: function() {
        var inlineCss = this.$el[0].style.backgroundImage;
        if (inlineCss == 'none') {
            return;
        }
        this.originalInlineCss = inlineCss;
        this.originalCssBackgroundImage = this.$el.css('backgroundImage');
        this.$el.css('backgroundImage', 'none');
    },
    restoreCssBackground: function() {

        this.$el.css('backgroundImage', this.originalInlineCss || '');
    },
    dropAtPointer: function(pointer, radius, strength) {
        var borderLeft = parseInt(this.$el.css('border-left-width')) || 0,
                borderTop = parseInt(this.$el.css('border-top-width')) || 0;

        this.drop(
            pointer.pageX - this.$el.offset().left - borderLeft,
            pointer.pageY - this.$el.offset().top - borderTop,
            radius,
            strength
        );
    },
    drop: function(x, y, radius, strength) {
        gl = this.context;

        var elWidth = this.$el.innerWidth();
        var elHeight = this.$el.innerHeight();
        var longestSide = Math.max(elWidth, elHeight);

        radius = radius / longestSide;

        var dropPosition = new Float32Array([
            (2 * x - elWidth) / longestSide,
            (elHeight - 2 * y) / longestSide
        ]);

        gl.viewport(0, 0, this.resolution, this.resolution);

        gl.bindFramebuffer(gl.FRAMEBUFFER, this.framebuffers[this.bufferWriteIndex]);
        bindTexture(this.textures[this.bufferReadIndex]);

        gl.useProgram(this.dropProgram.id);
        gl.uniform2fv(this.dropProgram.locations.center, dropPosition);
        gl.uniform1f(this.dropProgram.locations.radius, radius);
        gl.uniform1f(this.dropProgram.locations.strength, strength);

        this.drawQuad();

        this.swapBufferIndices();
    },
    updateSize: function() {
        var newWidth = this.$el.innerWidth(),
                newHeight = this.$el.innerHeight();

        if (newWidth != this.canvas.width || newHeight != this.canvas.height) {
            this.canvas.width = newWidth;
            this.canvas.height = newHeight;
        }
    },
    destroy: function() {
        this.$el
            .off('.ripples')
            .removeClass('jquery-ripples')
            .removeData('ripples');

        gl = null;

        $(window).off('resize', this.updateSize);

        this.$canvas.remove();
        this.restoreCssBackground();

        this.destroyed = true;
    },
    show: function() {
        this.visible = true;

        this.$canvas.show();
        this.hideCssBackground();
    },
    hide: function() {
        this.visible = false;

        this.$canvas.hide();
        this.restoreCssBackground();
    },
    pause: function() {
        this.running = false;
    },
    play: function() {
        this.running = true;
    },
    set: function(property, value) {
        switch (property) {
            case 'dropRadius':
            case 'perturbance':
            case 'interactive':
            case 'crossOrigin':
                this[property] = value;
                break;
            case 'imageUrl':
                this.imageUrl = value;
                this.loadImage();
                break;
        }
    }
};
var old = $.fn.ripples;
$.fn.ripples = function(option) {
    if (!config) {
        throw new Error('Your browser does not support WebGL, the OES_texture_float extension or rendering to floating point textures.');
    }
    var args = (arguments.length > 1) ? Array.prototype.slice.call(arguments, 1) : undefined;
    return this.each(function() {
        var $this = $(this),
                data = $this.data('ripples'),
                options = $.extend({}, Ripples.DEFAULTS, $this.data(), typeof option == 'object' && option);

        if (!data && typeof option == 'string') {
            return;
        }
        if (!data) {
            $this.data('ripples', (data = new Ripples(this, options)));
        }
        else if (typeof option == 'string') {
            Ripples.prototype[option].apply(data, args);
        }
    });
};

$.fn.ripples.Constructor = Ripples;

$.fn.ripples.noConflict = function() {
    $.fn.ripples = old;
    return this;
};

})));
</script> 
<script>
$(document).ready(function() {
    try {
        $('.seis').ripples({
            resolution: 512,
            dropRadius: 20, //px
            perturbance: 0.04,
        });
        $('album-cover').ripples({
            resolution: 128,
            dropRadius: 10, //px
            perturbance: 0.04,
            interactive: false
        });
    }
    catch (e) {
        $('.error').show().text(e);
    }

    $('.js-ripples-disable').on('click', function() {
        $('.seis, .seis .player-ghp ').ripples('destroy');
        $(this).hide();
    });

    $('.js-ripples-play').on('click', function() {
        $('.seis, .seis .player-ghp ').ripples('play');
    });

    $('.js-ripples-pause').on('click', function() {
        $('.seis, .seis .player-ghp ').ripples('pause');
    });

    setInterval(function() {
        var $el = $('.seis .player-ghp ');
        var x = Math.random() * $el.outerWidth();
        var y = Math.random() * $el.outerHeight();
        var dropRadius = 20;
        var strength = 0.04 + Math.random() * 0.04;

        $el.ripples('drop', x, y, dropRadius, strength);
    }, 400);
});
</script> 
<script src="https://mediapanel.app/dashboard/player/reproductores/<?php echo $Tema;?>.js"></script>
<script> $("#<?php echo $Tema;?>").<?php echo $Tema;?>({ 
URL: "<?php echo 'https://'.$IP.':'.$Puerto; ?>",
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
artwork: <?php echo $Artwork; ?>,
version: "2",
autoplay: true
}) 
</script>

<script>
document.getElementById("botonMio").style.visibility = "<?php echo $Mampara;?>";
document.getElementById("latido").style.color = "<?php echo $Color;?>";
document.getElementById("latido").innerHTML = "<?php echo $Late;?>";
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
          
          if(window.location.href.indexOf("<?php echo $perfil['text_footer']; ?>")<0){
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
$('#icon-popup').attr('href','popup/?idr=<?php echo base64_encode($IDR); ?>', );
        $('#icon-popup').click(function (event) {
            event.preventDefault();
            window.open($(this).attr('href'), 'popupWindow', 'onload="resizeIframe2(this)",onload="resizeIframe(this)",scrollbars=no,<?=$Ventana;?>')
        })
</script>
<?php }  ?>