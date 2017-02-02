<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
      $score = intval($res["score"]);
      $img = '';
      for ($i = 0; $i < 5; $i ++) {
          $file = $i < $score ? 'star-on.png' : 'star-off.png';
          $img .= sprintf('<img src="img/%s">', $file);
      }
//    $view .= '<p>'.$res["name"]."**".$res["indate"].'</p>';
    $view .= '<dd>'; 
    $view .= '<dl>'.$res["name"].'</dl>'; 
    $view .= '<dl>'.$res["author"].'</dl>'; 
    $view .= '<dl>'.$res["comment"].'</dl>'; 
    $view .= '<dl><img src="'.$res["thumbnail"].'"></dl>'; 
      $view .= '<dl>'.$img.'</dl>'; 
    $view .= '</dd>'; 
  }
}
?>



    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My 本棚</title>

        <style>
            div {
                padding: 10px;
                font-size: 16px;
            }
        </style>
    </head>

    <body id="main">
        <!-- Head[Start] -->
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">読書記録</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Head[End] -->

        <!-- Main[Start] -->
        <div>
            <div class="record">
                <?=
                    $view
                ?>
            </div>


        </div>
        <!-- Main[End] -->

    </body>

    </html>