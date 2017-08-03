<?php
// tools/logRotate.php
// ログのローテーション

// ログローテーション用の日付
$rotateDate = date("Ymd", strtotime('-1 day'));
// 削除対象の日付
$deleteDate = date("Ymd", strtotime('-92 day'));

var_dump($rotateDate);
var_dump($deleteDate);

// ログローテーション実施
// 昨日までのログをリネームする
rename("/home/mmao/L_Kininarimasu/log/cronBot.log", "/home/mmao/L_Kininarimasu/log/cronBot.".$rotateDate.".log");
rename("/home/mmao/L_Kininarimasu/log/errBot.log", "/home/mmao/L_Kininarimasu/log/errBot.".$rotateDate.".log");
rename("/home/mmao/L_Kininarimasu/log/bot.log", "/home/mmao/L_Kininarimasu/log/bot.".$rotateDate.".log");

// 旧ログの削除
// 92日以前のログは削除する
unlink("/home/mmao/L_Kininarimasu/log/cronBot.".$deleteDate.".log");
unlink("/home/mmao/L_Kininarimasu/log/errBot.".$deleteDate.".log");
unlink("/home/mmao/L_Kininarimasu/log/bot.".$deleteDate.".log");
?>