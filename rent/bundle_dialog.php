<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
include("../config.php");
include("../include/define.php");
include("../classes/SearchItemHelper.php");
$searchManager = new SearchItemHelper();
$postData = array_merge($_GET, $_POST);
$resultData = $postData['resultData'];
$rentSaleStr = RS_STR_RENT;
$link = "/{$rentSaleStr}/detail.php?id={$resultData[$searchManager::BK_DATA_ID]}";
$title = $searchManager->createLinkTitle($rentSaleStr, $resultData);
?>
<div>
    <div class="row">
        <div class="bundle-parent col-md-3 mb-sm-3"><img src="<?= $postData['img']; ?>" class="img"/></div>
        <div class="disp-contents col-md-9">
            <div class="crui_name badge badge-dark mb-1"><?= (empty($resultData[$searchManager::BK_DATA_BILDTYPE]['value']) ? '-' : $resultData[$searchManager::BK_DATA_BILDTYPE]['value']); ?></div>
            <div class="bk-title"><a href="<?= $link; ?>" title="<?= $title; ?>" target="_blank"><?= empty($resultData['name']) ? $title : $resultData['name']; ?></a></div>
            <div class="disp-main-item">
                <?php
                    $buildType = $resultData[$searchManager::BK_DATA_BILDTYPE]['key'];
                    $dispItem = [
                        $searchManager::BK_DATA_BILDFLOOR,
                        $searchManager::BK_DATA_BILDDATE,
                    ];
                ?>
                <?php foreach($dispItem as $key) { ?>
                <?php if(empty($resultData[$key])) { continue; } ?>
                <dl class="<?= $key; ?>">
                    <dt class="title list-inline-item">
                        <?= $searchManager->getBkItemName($rentSaleStr, $key) ?>
                    </dt>
                    <?php if($searchManager::BK_DATA_MONEY === $key) { ?>
                    <?php $money = $resultData[$key]; ?>
                    <dd class="value list-inline-item">
                        <?php $money = intval($money); ?>
                        <?php if(!empty($money)) { ?>
                        <?php foreach($searchManager->getMoneyConvert($money) as $moneyData) { ?>
                        <span class="<?= $moneyData['class']; ?>"><?= $moneyData['value']; ?></span>
                        <?php } ?>
                        <?php } else { ?>
                        <span class="empty">-</span>
                        <?php } ?>
                    </dd>
                    <?php } else { ?>
                    <dd class="value list-inline-item">
                        <?php
                            $text = $searchManager->getAndCheckBkData($resultData, $key, null);
                            if($searchManager::BK_DATA_AREASIZE === $key) {
                                $area_keisoku = "";
                                if(!empty($resultData[$searchManager::BK_DATA_AREASIZE_KEI]['value'])) {
                                        $area_keisoku = "（{$resultData[$searchManager::BK_DATA_AREASIZE_KEI]['value']}）";
                                }
                                $text = number_format($text, 2) . "㎡{$area_keisoku}(" . (floor($text * 0.3025 * 100) / 100) . "坪)";
                            } else {
                                $text = $searchManager->setConvertText($rentSaleStr, $key, $text);
                            }
                        ?>
                        <?= $text ?>
                    </dd>
                    <?php } ?>
                </dl>
                <?php } ?>
            </div>
            <div class="ad-kotu list-inline-item">
                <?php if(!empty($resultData[$searchManager::BK_DATA_ADDRESS])) { ?>
                <span class="<?= $searchManager::BK_DATA_ADDRESS; ?>">
                    <a href="<?= $link; ?>" title="<?= $title; ?>" target="_blank">
                        <p class="ad_value"><?= $resultData[$searchManager::BK_DATA_ADDRESS]; ?></p>
                    </a>
                </span>
                <?php } ?>
                <?php
                    if (isset($resultData[$searchManager::BK_DATA_TRAFFIC])) {
                        $trafficData = $searchManager->getAndConvertTrafficData($resultData[$searchManager::BK_DATA_TRAFFIC]);
                    } else {
                        $trafficData = [];
                    }
                ?>
                <?php if(!empty($trafficData[0])) { ?>
                <span class="<?= $trafficData[0]['class']; ?>">
                    <a href="<?= $link; ?>" title="<?= $title; ?>" target="_blank">
                        <p class="kotu_value"><?= $trafficData[0]['text']; ?></p>
                    </a>
                </span>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="disp-sub-item mt-2">
        <table class="table mb-0">
            <tbody>
                <?php if(isset($resultData[$searchManager::BK_DATA_ROOMS])) { ?>
                <?php foreach($resultData[$searchManager::BK_DATA_ROOMS] as $data) { ?>
                <?php $link = "/{$rentSaleStr}/detail.php?id={$data[$searchManager::BK_DATA_ID]}"; ?>
                <tr>
                    <td class="sub_content">
                        <a href="<?= $link; ?>" title="<?= $title; ?>" target="_blank">
                            <div class="link_content">
                                <?php
                                    $dispItem = [
                                        $searchManager::BK_DATA_MONEY,
                                        $searchManager::BK_DATA_KYOEKI,
                                        $searchManager::BK_DATA_SIKIKIN,
                                        $searchManager::BK_DATA_REIKIN,
                                        $searchManager::BK_DATA_HOSYOKIN,
                                        $searchManager::BK_DATA_SIKIBIKI,
                                        $searchManager::BK_DATA_MADORI,
                                        $searchManager::BK_DATA_AREASIZE,
                                        $searchManager::BK_DATA_BILDFLOOR_NOW,
                                        $searchManager::BK_DATA_ROOMNO,
                                        $searchManager::BK_DATA_NYUKYO,
                                    ];
                                ?>
                                <?php foreach($dispItem as $key) { ?>
                                <?php if(empty($data[$key])) { continue; } ?>
                                <dl class="<?= $key; ?>">
                                    <dt class="title list-inline-item">
                                        <?= $searchManager->getBkItemName($rentSaleStr, $key) ?>
                                    </dt>
                                    <?php if($searchManager::BK_DATA_MONEY === $key) { ?>
                                    <?php $money = $data[$key]; ?>
                                    <dd class="value list-inline-item">
                                        <?php $money = intval($money); ?>
                                        <?php if(!empty($money)) { ?>
                                        <?php foreach($searchManager->getMoneyConvert($money) as $moneyData) { ?>
                                        <span class="<?= $moneyData['class']; ?>"><?= $moneyData['value']; ?></span>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <span class="empty">-</span>
                                        <?php } ?>
                                    </dd>
                                    <?php } else { ?>
                                    <dd class="value list-inline-item">
                                        <?php
                                            $text = $searchManager->getAndCheckBkData($data, $key, null);
                                            if($searchManager::BK_DATA_AREASIZE === $key) {
                                                $area_keisoku = "";
                                                if(!empty($data[$searchManager::BK_DATA_AREASIZE_KEI]['value'])) {
                                                        $area_keisoku = "（{$data[$searchManager::BK_DATA_AREASIZE_KEI]['value']}）";
                                                }
                                                $text = number_format($text, 2) . "㎡{$area_keisoku}(" . (floor($text * 0.3025 * 100) / 100) . "坪)";
                                            } else {
                                                $text = $searchManager->setConvertText($rentSaleStr, $key, $text);
                                            }
                                        ?>
                                        <?= $text ?>
                                    </dd>
                                    <?php } ?>
                                </dl>
                                <?php } ?>
                            </div>
                        </a>
                    </td>
                    <td class="sub_link">
                        <div class="link"><a href="<?= $link; ?>" title="<?= $title; ?>" target="_blank" class="btn btn-sm">詳細</a></div>
                    </td>
                </tr><?php $comment = $searchManager->getPrComment($data, false); ?>
                <?php if(!empty($comment)) { ?>
                <tr>
                    <td colspan="2" class="sub_comment">
                        <div class="pr_comment"><?= implode("<br>", $comment); ?></div>
                    </td>
                </tr><?php } ?>
                <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
