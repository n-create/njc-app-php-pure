<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
   $path = parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH);
   if("/" === $path) {
       $path = "index";
   } else {
       $path = substr($path, 1);
       $path = str_replace("/", "_", $path);
       $path = str_replace(".php", "", $path);
   }
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>NJC-APPテストページ</title>
    <link rel="stylesheet" type="text/css" href="/css/njc/main.css?_=20180827042722" />
    <link rel="stylesheet" type="text/css" href="/css/components/bootstrap/bootstrap.min.css?_=20180827042722" />
    <link rel="stylesheet" type="text/css" href="/css/components/jquery/jquery-ui.min.css?_=20180827042722" />
    <script type="text/javascript" src="/js/components/jquery/jquery-3.3.1.min.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/components/jquery/jquery-migrate-3.0.0.min.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/components/jquery/jquery-ui/jquery-ui.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/components/jquery/jquery-ui/jquery-ui.custom.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/components/jquery/jquery-ui/jquery.ajaxDialog.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/components/bootstrap/bootstrap.min.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/components/popper/popper.min.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/njc/linkInputLabel.js?_=20180827042722"></script>
    <script type="text/javascript" src="/js/njc/searchCheckVaild.js?_=20180827042722"></script>
    <meta property="og:url" content="http://grape-dev.aws8.njc-web.info/rent/index" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="〇〇不動産" />
    <meta property="og:description" content="〇〇不動産のサイトです" />
    <meta property="og:image" content="http://grape-dev.aws8.njc-web.info/images/main_img.png" />
</head>
<body class="<?= $path; ?> public-body">
    <div class="inner-header-contents-wrap content1">
        <div id="header-contents-wrap">
            <div class="bg-dark">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar navbar-dark row">
                        <a href="/" class="navbar-brand">○○不動産</a>
                        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-around">
                            <ul class="nav navbar-nav">
                                <li class="nav-item"><a href="/" class="nav-link">ホーム</a></li>
                            </ul>
                            <ul class="nav navbar-nav">
                                <li class="nav-item dropdown">
                                    <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">賃貸物件検索</a>
                                    <div class="dropdown-menu">
                                        <a href="/rent/search.php" class="dropdown-item">条件から検索</a>
                                        <a href="/rent/railway.php" class="dropdown-item">沿線・駅から検索</a>
                                        <a href="/rent/city.php" class="dropdown-item">地域から検索</a>
                                        <a href="/rent/school.php" class="dropdown-item">学校区から検索</a>
                                        <a href="/rent/map.php" class="dropdown-item">地図から検索</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav">
                                <li class="nav-item dropdown">
                                    <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">売買物件検索</a>
                                    <div class="dropdown-menu">
                                        <a href="/sale/search.php" class="dropdown-item">条件から検索</a>
                                        <a href="/sale/railway.php" class="dropdown-item">沿線・駅から検索</a>
                                        <a href="/sale/city.php" class="dropdown-item">地域から検索</a>
                                        <a href="/sale/school.php" class="dropdown-item">学校区から検索</a>
                                        <a href="/sale/map.php" class="dropdown-item">地図から検索</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
