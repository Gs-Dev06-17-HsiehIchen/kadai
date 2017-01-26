<?php
	// ファイルを開く
	$buff = file_get_contents('./data/data.csv');

	// 結果データの配列
	$data = [];

	// 1行ずつ処理をする
	foreach (explode("\n", $buff) as $i) {

		// データがない場合、処理しない
		if ($i === '') {
			continue;
		}

		// カンマで分割する
		$line = explode(',', trim($i));

		// 配列に足す
		$data[] = [
			'name' => $line[0], // 分割したデータの1番目
			'age' => $line[1], // 分割したデータの2番目
			'gender' => $line[2], // 分割したデータの3番目
			'relationship' => $line[3], // 分割したデータの4番目
		];
	}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>アンケート収集</title>
        <style>
            th {
                width: 150px;
                padding: 5px;
                font-weight: bold;
                border: 1px solid #ccc;
                background-color: #E64E99;
            }
            
            td {
                width: 150px;
                padding: 5px;
                text-align: center;
                color: #222222;
                border: 1px solid #ccc;
            }
        </style>
    </head>

    <body>
        <table>
            <thead>
                <th>名前</th>
                <th>年齢</th>
                <th>性別</th>
                <th>交際関係</th>


            </thead>
            <?php foreach ($data as $i): ?>
                <tr>
                    <td>
                        <?php print htmlspecialchars($i['name']); ?>
                    </td>
                    <td>
                        <?php print htmlspecialchars($i['age' ]); ?>
                    </td>
                    <td>
                        <?php print htmlspecialchars($i['gender']); ?>
                    </td>
                    <td>
                        <?php print htmlspecialchars($i['relationship']); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
    </body>

    </html>