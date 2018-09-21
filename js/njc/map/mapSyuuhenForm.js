/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../../typings/index.d.ts" />
/// <reference path="./mapSearch.ts" />
$(function () {
    var stoCnt = 0;
    function initSyuuhenGoogleMap() {
        stoCnt++;
        if ('map' in window && map !== undefined) {
            if ($('div.map').length) {
                shuhenDisabled(parseInt(map.getZoom()));
                google.maps.event.addListener(map, 'zoom_changed', function () {
                    shuhenDisabled(parseInt(map.getZoom()));
                });
            }
        }
        else if (stoCnt < 10) {
            setTimeout(function () {
                initSyuuhenGoogleMap();
            }, 1000);
        }
    }
    initSyuuhenGoogleMap();
    $(window).on('load resize', function () {
        var con_div = $('.absolute').find('.divFacility');
        var tot_height = parseInt(con_div.css('height'));
        $('.absolute').css('margin-top', '-' + (tot_height + 16) + 'px');
        con_div.css('height', tot_height + 'px');
    });
    var mapOpen = false;
    var con_div = $('.absolute').find('.divFacility');
    $('.nrwMapBtn div').click(function () {
        $(this).toggleClass('on');
        if (false === mapOpen) {
            $('.absolute').css('margin-top', '-' + (350 + 16) + 'px');
            con_div.css('height', '350px');
            mapOpen = true;
        }
        else {
            mapOpen = false;
        }
        $('#shuhenForm').slideToggle(500);
        setTimeout(function () {
            con_div.css('height', 'auto');
            var tot_height = parseInt(con_div.css('height'));
            $('.absolute').css('margin-top', '-' + (tot_height + 16) + 'px');
            con_div.css('height', tot_height + 'px');
        }, 500);
    });
    function chgMapLiBg(_this) {
        btnClsOnOff($(_this).is(':checked'), $(_this).next('label'));
        btnClsOnOff($(_this).is(':checked'), $(_this).parents('ul'));
    }
    function btnClsOnOff(f, o) {
        if (f) {
            $(o).addClass('on');
        }
        else {
            $(o).removeClass('on');
        }
    }
    function shuhenDisabled(zoom) {
        $('.bkMapSyuuhenForm label').each(function () {
            if ($(this).hasClass('disabled'))
                $(this).removeClass('disabled');
            if (zoom <= dispSyuuhen) {
                $(this).addClass('disabled');
            }
        });
    }
    var preTarget = null;
    $('.bkMapSyuuhenForm input').each(function () {
        $(this).change(function () {
            if (preTarget === null) {
                preTarget = this;
            }
            else if ($(preTarget).prop('id') === $(this).prop('id')) {
                $(this).prop('checked', false);
                preTarget = null;
            }
            else {
                $(preTarget).prop('checked', false);
                chgMapLiBg(preTarget);
                preTarget = this;
            }
            chgMapLiBg(this);
        });
        chgMapLiBg(this);
    });
});
