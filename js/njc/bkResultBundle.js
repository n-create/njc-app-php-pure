/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/globals/jquery/index.d.ts" />
$(function () {
    $('.bundle-child-dialog').dialog({
        resizable: false,
        modal: true,
        autoOpen: false,
        title: '同一建物内物件情報',
        draggable: true,
        buttons: {
            '閉じる': function () {
                $(this).dialog('close');
            }
        }
    });
    $('.bundle-display-btn').click(function () {
        var winW = $(window).width();
        var winH = $(window).height();
        var dlgW = 1000;
        var btn = $(this);
        if (winW < 1000) {
            dlgW = '90%';
        }
        var dataString = btn.attr('data-bundle-childen');
        var resultData = $.parseJSON(dataString);
        $.ajax({
            type: "POST",
            url: '/rent/bundle_dialog',
            data: resultData,
            success: function (htmlDat) {
                $('.bundle-child-dialog').dialog({
                    width: dlgW,
                    draggable: false,
                    open: function () {
                        $(this).html(htmlDat);
                        var target = $(this).parent('.ui-dialog');
                        var sclTop = document.body.scrollTop || document.documentElement.scrollTop;
                        $(target).css({
                            'position': 'fixed',
                            'top': "50%",
                            'left': '50%',
                            'max-width': '90%',
                            'max-height': '90%',
                            'overflow-y': 'auto',
                            'transform': 'translate(-50%, -50%)'
                        });
                    }
                }).dialog('open');
            }
        });
    });
    // 物件詳細ボタンを作る
    function getLinkDetail(dv) {
        var link = "";
        var find = "href=";
        var quote = "";
        $.each(dv, function (dmk, dmv) {
            if (dmv['key'] === 'link') {
                var pos = dmv['value'].indexOf(find) + find.length;
                quote = dmv['value'].substring(pos, pos + 1);
                link = dmv['value'].substring(pos + 1, dmv['value'].indexOf(quote, pos + 2));
            }
        });
        return link;
    }
});
//物件詳細に飛ぶ、行全体に物件詳細のリンクを付ける時使用
function goDetail(link) {
    var e = (window.event) ? window.event : arguments.callee.caller.arguments[0];
    var self = e.target || e.srcElement;
    if (-1 < self.outerHTML.indexOf("</div>") || -1 < self.outerHTML.indexOf("</td>")) {
        window.open(link);
    }
}
