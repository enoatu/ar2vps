<?php
//00 */1
include "../../atsushi/ar2vps_e/appkey.php";

$_POST["a"]= "アプリ";    $si="アプリ";
$addwords=["出合い","どのアプリ","どんなアプリ","このアプリ","続きはアプリで","欲しいアプリ",
    "アプリ消し","くそアプリ","クソアプリ","ゴミアプリ","アプリ始め","たぶんアプリ"
    ,$si."で",$si."の",$si."を",$si."に",$si."へ",$si."と",$si."から",
    $si."より",$si."ばかり",$si."まで",$si."だけ",$si."ほど",$si."くらい",
    $si."も",$si."しか",$si."さえ",
    "面白いアプリないかな","なんかおもしろいアプリ","なんか面白いアプリ","なにか面白いアプリ",
    "何かおもしろいアプリ","なにかおもしろいアプリ","何か面白いアプリ",
    "何か良いアプリ","何かいいアプリ","なんかいいアプリ","なんか良いアプリ",
    "なんか楽しいアプリ","アプリアイデア","アプリアイディア","なんかおもろいアプリ",
    "何かおもろいアプリ","なんかいいアプリないかな","なんかいいアプリとかないんかな","何か良いアプリとかないんかな",
    "音楽アプリ",
    "多分アプリ","なんかいい音楽アプリ","なんか良い音楽アプリ","アップデート","アプデ","メンテ","インストール","もらえるアプリ"];

$sql = "SELECT tweet_id FROM app_tb2 WHERE tweet_id=(SELECT MAX(tweet_id) FROM app_tb2)";
include "cronbase.php";
?>