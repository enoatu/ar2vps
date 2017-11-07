<?php
/**
 * Created by PhpStorm.
 * User: s3701
 * Date: 2017/06/21
 * Time: 11:51
 */


$filtering_words0 = [
    //18禁 商業系
    "稼", "[PR]",  "アフィリエイト", "副業","通販サイト更新","[宣伝]","無料配布","そんなあなた","そんなアナタ",
    //18禁系
    "出逢い", "エロ", "エッチ", "卑猥","犯","出会い","セックス",
    "裏垢", "AV","セフレ","童貞","ムラムラ", "アダルト",
    //特殊
    "https://", "http://","RT", "@", "定期","OK",
    "われわれ自身","教えます","淫夢","エラー","威力",
    "洗脳","送ってね","攻略","ございます","求人","バグ",
    //そんなにうまく世界はできていないんだよw系
    "無料で音楽","無料音楽","無料で動画","曲ダウンロード","無料で漫画",
    "音楽ダウンロード","無料で見れる","無料でみれる","タダで音楽","タダで動画","ネトウヨ",
    "タダで見れる",
    //欲しい系
    "辞めてほしい","どうにかしてほしい","どうにかして欲しい","広まってほしい","広まって欲しい",
    "やってほしい","やって欲しい","おって欲しい","消えてほしい","消えて欲しい","潰れて欲しい","つぶれてほしい",
    "潰れてほしい","つぶれて欲しい","知ってほしい","みてください","見て下さい",
    "見てください",
    "止めてほしい","教えてほしい","教えて欲しい","にしてほしい","欲しいもの","欲しい物",
    //言葉系
   "いますか","やってます","わけわかんない","ふざけないでほしい","ふざけないで欲しい",
    "して下さい","してください","してくれます","んですよ","いただきます","頂きます","しています","あります",
    "しております","問い合わせは","送ります","気になる方は","いい音楽","募集します",
    //他社ゲーム系
    "うた☆プリ","うたプリ","ツキウタ","松アプリ","おそ松さん","松",
    "ドリフェス","Bプロ","B-PROJECT","刀剣","人狼","パズドラ","シノアリス","シンフォギア",
    "ミリシタ","アイナナ","あんスタ","あんさんぶるスターズ","A3","あんガル","デュエル","ミリオンアーサー",
    "バンドリ","ドラゴンボール","パンドリ","パチンコ","まどマギ","白猫","レイトン","ぶつぶつなんき",
    "FGO","ミラクルニキ","モンスト","デレステ","艦これ","ほしいカード","欲しいカード","ほしいゲーム",
    "欲しいゲーム","配布UR","確定ガチャ","SSR","対応して欲しい","対応してほしい","サービス終了",
    "フルボイス","おすすめ","事前登録"];
//フィルタリング候補　"稼","します"

$name_filtering_words=["bot","アフィリエイト","自動","公式","app","フリマアプリ",
    "高収入","紹介","アプリ","App"];

function getDB()
{
    $host = "localhost";
    $user = "user2";
    $password = "pass";
    $dbName = "user2db";
    // $host = 'mysql1.php.xdomain.ne.jp';
    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";//mysqlのDSN文字列
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //例外がスローされる設定にする
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

    //プリペアドステートメントのエミュレーションを無効化


        $greed = ["ほしい","欲しい","ないんかな","ないかな","作ってほしい","誰かつくって","つくって欲しい",
            "あったら助か",
            "あったらいい","ったら嬉しい","あればいい","需要有り","需要ある","需要あり"];





function disp_tweet($value, $text){
    $icon_url = $value->user->profile_image_url;
    $screen_name = $value->user->screen_name;
    $name = $value->user->name;
    $updated = date('Y/m/d H:i', strtotime($value->created_at));
    $tweet_id = $value->id_str;
    $url = 'https://twitter.com/' . $screen_name . '/status/' . $tweet_id;
    // $_SESSION['screen_name']=$screen_name;
    //$_SESSION['text']=$text;
    //$_SESSION['updated']=$updated;
    echo '<div class="tweetbox">' . PHP_EOL;
    echo '<div class="thumb">' . '<img alt="" src="' . $icon_url . '">' . '</div>' . PHP_EOL;
    echo $name. PHP_EOL;
    echo '<div class="meta"><a target="_blank" href="' . $url . '">' . $updated . '</a>' . '<br>@' . $screen_name .'</div>' . PHP_EOL;
    echo '<div class="tweet">' . $text .'</div>' . PHP_EOL;
    echo '</div>' . PHP_EOL;
    //
    try {

        //$screen_name=$_SESSION['screen_name'];
        //$text=$_SESSION['text'];
        //$updated=$_SESSION['updated'];
        //echo $text,$screen_name,$updated;
        //$screen_name, $text, $updated;
        $text = strip_tags($text);
        global $sql;
        if ($_POST["a"]== "アプリ" || $_POST["a"]== "スマホで" || $_POST["a"] == "アプリケーション") {
            $sql = "INSERT app_tb2(ツイート,ユーザー名,アカウント名,tweet_id,time) VALUES(:text,:username,:screen_name,:tweet_id,:updated)";
            //echo $_POST["a"];
        } else if ($_POST["a"] == "サイト") {
            $sql = "INSERT site_tb2(ツイート,ユーザー名,アカウント名,tweet_id,time) VALUES(:text,:username,:screen_name,:tweet_id,:updated)";
            //echo $_POST["a"];
        } else if ($_POST["a"] == "サービス") {
            $sql = "INSERT service_tb2(ツイート,ユーザー名,アカウント名,tweet_id,time) VALUES(:text,:username,:screen_name,:tweet_id,:updated)";
            //echo $_POST["a"];
        } else if ($_POST["a"] == "システム") {
            $sql = "INSERT system_tb2(ツイート,ユーザー名,アカウント名,tweet_id,time) VALUES(:text,:username,:screen_name,:tweet_id,:updated)";
            //echo $_POST["a"];
        }else if ($_POST["a"] == "ゲーム"){
                $sql = "INSERT game_tb2(ツイート,ユーザー名,アカウント名,tweet_id,time) VALUES(:text,:username,:screen_name,:tweet_id,:updated)";
        }else {echo "テーブル分岐に失敗しました。";};
        //($text,$screen_name,$updated)";
        $stm = getDB()->prepare($sql);
        //$stm = $pdo->prepare($sql);
        $screen_name = "@".$screen_name;
        $stm->bindParam(':text', $text, PDO::PARAM_STR);
        $stm->bindParam(':username', $name, PDO::PARAM_STR);
        $stm->bindParam(':screen_name', $screen_name, PDO::PARAM_STR);
        $stm->bindParam(':tweet_id', $tweet_id, PDO::PARAM_STR);
        $stm->bindParam(':updated', $updated, PDO::PARAM_STR);
        $stm->execute();

    } catch (Exception $e) {
        echo '<span class="error">insertエラーがありました</span><br>';
        echo $e->getMessage();
        exit();
    }
}

            function ultimateHoge()
            {/*global $radio;
            $radio = "アプリ";
                if($_POST["a"]!==null){
                    $radio = $_POST["a"];
                }*/
                $radio = $_POST["a"];
                //$arro1 = ["アプリ", "サイト","アプリケーション","スマホで", "サービス", "システム"];
                //$greed = ["ほしい","欲しい","ありませんか","誰か　教えて", "ない？", "ありませんか","教えて", "作って","つくって", "あればいい","需要有り","需要ある","需要あり"];
                global $greed;

                $glue = "　OR　";
                $greed_or = implode($glue,$greed);

                //$filtering=["NOT 出会い"];NOTワード失敗
                $filtering=[];
                //$delite_linktw=["-filter:links"];URL排除失敗
                $delite_linktw=[];
                $arro2=array_merge($filtering,$delite_linktw);
                $string =implode(" ",$arro2);

                $arro4 = trim($radio)."\x2C"." ".$greed_or." ".$string;
                //echo "<h3>検索内容:</h3>",$arro4,"<br><br><hr>";

                /*for ($L = 0; $L < count($arro1); $L++) {
                    for ($M = 0; $M < count($arro2); $M++) {

                        global $ultimateHoge;
                        $ultimateHoge=$arro1[$L].' '.$arro2[$M];
                        echo $ultimateHoge;
                    }
                }*/
                return $arro4;
            }

?>




