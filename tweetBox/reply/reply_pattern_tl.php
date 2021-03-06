<?php
//特定の単語を受け取った場合に特定の反応を返したいときに使う、反応のパターンを書くためのファイルです。
//複数のパターンに一致する場合は上のものが優先されます。PHPの正規表現にも対応しています。

//タイムライン反応する単語と、それに対するリプライを記しています。

$data = array(
	"千反田"=> array(
		"呼びましたか？何のご用でしょう...気になります！",
		"呼びましたか？...何か、気になる事があったのでしょうか、気になります！",
		"は、はい！ど、どうしたんですか、そんなに慌てて...？",
		"は、はい！な、何でしょう...何か問題でもありましたか...？",
		"はい、呼びましたか？{name}さん？？",
	),
	"えるたそ"=> array(
		"呼びましたか、{name}さん？...でもどうして、みなさんはわたしの事を「えるたそ」と呼ぶのでしょうか。気になります！",
		"呼びましたか、{name}さん？でも...いつの間に、わたしにそんなあだ名がついたのでしょう...わたし、気になります！",
		"呼びましたか？何のご用でしょう...気になります！",
		"呼びましたか？...何か、気になる事があったのでしょうか、気になります！",
		"は、はい！ど、どうしたんですか、そんなに慌てて...？",
		"は、はい！な、何でしょう...何か問題でもありましたか...？",
		"はい、呼びましたか？{name}さん？？",
	),
	"チタンダエル"=> array(
		"...！？{name}さん、怒りますよっ！",
		"...！？わ、わたしだって怒るときはあるんですよっ！",
	),
	"おはよ"=> array(
		"おはようございます。今日は、どちらへ行かれるのですか？わたし、気になります。",
		"おはようございます。あの...入須先輩を見かけませんでしたか？お願いしたい事があるのですが...。",
		"おはようございます。今日は、何をする予定なのですか？わたし、気になります。",
		"おはようございます、{name}さん。ちゃおですっ。",
		"おはようございます。そういえば...折木さんを見かけませんでしたか？わたし、気になる事があって...。",
		"おはようございます、{name}さん。シャッス！です！",
		"おはようございます。朝ご飯は、何をいただいたのですか？わたし、気になります。",
		"おはようございます。今日は、何をする予定なのですか？わたし、気になります。",
		"おはようございます。あ、福部さんを見かけませんでしたか？とても大事な、お話があるのですが...。",
		"おはようございます。今朝のニュース、何か気になる事がありましたか？",
		"おはようございます。えっと...摩耶花さんを見かけませんでしたか？今度のお休みの日のお誘いをしようと思っているのですが...。",
    ),
	"お早う"=> array(
		"おはようございます。今日は、どちらへ行かれるのですか？わたし、気になります。",
		"おはようございます。あの...入須先輩を見かけませんでしたか？お願いしたい事があるのですが...。",
		"おはようございます。今日は、何をする予定なのですか？わたし、気になります。",
		"おはようございます、{name}さん。ちゃおですっ。",
		"おはようございます。そういえば...折木さんを見かけませんでしたか？わたし、気になる事があって...。",
		"おはようございます、{name}さん。シャッス！です！",
		"おはようございます。朝ご飯は、何をいただいたのですか？わたし、気になります。",
		"おはようございます。今日は、何をする予定なのですか？わたし、気になります。",
		"おはようございます。あ、福部さんを見かけませんでしたか？とても大事な、お話があるのですが...。",
		"おはようございます。今朝のニュース、何か気になる事がありましたか？",
		"おはようございます。えっと...摩耶花さんを見かけませんでしたか？今度のお休みの日のお誘いをしようと思っているのですが...。",
	),
	"おーはー"=> array(
		"おはようございます、{name}さん。おーはーですっ。",
	),
	"おっはー"=> array(
		"おはようございます、{name}さん。おっはーですっ。",
	),
	"こん(に)?ち[はわ]"=> array(
		"こんにちは。わたしの気になっている事、聴いてくださいませんか？",
		"こんにちは。今はお時間ありますか？わたし、気になってる事がありまして...",
		"{name}さん、こんにちは。ちぇりお！ですっ。",
		"{name}さん、こんにちは。ちゃおですっ。",
		"{name}さん、こんにちは。ちぇりお！ですっ。",
		"こんにちは。...いい所にきてくださいました！わたし、気になってる事があるんです！",
	),
	"ごきげんよう"=> array(
		"あら...ごきげんよう、{name}さん。今日はどちらかへお出かけですか？",
		"{name}さん、ごきげんよう。今日のお天気模様は...どうなるのでしょう？{name}さん、ご存知ですか？",
		"あら、{name}さん...ごきげんよう。......って、ごきげんよう、という挨拶は冗談で言ってるんですよ？",
	),
	"こんちゃーっす"=> array(
		"こんちゃーっす！です、{name}さん。",
		"こんちゃーっす,{name}さん、こんちゃーっす！ですっ。",
	),
	"ばん[はわ]"=> array(
		"こんばんは。そろそろ、帰らないといけませんね。でも、気になる事があって...どうしましょう？",
		"{name}さん、こんばんは。こんな時間にお出かけですか？",
		"こんばんは。こんな時間まで大変ですね。お疲れ様です",
	),
	"おやすみ"=> array(
		"おやすみなさい。また明日、お会いしましょう。",
		"おやすみなさい。明日はお早いのでしょうか...わたし、気になります！",
		"おやすみなさい。{name}さんの明日の予定、わたし、気になります！",
		"おやすみなさい、{name}さん。ゆっくり、お休みになってください。",
		"お休みなさいませ、旦那様。...ふふっ、一度言ってみたかったんですっ。",
		"{name}さん、おやすみなさい。わたしの気になっていた事、考えておいていただけませんか...？",
		"おやすみなさい。明日も、千反田えるに、かかってこーい！です！",
		"お休みなさいませ、ご主人様っ。...どうです？わたしにもメイドさんが務まるでしょうか？",
		"おやすみなさい。明日も一緒に、気になる事を考えましょう！",
		"おやすみなさい。あ、{name}さんは、お休みされる前に、毎日何かしている事がありますか？わたし、気になります！",
		"{name}さん、おやすーですっ。",
		"おやすみなさい。こんな時間まで大変ですね。お疲れ様です。",
	),
	"[行い]って[来き]ます"=> array(
		"待ってください！この問題、わたし気になります！",
		"行ってらっしゃいませ、旦那さま。...できれば、メイドさんの格好で言いたかったのですが...。",
		"お出かけですか？気をつけて行ってきてくださいね。",
		"いてらーっです、{name}さんっ！",
		"お出かけですね。早く帰ってきて、一緒にこの問題を考えましょう？",
		"お出かけですね。いってらっしゃい、{name}さん。",
	),
	"[行い]って[来く]る"=> array(
		"待ってください！この問題、わたし気になります！",
		"行ってらっしゃいませ、旦那さま。...できれば、メイドさんの格好で言いたかったのですが...。",
		"お出かけですか？気をつけて行ってきてくださいね。",
		"いてらーっです、{name}さんっ！",
		"お出かけですね。早く帰ってきて、一緒にこの問題を考えましょう？",
		"お出かけですね。いってらっしゃい、{name}さん。",
	),
	"ただいま"=> array(
		"お帰りなさいませ、ご主人様っ！...ふふっどうです？メイドさんに見えますか？",
		"おかえりなさい。今日はどんな事があったのでしょう。何か、気になる事はありましたか？わたし...気になります！",
		"おかえりなさい。お疲れ様でした。ゆっくりお休みになってくださいね。",
		"おかえりなさい。お待ちしていましたよ。さあ、この問題を一緒に考えましょう！",
		"おかえりなさい。こんな時間まで大変ですね。お疲れ様です。",
	),
	"帰宅"=> array(
		"お帰りなさいませ、ご主人様っ！...ふふっどうです？メイドさんに見えますか？",
		"おかえりなさい。今日はどんな事があったのでしょう。何か、気になる事はありましたか？わたし...気になります！",
		"おかえりなさい。お疲れ様でした。ゆっくりお休みになってくださいね。",
		"おかえりなさい。お待ちしていましたよ。さあ、この問題を一緒に考えましょう！",
		"おかえりなさい。こんな時間まで大変ですね。お疲れ様です。",
	),
	"気にな[りる]"=> array(
		"{name}さんも気になりますよね？一緒に考えませんか？",
		"{name}さんも気になりますか？では、一緒に考えましょう！",
		"何か気になることがあるんですね！？わたしにも教えてくださいっ！",
		"{name}さんの気になること、わたしにも教えて下さいっ！",
	),
);