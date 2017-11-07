<?php
ini_set( 'display_errors', 1 );
/**
 * Created by PhpStorm.
 * User: enon51
 * Date: 2017/07/25
 * Time: 19:03DATE_FORMAT(T2.time,'%Y/%m/%d %H:%i') >= :ddd AND
 */
require_once "../utils.php";
$ddd=date("Y/m/d H:i",strtotime("-2 day"));
var_dump($ddd);
try{
    $sql="CREATE TABLE apptable AS
(SELECT T1.id FROM app_tb2 T1 WHERE DATE_FORMAT(T1.time,'%Y/%m/%d %H:%i') >= :ddd AND EXISTS
(SELECT* FROM app_tb2 T2 WHERE T1.ツイート=T2.ツイート AND T1.id != T2.id))";
    $stm = getDB()->prepare($sql);
    $stm->bindValue(':ddd',$ddd);
    $stm->bindValue(':ddd',$ddd);
    $stm->execute();
    $sql="UPDATE app_tb2 SET ツイート = NULL WHERE app_tb2.time >= :ddd
AND id IN (SELECT* FROM apptable)";
    $stm = getDB()->prepare($sql);
    $stm->bindValue(':ddd',$ddd);
    $stm->execute();
    $sql="DROP TABLE apptable";
    $stm = getDB()->prepare($sql);
    $stm->execute();
} catch (Exception $e) {
    echo '<span class="error">appDB optimizeエラーがありました</span><br>';
    echo $e->getMessage();
    exit();
}

//
//
//try {
//    getDB()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//    getDB()->beginTransaction();
//    $q1=getDB()->prepare("CREATE TABLE apptable AS
//(SELECT T1.id FROM app_tb2 T1 WHERE DATE_FORMAT(T1.time,'%Y/%m/%d %H:%i') >= :ddd AND EXISTS
//(SELECT* FROM app_tb2 T2 WHERE T1.ツイート=T2.ツイート AND T1.id != T2.id))");
//    $q2=getDB()->prepare("UPDATE app_tb2 SET ツイート = NULL WHERE app_tb2.time >= :ddd
//AND id IN (SELECT* FROM apptable)");
//    $q3=getDB()->prepare("DROP TABLE apptable");
//    $q1->bindValue(':ddd',$ddd);
//    $q2->bindValue(':ddd',$ddd);
//    $q1->execute();
//    $q2->execute();
//    $q3->execute();
//    getDB()->commit();
//
//} catch (Exception $e) {
//    getDB()->rollBack();
//    echo "appDB optimizeエラーがありました" . $e->getMessage();
//}