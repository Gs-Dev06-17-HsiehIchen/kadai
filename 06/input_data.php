<?php
	// メッセージ
	$message = '';
        try {
		// POSTでこなかったら
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			throw new Exception();
		}

		// 送信されてきたデータ
		$name = trim(filter_input(INPUT_POST, 'name'));
		$age = trim(filter_input(INPUT_POST, 'age'));
		$gender = trim(filter_input(INPUT_POST, 'gender'));
		$relationship = trim(filter_input(INPUT_POST, 'relationship'));


		// 入力内容のチェック
		if (!is_string($name) || $name === '') {
			throw new Exception('お名前が未入力です');
		}
//		if (!is_string($mail) || $mail === '') {
//			throw new Exception('メールアドレスが未入力です');
//		}

		// ファイルを開く
		$fp = fopen('./data/data.csv', 'a');
		if (!$fp) {
			throw new Exception('ファイルが開けません');
		}

		// 排他ロックできない場合
		if (!flock($fp, LOCK_EX)) {
			throw new Exception('ファイルが開けません');
		}

		// カンマ区切りで1行を作る
		$data = [
			$name,
			$age,
			$gender,
			$relationship,
		];
		$line = sprintf("%s\n", implode(',', $data));

		// データの保存
		fwrite($fp, $line);
		flock($fp, LOCK_UN);
		fclose($fp);

		$message = '入力ありがとうございます';

	} catch (Exception $e) {
		$message = $e->getMessage();
	}

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>モテ期恋愛診断占い</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="mental.js"></script>
        <style>
            #qArea {
                overflow: hidden;
                width: 700px;
                height: 500px;
                background: url(images/back.png) no-repeat 0 0;
                margin: 10px auto;
            }
        </style>

    </head>

    <body>
        <div id="info">
            <div class="login">
                <div class="info-left">
                    <form method="post" action="">
                        <h2>基本資料</h2>
                        <p class="info-title">お名前:</p>
                        <input type="text" name="name">
                        <p class="info-title">年齢</p>
                        <select name="age" style="color:#666">
                            <option name="age" value="16歳から20歳">16歳から20歳</option>
                            <option name="age" value="21歳から25">21歳から25</option>
                            <option name="age" value="26歳から30歳">26歳から30歳</option>
                            <option name="age" value="31歳から35歳">31歳から35歳</option>
                            <option name="age" value="36歳から40歳">36歳から40歳</option>
                        </select>

                        <p class="info-title">性別</p>
                        <input type="radio" name="gender" value="男性">男性
                        <input type="radio" name="gender" value="女性">女性

                        <p class="info-title">交際関係</p>
                        <label>
                            <input type="radio" name="relationship" value="独身">独身
                            <input type="radio" name="relationship" value="交際中">交際中
                            <input type="radio" name="relationship" value="既婚">既婚
                            <input type="radio" name="relationship" value="複雑な関係">複雑な関係
                            <input type="radio" name="relationship" value="オープンな関係">オープンな関係
                        </label>

                </div>

                <div class="info-right">
                    <button>
                        送信
                    </button>
                </div>
                </form>
            </div>
            <div class="alert"><i><?php print htmlspecialchars($message); ?></i></div>
            <div id="start">
                <img src="images/arrow.png" alt="" width="60px">
                <p>診断開始</p>

            </div>
        </div>

        <div id="qArea">
            <div id="qContainer">
                <div class="qBox">
                    <div class="ques"><span class="qNum">Q1</span>　自分の容姿を100点満点で採点すると？</div>
                    <ul>
                        <li id="0_0" sc="20">30点未満</li>
                        <li id="0_1" sc="15">70点以上90点未満</li>
                        <li id="0_2" sc="10">50点以上70点未満</li>
                        <li id="0_3" sc="5">30点以上50点未満</li>
                        <li id="0_4" sc="0">90点以上</li>
                    </ul>
                    <div class="fig"><img src="images/fig0.jpg" width="240" height="260" alt=""></div>
                </div>

                <div class="qBox">
                    <div class="ques"><span class="qNum">Q2</span>　先週あった楽しい出来事、15秒以内にいくつ思い出せる？</div>
                    <ul>
                        <li id="1_0" sc="20">4個以上</li>
                        <li id="1_1" sc="15">3個</li>
                        <li id="1_2" sc="10">2個</li>
                        <li id="1_3" sc="5">1個</li>
                        <li id="1_4" sc="0">0個</li>
                    </ul>
                    <div class="fig"><img src="images/fig1.jpg" width="240" height="260" alt=""></div>
                </div>

                <div class="qBox">
                    <div class="ques"><span class="qNum">Q3</span>　恋愛感情を持てそうにない異性の友人から告白されたときの返答は？</div>
                    <ul>
                        <li id="2_0" sc="20">ごめんなさい</li>
                        <li id="2_1" sc="15">あなたとはずっと友達でいたい</li>
                        <li id="2_2" sc="10">気持ちは嬉しいよ</li>
                        <li id="2_3" sc="5">無理無理！</li>
                        <li id="2_4" sc="0">異性の友人はいない...</li>
                    </ul>
                    <div class="fig"><img src="images/fig2.jpg" width="240" height="260" alt=""></div>
                </div>
                <div class="qBox">
                    <div class="ques"><span class="qNum">Q4</span>　これまでに付き合った異性の数は？</div>
                    <ul>
                        <li id="3_0" sc="20">１０人以上</li>
                        <li id="3_1" sc="15">６〜９人</li>
                        <li id="3_2" sc="10">３〜５人</li>
                        <li id="3_3" sc="5">１〜２人</li>
                        <li id="3_4" sc="0">０人</li>
                    </ul>
                    <div class="fig"><img src="images/fig3.jpg" width="240" height="260" alt=""></div>
                </div>

                <div class="qBox">
                    <div class="ques"><span class="qNum">Q5</span>　自分の性格に一番近いと思うものを次の中から選ぶとしたら？</div>
                    <ul>
                        <li id="4_0" sc="20">面倒くさがり</li>
                        <li id="4_1" sc="15">ポジティブ</li>
                        <li id="4_2" sc="10">神経質</li>
                        <li id="4_3" sc="5">シャイ</li>
                        <li id="4_4" sc="0">暗い</li>
                    </ul>
                    <div class="fig"><img src="images/fig4.jpg" width="240" height="260" alt=""></div>
                </div>

                <div class="qBox">
                    <div id="resultBox">
                        <div id="resultLeft">
                            <div id="resultTitle">あああああ</div>
                            <div id="resultText">残念ながら、あなたのモテ期はどうやら完全に終わってしまっているようですね。「そんな殺生な〜」と嘆きたくなる気持ちもわかりますが、過去にモテ期があっただけでもよしとしてください。世の中にはたった一度のモテ期さえ、味わえない人もいるのです。というわけで今後、いくつもの出会いが一度に訪れる状況は考えにくいので、ひとつひとつの出会いを大切に、全力を尽くしましょう。コツコツと地道にがんばる以外に道はありませんが、あまり気にしすぎないようにしてください。
                            </div>
                        </div>
                        <div class="resultRight">
                            <div style="padding-top:10px">結果発表</div>
                            <div id="resultPoint">
                                40</div>
                            <div id="resultImage"></div>
                        </div>
                        <div style="margin-top: 300px;margin-left: 450px;">
                            <p><a href="output_data.php">みんなの結果を見る</a>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </body>

    </html>