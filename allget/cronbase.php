<?php
//require_once "arro_insert.php";
//require("do2form.php");
require "../vendor/autoload.php";
require_once "../lib_es/lib/util.php";
include "utils.php";
//require "TwistOAuth.phar/TwistOAuth.php"
?>
<link rel="stylesheet" href="style/cssinputform.css" type="text/css">
<?php
$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

// キーワードによるツイート検索

$statuses = array(); //すべてのツイート用の配列

$stm = getDB()->prepare($sql);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $rr){
    $lasttweet=es($rr["tweet_id"]);
}
global $lasttweet;echo $lasttweet;

for ($i = 0; $i < 3200; $i += 200) {
    //200件取得
    $tweets_params = ['q' => ultimateHoge(), 'count' => '200'];
    if (isset($max_id)) {
        $tweets_params['max_id'] = $max_id;
    }


    $tweets = $connection->get('search/tweets', $tweets_params)->statuses;

// ハッシュタグによるツイート検索
    $hash_params = ['q' => '#html5,#css3', 'count' => '10', 'lang' => 'ja'];
    $hash = $connection->get('search/tweets', $hash_params)->statuses;

// 指定位置（geo情報）から投稿されたツイート検索
    $geo_params = ['geocode' => '35.710063,139.8107,0.2km', 'count' => '10'];
    $geo = $connection->get('search/tweets', $geo_params)->statuses;

// 自分のタイムラインを取得
    $home_params = ['count' => '10'];
    $home = $connection->get('statuses/home_timeline', $home_params);

// 自分のツイートを取得
    $user_params = ['count' => '10'];
    $user = $connection->get('statuses/user_timeline', $user_params);

// ニックネームからユーザ情報を取得
    $users_params = ['screen_name' => 'yokoh9'];
    $users = $connection->get('users/show', $users_params);


    global $tweets, $tweets_params;
    global $filtering_words0;

global $addwords;
    $filtering_words=array_merge($filtering_words0,$addwords);
//    var_dump($filtering_words);
    foreach ($tweets as $value) {
        $text = htmlspecialchars($value->text, ENT_QUOTES, 'UTF-8', false);
        // 検索キーワードをマーキング
        //superHelloWorld($text);
        //function superHelloWorld($text,$filtering_words){
        $tweet_id = $value->id_str;

        $keywords = preg_split('/,|\sOR\s/', $tweets_params['q']); //配列化
        foreach ($keywords as $key) {
            for ($i = 0; $i < count($filtering_words); $i++) {//一つのツイートをfor文で回す
                $result2 = mb_strpos($text, $filtering_words[$i]);//ツイートが結合した配列に入っているか検索
                if ($result2 === false) {//入っていなかったら
                    //有害ワードはなかった
                    $harm = false;
                } else {
                    $harm = true;//有害ワードあり
                    break;//高速化
                    //$text = "このツイートはフィルタリングにひっかかりました笑";

                    //$harm=false;

                }
            }

            if($lasttweet!==null){
                //$lasttweet(DB最後のツイid)にデータが入っているとき(DBが空じゃないとき)
                if($tweet_id <= $lasttweet) {
                    //もし$tweet_id(取得ツイid)が$lasttweet(DB最後のツイid)より小さいもしくは等しかったら
                    echo "--tweet_id--", $tweet_id, "--lasttweet--" . $lasttweet;
                    goto end;

                } }
            $text = str_ireplace($key, '<span class="keyword">' . $key . '</span>', $text);
        }

        // ツイート表示のHTML生成
        global $harm,$name_filtering_words;

        for ($j = 0; $j < count($name_filtering_words); $j++) {
            $result3 = mb_strpos($value->user->name, $name_filtering_words[$j]);
            if ($result3 === false) {
                $harm2 = false;
                //なまえに有害ワードなかった
            } else {
                $harm2 = true;
                break;
            }

        }


        //$harm=true;
        global $harm,$harm2,$value,$text;
        if ($harm===false && $harm2 === false) {
            disp_tweet($value, $text);
        }
    }

    global $tweets;
    if (count($tweets) == 0) { //取得件数0だったら終了
        echo "<br>取得件数0";
        break;
    } else {
        //echo "取得したツイートがあった時";
        $statuses = array_merge($statuses, $tweets); //配列の最後に追加
        $max_id = $tweets[count($tweets) - 1]->id - 1; //取得した最古のツイートのidを保存
    }
} end:

var_dump($filtering_words);


?>

