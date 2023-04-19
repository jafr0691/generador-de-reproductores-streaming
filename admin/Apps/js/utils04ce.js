
/*\
|*|  A complete cookies reader/writer framework with full unicode support.
|*|
|*|  Revision #1 - September 4, 2014
|*|
|*|  https://developer.mozilla.org/en-US/docs/Web/API/document.cookie
|*|  https://developer.mozilla.org/User:fusionchess
|*|
|*|  This framework is released under the GNU Public License, version 3 or later.
|*|  http://www.gnu.org/licenses/gpl-3.0-standalone.html
\*/
var docCookies = {
    getItem: function (sKey) {
        if (!sKey) { return null; }
        return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
    },
    setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
        if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
        var sExpires = "";
        if (vEnd) {
            switch (vEnd.constructor) {
                case Number:
                    sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
                    break;
                case String:
                    sExpires = "; expires=" + vEnd;
                    break;
                case Date:
                    sExpires = "; expires=" + vEnd.toUTCString();
                    break;
            }
        }
        document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
        return true;
    },
    removeItem: function (sKey, sPath, sDomain) {
        if (!this.hasItem(sKey)) { return false; }
        document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
        return true;
    },
    hasItem: function (sKey) {
        if (!sKey) { return false; }
        return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
    },
    keys: function () {
        var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
        for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) { aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]); }
        return aKeys;
    }
};

function asset(path) {
    return BASE_ASSETS + path + '?_t=' + ASSETS_CONSTANT;
}

var escapeElementHolder = $('<div/>');

function escapeHtml(str) {
    return escapeElementHolder.text(str).html();
}

function escapeHtmlAttr(str) {
    return escapeHtml(str)
        .replace(/'/g, '&apos;')
        .replace(/\"/g, '&quot;')
        .replace(/\\/g, '&bsol;');
}

function padLeft(nr, n, str) {
    return Array(n-String(nr).length+1).join(str||' ')+nr;
}

function parseAbsTimeToHuman(absTime) {
    absTime = parseInt(absTime) % 1440;
    return padLeft(Math.floor(absTime / 60), 2, '0') + ":" + padLeft(absTime % 60, 2, '0')
}

function cleanUrlParams(str) {
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
        str = str.replace(v.base, v.char);
    });

    str = str.replace(/ /g, '-').toLowerCase();
    str = str.replace(/[^0-9a-z\-]/g, '-');
    str = str.replace(/-+/g, '-').replace(/^[\-]*|[\-]*$/g, '');

    return str;
}

var QuickSortAttr = (function () {
    function partition(array, attr, left, right) {
        var cmp = array[right - 1], minEnd = left, maxEnd;
        for (maxEnd = left; maxEnd < right - 1; maxEnd += 1) {
            if (array[maxEnd][attr] <= cmp[attr]) {
                swap(array, maxEnd, minEnd);
                minEnd += 1;
            }
        }
        swap(array, minEnd, right - 1);
        return minEnd;
    }

    function swap(array, i, j) {
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
        return array;
    }

    function quickSort(array, attr, left, right) {
        if (left < right) {
            var p = partition(array, attr, left, right);
            quickSort(array, attr, left, p);
            quickSort(array, attr, p + 1, right);
        }
        return array;
    }

    return function(array, attr) {
        return quickSort(array, attr, 0, array.length);
    };
}());

var Translator = (function () {
    var localeData = {};

    function getLineContent(fileLine) {
        var lineContent = false;
        var fileContent = null;

        var line = fileLine ? fileLine.split('.') : [];

        if (line.length !== 0) {
            var deepSearch = function (content, level) {
                // chegou no ultimo nivel
                if (level.length === 0) {
                    return content;
                }

                // tem mais niveis mas não da pra acessar no conteudo
                if (typeof content !== 'object') {
                    return false;
                }

                var currentLevel = level.shift();

                // não tem um dos niveis
                if (typeof content[currentLevel] === 'undefined') {
                    return false;
                }

                // vai pro proximo nivel
                return deepSearch(content[currentLevel], level);
            };

            lineContent = deepSearch(localeData, line);
        } else {
            // retorna o conteudo inteiro
            lineContent = localeData;
        }

        if (lineContent === false) {
            console.warn('Translation line for "%s" not defined ', fileLine);
        }

        return lineContent;
    }

    function parseLineContentData(lineContent, data) {
        if (typeof lineContent !== 'string' || typeof data !== 'object') {
            return lineContent;
        }

        var lineContentResult = lineContent;

        for (var i in data) {
            lineContentResult = lineContentResult.replace(new RegExp('\\{' + i + '\\}', 'g'), data[i]);
        }

        return lineContentResult;
    }

    function TranslatorConstructor() {}

    TranslatorConstructor.prototype.mergeContent = function (content) {
        localeData = $.extend(true, localeData, content);
    };

    TranslatorConstructor.prototype.addContent = function (node, content) {
        var nodeLine = node.split('.');

        if (nodeLine.length === 1) {
            localeData[node] = content;
            return;
        }

        var baseNode = localeData;
        var currentNode = false;

        while (currentNode = nodeLine.shift()) {
            if (nodeLine.length === 0) {
                baseNode[currentNode] = content;
            } else {
                if (typeof baseNode[currentNode] != 'object') {
                    baseNode[currentNode] = {};
                }

                baseNode = baseNode[currentNode];
            }
        }
    };

    TranslatorConstructor.prototype.addFileContent = function (node, content) {
        this.addContent(node.replace(/^[^\.]+\./, ''), content);
    };

    TranslatorConstructor.prototype.getLine = function (line, data) {
        var lineContent = getLineContent(line);

        if (lineContent === false) {
            return line;
        }

        return parseLineContentData(lineContent, data);
    };

    TranslatorConstructor.prototype.getLineChoose = function (line, amount, data) {
        lineContent = getLineContent(line);

        if (lineContent === false) {
            return line;
        }

        if (typeof lineContent === 'string') {
            // remove os espaços entre os pipes ex: Nenhum item | Um item | {count} itens
            lineContent = lineContent.replace(/[\s]*\|[\s]*/g, '|');
            lineContent = lineContent.split('|')
        }

        if (!$.isArray(lineContent) || lineContent.length !== 3 || typeof lineContent[0] === 'undefined' || typeof lineContent[1] === 'undefined' || typeof lineContent[2] === 'undefined') {
            console.warn('Line "%s" invalid, must be a string (eg: "No items | One item | {count} items") or an array with indexes 0, 1 and 2 (eg: [0 => "No items", 1 => "One item", 2 => "{count} items"])', line);
            return line;
        }

        if (amount <= 0) {
            lineContent = lineContent[0];
        } else if (amount === 1) {
            lineContent = lineContent[1];
        } else {
            lineContent = lineContent[2];
        }

        return parseLineContentData(lineContent, data);
    }

    return new TranslatorConstructor();
})();

function __tl() {
    return Translator.getLine.apply(Translator, arguments);
}

function __tlc() {
    return Translator.getLineChoose.apply(Translator, arguments);
}
