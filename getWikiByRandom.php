<?php
// getWikiWordsByRandom.php
// Wikipediaの単語を出力するクラス

class getWikiByRandom {
    public function getWikiWordsByRandom() {

        do {
            // WikipeiaのAPIでファイル取得
            $result = file_get_contents('https://ja.wikipedia.org/w/api.php?format=xml&action=query&list=random&rnnamespace=0&rnlimit=1');

            // Wikipediaの記事タイトルを取得する
            // title="以降、次の"までの文字列を取得する
            $return = preg_match('/title="(...+)"/', $result, $match);
            $wikiTitle = $match[1];

            var_dump($wikiTitle);
            
        } while (strpos($wikiTitle, '曖昧さ回避') == true);

        // URL作成のため、取得したWikipedia記事タイトルをURLエンコーディングする
        $exchangeUrl = urlencode($wikiTitle);

        // URLとして有効な文字列にするため、「+」を「_」に変換する
        $search = array('+');
        $replace = array('_');
        $exchangeUrl = str_replace($search, $replace, $exchangeUrl);

        // URL生成
        $wikiUrl = 'https://ja.wikipedia.org/wiki/'.$exchangeUrl;

        $opt = array($wikiTitle, $wikiUrl);

        var_dump($opt);

        return $opt;
    }
}

?>