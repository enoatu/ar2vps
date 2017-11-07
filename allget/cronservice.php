<?php //30 */1
include "../../atsushi/ar2vps_e/servicekey.php";

$_POST["a"]= "サービス";
$si="サービス";
$addwords=["出合い","どのサービス","どんなサービス","このサービス"
    ,$si."で",$si."の",$si."を",$si."に",$si."へ",$si."と",$si."から",
    $si."より",$si."ばかり",$si."まで",$si."だけ",$si."ほど",$si."くらい",
    $si."も",$si."しか",$si."さえ"
];
$sql = "SELECT tweet_id FROM service_tb2 WHERE tweet_id=(SELECT MAX(tweet_id) FROM service_tb2)";
include "cronbase.php";
?>