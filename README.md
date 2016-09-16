# L_Kininarimasu
Twitterのbot、千反田える「わたし気になります」botのソースコード。
EasyBotterをカスタマイズしてます。
これを使えば、Twitterアカウントさえ入手すれば誰でも千反田える「わたし気になります」botを作成できます。

動作確認済みOS：CentOS6.4～6.8、7.0～7.2



【使い方】

1. サーバー上のテキトーなフォルダに配置する
※わたしの場合は/home/username/twitterbot01に配置してます。

2. Twitter Developersのページでアクセストークンを入手する
https://dev.twitter.com/

3. setting.phpに入手したアクセストークンを記述する

4. cronに下記を設定する。
※1行目は時刻合わせのコマンド、2行目はbotを動作させるためのコマンド、3行目はログをローテーションするためのコマンドです。
※1.の配置場所に合わせたコマンドになってますので、配置場所に合わせて変更してください。
0 3  * * * /usr/sbin/ntpdate -v ntp.nict.jp 1>>/home/username/cron.log 2>>/home/username/err.log
1-59/2 * * * * /usr/bin/php /home/username/twitterbot01/bot.php 1>>/home/username/twitterbot01/log/cronBot.log 2>>/home/username/twitterbot01/log/errBot.log
0 5 * * * /usr/bin/php /home/username/twitterbot01/logRotate.php 1>>/home/username/twitterbot01/log/rotate.log 2>>/home/username/twitterbot01/log/errRotate.log

【オマケ】

5. 同じアカウントとリプライし続ける場合、対象のアカウントのIDをEasyBotter.phpの313行目に記述する。



細かな不明点は下記EasyBotterのページを参照してください。
http://pha22.net/twitterbot/

