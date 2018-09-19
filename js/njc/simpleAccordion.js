/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/globals/jquery/index.d.ts" />
$(function () {
    var ckrs = [];
    $(document).on('click', '.switch .toggle', function () {
        var target = null;
        if (undefined !== $(this).attr("toggle-class")) {
            var target = $(this).attr("toggle-class");
        }
        if (undefined !== $(this).attr("toggle-mobile-only")) {
            if (window.matchMedia('(max-width:768px)').matches || 0 < $('body.preview.sp').length) {
                $(this).toggleClass("active");
                slideTarget(this, target);
                if (-1 === $.inArray(target, ckrs)) {
                    ckrs.push(target);
                }
            }
        }
        else {
            $(this).toggleClass("active");
            slideTarget(this, target);
        }
    });
    function slideTarget(me, tg) {
        var target = $(me).next();
        var speed = 500;
        if (null !== tg) {
            target = "." + tg;
        }
        if (undefined !== $("." + tg)[0]) {
            if ("DIV" != $("." + tg)[0].nodeName) {
                speed = 0;
            }
        }
        $(target).slideToggle(speed);
    }
    $(window).on('load resize', function () {
        if (!window.matchMedia('(max-width:768px)').matches || 0 < $('body.preview.sp').length) {
            for (var i = 0; i < ckrs.length; i++) {
                if ("none" === $("." + ckrs[i]).css("display")) {
                    $("." + ckrs[i]).slideToggle(0);
                }
            }
        }
    });
});
