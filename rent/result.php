<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
include("../config.php");
include("../include/define.php");
include("../include/headerInc.php");
include("../classes/SearchItemHelper.php");
$searchManager = new SearchItemHelper();
$result = $searchManager->getBkResultData(RS_STR_RENT);
$rentSaleStr = RS_STR_RENT;
?>
<div class="container resultBox <?= $rentSaleStr; ?>">
    <div class="headTitle">
        <div class="h2" data-subtitle="LIST">賃貸物件一覧</div>
    </div>
    <div class="bk-result-header mb-3">
        <div class="header-title">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="title navbar-brand">別の検索方法で再検索</div>
                <button type="button" data-toggle="collapse" data-target="#othersearch" aria-controls="othersearch" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                    <span class="navbar-toggler-icon othersearch-toggler-icon"></span>
                </button>
                <div id="othersearch" class="collapse navbar-collapse">
                    <ul class="value nav navbar-nav">
                        <li class="nav-item"><a href="/<?= $rentSaleStr; ?>/search.php" class="index nav-link">条件から検索</a></li>
                        <li class="nav-item"><a href="/<?= $rentSaleStr; ?>/railway.php" class="railway nav-link">沿線・駅から検索</a></li>
                        <li class="nav-item"><a href="/<?= $rentSaleStr; ?>/city.php" class="city nav-link">地域から検索</a></li>
                        <li class="nav-item"><a href="/<?= $rentSaleStr; ?>/school.php" class="school nav-link">学校区から検索</a></li>
                        <li class="nav-item"><a href="/<?= $rentSaleStr; ?>/map.php" class="map nav-link">地図から検索</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="bk-result-page-wrapper">
        <div class="bk-list-header mb-3">
            <div class="list-header-child bg-light">
                <?php
                    $query = $_GET;
                    $nowSort = (!isset($query['sorts'])) ? 'money_at' : $query['sorts'];
                    $nowLimit = (!isset($query['limit'])) ? 30 : $query['limit'];
                ?>
                <div class="row">
                    <div class="bk-count col-md-4">
                        <p class="count-text m-0">
                            <?php $meta = $searchManager->getResultMetaData($rentSaleStr); ?>
                            該当物件数<span class="count"><?= (empty($meta['total']) ? 0 : $meta['total']) ?></span>件
                        </p>
                    </div>
                    <div class="bk-list-sort col-md-8 text-md-right text-center">
                        <select name="sorts" onchange="location.href='<?= $searchManager->getAndUnsetUrl("sorts") ?>&sorts='+this.options[this.selectedIndex].value" class="sort-order form-control">
                            <?php foreach($searchManager->getSortOrderList($rentSaleStr) as $value => $text) { ?>
                            <option value="<?= $value ?>" <?= ($value == $nowSort) ? 'selected="selected"' : ''; ?>><?= $text ?></option>
                            <?php } ?>
                        </select>
                        <select name="limit" onchange="location.href='<?= $searchManager->getAndUnsetUrl("limit") ?>&limit='+this.options[this.selectedIndex].value" class="limit-select form-control">
                            <?php foreach([9, 15, 30, 60, 90] as $value) { ?>
                            <option value="<?= $value ?>" <?= ($value == $nowLimit) ? 'selected="selected"' : ''; ?>>表示件数 <?= $value ?>件</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="bk-list-body">
            <div class="list-item row">
                <?php foreach($result as $resultData) { ?>
                <?php
                    $link = "/{$rentSaleStr}/detail.php?id={$resultData[$searchManager::BK_DATA_ID]}";
                    $title = $searchManager->createLinkTitle($rentSaleStr, $resultData);
                    $isMatome = (RS_STR_RENT === $rentSaleStr) ? true : false;
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="list-item-inner card">
                        <a href="<?= $link; ?>" title="<?= $title; ?>" target="_blank" class="img card-img-top">
                            <div class="listGazo text-center">
                                <div class="GazoImg">
                                    <?php
                                        $imgPath = PATH_NOPHOTO_IMG;
                                        if(isset($resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'])) {
                                            $imgPath = $resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'];
                                        }
                                    ?>
                                    <img src="<?= $imgPath; ?>"/>
                                </div>
                            </div>
                        </a>
                        <div class="bk-body card-body">
                            <div class="disp-contents">
                                <?php
                                    $cnt = 0;
                                    $limit = 2;
                                    $imgPath = PATH_NOPHOTO_IMG;
                                    if(isset($resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'])) {
                                        $imgPath = $resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'];
                                    }
                                    $json = [
                                        'img'         => $imgPath,
                                        'resultData'  => $resultData,
                                    ];
                                ?>
                                <div class="crui_name badge badge-dark mb-1">
                                    <?= (empty($resultData[$searchManager::BK_DATA_BILDTYPE]['value']) ? '-' : $resultData[$searchManager::BK_DATA_BILDTYPE]['value']) ?>
                                </div>
                                <div class="bk-title card-title">
                                    <a href="<?= $link ?>" title="<?= $title ?>" target="_blank">
                                        <?= empty($resultData[$searchManager::BK_DATA_NAME]) ? $title : $resultData[$searchManager::BK_DATA_NAME] ?>
                                    </a>
                                </div>
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
                                    <span class="<?= $searchManager::BK_DATA_ADDRESS ?>">
                                        <a href="<?= $link ?>" title="<?= $title ?>" target="_blank">
                                            <p class="ad_value"><?= $resultData[$searchManager::BK_DATA_ADDRESS]; ?></p>
                                        </a>
                                    </span>
                                    <?php } ?>
                                    <?php $trafficData = $searchManager->getAndConvertTrafficData($resultData[$searchManager::BK_DATA_TRAFFIC]); ?>
                                    <?php if(!empty($trafficData[0])) { ?>
                                    <span class="<?= $trafficData[0]['class']; ?>">
                                        <a href="<?= $link; ?>" title="<?= $title; ?>" target="_blank">
                                            <p class="kotu_value"><?= $trafficData[0]['text']; ?></p>
                                        </a>
                                    </span>
                                    <?php } ?>
                                </div>
                                <div class="disp-sub-item mt-2">
                                    <table class="table">
                                        <tbody>
                                            <?php if(isset($resultData[$searchManager::BK_DATA_ROOMS])) { ?>
                                            <?php foreach($resultData[$searchManager::BK_DATA_ROOMS] as $data) { ?>
                                            <?php $cnt++; ?>
                                            <?php if($limit < $cnt) { ?>
                                            <tr>
                                                <td class="sub_allView text-center">
                                                    <button data-bundle-childen="<?= htmlentities(json_encode($json)) ?>" class="btn btn-dark bundle-display-btn">全て表示する</button>
                                                </td>
                                            </tr><?php break; ?>
                                            <?php } ?>
                                            <?php $link = "/{$rentSaleStr}/detail.php?id={$data[$searchManager::BK_DATA_ID]}"; ?>
                                            <tr>
                                                <td class="sub_content">
                                                    <a href="<?= $link ?>" title="<?= $title ?>" target="_blank">
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
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $comment = $searchManager->getPrComment($data, false); ?>
                                            <?php if(!empty($comment)) { ?>
                                            <tr>
                                                <td class="sub_comment">
                                                    <div class="pr_comment"><?= implode("<br>", $comment); ?></div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="bk-list-paging">
            <div class="list-page row nav-fill">
                <?php $metaData = $searchManager->getResultMetaData($rentSaleStr); ?>
                <?php
                    $page_first = 1;
                    $page_last = $metaData['last_page'];
                    $page_current = $metaData['current_page'];
                    $page_start = $page_current - 2;
                    $page_end = $page_current + 2;
                    if(1 > $page_start) {
                            $diff = (1 - $page_start);
                            $page_start = 1;
                            $page_end += $diff;
                    }
                    if($page_last < $page_end) {
                            $diff = ($page_last - $page_end);
                            $page_end = $page_last;
                            $page_start = (1 > $page_start + $diff) ? $page_start : $page_start + $diff;
                    }
                    $url = $searchManager->getAndUnsetUrl("page");
                ?>
                <?php if(1 < $page_last) { ?>
                <ul class="paging-list nav-item">
                    <li class="paging_back list-inline-item">
                        <?php if($page_current == $page_start) { ?>
                        <span class="btn btn-white no-link paging_back">前へ</span>
                        <?php } else { ?>
                        <a href="<?= $url; ?>&page=<?= $page_current - 1; ?>" class="btn btn-white paging_back">前へ</a>
                        <?php } ?>
                    </li>
                    <?php if($page_first < $page_start) { ?>
                    <li class="paging_first list-inline-item">
                        <a href="<?= $url ?>&page=1" class="paging_first btn btn-white"><?= $page_first ?></a>
                    </li>
                    <?php } ?>
                    <?php if($page_first + 1 < $page_start) { ?>
                    <li class="paging_dot list-inline-item">...</li>
                    <?php } ?>
                    <?php for($i = $page_start; $i <= $page_end; $i++) { ?>
                    <li class="paging_number list-inline-item">
                        <?php if($page_current == $i) { ?>
                        <span class="btn btn-white no-link paging_number"><?= $i; ?></span>
                        <?php } else { ?>
                        <a href="<?= $url; ?>&page=<?= $i; ?>" class="btn btn-white paging_number"><?= $i; ?></a>
                        <?php } ?>
                    </li><?php } ?>
                    <?php if($page_last - 1 > $page_end) { ?>
                    <li class="paging_dot list-inline-item">...</li><?php } ?>
                    <?php if($page_last > $page_end) { ?>
                    <li class="paging_last list-inline-item"><a href="<?= $url ?>&page=<?= $page_last ?>" class="paging_last btn btn-white"><?= $page_last ?></a></li><?php } ?>
                    <li class="paging_next list-inline-item">
                        <?php if($page_current == $page_end) { ?>
                        <span class="btn btn-white no-link paging_next">次へ</span>
                        <?php } else { ?>
                        <a href="<?= $url; ?>&page=<?= ($page_current + 1); ?>" class="btn btn-white paging_next">次へ</a>
                        <?php } ?>
                    </li>
                </ul><?php } ?>
            </div>
        </div>
    </div>
<script type="text/javascript"  src="/js/njc/bkResultBundle.js?_=<?= date('Ymdhis'); ?>"></script>
<div class="bundle-child-dialog"></div>
