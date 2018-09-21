/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/globals/jquery/index.d.ts" />
$(function () {
    $('.movie-disp-wrap').click(function () {
        if (window.matchMedia('(max-width:767px)').matches) {
            var $this = $(this);
            var $movieBtn = $this.find('.control-btn');
            var $target = $('#' + $this.attr('data-ng-target-id'));
            if ($movieBtn.hasClass('tmOpenIcon')) {
                $movieBtn.text('閉じる').addClass('tmCloseIcon').removeClass('tmOpenIcon');
                $target.fadeIn(200);
            }
            else {
                $movieBtn.text('開く').addClass('tmOpenIcon').removeClass('tmCloseIcon');
                $target.fadeOut(200);
            }
        }
    });
});
