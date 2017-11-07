<?php


//require("do2form.php");
require "../vendor/autoload.php";
require_once "../lib_es/lib/util.php";
require_once "utils.php";
//require "TwistOAuth.phar/TwistOAuth.php"
?>
    <link rel="stylesheet" href="style/cssinputform.css" type="text/css">
<?php
//$consumer_key = 'xZMkwValOe89McpYTyDKifsOR';
//$consumer_secret = 'msFGHF7KXAxfNjd1DGNQMw09yXMr1F0d7bisDLcZnzjNPRdw4J';
//$access_token = '3369138733-T9yxhTpy66Eod0cNm8MAlWohI9SbhmKqMxSkKrX';
//$access_token_secret = 'T8w4gpgwMv3ro4mnTRoYWfmBTbgWBK0tmPA8JWevDpsOe';
$consumer_key = 'mvN2fgA1QW2tk5iaIvo0dgEuQ';
$consumer_secret = 'oBY0TedaWkEmdcbLlzL06EFkDHy5w6POjVEhrwSBCH0grvgAx8';
$access_token = '3369138733-vXQMnTEBD2kNVSBlTbiYhMDBURntqYmsBKwFPKB';
$access_token_secret = 'IPggQMzvhtw4n0EsF8I8IMhVXx4L5feOQ4tcDlk4W7YBc';


$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
// キーワードによるツイート検索

//    $sql="SELECT* FROM trend_tb2 AS t WHERE t.trend=";
//    $stm = getDB()->prepare($sql);
//    $stm->execute();
//    $result = $stm->fetchAll(PDO::FETCH_ASSOC);


$trends = $connection->get('trends/place', ['id' => '90036018']);

$getdatePH = date("Y-m-d H:i:s");
//var_dump($trends);
$onetrend=[];
for($i=1;$i<=50;$i++){

        $onetrend=$trends[0]->trends[$i-1]->name;
        if($trends[$i-1]->name==null) {
            $rank = 0;
        }else{
            $rank=$i;
        }
    var_dump($onetrend,$rank);
    inserttrendDB($onetrend,$rank,$getdatePH);

        }

function inserttrendDB($onetrend,$rank,$getdatePH){
$sql = "INSERT trend_tb(trend,rank,getdate) VALUES(:trendPH,:rank,:getdatePH)";
$stm = getDB()->prepare($sql);
$stm->bindParam(':trendPH', $onetrend, PDO::PARAM_STR);
$stm->bindParam(':rank', $rank, PDO::PARAM_STR);
$stm->bindParam(':getdatePH', $getdatePH, PDO::PARAM_STR);

$stm->execute();}
//
//increaceFrequency();
//function increaceFrequency(){
//    $sql="UPDATE trend_tb AS t SET t.frequency = t.frequency + 1
// WHERE t.trend IN (SELECT tc.trend FROM trend_c AS tc)";
//    $stm = getDB()->prepare($sql);
//    $stm->execute();
//}
//
//
//
//deleterecords();
//function deleterecords(){
//    $sql="DELETE FROM trend_c";
//    $stm = getDB()->prepare($sql);
//    $stm->execute();
//}
