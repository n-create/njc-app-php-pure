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
    <form id="bkSearch" method="get" action="/sale/area.php" class="saleSearch city">
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
                <div class="searchBoxInner city">
                    <div class="h3 head_bar"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_CITY); ?>を選択してください</div>
                    <div class="inner">
                        <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_CITY); ?>
                        <?php foreach($master['search'] as $dataKey => $data) { ?>
                        <?php
                           $parentText = $data['prefecture_name'];
                           $group = $data['cities'];
                        ?>
                        <div class="head">
                            <h4>
                                <label>
                                    <span><?= $parentText; ?></span>
                                </label>
                            </h4>
                        </div>
                        <ul class="main_city_numbers">
                            <?php foreach($group as $groupData) { ?>
                            <?php
                               $text = $groupData['city_name'];
                               $value = $groupData['city_number'];
                               $count = $groupData['count'];
                            ?>
                            <li class="sub_city_numbers">
                                <label class="form-control">
                                    <input class="checksubmit" type='checkbox' name='city_numbers[]' class="child_city_numbers" value="<?= $value; ?>">
                                    <span><?= $text; ?>(<?= $count; ?>件)</span>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
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
