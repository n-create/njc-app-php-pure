/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/index.d.ts" />
$(function () {
    $("input[type='checkbox']:checked").parent().addClass('checked');
    $("input[type='radio']:checked").parent().addClass('checked');
    /**
     *  チェック時クラス付加
     */
    $('input:checkbox').not('.checkall').change(function () {
        $(this).parent().toggleClass('checked');
    });
    /**
     *  ラジオボタンチェック時にクラス付加
     */
    $('input:radio').change(function () {
        $("input[type='radio']").parent().removeClass('checked');
        $("input[type='radio']:checked").parent().addClass('checked');
    });
});
