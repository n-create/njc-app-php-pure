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
<?php
    $searchManager = new SearchItemHelper();
    $result = [];
    $resultKey = $searchManager::RS_STR_NO_BUNDLE;
    $jsonData = (new SearchItemHelper())->getBkResultData($resultKey);
    $rentSaleStr = RS_STR_RENT;
?>
<div class="mapBkList card <?= (1 >= count($jsonData)) ? 'noDotsSlider' : ''; ?>">
    <div class="header card-header">
        <div class="mapBkCount float-left">
            <span>該当物件数</span>
            <span class="njcSliderBukkenCount"><?= count($jsonData); ?></span>
            <span>件</span>
        </div>
        <div class="njcSliderClose float-right"> ×</div>
    </div>
    <div class="<?= $rentSaleStr; ?>">
        <div id="bkTinyList" class="overflow bk-carousel p-2">
            <?php foreach($jsonData as $key => $value) { ?>
            <?php
               list($bkImg, $kotu, $bkData) = $searchManager->setAjaxBukkenView($value, false, 'medium');
               $madoMenArr = [];
               if(!empty($bkData[$searchManager::BK_DATA_MADORI])) {
                   $madoMenArr[] = $searchManager->setConvertText($rentSaleStr, $searchManager::BK_DATA_MADORI, $bkData[$searchManager::BK_DATA_MADORI]);
               }
               if(!empty($bkData[$searchManager::BK_DATA_AREASIZE])) {
                   $madoMenArr[] = $searchManager->setConvertText($rentSaleStr, $searchManager::BK_DATA_AREASIZE, $bkData[$searchManager::BK_DATA_AREASIZE]);
               }
               $madoMen = implode("／", $madoMenArr);
            ?>
            <div class="mapBkItem row py-2">
                <div class="mapBkLeft col-6">
                    <div class="text-center">
                        <a href="/<?= $rentSaleStr; ?>/detail.php?id=<?= $bkData[$searchManager::BK_DATA_ID]; ?>" title="<?= $bkImg[0]['comment']; ?>" target='_blank'>
                                <img src="<?= $bkImg[0]['img']; ?>" alt="<?= $bkImg[0]['comment']; ?>">
                        </a>
                    </div>
                </div>
                <div class="mapBkContent col-6">
                    <a href="/<?= $rentSaleStr ?>/detail/<?= $bkData[$searchManager::BK_DATA_ID]; ?>" title="<?= $bkImg[0]['comment']; ?>" target='_blank'>
                        <div class="disp-list-item">
                            <div class="crui_name badge badge-dark">
                                <?= (empty($bkData[$searchManager::BK_DATA_BILDTYPE]['value']) ? '-' : $bkData[$searchManager::BK_DATA_BILDTYPE]['value']); ?>
                            </div>
                            <?php if(!empty($bkData[$searchManager::BK_DATA_MONEY])) { ?>
                            <div class="money">
                                <span><?= $searchManager->setConvertText($rentSaleStr, $searchManager::BK_DATA_MONEY, $bkData[$searchManager::BK_DATA_MONEY]); ?></span>
                            </div>
                            <?php } ?>
                            <?php if(!empty($madoMen)) { ?>
                            <div class="madomen"><?= $madoMen; ?></div>
                            <?php } ?>
                            <?php if(!empty($kotu)) { ?>
                            <div class="traffic"><?= $kotu; ?></div>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>
        <div class="buttonBg"></div>
    </div>
</div>
<script>
    $(function(){
        var isSlick = false;

        function slickChange() {
            if (window.matchMedia('(max-width:767px)').matches) {
                if(!isSlick) {
                    $('#bkTinyList').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: false,
                        dots: true,
                        infinite: false,
                        adaptiveHeight: true,
                        customPaging: function(slider, i) {
                            var max = $(slider.$slides).length;
                            return '<span class="nav_page">'+(i+1)+'/'+max+'</span>';
                        }
                    });
                    $('#njcAreaView').on('dialogclose', function() {
                        $('#bkTinyList').slick('unslick');
                    });
                    isSlick = true;
                }
            } else {
                if(isSlick) {
                    $('#bkTinyList').slick('unslick');
                    isSlick = false;
                }
            }
        }
        $(window).on('load resize', function() {
            slickChange();
        });

        slickChange();
    });
</script>
<?php
   $script_files = [
       '/js/components/slick/slick.js',
   ];
   $css_files = [
       '/js/components/slick/slick.css',
       '/js/components/slick/slick-theme.css',
   ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="<?= $filePath; ?>?_=<?= date('Ymdhis'); ?>")</script>
<?php } ?>
<?php foreach($css_files as $filePath) { ?>
<link rel="stylesheet" type="text/css" href!="<?= $filePath; ?>?_=<?= date('Ymdhis'); ?>"/>
<?php } ?>
