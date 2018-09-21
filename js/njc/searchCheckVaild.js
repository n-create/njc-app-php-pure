/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/index.d.ts" />
$(function () {
    $('.bkSearch_submit').on('click', function () {
        var checkedFlg = true;
        if (undefined !== $("form#bkSearchCheck").attr("id")) {
            var target = $(this).closest('form').find('.checksubmit');
            if (0 < target.length) {
                checkedFlg = (0 < target.filter(':checked').length);
                if (false === checkedFlg) {
                    alert($(this).data('alert'));
                }
            }
        }
        return checkedFlg;
    });
});
