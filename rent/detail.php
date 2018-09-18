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
$rentSaleStr = RS_STR_RENT;
$id = $_GET['id'];
$detailData = $searchManager->getBkDetailData($rentSaleStr, $id);
?>
<div class="container detailBox <?= $rentSaleStr; ?>">
    <div class="bk-detail-header">
        <!------------ 詳細上段 Start ------------>
        <?php
            $nowUrl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $moneyText = (RS_STR_RENT === $rentSaleStr) ? '賃料' : '価格';
        ?>
        <div class="bk-detail-top-data mb-3">
            <div class="bk-detail-top-title-area mb-1">
                <div class="bk-detail-crui-name badge badge-dark mr-1 mb-1">
                    <?= $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_BILDTYPE, null); ?>
                </div>
                <h2 class="bk-detail-title h4 mb-0">
                    <?php
                        $bkName = $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_NAME, null);
                        if("-" === $bkName) {
                            $bkName = $searchManager->createLinkTitle($rentSaleStr, $detailData);
                        }
                    ?>
                    <?= $bkName; ?>
                </h2>
            </div>
            <div class="row">
                <div class="bk-detail-top-other-area col-md-7 col-xl-6 mb-sm-0 mb-2">
                    <div class="bk-detail-address">
                        <?= $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_ADDRESS, null); ?>
                    </div>
                    <?php if(!empty($detailData[$searchManager::BK_DATA_TRAFFIC])) { ?>
                    <div class="bk-detail-transports-area">
                        <?php
                            $trafficData = $searchManager->getMergeEnsenBus($detailData[$searchManager::BK_DATA_TRAFFIC]);
                            $limit = 2;
                            $count = 0;
                        ?>
                        <?php foreach($trafficData['ensen_bus'] as $trafData) { ?>
                        <?php
                            $count++;
                            if($count > $limit) {
                                break;
                            }
                        ?>
                        <div class="bk-detail-transports-conts ensen_bus"><?= $trafData; ?></div>
                        <?php } ?>
                        <?php if(!empty($trafficData[$searchManager::BK_DATA_ETC][0])) { ?>
                        <div class="bk-detail-transports-conts etc"><?= $trafficData[$searchManager::BK_DATA_ETC][0]; ?></div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="detail-btn-set-area col-md-5 col-xl-6">
                    <div class="detail-btn-set-area-various mt-1 mb-1">
                        <div class="inner180 mr-1">
                            <div>
                                <?php
                                    $bkAddr = $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_ADDRESS, null);
                                    $moneyData = $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_MONEY, null);
                                    $bkMoney = "";
                                    foreach($searchManager->getMoneyConvert($moneyData) as $money) {
                                            $bkMoney .= $money['value'];
                                    }
                                    $bkMoneyName = (RS_STR_RENT === $rentSaleStr) ? '賃料' : '価格' ;
                                    $mailText = "物件名：{$bkName}%0D%0A" .
                                                "住所：{$bkAddr}%0D%0A" .
                                                "{$bkMoneyName}：{$bkMoney}%0D%0A";
                                ?>
                                <button type="button" onclick="location.href='mailto:?subject=おすすめの物件&amp;body=<?= $mailText ?><?= $nowUrl ?>'" class="btn btn-info btn-sm sendarticle_m180 sendInfoMail">物件情報をメールで送る</button>
                            </div>
                        </div>
                        <div>
                            <?php
                                $msg = "〇〇不動産のホームページで見つけた物件を送ります。%0D%0A{$mailText}";
                                $lineUrl = "https://social-plugins.line.me/lineit/share?url={$nowUrl}&text={$msg}{$nowUrl}";
                            ?>
                            <button type="button" onclick="window.open('<?= $lineUrl; ?>');" class="lineimage btn btn-sm btn-sns d-inline-block mr-1">
                                <svg viewbox="-1,0,17,17" width="17" height="17" class="mr-1">
                                    <path d="<?= SNS_SVG_PATH['lineimage']; ?>"></path>
                                </svg>
                                LINEで送る
                            </button>
                        </div>
                        <div class="inner96 d-md-inline-block d-none">
                            <div class="whole96"><a target="_blank" href="#" onclick="window.print(); return false;" class="btn btn-info btn-sm print96">印刷する</a></div>
                        </div>
                    </div>
                    <div class="detail-btn-set-area-sns mt-1 mb-1"><?php $facebookUrl = "http://www.facebook.com/share.php?u={$nowUrl}"; ?>
                        <button type="button" onclick="window.open('<?= $facebookUrl; ?>','fbwindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1');" class="fbimage btn btn-sm btn-sns d-inline-block mr-1 fb-like">
                            <svg viewbox="-2,-2,20,20" width="20" height="20">
                                <path d="<?= SNS_SVG_PATH['fbimage']; ?>"></path>
                            </svg>
                        </button><?php $twitterUrl = "http://twitter.com/share?url={$nowUrl}&text={$mailText}"; ?>
                        <button type="button" onclick="window.open('<?= $twitterUrl; ?>');" class="twimage btn btn-sm btn-sns d-inline-block mr-1">
                            <svg viewbox="-2,-2,20,20" width="20" height="20">
                                <path d="<?= SNS_SVG_PATH['twimage']; ?>"></path>
                            </svg>
                        </button><?php $googleUrl = "https://plus.google.com/share?url={$nowUrl}&text={$mailText}{$nowUrl}"; ?>
                        <button type="button" onclick="window.open('<?= $googleUrl; ?>');" class="glimage btn btn-sm btn-sns d-inline-block mr-1 g-plus">
                            <svg viewbox="-2,-2,20,20" width="20" height="20">
                                <path d="<?= SNS_SVG_PATH['glimage']; ?>"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!------------ 詳細上段 End ------------>
    </div>
    <div class="bk-detail-body">
        <div class="bk-detail-images mb-md-5 mb-4">
            <!------------ 詳細 画像スライダー Start ------------>
            <?php if (0 < count($detailData[$searchManager::BK_DATA_IMAGES])) { ?>
            <div class="galleriffic-slide clearfix p-3">
                <div class="row">
                    <div id="gallery" class="content col-md-7 mb-md-0 mb-2">
                        <div class="slideshow-container">
                            <div id="controls"></div>
                            <div id="loading"></div>
                            <div id="caption"></div>
                        </div>
                    </div>
                    <div id="thumbs" style="display: none;" class="navigation col-md-5 d-none d-sm-block">
                        <ul class="thumbs clearfix row">
                            <?php foreach($detailData[$searchManager::BK_DATA_IMAGES] as $num => $imgData) { ?>
                            <li class="col-xl-3 col-4 mt-1 mb-1">
                                <a href="<?= $imgData['path']['large'] ?>" title="<?= $imgData['comment'] ?>" class="thumb main-image-link">
                                    <img src="<?= $imgData['path']['large'] ?>" alt="<?= $imgData['comment'] ?>"/>
                                </a>
                                <div class="caption">
                                    <div class="slideshow">
                                        <span class="image-wrapper">
                                            <div class="image-contents">
                                                <div rel="cbviewer" href="<?= $imgData['path']['large'] ?>" title="<?= $imgData['comment'] ?>" class="advance-link">
                                                    <img src="<?= $imgData['path']['large'] ?>" alt="<?= $imgData['comment'] ?>"/>
                                                </div>
                                                <div class="image-contents-bottom p-2 clearfix">
                                                    <div class="image-description float-left"><?= $imgData['comment'] ?></div>
                                                    <div class="image-num float-right"><?= ($num + 1) ?> / <?= count($detailData[$searchManager::BK_DATA_IMAGES]) ?></div>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </li><?php } ?>
                        </ul>
                        <p class="thumbs-des mb-0">画像をクリックすると拡大されます。</p>
                    </div>
                </div>
            </div>
            <?php
              $script_files = [
                  '/js/components/galleriffic/jquery.galleriffic.js',
                  '/js/components/galleriffic/jquery.history.js',
                  '/js/components/galleriffic/jquery.opacityrollover.js',
                  '/js/njc/customGalleriffic.js',
              ];
            ?>
            <?php foreach($script_files as $filePath) { ?>
            <script type="text/javascript" src="<?= $filePath ?>?_=<?= date('Ymdhis') ?>"></script>
            <?php } ?>
            <?php } ?>
            <!------------ 詳細 画像スライダー End ------------>
        </div>
        <div class="bk-detail-arounds mb-md-5 mb-4">
            <!------------ 詳細 周辺環境 Start ------------>
            <?php $arounds = $searchManager->getAroundsData($detailData, true); ?>
            <?php if (!empty($arounds)) { ?>
            <?php $count = count($arounds); ?>
            <div class="surroundings">
                <div class="h4 heading bg-dark text-light mb-0">周辺施設（<?= $count; ?>枚）</div>
                <div class="btn btn-light btn-sm change-all-view-btn open-surroundings img-count-<?= $count; ?>">全て見る</div>
                <div class="surroundings-list-wrap bg-light loading">
                    <div id="surroundings_custom" class="surroundings-list">
                        <?php foreach ($arounds as $key => $data) { ?>
                        <div data-number="<?= $key; ?>" class="surroundings-contents">
                            <div class="surrounding-image">
                                <div class="image-wrap"><img src="<?= $data['image_path']['large']; ?>"/></div>
                            </div>
                            <div class="surrounding-message">
                                <div class="surrounding-name"><?= $data['name']; ?></div>
                                <?php if (!empty($data['kyori'])) { ?>
                                <div class="surrounding-range"><?= $data['kyori']; ?>m</div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div style="display:none;" class="surroundings-pop-wrap">
                    <?php foreach ($arounds as $key => $data) { ?>
                    <a href="#surroundings-contents-custom-<?= $key; ?>"></a>
                    <?php } ?>
                    <?php foreach ($arounds as $key => $data) { ?>
                    <div id="surroundings-contents-custom-<?= $key; ?>" class="surroundings-contents-pop">
                        <div class="surrounding-image-pop">
                            <div class="image-wrap"><img src="<?= $data['image_path']['large']; ?>"/></div>
                        </div>
                        <div class="surrounding-message">
                            <div class="surrounding-name"><?= $data['name']; ?></div>
                            <?php if (!empty($data['kyori'])) { ?>
                            <div class="surrounding-range"><?= $data['kyori']; ?>m</div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div><?php
                $script_files = [
                    '/js/components/slick/slick.js',
                    '/js/components/colorbox/jquery.colorbox-min.js',
                    '/js/njc/surroundings.js',
                ];
            ?>
            <?php foreach($script_files as $filePath) { ?>
            <script type="text/javascript" src="<?= $filePath; ?>?_=<?= date('Ymdhis'); ?>"></script><?php } ?>
            <?php
                $css_files = [
                    '/js/components/slick/slick.css',
                    '/js/components/slick/slick-theme.css',
                    '/css/components/colorbox/example3/colorbox.css',
                    '/css/njc/colorbox-custom.css'
                ];
            ?>
            <?php foreach($css_files as $filePath) { ?>
            <link rel="stylesheet" type="text/css" href="<?= $filePath; ?>?_=<?= date('Ymdhis'); ?>"/>
            <?php } ?>
            <script>
                $(function(){
                    function surroundingTimeout () {
                        if ('NJC' in window && window.NJC.surroundingSlick && $ && 'colorbox' in $ && 'slick' in $()) {
                            window.NJC.surroundingSlick.ResStart("#surroundings_custom");
                        } else {
                            setTimeout(surroundingTimeout, 1000);
                        }
                     }
                     surroundingTimeout();
                });
            </script>
            <?php } ?>
            <?php $aroundsText = $searchManager->getAroundsData($detailData, false); ?>
            <?php if (!empty($aroundsText)) { ?>
            <div>
                <div class="surroundings-summary-wrap">
                    <ul class="mb-0">
                        <?php foreach ($aroundsText as $key => $data) { ?>
                        <li>
                            <span class="surrounding-name"><?= $data['type']['value']; ?> <?= $data['name']; ?>まで</span>
                            <span class="surrounding-range"><?= $data['kyori']; ?>m</span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
            <!------------ 詳細 周辺環境 End ------------>
        </div>
        <div class="bk-detail-comments mb-md-5 mb-4">
            <!------------ 詳細 PRコメント Start ------------>
            <?php if(!empty($detailData[$searchManager::BK_DATA_SELLING_PT1]) || !empty($detailData[$searchManager::BK_DATA_SELLING_PT2])) { ?>
            <div class="prcnt">
                <div class="prcnt_title"></div>
                <div class="prcnt_box">
                    <?php if(!empty($detailData['selling_point_1'])) { ?>
                    <div class="selling_point_1"><?= $detailData['selling_point_1']; ?></div>
                    <?php } ?>
                    <?php if(!empty($detailData['selling_point_2'])) { ?>
                    <div class="selling_point_2"><?= $detailData['selling_point_2']; ?></div>
                    <?php } ?>
                </div>
            </div><?php } ?>
            <!------------ 詳細 PRコメント End ------------>
        </div>
        <div class="bk-detail-simple row mb-md-5 mb-4">
            <!------------ 詳細 メイン情報 Start ------------>
            <?php
                $data = [
                    [
                        "name" => "賃料/共益費等",
                        "text" => [
                            $searchManager::BK_DATA_MONEY,
                            $searchManager::BK_DATA_KYOEKI,
                        ],
                    ],
                    [
                        "name" => "敷金/礼金",
                        "text" => [
                            $searchManager::BK_DATA_SIKIKIN,
                            $searchManager::BK_DATA_REIKIN,
                        ],
                    ],
                    [
                        "name" => "間取り/間取り内訳",
                        "text" => [
                            $searchManager::BK_DATA_MADORI,
                            $searchManager::BK_DATA_MADORI_DETAIL,
                        ],
                    ],
                    [
                        "name" => "面積",
                        "text" => [
                            $searchManager::BK_DATA_AREASIZE,
                        ],
                    ],
                    [
                        "name" => "物件種別",
                        "text" => [
                            $searchManager::BK_DATA_BILDTYPE,
                        ],
                    ],
                    [
                        "name" => "築年月",
                        "text" => [
                            $searchManager::BK_DATA_BILDDATE,
                        ],
                    ],
                ];
            ?>
            <div class="col-md-6">
                <table class="table bkDetailDataHead">
                    <tbody>
                        <?php foreach($data as $template) { ?>
                        <tr>
                            <th><?= $template['name']; ?></th>
                            <td>
                                <?php $cnt = 0; ?>
                                <?php foreach($template['text'] as $key => $value) { ?>
                                <?php $cnt++; ?>
                                <?php if(!is_numeric($key)) { ?>
                                <div class="<?= $key; ?>"><?= $value; ?></div>
                                <?php } else { ?>
                                <?php $rKey = $value; ?>
                                <?php if($rKey == $searchManager::BK_DATA_MONEY) { ?>
                                <div class="<?= $rKey; ?>">
                                    <?php $money = intval($detailData[$rKey]); ?>
                                    <?php if(!empty($money)) { ?>
                                    <?php foreach($searchManager->getMoneyConvert($money) as $moneyData) { ?>
                                    <span class="<?= $moneyData['class']; ?>"><?= $moneyData['value']; ?></span>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <span class="empty">-</span>
                                    <?php } ?>
                                </div>
                                <?php } else { ?>
                                <div class="<?= $rKey; ?>">
                                    <?php
                                        $text = $searchManager->getAndCheckBkData($detailData, $rKey, null);
                                        if("-" !== $text) {
                                            if($searchManager::BK_DATA_AREASIZE === $rKey) {
                                                $area_keisoku = "";
                                                if(!empty($detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value'])) {
                                                        $area_keisoku = "（{$detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value']}）";
                                                }
                                                $text = number_format($text, 2) . "㎡{$area_keisoku}(" . (floor($text * 0.3025 * 100) / 100) . "坪)";
                                            } else {
                                                $text = $searchManager->setConvertText($rentSaleStr, $rKey, $text);
                                            }
                                        }
                                    ?>
                                    <?= $text; ?>
                                </div>
                                <?php } ?>
                                <?php if($cnt < count($template['text'])) { ?>
                                <span class="glue">/</span>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
                $imgPath = PATH_NOPHOTO_IMG;
                if(!empty($detailData[$searchManager::BK_DATA_IMAGES])) {
                    $imgPath = $searchManager->getMainImagePath($detailData[$searchManager::BK_DATA_IMAGES], $rentSaleStr);
                }
            ?>
            <?php if(!empty($imgPath)) { ?>
            <div class="col-md-6">
                <div class="bk-detail-sub-image-wrapper p-2">
                    <div class="bk-detail-sub-image-inner"><img src="<?= $imgPath; ?>"/></div>
                </div>
            </div>
            <?php } ?>
            <!------------ 詳細 メイン情報 End ------------>
        </div>
        <div class="bk-detail-media-movie row mb-md-5 mb-4">
            <!------------ 詳細 動画 Start ------------>
            <?php
                $media = !empty($detailData[$searchManager::BK_DATA_MEDIA]) ? $detailData[$searchManager::BK_DATA_MEDIA] : [];
                $youtube = !empty($media[$searchManager::BK_DATA_YOUTUBE]) ? $media[$searchManager::BK_DATA_YOUTUBE] : [];
            ?>
            <?php if(!empty($youtube)) { ?>
            <div class="mediaKomoku movie-parts mb-3 col">
                <div data-subtitle="MOVIE" class="h4">動画</div>
                <div class="mediaLinkBoxs">
                    <?php foreach($youtube as $num => $mediaData) { ?>
                    <?php
                        $url = $mediaData['link'];
                        if(false === strpos($url, 'www.youtube.com')) {
                            continue;
                        }
                        if(false !== strpos($url, 'http://')) {
                            $url = str_replace('http://', 'https://', $url);
                        }
                    ?>
                    <a data-ng-target-id="movie<?= ($num + 1); ?>" class="movie-disp-wrap movie-no-1 sp-view">
                            <span class="control-img-sp"><span class="control-img-sp-conts"></span></span>
                            <span class="control-txt-sp">
                                <p class="control-txt-sp-conts text-left mb-0 px-1">この物件の様子を動画で見る</p>
                            </span>
                            <span class="control-btn-sp"><span class="control-btn tmOpenIcon btn btn-dark btn-sm">開く</span></span>
                    </a>
                    <div id="movie<?= ($num + 1); ?>" class="mediaLinkBox pc-view">
                        <div class="youtubePlayerWrap">
                            <iframe src="<?= $url; ?>" frameborder="0" title="" allow="encrypted-media" class="youtubePlayer"></iframe>
                        </div>
                        <div class="mediaLinkComment p-2 text-left"><?= $mediaData['comment']; ?></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php
                $script_files = [
                    '/js/njc/mediaMovie.js',
                ];
            ?>
            <?php foreach($script_files as $filePath) { ?>
            <script type="text/javascript" src="<?= $filePath; ?>?_=<?= date('Ymdhis'); ?>"></script><?php } ?>
            <?php } ?>
            <!------------ 詳細 動画 End ------------>
        </div>
        <div class="bk-detail-media-theta row mb-md-5 mb-4">
            <!------------ 詳細 パノラマ画像 Start ------------>
            <?php
                $media = !empty($detailData[$searchManager::BK_DATA_MEDIA]) ? $detailData[$searchManager::BK_DATA_MEDIA] : [];
                $thetaLinks = !empty($media[$searchManager::BK_DATA_THETA]) ? $media[$searchManager::BK_DATA_THETA] : [];
            ?>
            <?php if (!empty($thetaLinks)) { ?>
            <?php
                $topTheta = $thetaLinks[0];
                list($panoramaURL,$url360Class)=$searchManager->getRicohInfo($topTheta['link']);
            ?>
            <div class="mediaKomoku theta-parts mb-3 col">
                <div data-subtitle="PANORAMA" class="h4">パノラマ画像</div>
                <div class="mediaLinkBoxs">
                    <a class="theta-disp-wrap theta-open-wrap sp-view">
                        <span class="control-img-sp"><span class="control-img-sp-conts"></span></span>
                        <span class="control-txt-sp">
                            <p class="control-txt-sp-conts text-left mb-0 px-1">この物件の様子を360°パノラマ画像で見る</p>
                        </span>
                        <span class="control-btn-sp"><span class="control-btn tmOpenIcon btn btn-dark btn-sm">開く</span></span>
                    </a>
                    <div class="thetaLinkBox pc-view">
                        <div class="thetaPlayerWrap">
                            <blockquote data-width="840" data-height="450" class="<?= $url360Class ; ?>"><a href="<?= $topTheta['link'] ; ?>" target="_blank"></a>
                                <script async="async" src="<?= $panoramaURL ; ?>" charset="utf-8"></script>
                            </blockquote>
                        </div>
                        <div class="theta-select">
                            <?php foreach($thetaLinks as $key => $theta) {?>
                            <?php if($key == 0) {?>
                            <div data-url="<?= $theta['link'] ; ?>" class="btn-theta btn btn-dark active"><?= $theta['title'] ; ?></div>
                            <?php } else { ?>
                            <div data-url="<?= $theta['link'] ; ?>" class="btn-theta btn btn-dark"><?= $theta['title'] ; ?></div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $script_files = [
                    '/js/njc/mediaTheta.js',
                ];
            ?>
            <?php foreach($script_files as $filePath) { ?>
            <script type="text/javascript" src="<?= $filePath ; ?>?_=<?= date('Ymdhis') ; ?>"></script><?php } ?>
            <?php } ?>
            <!------------ 詳細 パノラマ画像 End ------------>
        </div>
        <div class="bk-detail-contact-info mb-md-5 mb-4">
            <!------------ 詳細 お問い合わせ情報 Start ------------>
            <div class="detail-contact-info card bg-light">
                <div class="detail-contact-info-inner">
                    <div class="info-title card-header">この物件のお問い合わせ</div>
                    <div class="card-body">
                        <div class="info-message mb-2">お電話でお気軽にお問い合わせください。お電話でのお問い合わせの際は、「物件お問い合わせ番号」をお伝えいただけますとスムーズにご案内することができます。</div>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="info-num p-3 bg-white text-center mb-sm-0 mb-2">
                                    <span class="info-num-title d-inline-block">物件お問い合わせNo.：</span>
                                    <span class="info-num-conts d-inline-block mb-0 h4 text-danger">
                                        <?php
                                            $contactNo = $detailData[$searchManager::BK_DATA_BILDNUM];
                                            if(RS_STR_RENT === $rentSaleStr && !empty($detailData[$searchManager::BK_DATA_ROOMNO])) {
                                                    $contactNo .= "-" . $detailData[$searchManager::BK_DATA_ROOMNO];
                                            }
                                        ?>
                                        <?= $contactNo; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="info-telmail row align-items-center">
                                    <div class="child info-tel col-xl-5">
                                        <dl class="info-tel-conts mb-sm-0 mb-1">
                                            <dt class="info-st-title">TEL</dt>
                                            <dd class="info-st-conts h3">0120-12-3745</dd>
                                        </dl>
                                    </div>
                                    <div class="child info-holiday col-xl-7">
                                        <dl class="info-st mr-2">
                                            <dt class="info-st-title">営業時間</dt>
                                            <dd class="info-st-conts">9：00～18：00</dd>
                                        </dl>
                                        <dl class="info-st">
                                            <dt class="info-st-title">定休日</dt>
                                            <dd class="info-st-conts">水曜日・祝日(2月・3月は、定休日なしで営業しております。)</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!------------ 詳細 お問い合わせ情報 End ------------>
        </div>
        <div class="bk-detail-main mb-md-5 mb-4">
            <!------------ 詳細 物件情報詳細 Start ------------>
            <?php
                $data = [
                    "initial" => [
                        [
                            "name" => "月々　その他",
                            "cols" => 3,
                            "text" => [
                                $searchManager::BK_DATA_ETC_MONEY,
                            ]
                        ],
                        [
                            "name" => "保証金",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_HOSYOKIN,
                            ]
                        ],
                        [
                            "name" => "敷引・償却金",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_SIKIBIKI,
                            ]
                        ],
                        [
                            "name" => "保険料",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_HOKEN_MONEY,
                            ]
                        ],
                        [
                            "name" => "更新料",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_KOUSHIN_MONEY,
                            ]
                        ],
                        [
                            "name" => "仲介手数料",
                            "cols" => 2,
                            "text" => [
                                $searchManager::BK_DATA_CYUKAIKIN,
                            ]
                        ],
                        [
                            "name" => "保険契約年数",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_HOKEN_YEAR,
                            ]
                        ],
                        [
                            "name" => "賃貸保証内容",
                            "cols" => 2,
                            "text" => [
                                $searchManager::BK_DATA_HOSYOYACHIN,
                            ]
                        ],
                        [
                            "name" => "一時金　その他",
                            "cols" => 3,
                            "text" => [
                                $searchManager::BK_DATA_ETC_TEMP_MONEY,
                            ]
                        ],
                        [
                            "name" => "面積",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_AREASIZE,
                            ]
                        ],
                        [
                            "name" => "住居面積",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_HOUSESIZE,
                            ]
                        ],
                        [
                            "name" => "バルコニー面積",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_BALCOSIZE,
                            ]
                        ],
                        [
                            "name" => "建物階数",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_BILDFLOOR,
                                $searchManager::BK_DATA_BILDUNDER,
                            ]
                        ],
                        [
                            "name" => "所在階数",
                            "cols" => 2,
                            "text" => [
                                $searchManager::BK_DATA_BILDFLOOR_NOW,
                            ]
                        ],
                        [
                            "name" => "現況",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_STATE,
                            ]
                        ],
                        [
                            "name" => "入居時期",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_NYUKYO,
                            ]
                        ],
                        [
                            "name" => "取引態様",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_TORITAI,
                            ]
                        ],
                        [
                            "name" => "設備",
                            "cols" => 3,
                            "text" => [
                                $searchManager::BK_DATA_SETUBI,
                            ]
                        ],
                        [
                            "name" => "情報更新日",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_UPDATED,
                            ]
                        ],
                        [
                            "name" => "掲載期限日",
                            "cols" => 2,
                            "text" => [
                                $searchManager::BK_DATA_OPENED,
                            ]
                        ]
                    ],
                    "etcetera" => [
                        [
                            "name" => "駐車場",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_PARKING,
                            ]
                        ],
                        [
                            "name" => "駐車料",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_PARKMONEY,
                            ]
                        ],
                        [
                            "name" => "駐車台数空き",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_PARKAKI,
                            ]
                        ],
                        [
                            "name" => "駐輪台数",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_BICYDAISU,
                            ]
                        ],
                        [
                            "name" => "駐車場備考",
                            "cols" => 2,
                            "text" => [
                                $searchManager::BK_DATA_PARKBIKO,
                            ]
                        ],
                        [
                            "name" => "向き",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_MUKI,
                            ]
                        ],
                        [
                            "name" => "建物構造",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_STRUCTURE,
                            ]
                        ],
                        [
                            "name" => "総戸数",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_KOSU,
                            ]
                        ],
                        [
                            "name" => "小学校区",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_SYONAME,
                                $searchManager::BK_DATA_SYOKYORI,
                            ]
                        ],
                        [
                            "name" => "中学校区",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_CYUNAME,
                                $searchManager::BK_DATA_CYUKYORI,
                            ]
                        ],
                        [
                            "name" => "周辺環境",
                            "cols" => 1,
                            "text" => [
                                $searchManager::BK_DATA_AROUNDS,
                            ]
                        ],
                        [
                            "name" => "定期借地借家",
                            "cols" => 3,
                            "text" => [
                                $searchManager::BK_DATA_SYAKUEX,
                            ]
                        ],
                        [
                            "name" => "特記事項",
                            "cols" => 3,
                            "text" => [
                                $searchManager::BK_DATA_TOKKI,
                            ]
                        ],
                        [
                            "name" => "契約条件",
                            "cols" => 3,
                            "text" => [
                                $searchManager::BK_DATA_JYOKEN,
                            ]
                        ],
                        [
                            "name" => "備考",
                            "cols" => 3,
                            "text" => [
                                $searchManager::BK_DATA_BIKO,
                            ]
                        ],
                    ],
                ];
                $data = $searchManager->convertDetailData($data, 3);
            ?>
            <div data-subtitle="DETAIL" class="h2">物件詳細情報</div>
            <div class="bk-detail-table-wrap">
                <table class="table table-bordered tableDetail">
                    <?php foreach ($data as $key => $rows) { ?>
                    <tbody class="main-detail-box <?= $key; ?>">
                        <?php foreach ($rows as $rowValues) { ?>
                        <tr class="detail-row">
                            <?php foreach ($rowValues as $rowValue) { ?>
                            <?php $colspan = intval($rowValue['cols']) * 2 - 1; ?>
                            <th class="detail-col table-light">
                                <div><?= $rowValue['name']; ?></div>
                            </th>
                            <td colspan="<?= $colspan; ?>" class="detail-col">
                                <?php foreach ($rowValue['text'] as $rowKey => $rowText) { ?>
                                <?php if(!is_numeric($rowKey)) { ?>
                                <div class="<?= $rowKey; ?> no-data"><?= $rowText; ?></div>
                                <?php } else { ?>
                                <div class="<?= $rowText; ?>">
                                    <?php $dataKey = $rowText; ?>
                                    <?php
                                        $itemPath = "detailItems.detailMainItem";
                                        switch($dataKey) {
                                        case $searchManager::BK_DATA_TRAFFIC:
                                            $itemPath = "detailItems.detailMainTraffic";
                                            break;
                                        }
                                    ?>
                                    <?php if($searchManager::BK_DATA_TRAFFIC === $dataKey) { ?>
                                    <?php
                                        $trafficData = $searchManager->getMergeEnsenBus($detailData[$searchManager::BK_DATA_TRAFFIC]);
                                    ?>
                                    <?php foreach($trafficData['ensen_bus'] as $trafData) { ?>
                                    <p class="kotu_value"><?= $trafData; ?></p>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <?php
                                        $data = $searchManager->getAndCheckBkData($detailData, $dataKey, null);
                                        if("-" !== $data && $searchManager::BK_DATA_AROUNDS !== $dataKey) {
                                            if($searchManager::BK_DATA_AREASIZE === $dataKey) {
                                                $area_keisoku = "";
                                                if(!empty($detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value'])) {
                                                        $area_keisoku = "（{$detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value']}）";
                                                }
                                                $data = number_format($data, 2) . "{$area_keisoku}㎡(" . (floor($data * 0.3025 * 100) / 100) . "坪)";
                                            } else {
                                                $data = $searchManager->setConvertText($rentSaleStr, $dataKey, $data);
                                            }
                                        } else {
                                            switch($dataKey) {
                                            case $searchManager::BK_DATA_SYOGAKU_KYORI:
                                            case $searchManager::BK_DATA_CYUGAKU_KYORI:
                                            case $searchManager::BK_DATA_SETBACK_RYO:
                                            case $searchManager::BK_DATA_BILDUNDER:
                                                $data = "";
                                                break;
                                            }
                                        }
                                    ?>
                                    <?php if($searchManager::BK_DATA_AROUNDS !== $dataKey || "-" === $data) { ?>
                                    <?= $data; ?>
                                    <?php } else { ?>
                                    <?php foreach($data as $around) { ?>
                                    <?php
                                        if(!empty($around['type']['key']) && in_array($around['type']['key'], [19, 20])) {
                                            continue;
                                        }
                                    ?>
                                    <div class="aroundData">
                                        <?= empty($around['type']['value']) ? "-" : $around['type']['value']; ?>まで
                                        <?= empty($around['kyori']) ? "-" : $around['kyori']; ?>m
                                    </div>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php } ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        <?php if('initial' == $key) { ?>
                        <tr>
                            <td colspan="6" class="bg-trans">
                                <div class="inner">
                                    <div class="whole">
                                        <div class="viewNarrow text-center switch">
                                            <span toggle-class="etcetera" class="btn btn-info detailhide toggle"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
            <script type="text/javascript" src="/js/njc/simpleAccordion.js?_=<?= date('Ymdhis'); ?>"></script>
            <!------------ 詳細 物件情報詳細 End ------------>
        </div>
        |<?php if(!empty($detailData[$searchManager::BK_DATA_MAPOPEN])) { ?>
        <div class="bk-detail-map mb-md-5 mb-4">
            <!------------ 詳細 地図 Start ------------>
            <?php
                $mapSearchOption = [
                    'cruiNo'        => 1,
                    'icon'          => "/images/map/icon_bukken_map.gif",
                    'kaiinIcon'     => "/images/map/icon_kaiin.png",
                    'maxZoomLevel'  => 19,
                    'minZoomLevel'  => 10,
                    'zoom'          => 10,
                    'draggable'     => true,
                    'chinOrBai'     => (RS_STR_RENT == $rentSaleStr) ? RS_CODE_RENT : RS_CODE_SALE,
                    'searchObj'     => $searchManager::$searchObject,
                    'ido'           => $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_IDO, null),
                    'keido'         => $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_KEIDO, null),
                    'ctrl'          => 'mapSearch',
                ];
                $mapIcon = [
                    'ConvenienceStore' => 'コンビニ',
                    'laundry' => 'クリーニング店',
                    'library' => '図書館',
                    'supermarket' => 'スーパー',
                    'depart' => '百貨店・モール',
                    'post' => '郵便局',
                    'rental' => 'レンタルビデオ',
                    'school' => '学校',
                    'parking_map' => '駐車場',
                    'restaurant' => 'レストラン',
                    'bank' => '銀行',
                    'spa' => '温泉・スパ',
                    'hospital' => '病院',
                    'park' => '公園',
                    'atm' => 'ATM',
                ];
            ?>
            <div data-subtitle="MAP" class="h2">地図</div>
            <div class="flesh-wrap">
                <div class="parts bkDetailMap">
                    <div class="map">
                        <div>
                            <div id="map_canvas" style="width:100%; height: 500px;" class="text-center mb-2">
                                <img src="/images/dummy/dummy_map_detail.png" class="w-100"/>
                            </div>
                            <div class="nrwMapBtn"><span></span></div>
                            <div id="shuhenForm" class="func bkMapSyuuhenForm clearfix">
                                <p class="syuuhen-attension-origin">地図の縮尺度数を拡大すると、以下の周辺情報を表示することができます。</p>
                                <ul class="syuuhen-info row">
                                    <?php foreach($mapIcon as $key => $title) { ?>
                                    <li class="syuuhen-item col-lg-3 col-md-4 mb-2">
                                        <input type="checkbox" name="mapSearchContents" value="<?= $key; ?>" id="<?= $key; ?>" class="d-none"/>
                                        <label for="<?= $key; ?>" class="<?= $key; ?> mb-0 d-block btn btn-outline-info text-left">
                                            <img src="/images/map/icon_<?= $key; ?>.png" alt="<?= $title; ?>" class="mr-1"/><?= $title; ?>
                                        </label>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div id="mapRouteWrap" class="mb-2 p-3 bg-light">
                            <div class="map-attention">
                                <p class="map-attention-main">地図上を「クリック」すると、物件からその地点までの経路が表示されます。</p>
                            </div>
                            <div class="mapRoute">
                                <ul class="routeSelect btn-group mb-md-0 mb-1">
                                    <li tmode="DRIVING" class="button btn btn-info">自動車</li>
                                    <li tmode="WALKING" class="onMode button btn btn-info border-left active">徒歩</li>
                                </ul>
                                <div class="routeDistance">
                                    <p class="mapDistanceExplain mb-0">経路の距離と時間：</p>
                                    <div class="mapDistanceContext"><span class="mapDistance">-</span>，<span class="mapDuration">-</span></div>
                                </div>
                            </div>
                        </div>
                        <small class="map-attention-bottom">※地図上の各種のアイコンなどの情報は、付近住所に所在する事を示すものであり、正確な地点を保証するものではありません。</small>
                    </div>
                </div>
            </div>
            <?php
                $script_files = [
                    GOOGLE_MAPS_API."?key=".GOOGLE_MAPS_KEY."&libraries=places&language=ja",
                    "/js/njc/map/mapSearch.js",
                    "/js/njc/map/mapSyuuhenForm.js",
                    "/js/njc/map/mapDetail.js",
                ];
            ?>
            <?php foreach($script_files as $filePath) { ?>
            <script type="text/javascript" src="<?= $filePath; ?>?_=<?= date('Ymdhis'); ?>"></script>
            <?php } ?>
            <script>
                var bukken = (<?= json_encode($mapSearchOption); ?> );
                $(function(){
                    var mapDat = new jQuery.mapSearch( <?= json_encode($mapSearchOption) ?> );
                });
            </script>
            <!------------ 詳細 地図 End ------------>
        </div>
        <?php } ?>
        <div class="bk-detail-company mb-md-5 mb-4">
            <!------------ 詳細 会社情報 Start ------------>
            <div class="detail-shop card">
                <div class="shop-wrap card-body">
                    <div class="row">
                        <div class="innerL col-md-4">
                            <figure class="shop-image text-center"><img src="/images/nophoto.png" class="figure-img img-fluid"/></figure>
                        </div>
                        <div class="innerR col-md-8">
                            <div class="shop-info-top">
                                <p class="shop-name card-title h5">○○不動産</p>
                                <p class="shop-address">
                                    <span class="shop-address-post card-text">&#12306;885-0086</span>
                                    <span class="shop-address-conts card-text">宮崎県都城市○○○○○○1-2</span>
                                </p>
                            </div>
                            <div class="shop-info-main">
                                <div class="shop-ordinary">
                                    <div class="row">
                                        <dl class="shop-license col-md-6">
                                            <dt class="title">免許番号</dt>
                                            <dd class="value">宮崎県12121212</dd>
                                        </dl>
                                        <dl class="shop-group col-md-6">
                                            <dt class="title">所属団体</dt>
                                            <dd class="value">宮崎賃貸○○○○○○</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="shop-contact">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6">
                                            <dl class="shop-tel">
                                                <dt class="title">TEL</dt>
                                                <dd class="value">
                                                    <a href="tel:0120-12-3645" class="btn btn-outline-dark w-100 shop-tel-link">0120-12-3645</a>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <dl class="shop-tel">
                                                <dt class="title">TEL</dt>
                                                <dd class="value">
                                                    <a href="tel:090-1234-4568" class="btn btn-outline-dark w-100 shop-tel-link">090-1234-4568</a>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <dl class="shop-fax">
                                                <dt class="title">FAX</dt>
                                                <dd class="value">0120-12-4569</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="shop-sales-time">
                                    <div class="row">
                                        <dl class="shop-sales-time-hour col-md-6">
                                            <dt class="title">営業時間</dt>
                                            <dd class="value">
                                                <span class="shop-open-hours">9：00～18：00</span>
                                                <span class="shop-open-memo">ご都合により来店・ご案内が営業時間外の場合は、お気軽にお問合せください。</span>
                                            </dd>
                                        </dl>
                                        <dl class="shop-sales-time-day col-md-6">
                                            <dt class="title">定休日</dt>
                                            <dd class="value">水曜日・祝日(2月・3月は、定休日なしで営業しております。)</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!------------ 詳細 会社情報 End ------------>
        </div>
    </div>
</div>
<?php include("../include/footerInc.php"); ?>
