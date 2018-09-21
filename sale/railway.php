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
    <form id="bkSearch" method="get" action="/sale/station.php" class="saleSearch railway">
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
                <div class="searchBoxInner railway">
                    <div class="h3 head_bar"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_RAILWAY); ?>を選択してください</div>
                    <div class="inner">
                        <ul class="main_line_numbers">
                            <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_RAILWAY); ?>
                            <?php foreach($master['search'] as $dataKey => $data) { ?>
                            <?php
                                $text = $data['name'];
                                $value = $data['line_number'];
                                $count = $data['count'];
                            ?>
                            <li class="sub_line_numbers">
                                <label class="form-control">
                                    <input type="checkbox" name="line_numbers[]" value="<?= $value; ?>" class="checksubmit child_line_numbers">
                                    <span><?= $text; ?>(<?= $count; ?>件)</span>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchbtnbox">
            <div class="inner180">
                <div class="whole180">
                    <button type="submit", data-alert="沿線を選択してください" class="btn btn-default bksearch_submit">
                        駅を選択する
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include("../include/footerInc.php"); ?>
