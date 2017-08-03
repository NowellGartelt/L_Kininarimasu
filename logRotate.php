<?php
// ログのローテーション
$date = date("Ymd");
$date = $date - 1;
rename("/home/mmao/twitterbot01/log/cronBot.log","/home/mmao/twitterbot01/log/cronBot.".$date.".log");
rename("/home/mmao/twitterbot01/log/errBot.log","/home/mmao/twitterbot01/log/errBot.".$date.".log");
?>