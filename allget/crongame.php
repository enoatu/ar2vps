<?php
//00 */1
$consumer_key = 'mvN2fgA1QW2tk5iaIvo0dgEuQ';
$consumer_secret = 'oBY0TedaWkEmdcbLlzL06EFkDHy5w6POjVEhrwSBCH0grvgAx8';
$access_token = '3369138733-vXQMnTEBD2kNVSBlTbiYhMDBURntqYmsBKwFPKB';
$access_token_secret = 'IPggQMzvhtw4n0EsF8I8IMhVXx4L5feOQ4tcDlk4W7YBc';

$_POST["a"]= "ゲーム";    $si="ゲーム";
$addwords=["クソアプリ","ゴミアプリ","アプリ始め","たぶんアプリ"
    ,$si."で",$si."の",$si."を",$si."に",$si."へ",$si."と",$si."から",
    $si."より",$si."ばかり",$si."まで",$si."だけ",$si."ほど",$si."くらい",
    $si."も",$si."しか",$si."さえ"];

$sql = "SELECT tweet_id FROM game_tb2 WHERE tweet_id=(SELECT MAX(tweet_id) FROM game_tb2)";
include "cronbase.php";
?>
