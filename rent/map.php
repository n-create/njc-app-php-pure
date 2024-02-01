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
<?php
    $searchManager = new SearchItemHelper();
    $rentSaleStr = "rent";
    $mapSearchOption = [
        'searchObj'          => $searchManager::$searchObject,
        'icon'               => "/images/map/icon_bukken_map_mini.gif",
        'kaiinIcon'          => "/images/map/icon_kaiin.png",
        'kaiinLoginIcon'     => "/images/map/icon_kaiin2.png",
        'kaisyIcon'          => "/images/map/icon_kaisya_sdw.png",
        'iconSetting'        => "/images/map/icon_bukken_select_map.gif",
        'urlArea'            => "/{$rentSaleStr}/getMapArea.php",
        'urlCity'            => "/{$rentSaleStr}/getMapCity.php",
        'urlZahyou'          => "/{$rentSaleStr}/getMapZahyou.php",
        'urlZahyouBukken'    => "/{$rentSaleStr}/getMapZahyouBukken.php",
        'loadingImg'         => "/images/loading.gif",
        'openAreaFlg'        => true,
        'zoom'               => 10,
        'ido'                => 31.726937,
        'keido'              => 131.0658848,
        'isLogin'            => false,
        'maxZoomLevel'       => 19,
        'minZoomLevel'       => 10,
        'companyAddress'     => "宮崎県都城市中町",
        'companyIdo'         => 31.726937,
        'companyKeido'       => 131.0658848,
        'ctrl'               => "mapSearch",
        'chinOrBai'          => (RS_STR_RENT === $rentSaleStr) ? RS_CODE_RENT : RS_CODE_SALE,
        'siten'              => [],
    ];
?>
<div class="searchBox rent">
    <div class="searchIndex">
        <div class="searchBox">
            <div class="mapMainPanel row mx-0">
                <div class="mapSideSearch col-auto px-0">
                    <div class="mapAddSearch pt-2 bg-light text-center">
                        <input id="address" type="text" placeholder="住所・施設名を入力してください">
                        <input class="btn btn-sm" type="button" value="検索">
                    </div>
                    <div class="mapDiscription clearfix py-2 bg-light text-center">
                        <div class="btnArea">
                            <button class="btn btn-info btn-sm" id="njcCityButton">住所から検索</button>
                            <button class="btn btn-info btn-sm" id="njcSliderAllBukken">全物件を表示</button>
                            <button class="btn btn-info btn-sm sp-view" id="njcAddRefine">条件を追加</button>
                        </div>
                    </div>
                    <div class="content rent col-12">
                        <div class="searchBox">
                            <form id="bkSearchMapSetCondition" onsubmit="return false;" method="POST">
                                <div class="searchBoxInner building_type">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_BILDTYPE); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main building_types">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_BILDTYPE); ?>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <li class="sub building_types">
                                                        <label class="form-control">
                                                            <input type="checkbox" name="building_types[]" value="<?= $value ?>" class="child checksubmit building_types"/>
                                                            <span><?= $text; ?></span>
                                                        </label> 
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner money">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_MONEY); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_MONEY); ?>
                                                <select name="money_min" class="money_min form-control"> 
                                                    <option value="">下限なし</option>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <option value="<?= $value; ?>"><?= $text; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="afterSelectText money">〜</span>
                                                <select name="money_max" class="money_max form-control"> 
                                                    <option value="">上限なし</option>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <option value="<?= $value; ?>"><?= $text; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner money_etc">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_MONEY_ETC); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main money_etc">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_MONEY_ETC); ?>
                                                    <?php foreach($master['key'] as $name => $text) { ?>
                                                    <li class="sub money_etc">
                                                        <label class="form-control">
                                                            <input type="checkbox" name="<?= $name; ?>" value="1" class="child checksubmit money_etc <?= $name; ?>"/>
                                                            <span><?= $text; ?></span>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner room_type">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_MADORI); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main room_types">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_MADORI); ?>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <li class="sub room_types">
                                                        <label class="form-control">
                                                            <input type="checkbox" name="room_types[]" value="<?= $value; ?>" class="child checksubmit room_types"/>
                                                            <span><?= $text; ?></span>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner area_size">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_AREASIZE); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner"> 
                                                <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_AREASIZE); ?>
                                                <select name="area_size_min" class="area_size_min form-control">
                                                    <option value="">下限なし</option>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <option value="<?= $value; ?>"><?= $text; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="afterSelectText money">〜</span>
                                                <select name="area_size_max" class="area_size_max form-control">
                                                    <option value="">上限なし</option>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <option value="<?= $value; ?>"><?= $text; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner position">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_POSITION); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main position">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_POSITION); ?>
                                                    <?php foreach($master['key'] as $name => $text) { ?>
                                                    <li class="sub position">
                                                        <label class="form-control">
                                                            <input type="checkbox" name="<?= $name; ?>" value="1" class="child checksubmit money_etc <?= $name; ?>"/>
                                                            <span><?= $text; ?></span>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner new_bilding">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_NEWBILD); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main_new_building">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_NEWBILD); ?>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <li class="sub_new_building">
                                                        <label class="form-control">
                                                            <input type="radio" name="new_building" value="<?= $value; ?>" <?= ("" === $value) ? 'checked="checked"' : ''; ?> class="checksubmit child_new_building"/>
                                                            <span><?= $text; ?></span>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner building_year">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_BILDDATE); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main_building_year">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_BILDDATE); ?>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <li class="sub_building_year">
                                                        <label class="form-control">
                                                            <input type="radio" name="building_year" value="<?= $value; ?>" <?= ("" === $value) ? 'checked="checked"' : ''; ?> class="checksubmit child_building_year"/>
                                                            <span><?= $text; ?></span>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript" src="/js/njc/connectNewBildAndDate.js?_=20180827042722"></script>
                                <div class="searchBoxInner created_within">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_NEWCOME); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main_created_within">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_NEWBILD); ?>
                                                    <?php foreach($master['search'] as $value => $text) { ?>
                                                    <li class="sub_created_within">
                                                        <label class="form-control">
                                                            <input type="radio" name="created_within" value="<?= $value; ?>" <?= ("" === $value) ? 'checked="checked"' : ''; ?> class="checksubmit child_created_within"/>
                                                            <span><?= $text; ?></span>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner station_toho">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_EKITOHO); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
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
                                <div class="searchBoxInner images">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_IMAGES); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <ul class="main images">
                                                    <?php $master = $searchManager->getBkSearchMaster($rentSaleStr, $searchManager::BK_DATA_IMAGES); ?>
                                                    <?php foreach($master['key'] as $name => $text) { ?>
                                                    <li class="sub images">
                                                        <label class="form-control">
                                                            <input type="checkbox" name="<?= $name; ?>" value="1" class="child checksubmit images <?= $name; ?>"/>
                                                            <span><?= $text; ?></span>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner kodawari">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_KODAWARI); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <dl class="parent clearfix kodawari">
                                                    <dt>キッチン</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[10][]" value="10_01" class="child kodawari"/>
                                                                    <span>システムキッチン</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[8][]" value="8_01" class="child kodawari"/>
                                                                    <span>ガスコンロ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[8][]" value="8_02" class="child kodawari"/>
                                                                    <span>電気コンロ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[8][]" value="8_03" class="child kodawari"/>
                                                                    <span>IHコンロ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[9][]" value="9_05" class="child kodawari"/>
                                                                    <span>2口以上</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[48][]" value="48_01" class="child kodawari"/>
                                                                    <span>食器洗浄乾燥機</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[30][]" value="30_01" class="child kodawari"/>
                                                                    <span>冷蔵庫あり</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[78][]" value="78_01" class="child kodawari"/>
                                                                    <span>カウンターキッチン</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>バス・トイレ</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[7][]" value="7_01" class="child kodawari"/>
                                                                    <span>シャワー</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[12][]" value="12_01" class="child kodawari"/>
                                                                    <span>追い焚き</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[60][]" value="60_01" class="child kodawari"/>
                                                                    <span>浴室乾燥機</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[6][]" value="6_01" class="child kodawari"/>
                                                                    <span>バス・トイレ別</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[43][]" value="43_01" class="child kodawari"/>
                                                                    <span>温水洗浄便座</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[13][]" value="13_01" class="child kodawari"/>
                                                                    <span>洗髪洗面化粧台</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[61][]" value="61_01" class="child kodawari"/>
                                                                    <span>独立洗面</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>テレビ・通信</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[20][]" value="20_01" class="child kodawari"/>
                                                                    <span>CATV</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[22][]" value="22_01" class="child kodawari"/>
                                                                    <span>BSアンテナ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[21][]" value="21_01" class="child kodawari"/>
                                                                    <span>CSアンテナ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[23][]" value="23_01" class="child kodawari"/>
                                                                    <span>有線放送</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[35][]" value="35_01" class="child kodawari"/>
                                                                    <span>インターネット対応</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>室内設備</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[29][]" value="29_01" class="child kodawari"/>
                                                                    <span>フローリング</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[18][]" value="18_01" class="child kodawari"/>
                                                                    <span>ロフト付き</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[42][]" value="42_01" class="child kodawari"/>
                                                                    <span>バリアフリー</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[62][]" value="62_01" class="child kodawari"/>
                                                                    <span>照明器具</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[15][]" value="15_01" class="child kodawari"/>
                                                                    <span>トランクルーム</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[16][]" value="16_01" class="child kodawari"/>
                                                                    <span>床下収納</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[17][]" value="17_01" class="child kodawari"/>
                                                                    <span>ウォークインクローゼット</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[27][]" value="27_01" class="child kodawari"/>
                                                                    <span>出窓</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[19][]" value="19_01" class="child kodawari"/>
                                                                    <span>室内洗濯機置場</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[72][]" value="72_01" class="child kodawari"/>
                                                                    <span>家具・家電付</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[80][]" value="80_01" class="child kodawari"/>
                                                                    <span>家具付</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[81][]" value="81_01" class="child kodawari"/>
                                                                    <span>家電付</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[77][]" value="77_01" class="child kodawari"/>
                                                                    <span>シューズボックス</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>冷暖房</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[38][]" value="38_01" class="child kodawari"/>
                                                                    <span>床暖房</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[14][]" value="14_04" class="child kodawari"/>
                                                                    <span>エアコン付き</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[14][]" value="14_03" class="child kodawari"/>
                                                                    <span>石油暖房</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[14][]" value="14_02" class="child kodawari"/>
                                                                    <span>ガス暖房</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[53][]" value="53_01" class="child kodawari"/>
                                                                    <span>灯油FF暖房</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[54][]" value="54_01" class="child kodawari"/>
                                                                    <span>灯油ボイラー</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[55][]" value="55_01" class="child kodawari"/>
                                                                    <span>灯油配管</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[56][]" value="56_01" class="child kodawari"/>
                                                                    <span>ガスFF暖房</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[57][]" value="57_01" class="child kodawari"/>
                                                                    <span>集中暖房</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>入居条件</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[1][]" value="1_01" class="child kodawari"/>
                                                                    <span>楽器相談可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[2][]" value="2_01" class="child kodawari"/>
                                                                    <span>事務所可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[4][]" value="4_01" class="child kodawari"/>
                                                                    <span>２人入居可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[5][]" value="5_02" class="child kodawari"/>
                                                                    <span>女性限定</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[10][]" value="10_02" class="child kodawari"/>
                                                                    <span>ペット可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[16][]" value="16_02" class="child kodawari"/>
                                                                    <span>保証人不要</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[17][]" value="17_01" class="child kodawari"/>
                                                                    <span>ルームシェア可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[18][]" value="18_01" class="child kodawari"/>
                                                                    <span>分譲賃貸</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[31][]" value="31_01" class="child kodawari"/>
                                                                    <span>LGBTフレンドリー</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[34][]" value="34_01" class="child kodawari"/>
                                                                    <span>猫可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[34][]" value="34_02" class="child kodawari"/>
                                                                    <span>猫相談可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[36][]" value="36_01" class="child kodawari"/>
                                                                    <span>小型犬可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[36][]" value="36_02" class="child kodawari"/>
                                                                    <span>小型犬相談可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[35][]" value="35_01" class="child kodawari"/>
                                                                    <span>大型犬可</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>セキュリティ</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[24][]" value="24_01" class="child kodawari"/>
                                                                    <span>オートロック</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[39][]" value="39_01" class="child kodawari"/>
                                                                    <span>TVドアホン</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[75][]" value="75_01" class="child kodawari"/>
                                                                    <span>防犯カメラ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[76][]" value="76_01" class="child kodawari"/>
                                                                    <span>セキュリティ会社加入済</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>建物設備</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[26][]" value="26_01" class="child kodawari"/>
                                                                    <span>専用庭</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[25][]" value="25_01" class="child kodawari"/>
                                                                    <span>エレベータ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[28][]" value="28_01" class="child kodawari"/>
                                                                    <span>バルコニー</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[31][]" value="31_01" class="child kodawari"/>
                                                                    <span>宅配ボックス</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[2][]" value="2_01" class="child kodawari"/>
                                                                    <span>都市ガス</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[2][]" value="2_02" class="child kodawari"/>
                                                                    <span>プロパンガス</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[45][]" value="45_01" class="child kodawari"/>
                                                                    <span>耐震構造</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[51][]" value="51_01" class="child kodawari"/>
                                                                    <span>融雪槽</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[59][]" value="59_01" class="child kodawari"/>
                                                                    <span>ロードヒーティング</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[46][]" value="46_01" class="child kodawari"/>
                                                                    <span>オール電化</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[11][]" value="11_01" class="child kodawari"/>
                                                                    <span>給湯</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[73][]" value="73_01" class="child kodawari"/>
                                                                    <span>防音設備</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[74][]" value="74_01" class="child kodawari"/>
                                                                    <span>敷地内ゴミ置き場有り</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>駐車場</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="parking" value="2" class="child kodawari"/>
                                                                    <span>駐車場有り</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[32][]" value="32_01" class="child kodawari"/>
                                                                    <span>駐輪場あり</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[33][]" value="33_01" class="child kodawari"/>
                                                                    <span>バイク置き場あり</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                                <dl class="parent clearfix kodawari">
                                                    <dt>その他</dt>
                                                    <dd>
                                                        <ul class="main kodawari">
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[44][]" value="44_01" class="child kodawari"/>
                                                                    <span>デザイナーズ</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[34][]" value="34_01" class="child kodawari"/>
                                                                    <span>タイル貼り</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[36][]" value="36_01" class="child kodawari"/>
                                                                    <span>フリーアクセス</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[50][]" value="50_01" class="child kodawari"/>
                                                                    <span>複層ガラス</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[52][]" value="52_01" class="child kodawari"/>
                                                                    <span>24H管理</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[40][]" value="40_01" class="child kodawari"/>
                                                                    <span>二世帯住宅</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[41][]" value="41_01" class="child kodawari"/>
                                                                    <span>住宅性能保証付</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[69][]" value="69_01" class="child kodawari"/>
                                                                    <span>インターネット使用料不要</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[70][]" value="70_01" class="child kodawari"/>
                                                                    <span>初期費用クレジット決済可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[71][]" value="71_01" class="child kodawari"/>
                                                                    <span>賃料クレジット決済可</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[79][]" value="79_01" class="child kodawari"/>
                                                                    <span>メゾネット</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[82][]" value="82_01" class="child kodawari"/>
                                                                    <span>オンライン内見</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[83][]" value="83_01" class="child kodawari"/>
                                                                    <span>オンライン相談</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="setubi_options[84][]" value="84_01" class="child kodawari"/>
                                                                    <span>IT重説対応物件</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[32][]" value="32_01" class="child kodawari"/>
                                                                    <span>24時間ゴミ出し</span>
                                                                </label>
                                                            </li>
                                                            <li class="sub kodawari">
                                                                <label class="form-control">
                                                                    <input type="checkbox" name="jyoken_options[33][]" value="33_01" class="child kodawari"/>
                                                                    <span>DIY可</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchBoxInner freeword">
                                    <div class="row">
                                        <div class="h5 col-lg-2 col-md-3 col-12"><?= $searchManager->getBkItemName($rentSaleStr, $searchManager::BK_DATA_FREEWORD); ?></div>
                                        <div class="col-lg-10 col-md-9 col-12">
                                            <div class="inner">
                                                <input type="text" name="freeword" placeholder="地名、交通、条件で検索" maxlength="150" class="text_freeword form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="func bkSearchMap col-auto px-0">
                    <div id="aspectwrapper">
                        <div id="map_canvas" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
   $script_files = [
       "/js/components/jquery/jquery-ui/jquery-ui.custom.js",
       "/js/components/jquery/jquery-ui/jquery.ajaxDialog.js",
       GOOGLE_MAPS_API."?key=".GOOGLE_MAPS_KEY."&libraries=places&language=ja",
       "/js/njc/map/mapSearch.js",
       "/js/njc/map/mapGeocode.js",
       "/js/njc/map/markerClusterer.js",
   ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="<?= $filePath; ?>?_=<?= date('Ymdhis'); ?>"></script>
<?php } ?>
<script>
    $(function() { 
       var mapDat = new jQuery.mapSearch(<?= json_encode($mapSearchOption); ?>);
    });
</script>
<?php include("../include/footerInc.php"); ?>
