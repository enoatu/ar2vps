<?php
require_once("../../lib_es/lib/util.php");
require_once("../../lib_es/lib/util.php");
?>
<!DOCTYPE html>
<? require_once("table_utils.php");
$title ="ArroganciAのツイート取得結果";
createHeader($title);
?>
<body>
<h1>需要のあるアプリ一覧</h1>
<?
$user = 'a1221_arrogancia';
$password = 'adgjmpt3';
$dbName = 'a1221_arrogancia';
$host = 'mysql1.php.xdomain.ne.jp';
// $host = 'mysql1.php.xdomain.ne.jp';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";//mysqlのDSN文字列
try {
    $pdo = new PDO($dsn, $user, $password);
//プリペアドステートメントのエミュレーションを無効化
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//例外がスローされる設定にする
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "データベース{$dbName}に接続しました。", "<br>";

    $sql = "SELECT tweet_id,ツイート,ユーザー名,アカウント名,id,time FROM app_tb2 ORDER BY tweet_id DESC";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);


    echo "<table>";
    echo "<thead><tr>";
    echo "<th>", "tweet_id", "</th>";
    echo "<th>", "ツイート", "</th>";
    echo "<th>", "ユーザー名", "</th>";
    echo "<th>", "アカウント名", "</th>";
    echo "<th>", "id", "</th>";
    //echo "<th>", "RT数", "</th>";
    echo "<th>", "time", "</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>", es($row['tweet_id']), "</td>";
        echo "<td>", es($row['ツイート']), "</td>";
        echo "<td>", es($row['ユーザー名']), "</td>";
        echo "<td>", es($row['アカウント名']), "</td>";
        echo "<td>", es($row['id']), "</td>";
        //echo "<td>", es($row['RT数']), "</td>";
        echo "<td>", es($row['time']), "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

} catch (Exception $e) {
    echo '<span class="error">エラーがありました</span><br>';
    echo $e->getMessage();
    exit();
}


?>

</body>
<? createFooter();?>