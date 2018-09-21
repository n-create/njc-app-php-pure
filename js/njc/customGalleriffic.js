/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/globals/jquery/index.d.ts" />
jQuery(document).ready(function ($) {
    // Initially set opacity on thumbs and add
    // additional styling for hover effect on thumbs
    var onMouseOutOpacity = 0.67;
    // Initialize Advanced Galleriffic Gallery
    var gallery = $('#thumbs').galleriffic({
        buildPageLink: function () { },
        delay: 5000,
        numThumbs: 15,
        preloadAhead: 10,
        enableTopPager: false,
        enableBottomPager: true,
        maxPagesToShow: 7,
        imageContainerSel: '#slideshow',
        controlsContainerSel: '#controls',
        captionContainerSel: '#caption',
        loadingContainerSel: '#loading',
        renderSSControls: false,
        renderNavControls: true,
        playLinkText: 'Play Slideshow',
        pauseLinkText: 'Pause Slideshow',
        prevLinkText: '',
        nextLinkText: '',
        nextPageLinkText: '次へ',
        prevPageLinkText: '前へ',
        enableHistory: false,
        autoStart: false,
        syncTransitions: true,
        defaultTransitionDuration: 900,
        onSlideChange: function (prevIndex, nextIndex) { },
        onPageTransitionOut: function (callback) {
            this.fadeTo('fast', 0.0, callback);
        },
        onPageTransitionIn: function () {
            this.fadeTo('fast', 1.0);
        }
    });
    var isTchSt = false;
    var startPosX = 0;
    var startTime = 0;
    var endPosX = 0;
    //フリック機能を追加する
    $('#gallery').on('touchmove', function (e) {
        //フリックし始めるところ。
        var pos = getTouchPosition(e);
        if (!isTchSt) {
            startPosX = pos.x;
            startTime = new Date().getTime();
            isTchSt = true;
        }
        endPosX = pos.x;
    });
    $('#gallery').on('touchend', function (e) {
        //フリックし終わるところ。
        var move = endPosX - startPosX;
        var endTime = new Date().getTime();
        if (50 < Math.abs(move) && 1000 >= endTime - startTime) {
            if (0 < move) {
                gallery.previous();
            }
            else {
                gallery.next();
            }
        }
        isTchSt = false;
    });
    function getTouchPosition(e) {
        var x = e.originalEvent.touches[0].pageX;
        var y = e.originalEvent.touches[0].pageY;
        x = Math.floor(x);
        y = Math.floor(y);
        return { 'x': x, 'y': y };
    }
});
