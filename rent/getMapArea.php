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
    <div class="h3 mb-3">
        町域を選択してください。
    </div>
    <div class="clearfix">
        <?php
           $searchManager = new SearchItemHelper();
           $areaData = $searchManager->getMapAreaData(RS_STR_RENT);
           $areaData = $searchManager->checkAndSetBlankAreaName($areaData);
           $areaData = $searchManager->convertAreaData($areaData);
        ?>
        <div id="mapListDialog">
            <?php foreach($areaData as $data) { ?>
            <div class="h5">
                <span class="clickable mapDialogKenSi">
                    <?= $data['city_name']; ?>(<?= $searchManager->getTotalCountArea($data['towns']); ?>)
                </span>
            </div>
            <ul class="areaList">
                <?php foreach($data['towns'] as $choHead => $areaChild) { ?>
                <li class="mapChoHead mt-2"><?= $choHead.(1 === mb_strlen($choHead) ? '行' : ''); ?></li>
                <?php foreach($areaChild as $area) { ?>
                <?php
                   $id = $area['town_name'];
                   $text = $area['town_name'];
                   if (empty($text)) {
                       $id = $data['keyText'];
                       $text = '未分類';
                   }
                   $value = $area['post_code'];
                   if (8 < strlen($value)) {
                       $value = substr($value, 0, 8);
                   }
                   if(isset($area['count'])) {
                       $text .= "(" . $area['count'] . "件)";
                   }
                ?>
                <li class="njcAreaListAjax" id="<?= $id; ?>" data-postal-code="<?= $value; ?>">
                    <span class="clickable"><?= $text; ?></span>
                </li>
                <?php } ?>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
    </div>
</div>
