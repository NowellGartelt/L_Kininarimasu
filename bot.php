<?php
//=============================
//EasyBotterを呼び出します
//=============================
require_once("EasyBotter.php");
$eb = new EasyBotter();

//=============================
//botの動作をこの下に記述していきます。
//PHPでは先頭に//がある行はコメント扱いなので実行しません。実行したい行の先頭の//を削除してください。
//=============================

// 以下、2分ごとにcronで実行する想定

// 出力ログの設定
$botLog = "log/bot.log";
// $phpName = "bot.php";
$phpName = basename($_SERVER['PHP_SELF']);

// ログ出力モジュールの設定
require_once 'tools/botLogger.php';

// 時刻処理ここから
$botLogger = new botLogger($botLog, $phpName, "時刻処理：開始");

// 現在時刻の取得
require_once 'tools/getCurrentDateTime.php';
$currentDate = array();
$getcurrentDate = new getCurrentDateTime();
$currentDate = $getcurrentDate->getCurrentDateTime();

$botLogger = new botLogger($botLog, $phpName, "時刻処理：現在時刻取得");

// 年
$dateYear = $currentDate['dateYear'];
// 月
$dateMonth = $currentDate['dateMonth'];
// 日
$dateDay = $currentDate['dateDay'];
// 曜日
$dateWeek = $currentDate['dateWeek'];
// 時 (0なし)
$dateHour = $currentDate['dateHour'];
// 時 (0あり)
$dateHourZ = $currentDate['dateHourZ'];
// 分
$dateMinite = $currentDate['dateMinite'];
// 秒
$dateSecond = $currentDate['dateSecond'];

// ログ出力のため、曜日を数値から文字変換
require_once 'tools/exchangeWeek.php';
$exchangeWeek = new exchangeWeek($dateWeek);
$dateWeekLet = $exchangeWeek->exchangeWeek($dateWeek);

$botLogger = new botLogger($botLog, $phpName, "時刻処理：曜日文字列取得(".$dateWeekLet.")");

// 取得した時分を接続、「HHMM」の形式で保持する
$dateHM = $dateHourZ.$dateMinite;
$getType = gettype($dateHM);
$botLogger = new botLogger($botLog, $phpName, "時刻処理：形式変更保存 保存内容＝".$dateHM);

// 取得した日時を接続、「MMDD」の形式で保持する
$dateMD = $dateMonth.$dateDay;
$getType = gettype($dateMD);
$botLogger = new botLogger($botLog, $phpName, "時刻処理：形式変更保存 保存内容＝".$dateMD);

$botLogger = new botLogger($botLog, $phpName, "時刻処理：終了");
//　時刻処理、ここまで

// リプライ上限到達アカウントの記録リセット、ここから
$botLogger = new botLogger($botLog, $phpName, "リプライ上限到達アカウントの記録リセット処理：開始");

// 毎日8時、14時、20時にリプライ数上限到達アカウントの記録リセット実施
if (($dateHM == "0801" || $dateHM == "0802")
        || ($dateHM == "1401" || $dateHM == "1402")
        || ($dateHM == "2001" || $dateHM == "2002")) {
    $botLogger = new botLogger($botLog, $phpName, "リプライ上限到達アカウントのリセット処理：リセット条件分岐");
    $fp = fopen("log/kaiwalog.txt", "w");
    $botLogger = new botLogger($botLog, $phpName, "リプライ上限到達アカウントのリセット処理：リセット実行 ".$fp);
    fclose($fp);
    $botLogger = new botLogger($botLog, $phpName, "リプライ上限到達アカウントのリセット処理：ファイルクローズ");

}

$botLogger = new botLogger($botLog, $phpName, "リプライ上限到達アカウントの記録リセット処理：終了");
// リプライ上限到達アカウントの記録リセット、ここまで

// フォロー返し処理、ここから
$botLogger = new botLogger($botLog, $phpName, "フォロー返し処理：開始");

// 1～7時で1時間に1回、一括でフォロー返し実施
 if ($dateHourZ = "03" && 
         ($dateMinite == "00" || $dateMinite == "01")) {
    $botLogger = new botLogger($botLog, $phpName, "フォロー返し処理：フォロー返し条件分岐");
    $response = $eb->autoFollow();
    $botLogger = new botLogger($botLog, $phpName, "フォロー返し処理：フォロー返し実行 ");
    
}

$botLogger = new botLogger($botLog, $phpName, "フォロー返し処理：終了");
// フォロー返し処理、ここまで

// ツイート処理、ここから
$botLogger = new botLogger($botLog, $phpName, "ツイート処理：開始");

// 4月1日はエイプリルフール仕様
if (($dateMonth == "04" && $dateDay == "01") 
        && ($dateHour >= 8 && $dateHour <= 11)) {
    $botLogger = new botLogger($botLog, $phpName, "ツイート処理：エイプリルフール条件分岐");
    // 午前中だけエイプリルフール用のツイートをする
    // 8～23時の15分ごろor45分ごろにpost0401.txtをツイート
    if (($dateMinite == "14" || $dateMinite == "15") 
            || ($dateMinite == "44" || $dateMinite == "45")) {
        $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(エイプリルフール仕様)条件分岐");
        $response = $eb->postRotation("tweetBox/post/post0401.txt");
        $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(エイプリルフール仕様) ");
    }

// 4月1日以外は通常仕様	
} else {
    $botLogger = new botLogger($botLog, $phpName, "ツイート処理：通常日条件分岐");
	// 8時～23時はツイートおよびリプライする
    if ($dateHour >= 8 && $dateHour <= 23) {
        $botLogger = new botLogger($botLog, $phpName, "ツイート処理：活動時間条件分岐");
        
/*
        // 8～23時の15分にpostAnime.txtをツイート
        if ($dateMinite == "14" || $dateMinite == "15") {
            $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(アニメ関連のツイート)条件分岐");
            $response = $eb->postRandom("tweetBox/post/postAnime.txt");
            $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(アニメ関連のツイート) ");
            
		// 8～23時の45分にpostOther.txtをツイート
        } elseif ($dateMinite == "44" || $dateMinite == "45") {
            $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(その他のツイート)条件分岐");
            $response = $eb->postRandom("tweetBox/post/postOther.txt");
            $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(その他のツイート) ");
        }
*/
        // 8～23時の15分もしくは45分にツイート
        if ($dateMinite == "14" || $dateMinite == "15"
                || $dateMinite == "44" || $dateMinite == "45") {
            $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行条件分岐");
            
            // ツイートの内容を決めるため、乱数生成
            $postChoice = rand(1, 5);
            
            // 乱数1,2の場合、アニメのツイートをする
            if ($postChoice == 1 || $postChoice == 2) {
                $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(アニメ関連のツイート)条件分岐");
                $response = $eb->postRandom("tweetBox/post/postAnime.txt");
                $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(アニメ関連のツイート) ");
                
            // 乱数3,4の場合、その他のツイートをする
            } elseif ($postChoice == 3 || $postChoice == 4) {
                $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(その他のツイート)条件分岐");
                $response = $eb->postRandom("tweetBox/post/postOther.txt");
                $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(その他のツイート) ");
                
            // 乱数5の場合、Wikipediaからランダムで記事タイトルをツイートする
            } else {
                $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(Wikipedia)条件分岐");

                // Wikipedia用のツイートファイル生成
                include_once 'makePostFile.php';
                $result = new makePostFile();
                $exe = $result -> makePostFileByWikiWords();
                
                $response = $eb->postRandom("tweetBox/post/postWiki.txt");
                $botLogger = new botLogger($botLog, $phpName, "ツイート処理：ツイート実行(Wikipedia) ");
                
            }
            
        }

		// 8～23時は実行時必ずタイムライン反応する
		$response = $eb->replyTimeline(2,"tweetBox/reply/reply_pattern_tl.php");
		$botLogger = new botLogger($botLog, $phpName, "ツイート処理：タイムライン反応実行 ");
		
    }
	// 実行時必ずリプライに対し返信する
	$response = $eb->reply(2,"tweetBox/reply/reply.txt","tweetBox/reply/reply_pattern.php");
	$botLogger = new botLogger($botLog, $phpName, "ツイート処理：リプライ応答実行 ");
	
}

$botLogger = new botLogger($botLog, $phpName, "ツイート処理：終了");
// ツイート処理、ここまで
	
// 挨拶ツイート処理、ここから
$botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：開始");

// 毎日7:44～45に朝の挨拶をする
if ($dateHour == 7 
        && ($dateMinite == "44" || $dateMinite == "45")) {
    $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：挨拶条件分岐");
    // エイプリルフールの場合、用意された挨拶をする
    if ($dateMD == "0401") {
        $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：エイプリルフール条件分岐");
        $response = $eb->postRandom("tweetBox/greeting/greeting_morning0401.txt");
        $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：エイプリルフール挨拶ツイート実行 ");
        
        // それ以外の場合、通常の挨拶をする
    } else {
        $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：通常日条件分岐");
        $response = $eb->postRandom("tweetBox/greeting/greeting_morning.txt");
        $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：通常日挨拶ツイート実行 ");
        
    }
    
// 月曜の7:54～55に一週間の始まりの挨拶をする
} elseif ($dateWeek == 1 && $dateHour == 7 
        && ($dateMinite == "54" || $dateMinite == "55")) {
    $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：月曜朝の挨拶条件分岐");
    $response = $eb->postRandom("tweetBox/greeting/greeting_mondaymorning.txt");
    $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：月曜の朝の挨拶ツイート実行 ");
    
// 毎日23:54～55に夜の挨拶をする
} elseif ($dateHour == 23 
        && ($dateMinite == "54" || $dateMinite == "55")) {
    $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：夜の挨拶条件分岐");
    $response = $eb->postRandom("tweetBox/greeting/greeting_evening.txt");
    $botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：夜の挨拶ツイート実行 ");
    
}

$botLogger = new botLogger($botLog, $phpName, "挨拶ツイート処理：終了");
// 挨拶ツイート処理、ここまで

// 定期ツイート処理、ここから
$botLogger = new botLogger($botLog, $phpName, "定時ツイート処理：開始");

// 13時、17時、21時の0～1分にそれぞれ定期ツイートをする
if (($dateHour == 13 || $dateHour == 17 || $dateHour == 21) 
        && ($dateMinite == "00" || $dateMinite == "01")) {
    $botLogger = new botLogger($botLog, $phpName, "定時ツイート処理：定時ツイート条件分岐");
    $response = $eb->postRandom("tweetBox/greeting/greeting_announce.txt");
    $botLogger = new botLogger($botLog, $phpName, "定時ツイート処理：ツイート実行 ");
    
}

$botLogger = new botLogger($botLog, $phpName, "定時ツイート処理：終了");
// 定期ツイート処理、ここまで

/*
//===================================================
//EasyBotter 簡易マニュアル
//===================================================
////ここから下は作者による解説です。
////cronなどでこのbot.phpを実行するわけですが、動作の指定の仕方はこんな感じです。

//用意したデータをランダムにポストしたい
$response = $eb->postRandom("データを書き込んだファイル名"); 

//用意したデータを順番にポストしたい
$response = $eb->postRotation("データを書き込んだファイル名"); 

//@で話しかけられたときにリプライしたい
$response = $eb->reply(cronで実行する間隔（単位：分）, "データを書き込んだファイル名", "パターン反応を書き込んだファイル名"); 

//タイムラインの単語に反応してリプライしたい
$response = $eb->replyTimeline(cronで実行する間隔（単位：分）,"パターン反応を書き込んだファイル名"); 

//自動でフォロー返ししたい
$response = $eb->autoFollow();

//===================================================
//// cronを実行するたびに毎回実行するのではなく、
//// 実行する頻度を変えたい場合の例は以下のとおりです。
//// PHPのdata()の応用の仕方は以下のURLを参照ください。
//// http://php.net/manual/ja/function.date.php

//bot.phpを実行したときに毎回実行される
$response = $eb->postRandom("data.txt");

//bot.phpを実行したときに、5回に1回ランダムに実行される
if(rand(0,4) == 0){
    $response = $eb->postRandom("data.txt");
}

//bot.phpを実行したときに、0分、15分、30分、45分だったら実行される
if(date("i") % 15 == 0){
    $response = $eb->postRandom("data.txt");
}

//bot.phpを実行したときに、午前だったらgozen.txtのデータを、午後だったらgogo.txtのデータを使う
if(date("G") < 12){
    $response = $eb->postRandom("gozen.txt");
}else{
    $response = $eb->postRandom("gogo.txt");    
}

//bot.phpを実行したときに、2月14日のみvalentine.txtのデータを、それ以外はdata.txtのデータを使う
if(date("n") == 2 && date("j") == 14){
    $response = $eb->postRandom("valentine.txt");
}else{
    $response = $eb->postRandom("data.txt");    
}

//準備したテキストを順番にポストしていって、準備した中から「めでたしめでたし」が投稿されたらbotの投稿をそこで止める
$response = $eb->postRotation("data.txt","めでたしめでたし");    
*/
