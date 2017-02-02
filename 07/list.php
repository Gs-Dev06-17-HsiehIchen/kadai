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

      $view .= '<div class="left">'; 
    $view .= '<dl><img class="book_img" src="'.$res["thumbnail"].'"></dl>'; 
    $view .= '<dl class="score">'.$img.'</dl>'; 
    $view .= '</div>'; 
    $view .= '<div class="right">'; 
    $view .= '<dl>'.$res["name"].'</dl>'; 
    $view .= '<dl>'.$res["author"].'</dl>'; 
    $view .= '<dl>'.$res["comment"].'</dl>'; 
    $view .= '</div>'; 

      $view .= '<div class="clear">'; 
      $view .= '</div>'; 

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
            body {}
            
            a {
                text-decoration: none;
                font-size: 30px;
                font-weight: bold;
                color: #24211F;
            }
            
            div {
                padding: 10px;
            }
            
            .navbar-header {
                text-align: -webkit-right;
            }
            
            .record {
                background-image: url(img/woodbg.png);
                margin-left: 30px;
                background-color: #845833;
            }
            
            .wood {
                background-image: url(img/woodbg.jpg);
            }
            
            .left {
                float: left;
                margin-left: 40px;
            }
            
            .right {
                float: left;
                width: 500px;
                font-size: 12px;
                color: beige;
            }
            
            .clear {
                border-bottom-style: solid;
                clear: both;
                border-bottom-color: bisque;
                border-bottom-width: thick;
            }
            
            .book_img {
                width: 50%;
            }
            
            .score {}
        </style>
    </head>

    <body id="main">
        <!-- Head[Start] -->
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <img src="img/bird.png" width="50px" alt="">
                        <a class="navbar-brand" href="index.php">読書記録
                         
                        </a>
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