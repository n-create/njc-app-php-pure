/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../../typings/index.d.ts" />
/// <reference path="./mapSearch.ts" />
var markers = new Array();
var bkLatlng;
var destMarker;
var directionsService;
var directionsDisplay;
var travelMode;
var placeService;
var endloc;
var bukken;
var EventListener;
var mapSearchContents;
var homeControlDiv;
var nrwMapBtn;
var opts;
// 1度エラーダイアログを表示したら次成功するまで表示しない
var errorFlg = false;
function initBkDetailGoogleMap() {
    addDomListener();
    $('input[name=mapSearchContents]').click(function () {
        setMarker();
    });
    $('ul.routeSelect li.button').click(function () {
        $('ul.routeSelect li.button').removeClass('active');
        $(this).addClass('active');
        switch ($(this).attr("tmode")) {
            case 'DRIVING':
                travelMode = google.maps.DirectionsTravelMode.DRIVING;
                break;
            case 'WALKING':
            default:
                travelMode = google.maps.DirectionsTravelMode.WALKING;
                break;
        }
        if (destMarker) {
            routeDirectionsSim(destMarker.position);
        }
    });
    $("li.calcRoute").click(function () {
        var address = $(this).attr("data-ken") + ' ' + $(this).attr("data-eki") + '駅';
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK && results[0]) {
                endloc = results[0].geometry.location;
                setDestMarker(endloc);
                routeDirectionsSim(endloc);
            }
            else {
                alert('情報が取得できませんでした。');
            }
            ;
        });
    });
}
;
function addDomListener() {
    var ido = 'ido';
    var keido = 'keido';
    bkLatlng = new google.maps.LatLng(bukken[ido], bukken[keido]);
    travelMode = google.maps.DirectionsTravelMode.WALKING;
    var mapdiv = document.getElementById("map_canvas");
    var markerOpt = ({
        icon: mapDirectionGetBkIcon(bukken.chinOrBai, bukken.cruiNo, bukken.company),
        position: bkLatlng,
        map: map
    });
    directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true
    });
    // 周辺情報機能 注意書き。周辺情報機能が存在する場合のみ
    mapSearchContents = $("input[name='mapSearchContents']");
    if (mapSearchContents.size() > 0) {
        //新物件詳細か旧物件詳細か
        nrwMapBtn = $(".nrwMapBtn");
        var margin = nrwMapBtn.size() === 0 ? "margin:0;" : "margin:0 157px 0 0;";
        var displayFlg = parseInt(bukken.zoom) <= dispSyuuhen ? "display:block;" : "display:none;";
    }
    EventListener = google.maps.event.addListener(map, "dragend", function () {
        setMarker();
    });
    var singleClick = false;
    google.maps.event.addListener(map, 'click', function (event) {
        singleClick = true;
        setDestMarker(event.latLng);
        //マーカードラッグイベントの登録
        google.maps.event.addListener(destMarker, 'dragend', function (event) {
            routeDirectionsSim(event.latLng);
        });
        setTimeout(function (ee) {
            if (singleClick && destMarker) {
                routeDirectionsSim(destMarker.position);
            }
        }, 500);
    });
    google.maps.event.addListener(map, 'dblclick', function (event) {
        singleClick = false;
        if (destMarker) {
            destMarker.setMap(null);
        }
        ;
    });
    var draggableBtn = $('.draggable_button');
    if (0 < draggableBtn.length) {
        var func = function () {
            if (true === markerOpt.map.draggable) {
                $(this).html($(this).data('passiveText'));
                markerOpt.map.setOptions({ 'draggable': false });
            }
            else {
                $(this).html($(this).data('activeText'));
                markerOpt.map.setOptions({ 'draggable': true });
            }
        };
        var supportTouch = 'ontouchend' in document;
        var eventnameTouchstart = supportTouch ? 'touchstart' : 'mouseup';
        draggableBtn.on(eventnameTouchstart, func);
    }
}
function mapDirectionHomeControl(controlDiv, map) {
    controlDiv.style.padding = '1px';
    var controlUI = document.createElement('DIV');
    if (true !== bukken.company) {
        controlUI.innerHTML = '<input type="image" src="/images/map/btn_back_bukken.png" alt="物件に戻る" id="backButton">';
    }
    controlDiv.appendChild(controlUI);
    // Setup the click event listeners: simply set the map to Chicago
    google.maps.event.addDomListener(controlUI, 'click', function () {
        map.setCenter(bkLatlng);
    });
}
function setDestMarker(latLng) {
    if (destMarker) {
        destMarker.setMap(null);
    }
    ;
    destMarker = new google.maps.Marker({
        icon: '/images/map/icn_map_goal.png',
        position: latLng,
        draggable: true,
        map: map //マーカーを表示する地図
    });
}
function displaySyuuhenAttension(flg) {
    var display = flg ? "block" : "none";
    $(".syuuhen_attension").css("display", display);
}
function changeSyuuhen(zoom) {
    var disabled = (zoom <= dispSyuuhen) ? true : false;
    $(':checkbox[name="mapSearchContents"]').prop('disabled', disabled);
    displaySyuuhenAttension(disabled);
}
function setMarker() {
    placeService = new google.maps.places.PlacesService(map);
    closeMarker();
    $('input[name=mapSearchContents]:checked:enabled').each(function () {
        var targetContents = bukken.searchObj[this.value];
        $.each(targetContents.keyWord, function (key, keyWord) {
            getMarker(targetContents, keyWord);
        });
    });
}
function closeMarker() {
    jQuery.each(markers, function () {
        this.setVisible(false);
    });
    markers.length = 0;
}
function getMarker(targetContents, keyWord) {
    var request = {
        location: new google.maps.LatLng((map.getCenter()).lat(), (map.getCenter()).lng()),
        rankBy: google.maps.places.RankBy.DISTANCE,
        types: [keyWord]
    };
    loadingImg();
    placeService.search(request, function (results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK || status === google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
            $.each(results, function (i, val) {
                var markerOpt = ({
                    icon: targetContents.img,
                    position: val.geometry.location,
                    map: map
                });
                var marker = new google.maps.Marker(markerOpt);
                markers[markers.length] = marker;
                var infoWindow = new google.maps.InfoWindow({
                    content: val.name
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infoWindow.open(map, marker);
                });
                errorFlg = false;
            });
        }
        else if (errorFlg == false) {
            errorFlg = true;
            if (status != google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                alert('Googleから応答がありません、しばらくたってから再度お試しください。');
            }
        }
        loadingRemove();
    });
}
function loadingImg() {
    //内部完結のIDを付ける
    var divId = 'njcLoading';
    $('#map_canvas').append('<div id="' + divId + '"></div>');
    $('#' + divId)
        .css('position', 'absolute')
        .css('width', '65px')
        .css('height', '65px')
        .css('margin-top', ((parseInt($('#map_canvas').css("height")) - parseInt($('#' + divId).css("height"))) / 2) + 'px')
        .css('margin-left', ((parseInt($('#map_canvas').css("width")) - parseInt($('#' + divId).css("width"))) / 2) + 'px')
        .css('background-image', 'url(/images/map/back.png)')
        .css('padding', '5px')
        .css('opacity', '0.92')
        .html('<img src="/images/loading.gif">');
    $('#' + divId + ' img')
        .css('background-color', '#ffffff');
}
function loadingRemove() {
    var divId = 'njcLoading';
    $('#' + divId).remove();
}
function routeDirections(mode, avoidHighways, avoidTolls, startloc, endloc) {
    opts = {};
    opts.locale = "ja";
    directionsService.avoidHighways = avoidHighways; //高速
    directionsService.avoidTolls = avoidTolls; //有料道路
    var request = {
        origin: startloc,
        destination: endloc,
        travelMode: mode,
        unitSystem: google.maps.DirectionsUnitSystem.METRIC //単位km表示
    };
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            $(".mapDistance").html(response.routes[0].legs[0].distance.text);
            $(".mapDuration").html(response.routes[0].legs[0].duration.text);
        }
        else {
            alert('ルートを検索できませんでした。');
        }
    });
}
function routeDirectionsSim(endloc) {
    routeDirections(travelMode, false, false, bkLatlng, endloc);
}
function mapDirectionGetBkIcon(chinOrBai, cruiNo, company) {
    var $icon = '';
    if (true === company) {
        $icon = '/images/map/icon_kaisya_sdw.png';
    }
    else {
        $icon = '/images/map/icon_bukken_map_' + ((chinOrBai == 1) ? 'c' : 'b') + cruiNo + '.png';
    }
    return $icon;
}
