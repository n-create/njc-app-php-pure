<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
include("../config.php");
include("../include/define.php");
include("../classes/SearchItemHelper.php");
?>
<div class="parts">
    <div class="h3 mb-3">市区町村を選択してください。</div>
    <div class="clearfix">
        <?php
           $searchManager = new SearchItemHelper();
           $cityData = $searchManager->getMapCityData(RS_STR_RENT);
        ?>
        <div id="mapListDialog">
            <?php if(is_array($cityData)) { ?>
            <?php foreach($cityData as $data) { ?>
            <div class="h5 mapDialogKen">
                <span class="clickable"><?= $data['prefecture_name']; ?></span>
            </div>
            <ul class="areaList">
                <?php foreach($data['cities'] as $areaData) { ?>
                <?php
                   $id = $data['prefecture_name'].$areaData['city_name'];
                   $value = $areaData['city_number'];
                   $text = $areaData['city_name'];
                   if(isset($areaData['count'])) {
                       $text .= "(" . $areaData['count'] . "件)";
                   }
                ?>
                <li class="njcCityListAjax" label="<?= $value; ?>" id="<?= $id; ?>">
                    <span class="clickable"><?= $text; ?></span>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
            <?php } else { ?>
            <div>登録された物件がありません。</div>
            <?php } ?>
        </div>
    </div>
</div>
