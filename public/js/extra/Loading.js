function Loading(Checker, callback) {
    var LoadingImage = "/js/extra/loading_flower.gif"; //29x29

    if (typeof (Checker) == "boolean") {
        var dh = $(window).outerHeight(true);
        var wh = $(window).outerHeight(true);
        var h = (dh > wh) ? dh : wh;

        var dw = $(window).outerWidth(true);
        var ww = $(window).outerWidth(true);
        var w = (dw > ww) ? dw : ww;

        var posX = (w / 2) - 34;
        var posY = (h / 2) - 34;

        if (Checker) {
            if (document.getElementById("LoadingDivLayer") == null) {
                var loadingTag = "<div id=\"LoadingDivLayer\" class=\"LoadingDivLayerClass\" style=\"height:" + String(h) + "px\">";
                loadingTag += "<div class=\"LoadingForeground\" style=\"height:" + String(h) + "px;\">";
                loadingTag += "<div class=\"LoadingBox\" style=\"top:" + String(posY) + "px;left:" + String(posX) + "px;\">";
                loadingTag += "<img src=\"" + LoadingImage + "\" alt=\"Loading...\" />";
                loadingTag += "</div>";
                loadingTag += "</div>";
                loadingTag += "<div class=\"LoadingBackground\" style=\"height:" + String(h) + "px\">";
                loadingTag += "</div>";
                loadingTag += "</div>";
                $("body").prepend(loadingTag);
                $("#LoadingDivLayer").fadeIn(350, function () {
                    if (callback != null) {
                        callback();
                    }
                });
            }
        } else {
            if (document.getElementById("LoadingDivLayer") != null) {
                $("#LoadingDivLayer").remove();
                if (callback != null) {
                    callback();
                }
            }
        }
    } else if (typeof (Checker) == "string" && document.getElementById(String(Checker)) != null) {
        var parentLayer = document.getElementById(String(Checker));
        if (document.getElementById("LoadingDivLayer_" + String(Checker)) == null) {
            var off = $(parentLayer).offset();
            var posX = ($(parentLayer).width() / 2) - 34;
            var posY = ($(parentLayer).height() / 2) - 34;

            var loadingTag = "<div id=\"LoadingDivLayer_" + String(Checker) + "\" class=\"LoadingDivLayerClass\" style=\"width:" + String($(parentLayer).width()) + "px;height:" + String($(parentLayer).height()) + "px;top:" + String(off.top) + "px;left:" + String(off.left) + "px;\">";
            loadingTag += "<div class=\"LoadingForeground\" style=\"height:" + String($(parentLayer).height()) + "px;\">";
            loadingTag += "<div class=\"LoadingBox\" style=\"top:" + String(posY) + "px;left:" + String(posX) + "px;\">";
            loadingTag += "<img src=\"" + LoadingImage + "\" alt=\"Loading...\" />";
            loadingTag += "</div>";
            loadingTag += "</div>";
            loadingTag += "<div class=\"LoadingBackground\" style=\"width:" + String($(parentLayer).width()) + "px;height:" + String($(parentLayer).height()) + "px\">";
            loadingTag += "</div>";
            loadingTag += "</div>";
            $(parentLayer).prepend(loadingTag);
            $("#LoadingDivLayer_" + String(Checker)).fadeIn(350, function () {
                if (callback != null) {
                    callback();
                }
            });
        } else {
            $("#LoadingDivLayer_" + String(Checker)).remove();
            if (callback != null) {
                callback();
            }
        }
    }
}
;

$(window).resize(function () {
    if (document.getElementById("LoadingDivLayer") != null) {
        var dh = $(document).outerHeight(true);
        var wh = $(window).outerHeight(true);
        var h = (dh > wh) ? dh : wh;

        var dw = $(document).outerWidth(true);
        var ww = $(window).outerWidth(true);
        var w = (dw > ww) ? dw : ww;

        var posX = (w / 2) + 14;
        var posY = (h / 2) + 14;

        $("#LoadingDivLayer").css({
            height: String(h) + "px"
        });

        $("#LoadingDivLayer > .LoadingForeground").css({
            height: String(h) + "px"
        });

        $("#LoadingDivLayer > .LoadingForeground > .LoadingBox").css({
            top: String(posY) + "px",
            left: String(posX) + "px"
        });

        $("#LoadingDivLayer > .LoadingBackground").css({
            height: String(h) + "px"
        });
    }
});


Loading(true);