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
    <form id="bkSearch" method="get" action="/sale/result.php" class="saleSearch station">
        <div class="searchIndex">
            <div class="headTitle">
                <div data-subtitle="SEARCH" class="h2">沿線・駅から検索</div>
            </div>
            <div class="headBox">
                <div class="search-decription"></div>
            </div>
            <div class="searchBox">
                <?php
                   $searchManager = new SearchItemHelper();
                   $rentSaleStr = "sale";
                ?>
                <div class="searchBoxInner station">
                    <div class="h3 head_bar"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_STATION); ?>を選択してください</div>
                    <div class="inner">
                        <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_STATION); ?>
                        <?php foreach($master['search'] as $dataKey => $data) { ?>
                        <?php
                           $parentText = $data['name'];
                           $group = $data['stations'];
                        ?>
                        <div class="head">
                            <h4>
                                <label>
                                    <span><?= $parentText; ?></span>
                                </label>
                            </h4>
                        </div>
                        <ul class="main_station_numbers">
                            <?php foreach($group as $groupData) { ?>
                            <?php
                               $text = $groupData['name'];
                               $value = $groupData['station_number'];
                               $count = $groupData['count'];
                            ?>
                            <li class="sub_station_numbers">
                                <label class="form-control">
                                    <input class="checksubmit" type='checkbox' name='station_numbers[]' class="child_station_numbers" value="<?= $value; ?>">
                                    <span><?= $text; ?>(<?= $count; ?>件)</span>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="searchBoxInner station_toho">
                    <div class="h3 head_bar"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_EKITOHO); ?>を選択してください</div>
                    <div class="inner">
                        <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_EKITOHO); ?>
                        <select name="station_toho" class="station_toho form-control"> 
                            <?php foreach($master['search'] as $value => $text) { ?>
                            <option value="<?= $value; ?>"><?= $text; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchbtnbox">
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
