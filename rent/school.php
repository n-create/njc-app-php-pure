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
<div class="container searchBox rent">
    <form id="bkSearch" method="get" action="/rent/result.php" class="rentSearch school">
        <div class="searchIndex">
            <div class="headTitle">
                <div data-subtitle="SEARCH" class="h2">学校区から検索</div>
            </div>
            <div class="headBox">
                <div class="search-decription"></div>
            </div>
            <div class="searchBox">
                <?php
                   $searchManager = new SearchItemHelper();
                   $rentSaleStr = "rent";
                ?>
                <div class="searchBoxInner city_and_syogaku_names">
                    <div class="h3 head_bar" id="head_city_and_syogaku_names">
                        <?= $searchManager->getBkItemName(RS_STR_RENT, $searchManager::BK_DATA_SI_SYOGAKU) ?>へ
                        <a class="manual-right" href="#head_city_and_cyugaku_names">
                            <?= $searchManager->getBkItemName(RS_STR_RENT, $searchManager::BK_DATA_SI_CYUGAKU) ?>へ
                        </a>
                    </div>
                    <div class="inner">
                        <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_SI_SYOGAKU); ?>
                        <?php foreach($master['search'] as $dataKey => $data) { ?>
                        <?php
                           $parentText = $data['city_name'];
                           $group = $data['schools'];
                        ?>
                        <div class="head">
                            <h4>
                                <label>
                                    <span><?= $parentText; ?></span>
                                </label>
                            </h4>
                        </div>
                        <ul class="main_city_and_syogaku_names">
                            <?php foreach($group as $groupData) { ?>
                            <?php
                               $text = $groupData['name'];
                               $value = $groupData['search_key'];
                               $count = $groupData['count'];
                            ?>
                            <li class="sub_city_and_syogaku_names">
                                <label class="form-control">
                                    <input class="checksubmit" type='checkbox' name='city_and_syogaku_names[]' class="child_city_and_syogaku_names" value="<?= $value; ?>">
                                    <span><?= $text; ?>(<?= $count; ?>件)</span>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="searchBoxInner syogaku_kyori">
                    <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_SYOGAKU_KYORI); ?></div>
                    <div class="inner">
                        <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_SYOGAKU_KYORI); ?>
                        <select name="syogaku_kyori" class="syogaku_kyori form-control">
                            <?php foreach($master['search'] as $value => $text) { ?>
                            <option value="<?= $value; ?>"><?= $text; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="searchBoxInner city_and_cyugaku_names">
                    <div class="h3 head_bar" id="head_city_and_cyugaku_names">
                        <?= $searchManager->getBkItemName(RS_STR_RENT, $searchManager::BK_DATA_SI_CYUGAKU) ?>
                        <a class="manual-right" href="#head_city_and_syogaku_names">
                            <?= $searchManager->getBkItemName(RS_STR_RENT, $searchManager::BK_DATA_SI_SYOGAKU) ?>へ
                        </a>
                    </div>
                    <div class="inner">
                        <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_SI_CYUGAKU); ?>
                        <?php foreach($master['search'] as $dataKey => $data) { ?>
                        <?php
                           $parentText = $data['city_name'];
                           $group = $data['schools'];
                        ?>
                        <div class="head">
                            <h4>
                                <label>
                                    <span><?= $parentText; ?></span>
                                </label>
                            </h4>
                        </div>
                        <ul class="main_city_and_cyugaku_names">
                            <?php foreach($group as $groupData) { ?>
                            <?php
                               $text = $groupData['name'];
                               $value = $groupData['search_key'];
                               $count = $groupData['count'];
                            ?>
                            <li class="sub_city_and_cyugaku_names">
                                <label class="form-control">
                                    <input class="checksubmit" type='checkbox' name='city_and_cyugaku_names[]' class="child_city_and_cyugaku_names" value="<?= $value; ?>">
                                    <span><?= $text; ?>(<?= $count; ?>件)</span>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="searchBoxInner cyugaku_kyori">
                    <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_CYUGAKU_KYORI); ?></div>
                    <div class="inner">
                        <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_CYUGAKU_KYORI); ?>
                        <select name="cyugaku_kyori" class="cyugaku_kyori form-control">
                            <?php foreach($master['search'] as $value => $text) { ?>
                            <option value="<?= $value; ?>"><?= $text; ?></option>
                            <?php } ?>
                        </select>
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
