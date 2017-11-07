<?php
//45 */1

include "../../atsushi/ar2vps_e/syskey.php";

$_POST["a"]= "システム";
$si=$_POST['a'];
$addwords=[
    "システムです", "出合い","どのシステム","どんなシステム","このシステム"
    //助詞
    ,$si."で",$si."の",$si."を",$si."に",$si."へ",$si."と",$si."から",
    $si."より",$si."ばかり",$si."まで",$si."だけ",$si."ほど",$si."くらい",
    $si."も",$si."しか",$si."さえ"
];
$sql = "SELECT tweet_id FROM system_tb2 WHERE tweet_id=(SELECT MAX(tweet_id) FROM system_tb2)";

include "cronbase.php";
?>

