/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/globals/jquery/index.d.ts" /> 
if (undefined === this.NJC) {
    this.NJC = {};
}
if (undefined === this.NJC.surroundingSlick) {
    this.NJC.surroundingSlick = {
        ResStart: function (selector) {
            function _setCenterCboxDialog() {
                var center = ($(document).width() / 2) - ($("#colorbox.surroundings-dialog").width() / 2);
                $("#colorbox.surroundings-dialog").clearQueue().finish().css({ 'left': center });
            }
            var check = 0;
            var maxHeight = 0;
            var maxImageHeight = 0;
            var maxMessageHeight = 0;
            var _slick = $(selector);
            var count = _slick.find(".surroundings-contents").length - 1;
            _slick.find(".surroundings-contents").on('click', function () {
                var num = $(this).data('number');
                var cb = $('.surroundings-pop-wrap > a');
                if (cb.length && cb[num]) {
                    var colorConf = {
                        open: true,
                        maxWidth: "90%",
                        maxHeight: "90%",
                        slideshowSpeed: 0
                    };
                    $(cb[num]).colorbox(colorConf);
                    $(document).on('cbox_load', function () {
                        setTimeout(function () {
                            $(this).colorbox.resize();
                            _setCenterCboxDialog();
                        }, 50);
                    });
                    $(document).on('cbox_complete', function () {
                        $(this).colorbox.resize();
                        _setCenterCboxDialog();
                    });
                    $(window).on('resize', function () {
                        $(this).colorbox.resize();
                        _setCenterCboxDialog();
                    });
                }
            });
            $('.surroundings-pop-wrap > a').colorbox({
                rel: selector,
                inline: true,
                slideshowAuto: false,
                arrowsKey: false,
                className: 'surroundings-dialog',
                scrolling: false,
                current: "{current}/{total}"
            });
            var responCfg = [{
                    breakpoint: 768,
                    settings: {
                        autoplay: false,
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        focusOnSelect: false,
                        focusOnChange: false,
                        variableWidth: false
                    }
                }];
            var slickOption = {
                infinite: false,
                variableWidth: false,
                slidesToShow: 5,
                slidesToScroll: 5,
                dots: false,
                centerMode: false,
                arrows: true,
                responsive: responCfg
            };
            _slick.closest('.surroundings').find('.change-all-view-btn').on('click', function () {
                if (_slick.hasClass('all-view')) {
                    $(this).removeClass('close-surroundings').addClass('open-surroundings').text('全て見る');
                    _slick.slick(slickOption).find('.slick-arrow').css({ height: _slick.closest('.surroundings-list-wrap').outerHeight(true) });
                    _slick.removeClass('all-view');
                }
                else {
                    $(this).removeClass('open-surroundings').addClass('close-surroundings').text('閉じる');
                    _slick.slick('destroy');
                    _slick.addClass('all-view');
                }
            });
            //画像ロードが終わって実行
            _slick.find('.surrounding-image img').bind('load', function () {
                if (count == check++) {
                    _slick.slick(slickOption).find('.slick-slide').each(function (index) {
                        var _that = $(this);
                        var _thatImageHeight = _that.find('.surrounding-image').outerHeight(true);
                        var _thatMessageHeight = _that.find('.surrounding-message').outerHeight(true);
                        maxImageHeight = (maxImageHeight < _thatImageHeight) ? _thatImageHeight : maxImageHeight;
                        maxMessageHeight = (maxMessageHeight < _thatMessageHeight) ? _thatMessageHeight : maxMessageHeight;
                        if (index == count) {
                            _that.closest('.surroundings-list').find('.surrounding-image').css({ height: maxImageHeight });
                            _that.closest('.surroundings-list').find('.surrounding-message').css({ height: maxMessageHeight });
                            _that.closest('.surroundings-list-wrap').removeClass('loading');
                            _that.closest('.surroundings-list').find('.slick-arrow').css({ height: _that.closest('.surroundings-list-wrap').outerHeight(true) });
                        }
                    });
                }
            });
            _slick.find('.surrounding-image img').each(function () {
                $(this).attr('src', $(this).attr('src'));
            });
        }
    };
}
