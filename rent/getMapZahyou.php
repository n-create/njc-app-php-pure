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
$jsonData = (new SearchItemHelper())->getMapZahyouData(RS_STR_RENT);
(new JsonHelper())->viewJson($jsonData);
?>
