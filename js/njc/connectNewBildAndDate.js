/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/// <reference path="../../../../typings/globals/jquery/index.d.ts" />
$(function () {
    var strNameNewBild = 'new_building';
    var strNameBildDate = 'building_year';
    var $radioNewBild = $("input[name='" + strNameNewBild + "']:radio");
    var $radioBildDate = $("input[name='" + strNameBildDate + "']:radio");
    if (0 < $radioNewBild.length && 0 < $radioBildDate.length) {
        $radioNewBild.on('change', function () {
            var radioval = $(this).val();
            var check = "";
            if ("1" == radioval) {
                check = radioval;
            }
            if (0 < $("label.btn-disabled").length || (0 == $("label.btn-disabled").length && "1" == radioval)) {
                $.each($radioBildDate, function () {
                    var bCheck = (check === $(this).val());
                    $(this).prop("checked", bCheck);
                    if (!bCheck && "1" == check) {
                        $(this).prop("disabled", true);
                        $(this).parent().addClass("btn-disabled");
                    }
                    else {
                        $(this).prop("disabled", false);
                        $(this).parent().removeClass("btn-disabled");
                    }
                });
                $("input[name='" + strNameBildDate + "']").parent().removeClass('checked');
                $("input[name='" + strNameBildDate + "']:checked").parent().addClass('checked');
            }
        });
    }
});
