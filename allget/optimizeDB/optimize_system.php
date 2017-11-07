<?php
/**
 * Created by PhpStorm.
 * User: enon51
 * Date: 2017/07/21
 * Time: 23:55
 */
require_once "../utils.php";

$ddd=date("Y/m/d H:i",strtotime("-2 day"));
var_dump($ddd);
try{
    $sql="CREATE TABLE systemtable AS
(SELECT T1.id FROM system_tb2 T1 WHERE DATE_FORMAT(T1.time,'%Y/%m/%d %H:%i') >= :ddd AND EXISTS
(SELECT* FROM system_tb2 T2 WHERE T1.ツイート=T2.ツイート AND T1.id != T2.id))";
    $stm = getDB()->prepare($sql);
    $stm->bindValue(':ddd',$ddd);
    $stm->bindValue(':ddd',$ddd);
    $stm->execute();
    $sql="UPDATE system_tb2 SET ツイート = NULL WHERE system_tb2.time >= :ddd
AND id IN (SELECT* FROM systemtable)";
    $stm = getDB()->prepare($sql);
    $stm->bindValue(':ddd',$ddd);
    $stm->execute();
    $sql="DROP TABLE systemtable";
    $stm = getDB()->prepare($sql);
    $stm->execute();
} catch (Exception $e) {
    echo '<span class="error">appDB optimizeエラーがありました</span><br>';
    echo $e->getMessage();
    exit();
}


//try{
//    $sql="CREATE TABLE systemtable AS (SELECT T1.id FROM system_tb2 T1 WHERE EXISTS
//(SELECT* FROM system_tb2 T2 WHERE T1.ツイート=T2.ツイート AND T1.id != T2.id))";
//    $stm = getDB()->prepare($sql);
//    $stm->execute();
//    $sql="UPDATE system_tb2 SET ツイート = NULL WHERE id IN (SELECT* FROM systemtable)";
//    $stm = getDB()->prepare($sql);
//    $stm->execute();
//    $sql="DROP TABLE systemtable";
//    $stm = getDB()->prepare($sql);
//    $stm->execute();
//
//} catch (Exception $e) {
//    echo '<span class="error">systemDB optimezeエラーがありました</span><br>';
//    echo $e->getMessage();
//    exit();
//}

//
//try {
//    getDB()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//    getDB()->beginTransaction();
//    getDB()->exec("CREATE TABLE systemtable AS (SELECT T1.id FROM system_tb2 T1 WHERE EXISTS 
//(SELECT* FROM system_tb2 T2 WHERE T1.ツイート=T2.ツイート AND T1.id != T2.id))");
//    getDB()->exec("UPDATE system_tb2 SET ツイート = NULL WHERE id IN (SELECT* FROM systemtable)");
//    getDB()->exec("DROP TABLE systemtable");
//    getDB()->commit();
//
//} catch (Exception $e) {
//    getDB()->rollBack();
//    echo "appDB optimizeエラーがありました" . $e->getMessage();
//}