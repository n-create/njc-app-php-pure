<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */

class MstBkSearch {
    const MASTER_DATA_LOCAL = 'local';
    const API_DATA_BKSEARCH = 'bk_search';
    const API_DATA_NOARRAY = 'no_array';
    const API_DATA_ARRAY = 'array';
    const API_DATA_GROUPING = 'grouping';
    const API_DATA_DIRECT = 'direct';

    const DATA_TYPE_CHECK = 'check';
    const DATA_TYPE_LIST = 'list';
    const DATA_TYPE_RADIO = 'radio';
    const DATA_TYPE_TEXT = 'text';
    const DATA_TYPE_GROUP = 'group';
    const DATA_TYPE_CUSTOM = 'custom';
    const DATA_TYPE_CUSTOM_GROUP = 'custom_group';

    const IMG_TYPE_MADORI       = 'madori';
    const IMG_TYPE_GAIKAN       = 'gaikan';
    const IMG_TYPE_NAIKAN       = 'naikan';
    const IMG_TYPE_KUKAKU       = 'kukaku';
    const IMG_TYPE_OTHER        = 'other';
    const IMG_TYPE_GAIKANPERS   = 'gaikanpers';
    const IMG_TYPE_MAP          = 'map';
    const IMG_TYPE_YOUSHITSU    = 'youshitsu';
    const IMG_TYPE_KYOYU        = 'kyoyu';
    const IMG_TYPE_WASHITSU     = 'washitsu';
    const IMG_TYPE_GENKAN       = 'genkan';
    const IMG_TYPE_KITCHEN      = 'kitchen';
    const IMG_TYPE_BATH         = 'bath';
    const IMG_TYPE_TOILET       = 'toilet';
    const IMG_TYPE_WASH         = 'wash';
    const IMG_TYPE_LIVING       = 'living';
    const IMG_TYPE_BEDROOM      = 'bedroom';
    const IMG_TYPE_CHILDROOM    = 'childroom';
    const IMG_TYPE_STORAGE      = 'storage';
    const IMG_TYPE_SECURITY     = 'security';
    const IMG_TYPE_FACILITY     = 'facility';
    const IMG_TYPE_BELANDA      = 'belanda';
    const IMG_TYPE_YARD         = 'yard';
    const IMG_TYPE_PARKING      = 'parking';
    const IMG_TYPE_ENTRANCE     = 'entrance';
    const IMG_TYPE_SYUHEN       = 'syuhen';

    const BK_TEMPLATE_SIMPLE = 'simple';
    const BK_TEMPLATE_DETAIL = 'detail';

    const BK_DATA_NAME = 'name';
    const BK_DATA_KANA = 'kana';
    const BK_DATA_POST = 'post_code';
    const BK_DATA_KENNAME = 'prefecture';
    const BK_DATA_ADDRESS = 'address';
    const BK_DATA_BILDNO = 'building_no';
    const BK_DATA_BILDTYPE = 'building_type';
    const BK_DATA_STRUCTURE = 'structure_type';
    const BK_DATA_KEY = 'key';
    const BK_DATA_VALUE = 'value';
    const BK_DATA_BILDNUM = 'building_number';
    const BK_DATA_BILDFLOOR = 'building_floor';
    const BK_DATA_BILDUNDER = 'building_underground';
    const BK_DATA_BILDDATE = 'building_year';
    const BK_DATA_BILDFLOOR_NOW = 'building_current';
    const BK_DATA_IDO = 'latitude';
    const BK_DATA_KEIDO = 'longitude';
    const BK_DATA_IMAGES = 'images';
    const BK_DATA_TYPE = 'type';
    const BK_DATA_COMMENT = 'comment';
    const BK_DATA_PATH = 'path';
    const BK_DATA_TRAFFIC = 'traffics';
    const BK_DATA_ENSEN = 'ensen';
    const BK_DATA_BUS = 'bus';
    const BK_DATA_ETC = 'etc';
    const BK_DATA_SYONAME = 'syogaku_name';
    const BK_DATA_SYOKYORI = 'syogaku_kyori';
    const BK_DATA_CYUNAME = 'cyugaku_name';
    const BK_DATA_CYUKYORI = 'cyugaku_kyori';
    const BK_DATA_ROOMS = 'rooms';
    const BK_DATA_ID = 'id';
    const BK_DATA_ROOMNO = 'room_number';
    const BK_DATA_BILDID = 'building_id';
    const BK_DATA_MADORI = 'room_type';
    const BK_DATA_MADORI_DETAIL = 'room_type_detail';
    const BK_DATA_SIKIKIN = 'sikikin';
    const BK_DATA_REIKIN = 'reikin';
    const BK_DATA_HOSYOKIN = 'hosyokin';
    const BK_DATA_HOSYOYACHIN = 'yachinhosyo';
    const BK_DATA_CYUKAIKIN = 'cyukai_ryokin';
    const BK_DATA_SIKIBIKI = 'sikibikikin';
    const BK_DATA_AREASIZE_KEI = 'area_size_keisoku';
    const BK_DATA_AREASIZE = 'area_size';
    const BK_DATA_SIDOSIZE = 'sido_men';
    const BK_DATA_FLOORSIZE = 'floor_area_size';
    const BK_DATA_LANDSIZE = 'land_area_size';
    const BK_DATA_BILDSIZE = 'building_area_size';
    const BK_DATA_BALCOSIZE = 'balcony_area_size';
    const BK_DATA_HOUSESIZE = 'house_area_size';
    const BK_DATA_CONSTSIZE = 'construction_area_size';
    const BK_DATA_BILDMANAGE = 'building_manager';
    const BK_DATA_BILDCOMP = 'building_company';
    const BK_DATA_BILDGROUP = 'building_kumiai';
    const BK_DATA_BILDKEITAI = 'building_keitai';
    const BK_DATA_BILDCODE = 'building_check_code';
    const BK_DATA_ROADDETAIL = 'connecting_road_detail';
    const BK_DATA_MONEY = 'money';
    const BK_DATA_ETC_MONEY = 'etc_kin';
    const BK_DATA_ETC_TEMP_MONEY = 'etc_ichiji_kin';
    const BK_DATA_ETC_HIYO = 'etc_hiyo';
    const BK_DATA_TUBOMONEY = 'tubo_tanka';
    const BK_DATA_HOKEN_MONEY = 'hoken_ryokin';
    const BK_DATA_HOKEN_YEAR = 'hoken_year';
    const BK_DATA_KOUSHIN_MONEY = 'koshin_ryokin';
    const BK_DATA_SYAKUCI_MONEY = 'syakuchi_ryokin';
    const BK_DATA_SYAKUCI_DATE = 'syakuchi_keiyaku';
    const BK_DATA_SYAKUCI_CONTENT = 'syakuchi_naiyo';
    const BK_DATA_RIMAWARI_NOW = 'genko_yield';
    const BK_DATA_RIMAWARI_MAX = 'manshitsu_yield';
    const BK_DATA_RENTOU_MUNE = 'rentou_mune';
    const BK_DATA_CREATED = 'created_at';
    const BK_DATA_UPDATED = 'updated_at';
    const BK_DATA_OPENED  = 'open_at';
    const BK_DATA_NYUKYO = 'nyukyo';
    const BK_DATA_KANRI = 'kanri';
    const BK_DATA_SYUZEN = 'syuzen';
    const BK_DATA_YOUTO = 'youto_region';
    const BK_DATA_KOKUDO = 'kokudo_hou';
    const BK_DATA_LANDCATE = 'land_category';
    const BK_DATA_LANDKENRI = 'tochi_kenri';
    const BK_DATA_TOPOGRAPH = 'topography';
    const BK_DATA_KEISOKU = 'area_size_keisoku';
    const BK_DATA_KENPEI = 'kenpei';
    const BK_DATA_YOSEKI = 'yoseki';
    const BK_DATA_MUKI = 'muki';
    const BK_DATA_PARKING = 'parking_type';
    const BK_DATA_PARKMONEY = 'parking_ryokin';
    const BK_DATA_PARKDAISU = 'parking_daisu';
    const BK_DATA_PARKAKI = 'parking_daisu_aki';
    const BK_DATA_PARKBIKO = 'parking_biko';
    const BK_DATA_BICYDAISU = 'bicycle_parking_daisu';
    const BK_DATA_KOSU = 'kosu';
    const BK_DATA_SELL_KOSU = 'hanbai_kosu';
    const BK_DATA_KYOEKI = 'kyoeki';
    const BK_DATA_STATE = 'state';
    const BK_DATA_TORITAI = 'torihiki_taiyo';
    const BK_DATA_HIKIJYOKEN = 'hikiwatashi_jyoken';
    const BK_DATA_SETUBI = 'setubi_options';
    const BK_DATA_JYOKEN = 'jyoken_options';
    const BK_DATA_KENTIKU = 'kentiku_jyoken';
    const BK_DATA_KODAWARI = 'kodawari';
    const BK_DATA_SYAKUEX = 'teisyaku_exist';
    const BK_DATA_TOKKI = 'tokki';
    const BK_DATA_BIKO = 'biko';
    const BK_DATA_RAWHOREI = 'horei';
    const BK_DATA_NEWBILD = 'new_bilding';
    const BK_DATA_NEWCOME = 'created_within';
    const BK_DATA_EKITOHO = 'station_toho';
    const BK_DATA_FREEWORD = 'freeword';
    const BK_DATA_MONEY_ETC = 'money_etc';
    const BK_DATA_POSITION = 'position';
    const BK_DATA_SYUEKI = 'rimawari';
    const BK_DATA_SYUEKI_PER = 'rimawari_per';
    const BK_DATA_SYOGAKU = 'syogaku_names';
    const BK_DATA_SI_SYOGAKU = 'city_and_syogaku_names';
    const BK_DATA_CYUGAKU = 'cyugaku_names';
    const BK_DATA_SI_CYUGAKU = 'city_and_cyugaku_names';
    const BK_DATA_CITYPLAN = 'city_planning';
    const BK_DATA_SYOGAKU_KYORI = 'syogaku_kyori';
    const BK_DATA_CYUGAKU_KYORI = 'cyugaku_kyori';
    const BK_DATA_AROUNDS = 'arounds';
    const BK_DATA_RAILWAY = 'railway';
    const BK_DATA_STATION = 'station';
    const BK_DATA_CITY = 'city';
    const BK_DATA_AREA = 'area';
    const BK_DATA_MAP = 'map';
    const BK_DATA_MAPOPEN = 'is_open_map';
    const BK_DATA_MEDIA = 'media';
    const BK_DATA_YOUTUBE = 'youtube';
    const BK_DATA_THETA = 'theta';
    const BK_DATA_SETBACK = 'setback';
    const BK_DATA_SETBACK_RYO = 'setback_ryo';
    const BK_DATA_SELLING_PT1 = 'selling_point_1';
    const BK_DATA_SELLING_PT2 = 'selling_point_2';

    const BK_ITEM_DISPNAME = [
        self::BK_DATA_MAP           => '地図',
        self::BK_DATA_NAME          => '物件名',
        self::BK_DATA_KANA          => 'カナ',
        self::BK_DATA_KANRI         => '管理費',
        self::BK_DATA_BILDTYPE      => '物件種別',
        self::BK_DATA_POST          => '郵便番号',
        self::BK_DATA_KENNAME       => '県',
        self::BK_DATA_ADDRESS       => '住所',
        self::BK_DATA_BILDNO        => '物件番号',
        self::BK_DATA_STRUCTURE     => '建物構造',
        self::BK_DATA_KEY           => 'キー',
        self::BK_DATA_VALUE         => 'データ',
        self::BK_DATA_BILDFLOOR     => '建物階数',
        self::BK_DATA_BILDUNDER     => '建物地下階数',
        self::BK_DATA_BILDDATE      => '築年月',
        self::BK_DATA_BILDFLOOR_NOW => '所在階数',
        self::BK_DATA_IDO           => '緯度',
        self::BK_DATA_KEIDO         => '経度',
        self::BK_DATA_IMAGES        => '画像',
        self::BK_DATA_TYPE          => 'タイプ',
        self::BK_DATA_COMMENT       => 'コメント',
        self::BK_DATA_PATH          => 'パス',
        self::BK_DATA_TRAFFIC       => '交通情報',
        self::BK_DATA_ENSEN         => '沿線',
        self::BK_DATA_BUS           => 'バス',
        self::BK_DATA_ETC           => 'その他',
        self::BK_DATA_SYONAME       => '小学校名',
        self::BK_DATA_CYUNAME       => '中学校名',
        self::BK_DATA_ROOMS         => '部屋情報',
        self::BK_DATA_ID            => 'ID',
        self::BK_DATA_ROOMNO        => '部屋番号',
        self::BK_DATA_BILDID        => '物件ID',
        self::BK_DATA_MADORI        => '間取り',
        self::BK_DATA_SIKIKIN       => '敷金',
        self::BK_DATA_REIKIN        => '礼金',
        self::BK_DATA_HOSYOKIN      => '保証金',
        self::BK_DATA_SIKIBIKI      => '敷引・償却',
        self::BK_DATA_AREASIZE      => '専有面積',
        self::BK_DATA_FLOORSIZE     => '延べ床面積',
        self::BK_DATA_LANDSIZE      => '土地面積',
        self::BK_DATA_BILDSIZE      => '建物面積',
        self::BK_DATA_BALCOSIZE     => 'バルコニー面積',
        self::BK_DATA_MONEY         => '賃料・価格',
        self::BK_DATA_TUBOMONEY     => '坪単価',
        self::BK_DATA_CREATED       => '登録日',
        self::BK_DATA_UPDATED       => '更新日',
        self::BK_DATA_NYUKYO        => '入居時期',
        self::BK_DATA_MUKI          => '向き',
        self::BK_DATA_PARKING       => '駐車場',
        self::BK_DATA_KYOEKI        => '共益費等',
        self::BK_DATA_STATE         => '現況',
        self::BK_DATA_TORITAI       => '取引態様',
        self::BK_DATA_SETUBI        => '設備',
        self::BK_DATA_JYOKEN        => '契約条件',
        self::BK_DATA_KODAWARI      => 'こだわり条件',
        self::BK_DATA_PARKMONEY     => '駐車料',
        self::BK_DATA_NEWBILD       => '新築区分',
        self::BK_DATA_NEWCOME       => '新着物件',
        self::BK_DATA_CITY          => '市区町村',
        self::BK_DATA_AREA          => '町域',
        self::BK_DATA_RAILWAY       => '沿線',
        self::BK_DATA_STATION       => '駅',
        self::BK_DATA_SI_SYOGAKU    => '小学校区',
        self::BK_DATA_SI_CYUGAKU    => '中学校区',
        self::BK_DATA_EKITOHO       => '最寄り駅までの徒歩時間',
        self::BK_DATA_MONEY_ETC     => 'その他費用',
        self::BK_DATA_SYUEKI        => '収益物件',
        self::BK_DATA_SYUEKI_PER    => '利回り',
        self::BK_DATA_SYOGAKU       => '小学校区',
        self::BK_DATA_SI_SYOGAKU    => '小学校区',
        self::BK_DATA_CYUGAKU       => '中学校区',
        self::BK_DATA_SI_CYUGAKU    => '中学校区',
        self::BK_DATA_SYOGAKU_KYORI => '小学校までの距離',
        self::BK_DATA_CYUGAKU_KYORI => '中学校までの距離',
        self::BK_DATA_FREEWORD      => 'フリーワード',
        self::BK_DATA_POSITION      => '位置',
        self::BK_DATA_KENPEI        => '建ぺい率',
        self::BK_DATA_YOSEKI        => '容積率',
        self::BK_DATA_LANDCATE      => '地目',
    ];

    const BK_DATA_REALDATA = [
        self::BK_DATA_BILDTYPE => [
            'key' => ['building_types'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_MONEY => [
            'key' => ['money_min', 'money_max'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_MONEY_ETC => [
            'key' => [
                'kyoeki_included' => '共益費等込',
                'sikikin_zero' => '敷金無し',
                'reikin_zero' => '礼金無し',
            ],
            'type' => self::DATA_TYPE_CUSTOM,
        ],
        self::BK_DATA_MADORI => [
            'key' => ['room_types'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_LANDSIZE => [
            'key' => ['land_area_size_min', 'land_area_size_max'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_AREASIZE => [
            'key' => ['area_size_min', 'area_size_max'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_BILDSIZE => [
            'key' => ['building_area_size_min', 'building_area_size_max'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_POSITION => [
            'key' => [
                'first_floor' => '1F',
                'more_first_floor' => '2F以上',
                'underground' => '地下',
                'top_floor' => '最上階',
                'southfacing' => '南向き',
            ],
            'type' => self::DATA_TYPE_CUSTOM,
        ],
        self::BK_DATA_BILDDATE => [
            'key' => ['building_year'],
            'type' => self::DATA_TYPE_RADIO,
        ],
        self::BK_DATA_NEWBILD => [
            'key' => ['new_building'],
            'type' => self::DATA_TYPE_RADIO,
        ],
        self::BK_DATA_NEWCOME => [
            'key' => ['created_within'],
            'type' => self::DATA_TYPE_RADIO,
        ],
        self::BK_DATA_BILDDATE => [
            'key' => ['building_year'],
            'type' => self::DATA_TYPE_RADIO,
        ],
        self::BK_DATA_EKITOHO => [
            'key' => ['station_toho'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_IMAGES => [
            'key' => [
                'image_count' => '物件画像あり',
                'movie' => '物件動画あり',
                'panorama' => '360度パノラマ画像有り',
            ],
            'type' => self::DATA_TYPE_CUSTOM,
        ],
        self::BK_DATA_SETUBI => [
            'key' => ['setubi_options'],
            'type' => self::DATA_TYPE_GROUP,
        ],
        self::BK_DATA_JYOKEN => [
            'key' => ['jyoken_options'],
            'type' => self::DATA_TYPE_GROUP,
        ],
        self::BK_DATA_KODAWARI => [
            'type' => self::DATA_TYPE_CUSTOM_GROUP,
        ],
        self::BK_DATA_FREEWORD => [
            'key' => ['freeword'],
            'type' => self::DATA_TYPE_TEXT,
        ],
        self::BK_DATA_SYUEKI => [
            'key' => ['rimawari'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_SYUEKI_PER => [
            'key' => ['rimawari_per'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_SI_SYOGAKU => [
            'key'=> ['city_and_syogaku_names'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_SI_CYUGAKU => [
            'key'=> ['city_and_cyugaku_names'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_SYOGAKU_KYORI => [
            'key'=> ['syogaku_kyori'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_CYUGAKU_KYORI => [
            'key'=> ['cyugaku_kyori'],
            'type' => self::DATA_TYPE_LIST,
        ],
        self::BK_DATA_RAILWAY => [
            'key'=> ['line_numbers'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_STATION => [
            'key'=> ['station_numbers'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_CITY => [
            'key'=> ['city_numbers'],
            'type' => self::DATA_TYPE_CHECK,
        ],
        self::BK_DATA_AREA => [
            'key'=> ['post_codes'],
            'type' => self::DATA_TYPE_CHECK,
        ],
    ];

    const FROM_MASTER_DATA_NEW = [
        self::BK_DATA_BILDTYPE      => 'building_types',
        self::BK_DATA_JYOKEN        => 'jyoken_options',
        self::BK_DATA_SETUBI        => 'setubi_options',
        self::BK_DATA_SI_SYOGAKU    => 'syogaku',
        self::BK_DATA_SI_CYUGAKU    => 'cyugaku',
        self::BK_DATA_RAILWAY       => 'line',
        self::BK_DATA_STATION       => 'line',
        self::BK_DATA_CITY          => 'address',
        self::BK_DATA_AREA          => 'address',
        self::BK_DATA_MAP           => 'zahyo',
    ];

    const BK_DISPITEM_KEY_MAIN = 'main';
    const BK_DISPITEM_KEY_SUB = 'sub';
    const BK_DISPITEM_KEY_TINYMAIN = 'tiny_main';
    const BK_DISPITEM_KEY_TINYSUB = 'tiny_sub';
    const BK_DISPITEM_KEY_MATOME = 'bundle';

    const TAX_MASTER_DATA = [
        2 => '税有',
        3 => '',
    ];

    // APIからのデータをAPP側で使いやすいように変換する用、実際の値とテキストのキーを定義する。
    public static $convertKey = [
        self::BK_DATA_SI_SYOGAKU => [
            'keyText' => 'city_name',
            'keyGroup' => 'schools',
            'keyGroupText' => 'name',
            'keyGroupValue' => 'search_key',
        ],
        self::BK_DATA_SI_CYUGAKU => [
            'keyText' => 'city_name',
            'keyGroup' => 'schools',
            'keyGroupText' => 'name',
            'keyGroupValue' => 'search_key',
        ],
        self::BK_DATA_RAILWAY => [
            'keyText' => 'name',
            'keyValue' => 'line_number',
        ],
        self::BK_DATA_STATION => [
            'keyText' => 'name',
            'keyGroup' => 'stations',
            'keyGroupText' => 'name',
            'keyGroupValue' => 'station_number',
        ],
        self::BK_DATA_CITY => [
            'keyText' => 'prefecture_name',
            'keyGroup' => 'cities',
            'keyGroupText' => 'city_name',
            'keyGroupValue' => 'city_number',
        ],
        self::BK_DATA_AREA => [
            'keyText' => 'city_name',
            'keyGroup' => 'towns',
            'keyGroupText' => 'town_name',
            'keyGroupValue' => 'post_code',
        ],
    ];

    // 物件種別
    public static $bulding_type = [
        RS_STR_RENT => [
            1 => "マンション",
            2 => "アパート",
            3 => "一戸建て",
            4 => "店舗",
            5 => "事務所",
            6 => "工場",
            7 => "倉庫",
            8 => "駐車場",
            9 => "その他",
        ],
        RS_STR_SALE => [
            1 => "土地",
            2 => "一戸建て",
            3 => "マンション",
            4 => "店舗",
            5 => "店舗付住宅",
            6 => "事務所",
            7 => "工場",
            8 => "倉庫",
            9 => "その他",
        ],
    ];

    // APIから直接検索データを取ってくるデータで、URLのアクションとキーが食い違う場合、
    // キー情報を取ってくる時に使う実際のキーをこちらに設定する。
    public static $realKey = [
        'syogaku' => 'si_syogaku',
        'cyugaku' => 'si_cyugaku',
        'city' => 'si',
        'area' => 'post',
        'ensen' => 'en',
        'eki' => 'eki',
    ];

    // NEW
    // ローカル（PHP）のマスターからのデータ参照が必要な項目
    public static $localDataNew = [
        self::BK_DATA_MONEY => [
            RS_STR_RENT => 'rentalRate',
            RS_STR_SALE => 'priceRate',
        ],
        self::BK_DATA_MADORI => 'madori',
        self::BK_DATA_LANDSIZE => 'menseki',
        self::BK_DATA_AREASIZE => 'menseki',
        self::BK_DATA_BILDSIZE => 'menseki',
        self::BK_DATA_NEWBILD => 'buildAgeKbn',
        self::BK_DATA_BILDDATE => 'buildAge',
        self::BK_DATA_NEWCOME => 'shinchakuKbn',
        self::BK_DATA_EKITOHO => 'tohokubun',
        self::BK_DATA_SYUEKI_PER => 'rimawari',
        self::BK_DATA_SYOGAKU_KYORI => 'kyorikubun',
        self::BK_DATA_CYUGAKU_KYORI => 'kyorikubun',
        self::BK_DATA_KODAWARI      => 'customSearch',
    ];

    // 公開物件の選択
    public static $kaiinOpFlg = [
        ['value' => '2', 'label' => '指定無し'],
        ['value' => '1', 'label' => '会員公開物件のみ'],
        ['value' => '0', 'label' => '一般公開物件のみ'],
    ];

    // 賃料選択肢
    public static $rentalRate = [
        '30000' => '3.0万円',
        '35000' => '3.5万円',
        '40000' => '4.0万円',
        '45000' => '4.5万円',
        '50000' => '5.0万円',
        '55000' => '5.5万円',
        '60000' => '6.0万円',
        '65000' => '6.5万円',
        '70000' => '7.0万円',
        '75000' => '7.5万円',
        '80000' => '8.0万円',
        '85000' => '8.5万円',
        '90000' => '9.0万円',
        '95000' => '9.5万円',
        '100000' => '10.0万円',
        '110000' => '11.0万円',
        '120000' => '12.0万円',
        '130000' => '13.0万円',
        '140000' => '14.0万円',
        '150000' => '15.0万円',
        '160000' => '16.0万円',
        '170000' => '17.0万円',
        '180000' => '18.0万円',
        '190000' => '19.0万円',
        '200000' => '20.0万円',
        '300000' => '30.0万円',
        '500000' => '50.0万円',
        '1000000' => '100.0万円',
    ];

    // 価格選択肢
    public static $priceRate = [
        '3000000' =>  '300万円',
        '5000000' =>  '500万円',
        '10000000' => '1000万円',
        '15000000' => '1500万円',
        '20000000' => '2000万円',
        '25000000' => '2500万円',
        '30000000' => '3000万円',
        '35000000' => '3500万円',
        '40000000' => '4000万円',
        '45000000' => '4500万円',
        '50000000' => '5000万円',
        '55000000' => '5500万円',
        '60000000' => '6000万円',
        '65000000' => '6500万円',
        '70000000' => '7000万円',
        '75000000' => '7500万円',
        '80000000' => '8000万円',
        '85000000' => '8500万円',
        '90000000' => '9000万円',
        '95000000' => '9500万円',
        '100000000' => '1億円',
    ];
    public static $buyTime = [
        0 => '指定しない',
        1 => 'できればすぐに',
        2 => '１～２ヶ月以内',
        3 => '２～３ヶ月以内',
        4 => '半年以内',
        5 => '１年以内',
        6 => '希望するものが出るまで待つ'
    ];
    public static $nyukyoTime = [
        0 => '指定しない',
        1 => '即入居希望',
        2 => '１～２ヶ月以内',
        3 => '２～３ヶ月以内',
        4 => '半年以内'
    ];
    public static $buildAge = [
        '' => '指定しない',
        1 => '1年未満',
        3 => '3年未満',
        5 => '5年未満',
        10 => '10年未満',
        15 => '15年未満',
        20 => '20年未満',
        25 => '25年未満'
    ];
    public static $bbwBuildAge = [
        ''      => '指定しない',
        '0'     => '新築',
        '1,3'   => '1年〜3年',
        '4,5'   => '4年〜5年',
        '6,10'  => '6年〜10年',
        '11,15' => '11年〜15年',
        '16,20' => '16年〜20年',
        '21,' => '21年以上'
    ];
    public static $buildAgeEorReq = [
        '' => '指定しない',
        1 => '1年未満',
        3 => '3年未満',
        5 => '5年未満',
        10 => '10年未満',
        15 => '15年未満',
        20 => '20年未満'
    ];
    public static $buildAgeKbn = [
        '' => '指定しない',
        1 => '新築',
        2 => '中古'
    ];
    public static $residentsNumber = [
        1 => '１人',
        2 => '２人',
        3 => '３人',
        4 => '４人',
        5 => '５人',
        6 => '６人以上'
    ];
    public static $areaUnit = [
        1 => '平米',
        2 => '坪'
    ];
    public static $upDown = [
        1 => '前後',
        2 => '以内',
        3 => '以上'
    ];

    public static $chikuNen = [
        '' => '指定しない',
        1 => '1年未満',
        2 => '2年未満',
        3 => '3年未満',
        4 => '4年未満',
        5 => '5年未満',
        6 => '6年未満',
        7 => '7年未満',
        8 => '8年未満',
        9 => '9年未満',
        10 => '10年未満',
        11 => '11年未満',
        12 => '12年未満',
        13 => '13年未満',
        14 => '14年未満',
        15 => '15年未満',
        16 => '16年未満',
        17 => '17年未満',
        18 => '18年未満',
        19 => '19年未満',
        20 => '20年未満',
        21 => '21年未満',
        22 => '22年未満',
        23 => '23年未満',
        24 => '24年未満',
        25 => '25年未満',
        99 => '25年以上'
    ];

    public static $shinchakuKbn = [
        '' => '指定なし',
        3 => '3日以内',
        7 => '1週間以内',
        14 => '2週間以内'
    ];

    public static $genkyo = [
        1 => '居住中',
        2 => '賃貸貸出中',
        3 => '空室',
        4 => '更地'
    ];
    public static $kaikae = [
        1 => '有り',
        0 => '無し'
    ];
    public static $saleTime = [
        99 => '未定',
        0 => '即',
        1 => '１ヶ月',
        3 => '３ヶ月',
        6 => '６ヶ月',
        12 => '１年以内'
    ];
    public static $otherRequest = [
        1 => '依頼している',
        0 => '依頼していない'
    ];
    public static $time = [
        0 => '0時',
        1 => '1時',
        2 => '2時',
        3 => '3時',
        4 => '4時',
        5 => '5時',
        6 => '6時',
        7 => '7時',
        8 => '8時',
        9 => '9時',
        10 => '10時',
        11 => '11時',
        12 => '12時',
        13 => '13時',
        14 => '14時',
        15 => '15時',
        16 => '16時',
        17 => '17時',
        18 => '18時',
        19 => '19時',
        20 => '20時',
        21 => '21時',
        22 => '22時',
        23 => '23時'
    ];
    public static $week = [
        1 => '月曜',
        2 => '火曜',
        3 => '水曜',
        4 => '木曜',
        5 => '金曜',
        6 => '土曜',
        7 => '日曜'
    ];

    public static $menseki = [
        10 =>'10㎡(3.02坪)',
        15 =>'15㎡(4.53坪)',
        20 =>'20㎡(6.05坪)',
        25 =>'25㎡(7.56坪)',
        30 =>'30㎡(9.07坪)',
        35 =>'35㎡(10.58坪)',
        40 =>'40㎡(12.1坪)',
        45 =>'45㎡(13.61坪)',
        50 =>'50㎡(15.12坪)',
        60 =>'60㎡(18.15坪)',
        70 =>'70㎡(21.17坪)',
        80 =>'80㎡(24.2坪)',
        90 =>'90㎡(27.22坪)',
        100 =>'100㎡(30.25坪)',
        110 =>'110㎡(33.27坪)',
        120 =>'120㎡(36.3坪)',
        130 =>'130㎡(39.32坪)',
        140 =>'140㎡(42.35坪)',
        150 =>'150㎡(45.37坪)',
        160 =>'160㎡(48.4坪)',
        170 =>'170㎡(51.42坪)',
        180 =>'180㎡(54.45坪)',
        190 =>'190㎡(57.47坪)',
        200 =>'200㎡(60.5坪)',
        250 =>'250㎡(75.62坪)',
        300 =>'300㎡(90.75坪)',
        350 =>'350㎡(105.87坪)',
        400 =>'400㎡(121坪)',
        450 =>'450㎡(136.12坪)',
        500 =>'500㎡(151.25坪)',
        550 =>'550㎡(166.37坪)',
        600 =>'600㎡(181.5坪)',
        650 =>'650㎡(196.62坪)',
        700 =>'700㎡(211.75坪)',
        750 =>'750㎡(226.87坪)',
        800 =>'800㎡(242坪)',
        850 =>'850㎡(257.12坪)',
        900 =>'900㎡(272.25坪)',
        950 =>'950㎡(287.37坪)',
        1000 =>'1000㎡(302.5坪)'
    ];

    public static $shuekiBukken = [
        1 => '収益物件'
    ];

    public static $kaiinBukken = [
        1 => '会員物件'
    ];
     /**
     * 検索フォーム表示（距離）
     *
     * @var array
     */
    public static $kyorikubun = [
        '' => '距離を選択してください。',
        500 => '500',
        1000 => '1000',
        1500 => '1500',
        2000 => '2000',
        2500 => '2500',
        3000 => '3000'
    ];
     /**
     * 検索フォーム表示（徒歩時間）
     *
     * @var array
     */
    public static $tohokubun = [
        '' => '徒歩時間を選択してください。',
        5 => '5分以内',
        10 => '10分以内',
        15 => '15分以内',
        20 => '20分以内',
        25 => '25分以内',
        30 => '30分以内',
    ];

    /**
     * 検索フォーム表示（収益物件）
     *
     * @var array
     */
    public static $rimawari = [
        '' => '指定なし',
        5 => '5％以上',
        6 => '6％以上',
        7 => '7％以上',
        8 => '8％以上',
        9 => '9％以上',
        10 => '10％以上',
        11 => '11％以上',
        12 => '12％以上',
        13 => '13％以上',
        14 => '14％以上',
        15 => '15％以上',
        16 => '16％以上',
        17 => '17％以上',
        18 => '18％以上',
        19 => '19％以上',
        20 => '20％以上',
    ];

    public static $madori = [
        '1r' =>   'ワンルーム',
        '1k' =>   '1K',
        '1dk' =>  '1DK',
        '1lk' =>  '1LK',
        '1ldk' => '1LDK',
        '2k' =>   '2K',
        '2dk' =>  '2DK',
        '2lk' =>  '2LK',
        '2ldk' => '2LDK',
        '3k' =>   '3K',
        '3dk' =>  '3DK',
        '3lk' =>  '3LK',
        '3ldk' => '3LDK',
        '4k' =>   '4K',
        '4dk' =>  '4DK',
        '4lk' =>  '4LK',
        '4ldk' => '4LDK',
        'm4ldk' => '5K以上',
    ];

    public static $createTitleItem = [
        self::BK_DATA_NAME,
        self::BK_DATA_ADDRESS,
        self::BK_DATA_MADORI,
        self::BK_DATA_MONEY,
        'skinrkin',
    ];

    public static $searchObject = [
        'ConvenienceStore' => [
            'keyWord' => ['convenience_store'],
            'title' => 'コンビニ',
            'img' => '/images/map/icon_ConvenienceStore_sdw.png',
        ],
        'laundry' => [
            'keyWord' => ['laundry'],
            'title' => 'クリーニング店',
            'img' => '/images/map/icon_laundry_sdw.png'
        ],
        'library' => [
            'keyWord' => ['library'],
            'title' => '図書館',
            'img' => '/images/map/icon_library_sdw.png'
        ],
        'supermarket' => [
            'keyWord' => ['grocery_or_supermarket'],
            'title' => 'スーパー',
            'img' => '/images/map/icon_supermarket_sdw.png',
        ],
        'depart' => [
            'keyWord' => ['department_store', 'shopping_mall'],
            'title' => '百貨店・モール',
            'img' => '/images/map/icon_depart_sdw.png',
        ],
        'post' => [
            'keyWord' => ['post_office'],
            'title' => '郵便局',
            'img' => '/images/map/icon_post_sdw.png',
        ],
        'rental' => [
            'keyWord' => ['movie_rental'],
            'title' => 'レンタルビデオ',
            'img' => '/images/map/icon_rental_sdw.png',
        ],
        'school' => [
            'keyWord' => ['school'],
            'title' => '学校',
            'img' => '/images/map/icon_school_sdw.png',
        ],
        'parking_map' => [
            'keyWord' => ['parking'],
            'title' => '駐車場',
            'img' => '/images/map/icon_parking_map_sdw.png',
        ],
        'restaurant' => [
            'keyWord' => ['restaurant'],
            'title' => 'レストラン',
            'img' => '/images/map/icon_restaurant_sdw.png',
        ],
        'bank' => [
            'keyWord' => ['bank'],
            'title' => '銀行',
            'img' => '/images/map/icon_bank_sdw.png',
        ],
        'spa' => [
            'keyWord' => ['spa'],
            'title' => '温泉・スパ',
            'img' => '/images/map/icon_spa_sdw.png',
        ],
        'hospital' => [
            'keyWord' => ['hospital'],
            'title' => '病院',
            'img' => '/images/map/icon_hospital_sdw.png',
        ],
        'park' => [
            'keyWord' => ['park'],
            'title' => '公園',
            'img' => '/images/map/icon_park_sdw.png',
        ],
        'atm' => [
            'keyWord' => ['atm'],
            'title' => 'ATM',
            'img' => '/images/map/icon_atm_sdw.png',
        ],
    ];

    public static $rentDispItemMatome = [
        self::BK_DISPITEM_KEY_MAIN => [
            self::BK_DATA_STRUCTURE,
            self::BK_DATA_BILDFLOOR,
            self::BK_DATA_MUKI,
            self::BK_DATA_BILDDATE,
        ],
        self::BK_DISPITEM_KEY_MATOME => [
            self::BK_DATA_MONEY,
            self::BK_DATA_KYOEKI,
            self::BK_DATA_SIKIKIN,
            self::BK_DATA_REIKIN,
            self::BK_DATA_HOSYOKIN,
            self::BK_DATA_SIKIBIKI,
            self::BK_DATA_MADORI,
            self::BK_DATA_AREASIZE,
            self::BK_DATA_BILDFLOOR_NOW,
            self::BK_DATA_ROOMNO,
            self::BK_DATA_NYUKYO,
        ],
    ];
    public static $tempDispItem = [
        self::BK_DATA_AREASIZE,
        self::BK_DATA_BILDFLOOR,
        self::BK_DATA_BILDFLOOR_NOW,
        self::BK_DATA_ROOMNO,
        self::BK_DATA_BILDDATE,
        self::BK_DATA_NYUKYO,
    ];
    public static $rsDispItem = [
        RS_STR_RENT => [
            self::BK_DISPITEM_KEY_MAIN => [
                self::BK_DATA_MONEY,
                self::BK_DATA_SIKIKIN,
                self::BK_DATA_REIKIN,
                self::BK_DATA_MADORI,
            ],
            self::BK_DISPITEM_KEY_SUB => [
                self::BK_DATA_AREASIZE,
                self::BK_DATA_STRUCTURE,
                self::BK_DATA_BILDFLOOR,
                self::BK_DATA_ROOMNO,
                self::BK_DATA_MUKI,
                self::BK_DATA_BILDDATE,
                self::BK_DATA_NYUKYO,
            ],
        ],
        RS_STR_SALE => [
            self::BK_DISPITEM_KEY_MAIN => [
                self::BK_DATA_MONEY,
                self::BK_DATA_KANRI,
                self::BK_DATA_MADORI,
            ],
            self::BK_DISPITEM_KEY_SUB => [
                self::BK_DATA_ROOMNO,
                self::BK_DATA_LANDSIZE,
                self::BK_DATA_BILDSIZE,
                self::BK_DATA_AREASIZE,
                self::BK_DATA_STRUCTURE,
                self::BK_DATA_BILDFLOOR,
                self::BK_DATA_MUKI,
                self::BK_DATA_PARKING,
                self::BK_DATA_BILDDATE,
                self::BK_DATA_NYUKYO,
            ],
        ],
    ];

    public static $sortOrderList = [
        RS_STR_RENT => [
            'room_type' => '間取が広い順',
            'room_type_at' => '間取が狭い順',
            'money' => '賃料が高い順',
            'money_at' => '賃料が安い順',
            'area_size' => '面積が広い順',
            'area_size_at' => '面積が狭い順',
            'floor' => '階層が高い順',
            'floor_at' => '階層が低い順',
            'created' => '登録日が新しい順',
            'created_at' => '登録日が古い順',
            'updated' => '更新日が新しい順',
            'updated_at' => '更新日が古い順',
        ],
        RS_STR_SALE => [
            'room_type' => '間取が広い順',
            'room_type_at' => '間取が狭い順',
            'money' => '金額が高い順',
            'money_at' => '金額が安い順',
            'area_size' => '専有面積が広い順',
            'area_size_at' => '専有面積が狭い順',
            'floor_area_size' => '延床面積が広い順',
            'floor_area_size_at' => '延床面積が狭い順',
            'floor' => '階層が高い順',
            'floor_at' => '階層が低い順',
            'created' => '登録日が新しい順',
            'created_at' => '登録日が古い順',
            'updated' => '更新日が新しい順',
            'updated_at' => '更新日が古い順',
        ],
    ];

    public static $imgChecker = [
        RS_STR_RENT => [
            self::IMG_TYPE_MADORI       => '',
            self::IMG_TYPE_MAP          => '',
            self::IMG_TYPE_GAIKAN       => '',
            self::IMG_TYPE_GAIKANPERS   => '',
            self::IMG_TYPE_YOUSHITSU    => '',
            self::IMG_TYPE_WASHITSU     => '',
            self::IMG_TYPE_GENKAN       => '',
            self::IMG_TYPE_KITCHEN      => '',
            self::IMG_TYPE_BATH         => '',
            self::IMG_TYPE_TOILET       => '',
            self::IMG_TYPE_WASH         => '',
            self::IMG_TYPE_LIVING       => '',
            self::IMG_TYPE_BEDROOM      => '',
            self::IMG_TYPE_CHILDROOM    => '',
            self::IMG_TYPE_STORAGE      => '',
            self::IMG_TYPE_SECURITY     => '',
            self::IMG_TYPE_FACILITY     => '',
            self::IMG_TYPE_BELANDA      => '',
            self::IMG_TYPE_YARD         => '',
            self::IMG_TYPE_PARKING      => '',
            self::IMG_TYPE_ENTRANCE     => '',
            self::IMG_TYPE_OTHER        => '',
            self::IMG_TYPE_KYOYU        => '',
        ],
        RS_STR_SALE => [
            self::IMG_TYPE_MADORI       => '',
            self::IMG_TYPE_MAP          => '',
            self::IMG_TYPE_GAIKAN       => '',
            self::IMG_TYPE_NAIKAN       => '',
            self::IMG_TYPE_KUKAKU       => '',
            self::IMG_TYPE_OTHER        => '',
        ],
    ];

    const SNS_LINK_FACEBOOK = 'facebook';
    const SNS_LINK_TWITTER = 'twitter';
    const SNS_LINK_GOOGLEP = 'googlep';

    public static $customSearch = [
        RS_STR_RENT => [
            [
                'category' => 'キッチン',
                'list' => [
                    '10_01' => [
                        'name' => 'setubi_options',
                        'text' => 'システムキッチン',
                    ],
                    '8_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ガスコンロ',
                    ],
                    '8_02' => [
                        'name' => 'setubi_options',
                        'text' => '電気コンロ',
                    ],
                    '8_03' => [
                        'name' => 'setubi_options',
                        'text' => 'IHコンロ',
                    ],
                    '9_05' => [
                        'name' => 'setubi_options',
                        'text' => '2口以上',
                    ],
                    '48_01' => [
                        'name' => 'setubi_options',
                        'text' => '食器洗浄乾燥機',
                    ],
                    '30_01' => [
                        'name' => 'setubi_options',
                        'text' => '冷蔵庫あり',
                    ],
                ],
            ],
            [
                'category' => 'バス・トイレ',
                'list' => [
                    '7_01' => [
                        'name' => 'setubi_options',
                        'text' => 'シャワー',
                    ],
                    '12_01' => [
                        'name' => 'setubi_options',
                        'text' => '追い焚き',
                    ],
                    '60_01' => [
                        'name' => 'setubi_options',
                        'text' => '浴室乾燥機',
                    ],
                    '6_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バス・トイレ別',
                    ],
                    '43_01' => [
                        'name' => 'setubi_options',
                        'text' => '温水洗浄便座',
                    ],
                    '13_01' => [
                        'name' => 'setubi_options',
                        'text' => '洗髪洗面化粧台',
                    ],
                    '61_01' => [
                        'name' => 'setubi_options',
                        'text' => '独立洗面',
                    ],
                ],
            ],
            [
                'category' => 'テレビ・通信',
                'list' => [
                    '20_01' => [
                        'name' => 'setubi_options',
                        'text' => 'CATV',
                    ],
                    '22_01' => [
                        'name' => 'setubi_options',
                        'text' => 'BSアンテナ',
                    ],
                    '21_01' => [
                        'name' => 'setubi_options',
                        'text' => 'CSアンテナ',
                    ],
                    '23_01' => [
                        'name' => 'setubi_options',
                        'text' => '有線放送',
                    ],
                    '35_01' => [
                        'name' => 'setubi_options',
                        'text' => 'インターネット対応',
                    ],
                ],
            ],
            [
                'category' => '室内設備',
                'list' => [
                    '29_01' => [
                        'name' => 'setubi_options',
                        'text' => 'フローリング',
                    ],
                    '18_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ロフト付き',
                    ],
                    '42_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バリアフリー',
                    ],
                    '62_01' => [
                        'name' => 'setubi_options',
                        'text' => '照明器具',
                    ],
                    '15_01' => [
                        'name' => 'setubi_options',
                        'text' => 'トランクルーム',
                    ],
                    '16_01' => [
                        'name' => 'setubi_options',
                        'text' => '床下収納',
                    ],
                    '17_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ウォークインクローゼット',
                    ],
                    '27_01' => [
                        'name' => 'setubi_options',
                        'text' => '出窓',
                    ],
                    '19_01' => [
                        'name' => 'setubi_options',
                        'text' => '室内洗濯機置場',
                    ],
                ],
            ],
            [
                'category' => '冷暖房',
                'list' => [
                    '38_01' => [
                        'name' => 'setubi_options',
                        'text' => '床暖房',
                    ],
                    '14_04' => [
                        'name' => 'setubi_options',
                        'text' => 'エアコン付き',
                    ],
                    '14_03' => [
                        'name' => 'setubi_options',
                        'text' => '石油暖房',
                    ],
                    '14_02' => [
                        'name' => 'setubi_options',
                        'text' => 'ガス暖房',
                    ],
                    '53_01' => [
                        'name' => 'setubi_options',
                        'text' => '灯油FF暖房',
                    ],
                    '54_01' => [
                        'name' => 'setubi_options',
                        'text' => '灯油ボイラー',
                    ],
                    '55_01' => [
                        'name' => 'setubi_options',
                        'text' => '灯油配管',
                    ],
                    '56_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ガスFF暖房',
                    ],
                    '57_01' => [
                        'name' => 'setubi_options',
                        'text' => '集中暖房',
                    ],
                ],
            ],
            [
                'category' => '入居条件',
                'list' => [
                    '1_01' => [
                        'name' => 'jyoken_options',
                        'text' => '楽器相談可',
                    ],
                    '2_01' => [
                        'name' => 'jyoken_options',
                        'text' => '事務所可',
                    ],
                    '4_01' => [
                        'name' => 'jyoken_options',
                        'text' => '２人入居可',
                    ],
                    '5_02' => [
                        'name' => 'jyoken_options',
                        'text' => '女性限定',
                    ],
                    '10_02' => [
                        'name' => 'jyoken_options',
                        'text' => 'ペット可',
                    ],
                    '16_02' => [
                        'name' => 'jyoken_options',
                        'text' => '保証人不要',
                    ],
                    '17_01' => [
                        'name' => 'jyoken_options',
                        'text' => 'ルームシェア可',
                    ],
                    '18_01' => [
                        'name' => 'jyoken_options',
                        'text' => '分譲賃貸',
                    ],
                ],
            ],
            [
                'category' => 'セキュリティ',
                'list' => [
                    '24_01' => [
                        'name' => 'setubi_options',
                        'text' => 'オートロック',
                    ],
                    '39_01' => [
                        'name' => 'setubi_options',
                        'text' => 'TVドアホン',
                    ],
                ],
            ],
            [
                'category' => '建物設備',
                'list' => [
                    '26_01' => [
                        'name' => 'setubi_options',
                        'text' => '専用庭',
                    ],
                    '25_01' => [
                        'name' => 'setubi_options',
                        'text' => 'エレベータ',
                    ],
                    '28_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バルコニー',
                    ],
                    '31_01' => [
                        'name' => 'setubi_options',
                        'text' => '宅配ボックス',
                    ],
                    '2_01' => [
                        'name' => 'setubi_options',
                        'text' => '都市ガス',
                    ],
                    '2_02' => [
                        'name' => 'setubi_options',
                        'text' => 'プロパンガス',
                    ],
                    '45_01' => [
                        'name' => 'setubi_options',
                        'text' => '耐震構造',
                    ],
                    '51_01' => [
                        'name' => 'setubi_options',
                        'text' => '融雪槽',
                    ],
                    '59_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ロードヒーティング',
                    ],
                    '46_01' => [
                        'name' => 'setubi_options',
                        'text' => 'オール電化',
                    ],
                    '11_01' => [
                        'name' => 'setubi_options',
                        'text' => '給湯',
                    ],
                ],
            ],
            [
                'category' => '駐車場',
                'list' => [
                    '2' => [
                        'name' => 'parking',
                        'text' => '駐車場有り',
                    ],
                    '32_01' => [
                        'name' => 'setubi_options',
                        'text' => '駐輪場あり',
                    ],
                    '33_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バイク置き場あり',
                    ],
                ],
            ],
            [
                'category' => 'その他',
                'list' => [
                    '44_01' => [
                        'name' => 'setubi_options',
                        'text' => 'デザイナーズ',
                    ],
                    '34_01' => [
                        'name' => 'setubi_options',
                        'text' => 'タイル貼り',
                    ],
                    '36_01' => [
                        'name' => 'setubi_options',
                        'text' => 'フリーアクセス',
                    ],
                    '50_01' => [
                        'name' => 'setubi_options',
                        'text' => '複層ガラス',
                    ],
                    '52_01' => [
                        'name' => 'setubi_options',
                        'text' => '24H管理',
                    ],
                    '40_01' => [
                        'name' => 'setubi_options',
                        'text' => '二世帯住宅',
                    ],
                    '41_01' => [
                        'name' => 'setubi_options',
                        'text' => '住宅性能保証付',
                    ],
                ],
            ],
        ],
        RS_STR_SALE => [
            [
                'category' => 'キッチン',
                'list' => [
                    '10_01' => [
                        'name' => 'setubi_options',
                        'text' => 'システムキッチン',
                    ],
                    '8_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ガスコンロ',
                    ],
                    '8_02' => [
                        'name' => 'setubi_options',
                        'text' => '電気コンロ',
                    ],
                    '8_03' => [
                        'name' => 'setubi_options',
                        'text' => 'IHコンロ',
                    ],
                    '9_06' => [
                        'name' => 'setubi_options',
                        'text' => '3口以上',
                    ],
                    '48_01' => [
                        'name' => 'setubi_options',
                        'text' => '食器洗浄乾燥機',
                    ],
                    '30_01' => [
                        'name' => 'setubi_options',
                        'text' => '冷蔵庫あり',
                    ],
                ],
            ],
            [
                'category' => 'バス・トイレ',
                'list' => [
                    '7_01' => [
                        'name' => 'setubi_options',
                        'text' => 'シャワー',
                    ],
                    '12_01' => [
                        'name' => 'setubi_options',
                        'text' => '追い焚き',
                    ],
                    '60_01' => [
                        'name' => 'setubi_options',
                        'text' => '浴室乾燥機',
                    ],
                    '6_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バス・トイレ別',
                    ],
                    '43_01' => [
                        'name' => 'setubi_options',
                        'text' => '温水洗浄便座',
                    ],
                    '13_01' => [
                        'name' => 'setubi_options',
                        'text' => '洗髪洗面化粧台',
                    ],
                ],
            ],
            [
                'category' => 'テレビ・通信',
                'list' => [
                    '20_01' => [
                        'name' => 'setubi_options',
                        'text' => 'CATV',
                    ],
                    '22_01' => [
                        'name' => 'setubi_options',
                        'text' => 'BSアンテナ',
                    ],
                    '21_01' => [
                        'name' => 'setubi_options',
                        'text' => 'CSアンテナ',
                    ],
                    '23_01' => [
                        'name' => 'setubi_options',
                        'text' => '有線放送',
                    ],
                    '35_01' => [
                        'name' => 'setubi_options',
                        'text' => 'インターネット対応',
                    ],
                ],
            ],
            [
                'category' => '室内設備',
                'list' => [
                    '29_01' => [
                        'name' => 'setubi_options',
                        'text' => 'フローリング',
                    ],
                    '18_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ロフト付き',
                    ],
                    '42_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バリアフリー',
                    ],
                    '15_01' => [
                        'name' => 'setubi_options',
                        'text' => 'トランクルーム',
                    ],
                    '16_01' => [
                        'name' => 'setubi_options',
                        'text' => '床下収納',
                    ],
                    '17_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ウォークインクローゼット',
                    ],
                    '27_01' => [
                        'name' => 'setubi_options',
                        'text' => '出窓',
                    ],
                    '19_01' => [
                        'name' => 'setubi_options',
                        'text' => '室内洗濯機置場',
                    ],
                ],
            ],
            [
                'category' => '冷暖房',
                'list' => [
                    '38_01' => [
                        'name' => 'setubi_options',
                        'text' => '床暖房',
                    ],
                    '14_04' => [
                        'name' => 'setubi_options',
                        'text' => 'エアコン付き',
                    ],
                    '14_03' => [
                        'name' => 'setubi_options',
                        'text' => '石油暖房',
                    ],
                    '14_02' => [
                        'name' => 'setubi_options',
                        'text' => 'ガス暖房',
                    ],
                    '53_01' => [
                        'name' => 'setubi_options',
                        'text' => '灯油FF暖房',
                    ],
                    '54_01' => [
                        'name' => 'setubi_options',
                        'text' => '灯油ボイラー',
                    ],
                    '55_01' => [
                        'name' => 'setubi_options',
                        'text' => '灯油配管',
                    ],
                    '56_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ガスFF暖房',
                    ],
                    '57_01' => [
                        'name' => 'setubi_options',
                        'text' => '集中暖房',
                    ],
                ],
            ],
            [
                'category' => '入居条件',
                'list' => [
                    '1_01' => [
                        'name' => 'jyoken_options',
                        'text' => '楽器相談可',
                    ],
                    '10_02' => [
                        'name' => 'jyoken_options',
                        'text' => 'ペット可',
                    ],
                    '2_01' => [
                        'name' => 'jyoken_options',
                        'text' => '事務所可',
                    ],
                    '11_02' => [
                        'name' => 'jyoken_options',
                        'text' => '建築条件無',
                    ],
                ]
            ],
            [
                'category' => 'セキュリティ',
                'list' => [
                    '24_01' => [
                        'name' => 'setubi_options',
                        'text' => 'オートロック',
                    ],
                    '39_01' => [
                        'name' => 'setubi_options',
                        'text' => 'TVドアホン',
                    ],
                ],
            ],
            [
                'category' => '建物設備',
                'list' => [
                    '26_01' => [
                        'name' => 'setubi_options',
                        'text' => '専用庭',
                    ],
                    '25_01' => [
                        'name' => 'setubi_options',
                        'text' => 'エレベータ',
                    ],
                    '28_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バルコニー',
                    ],
                    '31_01' => [
                        'name' => 'setubi_options',
                        'text' => '宅配ボックス',
                    ],
                    '2_01' => [
                        'name' => 'setubi_options',
                        'text' => '都市ガス',
                    ],
                    '2_02' => [
                        'name' => 'setubi_options',
                        'text' => 'プロパンガス',
                    ],
                    '45_01' => [
                        'name' => 'setubi_options',
                        'text' => '耐震構造',
                    ],
                    '51_01' => [
                        'name' => 'setubi_options',
                        'text' => '融雪槽',
                    ],
                    '59_01' => [
                        'name' => 'setubi_options',
                        'text' => 'ロードヒーティング',
                    ],
                    '46_01' => [
                        'name' => 'setubi_options',
                        'text' => 'オール電化',
                    ],
                    '11_01' => [
                        'name' => 'setubi_options',
                        'text' => '給湯',
                    ],
                    '47_01' => [
                        'name' => 'setubi_options',
                        'text' => '太陽光発電',
                    ],
                ],
            ],
            [
                'category' => '駐車場',
                'list' => [
                    '2' => [
                        'name' => 'parking',
                        'text' => '駐車場有り',
                    ],
                    '32_01' => [
                        'name' => 'setubi_options',
                        'text' => '駐輪場あり',
                    ],
                    '33_01' => [
                        'name' => 'setubi_options',
                        'text' => 'バイク置き場あり',
                    ],
                ],
            ],
            [
                'category' => 'その他',
                'list' => [
                    '44_01' => [
                        'name' => 'setubi_options',
                        'text' => 'デザイナーズ',
                    ],
                    '34_01' => [
                        'name' => 'setubi_options',
                        'text' => 'タイル貼り',
                    ],
                    '36_01' => [
                        'name' => 'setubi_options',
                        'text' => 'フリーアクセス',
                    ],
                    '50_01' => [
                        'name' => 'setubi_options',
                        'text' => '複層ガラス',
                    ],
                    '52_01' => [
                        'name' => 'setubi_options',
                        'text' => '24H管理',
                    ],
                    '40_01' => [
                        'name' => 'setubi_options',
                        'text' => '二世帯住宅',
                    ],
                    '41_01' => [
                        'name' => 'setubi_options',
                        'text' => '住宅性能保証付',
                    ],
                    '49_01' => [
                        'name' => 'setubi_options',
                        'text' => 'リフォーム',
                    ],
                ],
            ],
        ],
    ];

}
