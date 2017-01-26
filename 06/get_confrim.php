<?php
include("funcs.php");
$name = $_POST["name"];
$mail = $_POST["mail"];
$gender = $_POST["gender"];
?>

    <html lang="ja">

    <head>
        <meta charset="utf-8">
        <title>GET練習（受信）</title>
    </head>

    <body>
        お名前：
        <?php echo $name; ?>
            Mail：
            <?php echo $mail; ?>
                性別
                <?php echo $gender; ?>

    </body>
    <?php  
        //CSVのヘッダ行
        $title = ["name","mail","gender"];
        //CSVのデータ
        $vararray  = [$name, $mail, $gender];
//        //文字列をUTF-8から変換 
        mb_convert_variables("SJIS-win", "UTF-8",  $title); 
        mb_convert_variables("SJIS-win", "UTF-8",  $vararray); 
        
        //ファイルへ書き込み実行 
        $handle = fopen('data/data.csv','a'); 
        flock($handle,LOCK_EX); 
        fputcsv($handle,$title); 
        fputcsv($handle,$vararray); 
        flock($handle,LOCK_UN); 
        fclose($handle);
        
        
        
        
        
        
        
?>

    </html>