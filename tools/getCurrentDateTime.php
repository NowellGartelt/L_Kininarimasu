<?php
// tools/getCurrentDateTime.php
// 現在日時を取得し、配列で返すクラス

class getCurrentDateTime {
    // 実行時時刻取得
    public $dateYear = null;
    public $dateMonth = null;
    public $dateDay = null;
    public $dateWeek = null;
    public $dateHour = null;
    public $dateHourZ = null;
    public $dateMinite	= null;
    public $dateSecond = null;
    
    public function getCurrentDateTime() {
        // 出力ログの設定
//        $botLog = "../log/bot.log";
//        $phpName = "bot.php";
//        $phpName = basename($_SERVER['PHP_SELF']);
        
        // ログ出力モジュールの設定
        require_once 'tools/botLogger.php';
        
//        $botLogger = new botLogger($botLog, $phpName, "現在日時取得処理：開始");
        
        // 現在時刻取得
        // 年
        $dateYear = date("Y");
        // 月
        $dateMonth = date("m");
        // 日
        $dateDay = date("d");
        // 曜日
        $dateWeek = date("N");
        // 時 (0なし)
        $dateHour = date("G");
        // 時 (0あり)
        $dateHourZ = date("H");
        // 分
        $dateMinite	= date("i");
        // 秒
        $dateSecond = date("s");
        
//        $botLogger = new botLogger($botLog, $phpName, "現在日時取得処理：現在日時取得 取得時刻＝"
//                .$dateYear."/".$dateMonth."/".$dateDay." ".$dateWeek." "
//                .$dateHour.":".$dateMinite.":".$dateSecond);
        
        // 初期化処理
        $currentDateTime = array();
//        $botLogger = new botLogger($botLog, $phpName, "現在日時取得処理：配列初期化処理");
        
        // 配列に格納する
        $currentDateTime['dateYear'] = $dateYear;
        $currentDateTime['dateMonth'] = $dateMonth;
        $currentDateTime['dateDay'] = $dateDay;
        $currentDateTime['dateWeek'] = $dateWeek;
        $currentDateTime['dateHour'] = $dateHour;
        $currentDateTime['dateHourZ'] = $dateHourZ;
        $currentDateTime['dateMinite'] = $dateMinite;
        $currentDateTime['dateSecond'] = $dateSecond;
//        $botLogger = new botLogger($botLog, $phpName, "現在日時取得処理：配列格納処理");
        
//        $botLogger = new botLogger($botLog, $phpName, "現在日時取得処理：終了");
        
        // 配列を返す
        return $currentDateTime;

    }
}