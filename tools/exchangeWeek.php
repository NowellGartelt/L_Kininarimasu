<?php
// tools/exchangeWeek.php
// 数値表現の曜日から文字列の曜日を取得するクラス

class exchangeWeek {
    private $dateWeek = null;
    private $dateWeekLet = null;
    
    public function exchangeWeek($dateWeek) {
        $this->dateWeek = $dateWeek;

        // 出力ログの設定
//        $botLog = "../log/bot.log";
//        $phpName = "bot.php";
//        $phpName = basename($_SERVER['PHP_SELF']);

        // ログ出力モジュールの設定
        require_once 'tools/botLogger.php';
        
//        $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：開始");
        
        // ログ出力のため、曜日を数値から文字変換
        switch ($dateWeek) {
            case 1;
                $dateWeekLet = "月曜日";
//                $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：条件分岐 曜日：月曜日");
                break;
            case 2;
                $dateWeekLet = "火曜日";
//                $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：条件分岐 曜日：火曜日");
                break;
            case 3;
                $dateWeekLet = "水曜日";
//                $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：条件分岐 曜日：水曜日");
                break;
            case 4;
                $dateWeekLet = "木曜日";
//                $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：条件分岐 曜日：木曜日");
                break;
            case 5;
                $dateWeekLet = "金曜日";
//                $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：条件分岐 曜日：金曜日");
                break;
            case 6;
                $dateWeekLet = "土曜日";
//                $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：条件分岐 曜日：土曜日");
                break;
            case 7;
                $dateWeekLet = "日曜日";
//                $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：条件分岐 曜日：日曜日");
                break;
        }
//        $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：取得完了 曜日：".$dateWeekLet);
        
//        $botLogger = new botLogger($botLog, $phpName, "曜日文字列取得処理：終了");
        
        // 変換結果を返り値として返す
        return $dateWeekLet;
        
    }
}