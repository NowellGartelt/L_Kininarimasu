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

// 実行時時刻取得
// 年
$dateYear	= date("Y");
// 時間
$dateHour	= date("H");
// 分
$dateMinite	= date("i");
// 月
$dateMonth	= date("m");
//　日
$dateDay	= date("d");
// 曜日
$dateWeek	= date("N");

$dateHM		= $dateHour.$dateMinite;

var_dump($dateHM);

// リプライした人の記録リセット
if($dateHM == '0801' || $dateHM == '1401' || $dateHM == '2001'){
	$fp = fopen("kaiwalog.txt", "w");
	fclose($fp);
}

/*
var_dump($dateYear);
var_dump($dateHour);
var_dump($dateMinite);
var_dump($dateMonth);
var_dump($dateDay);
var_dump($dateWeek);
var_dump($dateHM);
*/

// 1～7時で1時間に1回、一括でフォロー返しを行う
if($dateHour > 00 && $dateHour < 08 && $dateMinite >= 00 && $dateMinite <= 02){
	$response = $eb->autoFollow();
}

	// 8時～23時はツイートする
if($dateHour >= 8 && $dateHour <= 23){
	if($dateMinite >= 14 && $dateMinite <= 15){
		// 8～23時の15分にpostNew.txtをツイート
		$response = $eb->postRandom("postAnime.txt");
	} elseif($dateMinite >= 44 && $dateMinite <= 45){
		// 8～23時の45分にpost.txtをツイート
		$response = $eb->postRandom("postOther.txt");
	}
	// 8～23時は実行時必ずタイムライン反応する
	$response = $eb->replyTimeline(2,"reply_pattern_tl.php");
}
// 実行時必ずリプライに対し返信する
$response = $eb->reply(2,"reply.txt","reply_pattern.php");

if($dateHour == 07 && $dateMinite >= 44 && $dateMinite <= 45){
	// 7:44～46に朝の挨拶をする
	$response = $eb->postRandom("greeting_morning.txt");
} elseif($dateWeek == 1 && $dateHour == 06 && $dateMinite >= 54 && $dateMinite <= 55){
	// 月曜の7:44～46に一週間の始まりの挨拶をする
	$response = $eb->postRandom("greeting_mondaymorning.txt");
} elseif($dateHour == 23 && $dateMinite >= 54 && $dateMinite <= 55){
	// 0:14～16に夜の挨拶をする
	$response = $eb->postRandom("greeting_evening.txt");
}

// 13時、17時、21時の0～2分にそれぞれ定期ポストをする
if(($dateMinite >= 00 && $dateMinite <= 2) && ($dateHour == 13 || $dateHour == 17 || $dateHour == 21)){
	$response = $eb->postRandom("greeting_announce.txt");
}

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
