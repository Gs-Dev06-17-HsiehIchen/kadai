<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$author  = $_POST["author"];
$comment = $_POST["comment"];
$thumbnail = $_POST["thumbnail"];
$score = $_POST["score"];


//2. DB接続します このまま丸っと使う こーゆーもんだ
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}



//３．データ登録SQL作成　ここもコピペでOK　危ない文字を無効化する
$sql = <<<SQL
INSERT INTO gs_bm_table
    (name, author, comment, thumbnail, score, indate)
VALUES
    (:name, :author, :comment, :thumbnail, :score, SYSDATE())
SQL;
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':thumbnail', $thumbnail, PDO::PARAM_STR);
$stmt->bindValue(':score', $score, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）これもコピペ
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
    header("Location: index.php"); // exit;

}
?>