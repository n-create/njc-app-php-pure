<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
include("../classes/JsonHelper.php");
include("../classes/MstBkSearch.php");

class SearchItemHelper extends MstBkSearch {
    const RS_STR_NO_BUNDLE = 'no_bundle';

    // DEMOデータのパス
    const DEMO_SEARCHCONF = [
        RS_STR_RENT => '/Private/demo/SearchMaster/rent/',
        RS_STR_SALE => '/Private/demo/SearchMaster/sale/',
    ];
    const DEMO_RESULTJSON = [
        RS_STR_RENT => '/Private/demo/Result/rent/',
        RS_STR_SALE => '/Private/demo/Result/sale/',
    ];
    const RELEASE_SEARCHCONF = API_DOMAIN . '/masters';
    const RELEASE_GROUP = [
        RS_STR_RENT => API_DOMAIN . '/rents/group/',
        RS_STR_SALE => API_DOMAIN . '/sales/group/',
    ];
    const RELEASE_RESULT = [
        RS_STR_RENT => API_DOMAIN . '/rents',
        RS_STR_SALE => API_DOMAIN . '/sales',
        self::RS_STR_NO_BUNDLE => API_DOMAIN . '/rooms',
    ];
    const RELEASE_DETAIL = [
        RS_STR_RENT => API_DOMAIN . '/rooms/',
        RS_STR_SALE => API_DOMAIN . '/sales/',
    ];
    const BK_RESULT_TEMPLATE_JSON = [
        RS_STR_RENT => '/Private/searchItem/rent/',
        RS_STR_SALE => '/Private/searchItem/sale/',
    ];
    const BK_DEATIL_TEMPLATE_JSON = [
        RS_STR_RENT => '/Private/detailItem/rent/',
        RS_STR_SALE => '/Private/detailItem/sale/',
    ];

    public static $resultData = [];
    public static $searchData = [];

    public function getPrComment($resultData, $isSingle)
    {
        $cmt = [];
        $cmtKey = [
            self::BK_DATA_SELLING_PT1,
            self::BK_DATA_SELLING_PT2,
        ];
        foreach($cmtKey as $key) {
            if(self::BK_DATA_SELLING_PT2 == $key && $isSingle) {
                break;
            }
            if(!empty($resultData[$key])) {
                $cmt[] = $resultData[$key];
            }
        }
        return $cmt;
    }

    public function getMainImagePath ($imagesData, $rentSaleStr)
    {
        $result = PATH_NOPHOTO_IMG;
        $imgChecker = self::$imgChecker[$rentSaleStr];
        foreach($imagesData as $data) {
            if(isset($imgChecker[$data['type']]) && empty($imgChecker[$data['type']])) {
                $imgChecker[$data['type']] = $data['path']['large'];
            }
        }
        foreach($imgChecker as $imgType => $imgPath) {
            if(!empty($imgPath)) {
                $result = $imgPath;
                break;
            }
        }
        return $result;
    }

    public function getRicohInfo ($url360)
    {
        $parseUrl = parse_url($url360);
        if (false === empty($parseUrl['host'])) {
            $hostName = $parseUrl['host'];
            if (strstr($url360, "biz/s")) {
                $panoramaURL = "https://{$hostName}/widgets.js";
                $url360Class = "ricoh-theta-spherical-image";
            } else if (strstr($url360,"biz/t")) {
                $panoramaURL = "https://{$hostName}/t_widgets.js";
                $url360Class = "ricoh-theta-tour-image";
            } else {
                $panoramaURL = "https://theta360.com/widgets.js";
                $url360Class = "ricoh-theta-spherical-image";
            }
        }
        return array($panoramaURL,$url360Class);
    }

    public function getAroundsData($detailData, $isRequireImagesPath) {
        $result = [];
        if(!empty($detailData[self::BK_DATA_AROUNDS])) {
            $result = $detailData[self::BK_DATA_AROUNDS];
            if($isRequireImagesPath) {
                foreach($result as $key => $data) {
                    if(empty($data['image_path'])) {
                        unset($result[$key]);
                    }
                }
            }
        }
        return $result;
    }

    public function getAllBkCount() {
        $result = [];
        $count = 0;
        $time_update = 0;
        foreach([self::RS_STR_NO_BUNDLE, RS_STR_SALE] as $rsKey) {
            $url = self::RELEASE_RESULT[$rsKey] . '?fields=synced_at&sorts=synced&limit=1';
            $jsonData = (new JsonHelper())->getJsonData($url, true);
            if(isset($jsonData['data'][0]['synced_at'])) {
                $nTime = strtotime($jsonData['data'][0]['synced_at']);
                if($time_update < $nTime) {
                    $time_update = $nTime;
                }
            }
            if(isset($jsonData['meta']['total'])) {
                $count += intval($jsonData['meta']['total']);
            }
        }
        $result = [
            'count' => $count,
            'updated' => date("Y-m-d H:i", $time_update),
        ];
        return $result;
    }

    public function convertGroupingData($master) {
        $result = [];
        foreach($master as $value => $text) {
            $key = explode("_", $value);
            $arrText = explode(":", $text);
            $parentKey = $key[0];
            $childKey = $key[1];
            if(!isset($result[$parentKey]['name'])) {
                $result[$parentKey]['name'] = $arrText[0];
            }
            $data = isset($arrText[1]) ? $arrText[1] : $text;
            $result[$parentKey]['child'][$childKey] = $data;
        }
        return $result;
    }

    public function setConvertText($rentSaleStr, $key, $text) {
        switch($key) {
        case self::BK_DATA_BILDFLOOR:
            $text = "地上" . number_format(intval($text)) . "階建て";
            break;
        case self::BK_DATA_BILDUNDER:
            $text = "/ 地下" . number_format(intval($text)) . "階";
            break;
        case self::BK_DATA_BILDFLOOR_NOW:
            $text = number_format(intval($text)) . "階部分";
            break;
        case self::BK_DATA_MUKI:
            $text .= '向き';
            break;
        case self::BK_DATA_KENPEI:
        case self::BK_DATA_YOSEKI:
            $text = number_format(intval($text)) . "％";
            break;
        case self::BK_DATA_SIDOSIZE:
        case self::BK_DATA_FLOORSIZE:
        case self::BK_DATA_LANDSIZE:
        case self::BK_DATA_BILDSIZE:
        case self::BK_DATA_BALCOSIZE:
        case self::BK_DATA_CONSTSIZE:
        case self::BK_DATA_HOUSESIZE:
        case self::BK_DATA_AREASIZE:
            $text = number_format($text, 2) . "㎡(" . (floor($text * 0.3025 * 100) / 100) . "坪)";
            break;
        case self::BK_DATA_SYOGAKU_KYORI:
        case self::BK_DATA_CYUGAKU_KYORI:
            $text = number_format($text) . "m";
            break;
        case self::BK_DATA_BILDDATE:
            $text = date("Y/m", strtotime($text));
            break;
        case self::BK_DATA_UPDATED:
        case self::BK_DATA_CREATED:
        case self::BK_DATA_OPENED:
            $text = date("Y/m/d", strtotime($text));
            break;
        case self::BK_DATA_TUBOMONEY:
            if(is_numeric($text)) {
                $moneyArr = self::getMoneyConvert($text);
                $text = "";
                foreach($moneyArr as $mArr) {
                    $text .= $mArr['value'];
                }
                $text .= "/坪";
            }
            break;
        case self::BK_DATA_MONEY:
        case self::BK_DATA_KYOEKI:
        case self::BK_DATA_PARKMONEY:
        case self::BK_DATA_KANRI:
        case self::BK_DATA_SYUZEN:
        case self::BK_DATA_HOKEN_MONEY:
        case self::BK_DATA_KOUSHIN_MONEY:
            if(is_numeric($text)) {
                $text = number_format($text) . "円";
            }
            break;
        case self::BK_DATA_SYAKUCI_DATE:
            $text .= "年";
            break;
        case self::BK_DATA_SYAKUCI_MONEY:
            $text = intval($text);
            $text = number_format($text) . "円/月";
            break;
        case self::BK_DATA_PARKDAISU:
        case self::BK_DATA_BICYDAISU:
            $text = number_format($text) . "台";
            break;
        case self::BK_DATA_KOSU:
        case self::BK_DATA_SELL_KOSU:
            $text = number_format($text) . "戸";
            break;
        case self::BK_DATA_SETBACK_RYO:
            $text = "({$text}㎡)";
            break;
        case self::BK_DATA_MADORI_DETAIL:
            $text = "内訳：{$text}";
            break;
        }
        return $text;
    }

    public function getAndCheckBkData($detailData, $key, $valueKey) {
        $vKey = empty($valueKey) ? 'value' : $valueKey;
        $result = '-';
        if(!empty($detailData[$key])) {
            if(is_array($detailData[$key])) {
                if(isset($detailData[$key][$vKey])) {
                    $result = $detailData[$key][$vKey];
                    if(!empty($result) || 0 == $result) {
                        if(is_numeric($result) && 1000 <= $result) {
                            $result = number_format($result);
                        }
                        if(!empty($detailData[$key]['unit'])) {
                            $result .= $detailData[$key]['unit'];
                        }
                        if(!empty($detailData[$key]['tax']) && !empty($detailData[$key][$vKey])) {
                            $tax_code = $detailData[$key]['tax'];
                            if(!empty($detailData[$key]['unit']) && "円" !== $detailData[$key]['unit']) {
                                $result .= isset(self::TAX_MASTER_DATA[$tax_code]) ? " ".self::TAX_MASTER_DATA[$tax_code] : '';
                            }
                        }
                    } else {
                        $result = "-";
                    }
                } else {
                    if(self::BK_DATA_AROUNDS === $key) {
                        $result = $detailData[$key];
                    } else {
                        $temp = [];
                        foreach($detailData[$key] as $val) {
                            $value = $val;
                            if(is_array($val)) {
                                $value = $val[$vKey];
                                if(is_numeric($value) && 1000 <= $value) {
                                    $value = number_format($value);
                                }
                                if(!empty($val['unit'])) {
                                    $value .= $val['unit'];
                                }
                            }
                            if(!empty($val)) {
                                $temp[] = $value;
                            }
                        }
                        if(!empty($temp)) {
                            if(self::BK_DATA_MADORI_DETAIL === $key) {
                                $result = implode(" ", $temp);
                            } else {
                                $result = implode("、", $temp);
                            }
                        }
                    }
                }
            } else {
                $result = $detailData[$key];
            }
        } else {
            switch($key) {
            case self::BK_DATA_ENSEN:
            case self::BK_DATA_BUS:
            case self::BK_DATA_ETC:
                $result = implode("、", $detailData[self::BK_DATA_TRAFFIC][$key]);
                break;
            }
        }
        return $result;
    }

    public function getMergeEnsenBus($traffic) {
        $result = [];
        $temp = [];
        foreach($traffic as $type => $datas) {
            if(self::BK_DATA_ETC !== $type) {
                foreach($datas as $key => $data) {
                    if(!empty($temp[$key])) {
                        $temp[$key] .= "/{$data}";
                    } else {
                        $temp[$key] = $data;
                    }
                }
            }
        }
        $result = [
            'ensen_bus' => $temp,
            'etc' => $traffic[self::BK_DATA_ETC],
        ];
        return $result;
    }

    public function getAndConvertTrafficData($traffic) {
        $result = [];
        $key = self::BK_DATA_TRAFFIC;
        foreach($traffic as $type => $datas) {
            foreach($datas as $data) {
                $result[] = [
                    'class' => "{$key}_{$type}",
                    'text' => $data,
                ];
            }
        }
        return $result;
    }

    public function getSortOrderList($rentSaleStr) {
        return self::$sortOrderList[$rentSaleStr];
    }

    public function getAndUnsetUrl($unsetKey) {
        $get = $_GET;
        $url = $_SERVER['SCRIPT_NAME'];
        $temp = self::getAndUnsetParameter($get, $unsetKey);
        $url .= "?" . implode('&', $temp);
        return $url;
    }

    public function getAndUnsetParameter($param, $unsetKey) {
        $temp = [];
        foreach($param as $key => $val) {
            if($unsetKey !== $key) {
                $val = self::_getAllImplode(",", $val);
                $temp[] = "{$key}={$val}";
            }
        }
        return $temp;
    }

    /**
     * 地図上のアイコンをクリックした時の物件一覧表示
     * データ取得
     *
     * @param array   $value     apiから取得したデータ
     * @param string  $imgSize   画像サイズ
     *
     * @return list
     */
    public function setAjaxBukkenView($value, $imgSize)
    {
        $bkImg = [];
        $bkVal = $value;
        if (!empty($value[self::BK_DATA_ROOMS][0])) {
            $bkVal = array_merge($bkVal, $value[self::BK_DATA_ROOMS][0]);
            $bkVal[self::BK_DATA_IMAGES] = !empty($value[self::BK_DATA_IMAGES]) ? $value[self::BK_DATA_IMAGES] : $bkVal[self::BK_DATA_IMAGES];
        }
        if(empty($imgSize)) {
            $imgSize = "medium";
        }
        $kotu = empty($value[self::BK_DATA_TRAFFIC][self::BK_DATA_ENSEN][0])?'':$value[self::BK_DATA_TRAFFIC][self::BK_DATA_ENSEN][0];
        if(!empty($bkVal[self::BK_DATA_IMAGES])) {
            foreach ($bkVal[self::BK_DATA_IMAGES] as $key => $val) {
                if (!empty($val[self::BK_DATA_PATH][$imgSize])) {
                    $bkImg[$key]['img'] = $val[self::BK_DATA_PATH][$imgSize];
                    $bkImg[$key]['comment'] = $val[self::BK_DATA_COMMENT];
                } else {
                    $bkImg[$key]['img'] = PATH_NOPHOTO_IMG;
                    $bkImg[$key]['comment'] = '';
                }
            }
        } else {
            $bkImg[] = [
                'img' => PATH_NOPHOTO_IMG,
                'comment' => '',
            ];
        }
        return [$bkImg, $kotu, $bkVal];
    }
    /**
     * 引数のキーが別々のキーを配列化させたデータかを確認します。
     *
     * @param string    $rKey     確認するキー
     *
     * @return string 表示名
     */
    public function isNoArrayData($rKey) {
        return isset(self::$noArrayItems[$rKey]);
    }

    /**
     *
     */
    public function getMapZahyouData($rentSaleStr) {
        $jsonData = [];
        $query = $_GET;
        $rKey = self::FROM_MASTER_DATA_NEW[self::BK_DATA_MAP];
        $url = self::_getSpecialSearchUrl($rentSaleStr, $rKey, self::BK_DATA_MAP);
        $param = [];
        foreach($query as $key => $value) {
            $value = self::_getAllImplode(",", $value);
            if(!empty($value)) {
                $param[] = "{$key}={$value}";
            }
        }
        $jsonData = (new JsonHelper())->getJsonDataNoDebug($url . "?" . implode("&", $param), true);
        return $jsonData;
    }

    /**
     *
     */
    public function getMapAreaData($rentSaleStr) {
        $rKey = self::FROM_MASTER_DATA_NEW[self::BK_DATA_AREA];
        $url = self::_getSpecialSearchUrl($rentSaleStr, $rKey, self::BK_DATA_AREA);
        $url .= "&map=1";
        $jsonData = (new JsonHelper())->getJsonData($url, true);
        $jsonData = $jsonData[0]['cities'];
        return $jsonData;
    }

    private function _shiftKanaOld ($kana)
    {
        $rtn = '';
        if (mb_ereg_match('[あ-お]', $kana)) {
            $rtn = 'あ';
        } else if (mb_ereg_match('[か-こ]', $kana)) {
            $rtn = 'か';
        } else if (mb_ereg_match('[さ-そ]', $kana)) {
            $rtn = 'さ';
        } else if (mb_ereg_match('[た-と]', $kana)) {
            $rtn = 'た';
        } else if (mb_ereg_match('[な-の]', $kana)) {
            $rtn = 'な';
        } else if (mb_ereg_match('[は-ほ]', $kana)) {
            $rtn = 'は';
        } else if (mb_ereg_match('[ま-も]', $kana)) {
            $rtn = 'ま';
        } else if (mb_ereg_match('[や-よ]', $kana)) {
            $rtn = 'や';
        } else if (mb_ereg_match('[ら-ろ]', $kana)) {
            $rtn = 'ら';
        } else {
            $rtn = 'わ';
        }
        return $rtn;
    }

    public function getTotalCountArea($areaData) {
        $count = 0;
        foreach($areaData as $areaChild) {
            foreach($areaChild as $area) {
                if(empty($area['count'])) {
                    continue;
                }
                $count += $area['count'];
            }
        }
        return $count;
    }

    /**
     *
     */
    public function getMapCityData($rentSaleStr) {
        $query = $_GET;
        $rKey = self::FROM_MASTER_DATA_NEW[self::BK_DATA_CITY];
        $url = self::_getSpecialSearchUrl($rentSaleStr, $rKey, self::BK_DATA_CITY);
        $url .= "&map=1";
        $result = (new JsonHelper())->getJsonData($url, true);
        return $result;
    }

    public function getBkDetailData($rentSaleStr, $id) {
        $result = (new JsonHelper())->getJsonData(self::RELEASE_DETAIL[$rentSaleStr] . $id, true);
        return $result;
    }

    public function getBkResultTemplateData($key, $rentSaleStr, $buildType, $isMatome) {
        if($isMatome) {
            $key = "matome_{$key}";
        }
        $path = self::BK_RESULT_TEMPLATE_JSON[$rentSaleStr];
        $path .= "{$key}/{$buildType}" . JSON_EXT;
        $result = (new JsonHelper())->getLocalJsonData($path, true);
        return $result;
    }

    public function getBkDetailTemplateData($rentSaleStr, $key, $buildType) {
        $result = (new JsonHelper())->getLocalJsonData(self::BK_DEATIL_TEMPLATE_JSON[$rentSaleStr] . "{$key}/{$buildType}" . JSON_EXT, true);
        if(self::BK_TEMPLATE_DETAIL == $key) {
            $result = $this->convertDetailData($result, 3);
        }
        return $result;
    }

    public function convertDetailData($data, $colsLimit) {
        $result = [];
        $nowCols = 0;
        if(!empty($data)) { 
            foreach($data as $defKey => $mainDatas) {
                $temp = [];
                foreach($mainDatas as $mainData) {
                    $nowCols += intval($mainData['cols']);
                    $temp[] = $mainData;
                    if($colsLimit <= $nowCols) {
                        $result[$defKey][] = $temp;
                        $nowCols = 0;
                        $temp = [];
                    }
                }
                if(!empty($temp)) {
                    $result[$defKey][] = $temp;
                }
            }
        }
        return $result;
    }

    public function getBkResultDataDirect($rentSaleStr, $query) {
        $result = [];
        $limit = 9;
        if(isset($query['limit'])) {
            $limit = $query['limit'];
        }
        $param = [];
        foreach($query as $key => $value) {
            $value = self::_getAllImplode(",", $value);
            if(!empty($value)) {
                $param[] = "{$key}={$value}";
            }
        }
        self::$resultData = (new JsonHelper())->getJsonData(self::RELEASE_RESULT[$rentSaleStr] . "?" . implode("&", $param), true);
        $result = self::$resultData['data'];
        $result = self::_setRoomsData($result);
        return $result;
    }
    /**
     * 検索条件に沿って検索を行い、物件一覧データを返す。
     *
     * @param string    $rentSaleStr     rent / sale
     *
     * @return array 該当マスターデータ
     */
    public function getBkResultData($rentSaleStr) {
        $result = [];
        $query = $_GET;
        $limit = 9;
        if(isset($query['limit'])) {
            $limit = $query['limit'];
        }
        if(empty(self::$resultData)) {
            self::_setBkResultData($rentSaleStr);
        }
        $result = self::$resultData['data'];
        $result = self::_setRoomsData($result);
        return $result;
    }

    private function _setBkResultData($rentSaleStr) {
        $query = $_GET;
        $param = [];
        foreach($query as $key => $value) {
            $value = self::_getAllImplode(",", $value);
            if(!empty($value)) {
                $param[] = "{$key}={$value}";
            }
        }
        self::$resultData = (new JsonHelper())->getJsonData(self::RELEASE_RESULT[$rentSaleStr] . "?" . implode("&", $param), true);
    }

    private function _getAllImplode($glue, $data) {
        $result = [];
        if(is_array($data)) {
            foreach($data as $value) {
                if(is_array($value)) {
                    $value = self::_getAllImplode($glue, $value);
                }
                $result[] = $value;
            }
            $result = implode($glue, $result);
        } else {
            $result = $data;
        }
        return $result;
    }
    /**
     * 新API専用。
     * rooms内に該当物件の全部屋データが入ってるいるのでループで回しづらい。
     * rooms内のデータ確認して最初の１件は外に出して、残りはrooms内に残すよう調整する。
     *
     * @param array $bkDatas       物件一覧データ
     *
     * @return array 整形されたデータ
     */
    private function _setRoomsData($bkDatas) {
        $result = [];
        if(!empty($bkDatas)) {
            foreach($bkDatas as $bkData) {
                if(!empty($bkData['rooms'][0])) {
                    $parent_room = $bkData['rooms'];
                    $child_room = array_splice($parent_room, 1);
                    $images = !empty($bkData[self::BK_DATA_IMAGES]) ? $bkData[self::BK_DATA_IMAGES] : [];
                    $bkData = array_merge($bkData, $parent_room[0]);
                    $bkData[self::BK_DATA_IMAGES] = !empty($images) ? $images : $bkData[self::BK_DATA_IMAGES];
                }
                $result[] = $bkData;
            }
        }
        return $result;
    }

    /**
     * 物件データからリンクのaltやtitleにつけるためのテキストを作成する。
     */
    public function createLinkTitle($rentSaleStr, $bkData) {
        $join = [];
        foreach(self::$createTitleItem as $key) {
            if(!empty($bkData[$key])) {
                if(self::BK_DATA_MONEY === $key) {
                    $money = self::getMoneyConvert($bkData[$key]);
                    if(!empty($money)) {
                        $text = "";
                        foreach($money as $mArr) {
                            $text .= $mArr['value'];
                        }
                        $join[] = $text;
                    }
                } else {
                    $join[] = self::setConvertText($rentSaleStr, $key, $bkData[$key]);
                }
            } else if ('skinrkin' === $key && RS_STR_RENT === $rentSaleStr) {
                $temp = "";
                $data = [
                    self::BK_DATA_SIKIKIN => intval(self::getAndCheckBkData($bkData, self::BK_DATA_SIKIKIN, null)),
                    self::BK_DATA_REIKIN  => intval(self::getAndCheckBkData($bkData, self::BK_DATA_REIKIN, null)),
                ];
                $temp .= (empty($data[self::BK_DATA_SIKIKIN])) ? '敷金' : '';
                $temp .= (empty($data[self::BK_DATA_REIKIN]))  ? '礼金' : '';
                if(!empty($temp)) {
                    $join[] = $temp . '無し';
                }
            }
        }
        return implode(' ', $join);
    }

    /**
     * 金額を１万単位で分割する。
     *
     * @param int $money    金額
     *
     * @return array 金額表示用配列
     */
    public function getMoneyConvert($money) {
        $moneyRate = [
            1 => '万',
            2 => '億',
            3 => '兆',
            4 => '京',
        ];
        $result = [];
        $arrMoney = [];
        while($money > 0) {
            $divRemain = $money % 10000;
            $arrMoney[] = $divRemain;
            if($money != $divRemain) {
                $money = intval($money / 10000);
            } else {
                $money = 0;
            }
        }
        $firstMoney = '';
        foreach($arrMoney as $key => $rMoney) {
            if(!empty($rMoney)) {
                if(isset($moneyRate[$key])) {
                    $rMoney = number_format($rMoney);
                    $result[] = [
                        'value' => "{$moneyRate[$key]}",
                        'class' => 'unit',
                    ];
                    if(!empty($firstMoney)) {
                        $result[] = [
                            'value' => "{$firstMoney}",
                            'class' => 'small-num',
                        ];
                        $firstMoney = '';
                    }
                    $result[] = [
                        'value' => "{$rMoney}",
                        'class' => 'num',
                    ];
                } else {
                    $firstMoney = (string)($rMoney / 10000);
                    $firstMoney = substr($firstMoney, 1);
                    if(1 == count($arrMoney)) {
                        $result[] = [
                            'value' => "万",
                            'class' => 'unit',
                        ];
                        $result[] = [
                            'value' => "{$firstMoney}",
                            'class' => 'small-num',
                        ];
                        $result[] = [
                            'value' => "0",
                            'class' => 'num',
                        ];
                    }
                }
            }
        }
        if(!empty($result[0]['value'])) {
            $result[0]['value'] .= '円';
        }
        krsort($result);
        return $result;
    }

    /**
     * 物件検索で使われる項目の表示名を取得します。
     *
     * @param string    $rentSaleStr     rent / sale
     * @param string    $key             取得する項目キー (App\Models\Masters\MstBkSearch)
     *
     * @return string 表示名
     */
    public function getBkItemName($rentSaleStr, $key) {
        $result = isset(self::BK_ITEM_DISPNAME[$key]) ? self::BK_ITEM_DISPNAME[$key] : '-';
        switch($key) {
        case self::BK_DATA_NYUKYO:
            $result = (RS_STR_RENT === $rentSaleStr) ? '入居時期' : '引渡時期';
            break;
        case self::BK_DATA_AREASIZE:
            $result = (RS_STR_RENT === $rentSaleStr) ? '面積' : '専有面積';
            break;
        case self::BK_DATA_MONEY:
            $result = (RS_STR_RENT === $rentSaleStr) ? '賃料' : '価格';
            break;
        }
        return $result;
    }

    public function getBkSearchMaster($rentSaleStr, $key) {
        $result = [];
        $master = [];
        if(isset(self::BK_DATA_REALDATA[$key])) {
            if(empty(self::$searchData)) {
                self::$searchData = (new JsonHelper())->getJsonData(self::RELEASE_SEARCHCONF, true);
            }
            $result = self::BK_DATA_REALDATA[$key];
            if(empty(self::FROM_MASTER_DATA_NEW[$key])) {
                if(isset(self::$localDataNew[$key])) {
                    $rKey = self::$localDataNew[$key];
                    if(isset($rKey[$rentSaleStr])) {
                        $rKey = $rKey[$rentSaleStr];
                    }
                    $result['search'] = self::${$rKey};
                } else {
                    $result['search'] = true;
                }
            } else {
                $rKey = self::FROM_MASTER_DATA_NEW[$key];
                if (!empty(self::$searchData[$rentSaleStr][$rKey])) {
                    $result['search'] = self::$searchData[$rentSaleStr][$rKey];
                } else {
                    $url = self::_getSpecialSearchUrl($rentSaleStr, $rKey, $key);
                    $jsonData = (new JsonHelper())->getJsonData($url, true);
                    if(self::BK_DATA_AREA === $key) {
                        $filterData = [];
                        foreach($jsonData as $data) {
                            foreach($data['cities'] as $cityData) {
                                $filterData[] = $cityData;
                            }
                        }
                        $jsonData = $filterData;
                    }
                    $result['search'] = $jsonData;
                }
            }
        } else {
            var_dump(['key' => $key]);die;
        }
        return $result;
    }
    /**
     *
     */
    private function _getSpecialSearchUrl($rentSaleStr, $rKey, $key) {
        $url = self::RELEASE_GROUP[$rentSaleStr] . "{$rKey}";
        switch($key) {
        case self::BK_DATA_RAILWAY:
            $url .= "?fields=count,line_number,name";
            break;
        case self::BK_DATA_STATION:
            $url .= "?" . self::_getParamUrl([self::BK_DATA_RAILWAY]);
            break;
        case self::BK_DATA_CITY:
            $url .= "?fields=prefecture_name,prefecture_number,cities,cities.count,cities.city_name,cities.city_number";
            break;
        case self::BK_DATA_AREA:
            $url .= "?fields=cities";
            $url .= "&" . self::_getParamUrl([self::BK_DATA_CITY]);
            break;
        }
        return $url;
    }
    private function _getParamUrl($keys) {
        $query = $_GET;
        $result = [];
        foreach($keys as $key) {
            $pKey = self::BK_DATA_REALDATA[$key]['key'][0];
            $params = $query[$pKey];
            $result[] = "{$pKey}=" . implode(",", $params);
        }
        return implode("&", $result);
    }
    /**
     * デモのJSONデータ獲得
     *
     * @param string    $rentSaleStr     rent / sale
     * @param string    $key             ファイル名
     *
     * @return array JSONデータ
     */
    private function _getDemoData($rentSaleStr, $key) {
        return (new JsonHelper())->getLocalJsonData(self::DEMO_SEARCHCONF[$rentSaleStr] . $key . JSON_EXT, true);
    }
    /**
     * 現在はAREA（町駅）専用
     * 項目データで名前が無い場合、cho_head(頭文字）と名前をその他にして、一件の物件内容にまとめる。
     *
     * @param array $master     検索項目マスター
     *
     * @return array 修正が終わったマスター
     */
    public function checkAndSetBlankAreaName ($master) {
        if(!empty($master)) {
            foreach($master as $key => $searchData) {
                $etcName = $searchData['city_name']."その他";
                $etcCount = 0;
                $etcPost = [];
                foreach($searchData['towns'] as $data) {
                    if(empty($data['town_name'])) {
                        $etcCount += intval($data['count']);
                        $etcPost[] = $data['post_code'];
                    }
                }
                if(0 < $etcCount) {
                    $master[$key]['towns'][] = [
                        'town_name' => $etcName,
                        'post_code' => implode(",", $etcPost),
                        'count' => $etcCount,
                        'town_head' => "その他",
                    ];
                }
            }
        }
        return $master;
    }
    /**
     * 現在はAREA（町駅）専用
     * データを描画するための形式に再構築する。
     * JADEで描画するのは現在の構造では無理があったため作成。
     *
     * @param array $master     検索項目マスター
     *
     * @return array 修正が終わったマスター
     */
    public function convertAreaData($areaData) {
        if(isset($areaData)) {
            foreach($areaData as $key => $searchData) {
                $temp = [];
                $etc = null;
                foreach($searchData['towns'] as $data) {
                    if(empty($data['town_name'])) {
                        continue;
                    }
                    $cho_head = self::_shiftKana($data['town_head']);
                    if("その他" === $cho_head) {
                        $etc = $data;
                    } else {
                        $temp[$cho_head][] = $data;
                    }
                }
                ksort($temp);
                if(!empty($etc)) {
                    $temp['その他'][] = $etc;
                }
                $areaData[$key]['towns'] = $temp;
            }
        }
        return $areaData;
    }

    private function _shiftKana ($kana) {
        $rtn = '';
        if (mb_ereg_match('[ｱ-ｵ]', $kana)) {
            $rtn = 'あ';
        } else if (mb_ereg_match('[ｶ-ｺ]', $kana)) {
            $rtn = 'か';
        } else if (mb_ereg_match('[ｻ-ｿ]', $kana)) {
            $rtn = 'さ';
        } else if (mb_ereg_match('[ﾀ-ﾄ]', $kana)) {
            $rtn = 'た';
        } else if (mb_ereg_match('[ﾅ-ﾉ]', $kana)) {
            $rtn = 'な';
        } else if (mb_ereg_match('[ﾊ-ﾎ]', $kana)) {
            $rtn = 'は';
        } else if (mb_ereg_match('[ﾏ-ﾓ]', $kana)) {
            $rtn = 'ま';
        } else if (mb_ereg_match('[ﾔ-ﾖ]', $kana)) {
            $rtn = 'や';
        } else if (mb_ereg_match('[ﾗ-ﾛ]', $kana)) {
            $rtn = 'ら';
        } else if ("その他" !== $kana){
            $rtn = 'わ';
        } else {
            $rtn = 'その他';
        }
        return $rtn;
    }
    public function getResultMetaData($rentSaleStr) {
        if(empty(self::$resultData)) {
            self::_setBkResultData($rentSaleStr);
        }
        return self::$resultData['meta'];
    }

}
