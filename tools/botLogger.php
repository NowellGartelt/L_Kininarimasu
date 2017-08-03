<?php
// tools/botLogger.php
// ログ出力のためのクラス

class botLogger {
    // 変数初期化
    private $currentDate = null;
    private $currentTime = null;
    private $logFile = null;
    private $logMessage = null;
    private $logResult = null;
    private $phpName = null;
    
    public function botLogger($file, $phpName, $message) {
        $this->logFile = $file;
        $this->phpName = $phpName;
        $this->logMessage = $message;

        // 現在日時の取得
//        require_once 'getCurrentDateTime.php';
//        $currentDateTime = array();
//        $getCurrentDate = new getCurrentDateTime();
//        $currentDateTime = $getCurrentDate->getCurrentDateTime();
        
        // 現在時刻取得
        // 年
        $dateYear = date("Y");
        // 月
        $dateMonth = date("m");
        // 日
        $dateDay = date("d");
        // 曜日
        $dateWeek = date("N");
        // 時 (0あり)
        $dateHour0 = date("H");
        // 分
        $dateMinite	= date("i");
        // 秒
        $dateSecond = date("s");
        
/*
        // 年
        $dateYear = $currentDateTime['dateYear'];
        // 月
        $dateMonth = $currentDateTime['dateMonth'];
        // 日
        $dateDay = $currentDateTime['dateDay'];
        // 曜日
        $dateWeek = $currentDateTime['dateWeek'];
        // 時
        $dateHour = $currentDateTime['dateHour'];
        // 分
        $dateMinite = $currentDateTime['dateMinite'];
        // 秒
        $dateSecond = $currentDateTime['dateSecond'];
*/
        
        // 現在日付をフォーマットに合わせて連結
        $currentDate = $dateYear."/".$dateMonth."/".$dateDay;
        
        // 現在時刻をフォーマットに合わせて連結
        $currentTime = $dateHour0.":".$dateMinite.":".$dateSecond;
        
        // ログ出力
        $logResult = file_put_contents($file,
                $dateYear."/".$dateMonth."/".$dateDay." ".$dateHour0.":".$dateMinite.":".$dateSecond
                ." ".$phpName."\t".$message."\n", FILE_APPEND);
        
        // 結果を返す
        // 成功であれば書き込んだバイト数、失敗であればfalse
        return $logResult;
        
    }
}