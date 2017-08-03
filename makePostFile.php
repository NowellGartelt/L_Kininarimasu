<?php
class makePostFile {
	public function makePostFileByWikiWords() {
		// WikiのタイトルとURLを取得するクラスの読み込み
		include_once 'getWikiByRandom.php';

		$filename = 'tweetBox/post/postWiki.txt';
		$result = new getWikiByRandom();
		$getWiki = $result -> getWikiWordsByRandom();

		$postWords = $getWiki[0]."...わたし、気になります！　".$getWiki[1];

		$fileWrite = fopen($filename, "w+");

		$outputFile = fwrite($fileWrite, $postWords);

		fclose($fileWrite);
	}
}
?>