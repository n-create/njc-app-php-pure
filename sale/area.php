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
?>
<div class="container searchBox sale">
    <form id="bkSearch" method="get" action="/sale/result.php" class="saleSearch area">
        <div class="searchIndex">
            <div class="headTitle">
                <div data-subtitle="SEARCH" class="h2">地域から検索</div>
            </div>
            <div class="headBox">
                <div class="search-decription"></div>
            </div>
            <div class="searchBox">
                <?php
                   $searchManager = new SearchItemHelper();
                   $rentSaleStr = "sale";
                ?>
                <div class="searchBoxInner area">
                    <div class="h3 head_bar"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_AREA); ?>を選択してください</div>
                    <div class="inner">
                        <?php
                            $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_AREA);
                            $master['search'] = $searchManager->checkAndSetBlankAreaName($master['search']);
                            $master['search'] = $searchManager->convertAreaData($master['search']);
                        ?>
                        <?php foreach($master['search'] as $dataKey => $data) { ?>
                        <?php
                           $parentText = $data['city_name'];
                           $group = $data['towns'];
                        ?>
                        <div class="head">
                            <h4>
                                <label>
                                    <span><?= $parentText; ?></span>
                                </label>
                            </h4>
                        </div>
                        <?php foreach($group as $choHead => $choData) { ?>
                        <div class="h5">
                            <?= ("その他" === $choHead) ? $choHead : $choHead . "行"; ?>
                        </div>
                        <ul class="main_post_codes clearfix">
                            <?php foreach($choData as $groupData) { ?>
                            <?php
                               $text = $groupData['town_name'];
                               $value = $groupData['post_code'];
                               $count = $groupData['count'];
                            ?>
                            <li class="sub_post_codes">
                                <label class="form-control">
                                    <input class="checksubmit" type='checkbox' name='post_codes[]' class="child_post_codes" value="<?= $value; ?>">
                                    <span><?= $text; ?>(<?= $count; ?>件)</span>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchBtnBox">
            <div class="inner180">
                <div class="whole180">
                    <button type="submit", data-alert="駅を選択してください" class="btn btn-default bksearch_submit">
                        この条件で検索
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include("../include/footerInc.php"); ?>
