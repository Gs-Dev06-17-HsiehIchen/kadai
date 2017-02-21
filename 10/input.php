<?php
session_start();
include("functions.php");
ssidCheck();

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <script src="ckeditor/ckeditor.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
      div{padding: 10px;font-size:16px;}
    </style><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--jQuery IMG Upload Preview-->
<script>
$(function(){
	var setFileInput = $('.imgInput');

	setFileInput.each(function(){
		var selfFile = $(this),
		selfInput = $(this).find('input[type=file]');

		selfInput.change(function(){
			var file = $(this).prop('files')[0],
			fileRdr = new FileReader(),
			selfImg = selfFile.find('.imgView');

			if(!this.files.length){
				if(0 < selfImg.size()){
					selfImg.remove();
					return;
				}
			} else {
				if(file.type.match('image.*')){
					if(!(0 < selfImg.size())){
						selfFile.append('<img alt="" class="imgView">');
					}
					var prevElm = selfFile.find('.imgView');
					fileRdr.onload = function() {
						prevElm.attr('src', fileRdr.result);
					}
					fileRdr.readAsDataURL(file);
				} else {
					if(0 < selfImg.size()){
						selfImg.remove();
						return;
					}
				}
			}
		});
	});
});
</script>
</head>
<body>

<!-- Head[Start] -->
<?php include("menu.php"); ?>
<!-- Head[End] -->
<div>
    <div> <?php echo $_SESSION["name"] ?> さんログイン中</div>
</div>
<!-- Main[Start] -->
<form method="post" action="insert.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>記事登録</legend>
     <label>Newsタイトル：<input type="text" name="title"></label><br>
     <label>News記事：<br><textArea name="article" id="editor1" rows="10" cols="80">ワードみたいに使ってね  v（＊＾_＾＊）v</textArea></label><br>

     <script>
     CKEDITOR.replace("editor1");
     </script>
     
     <div id="container">
     <div class="imgInput">
     <input type="file" name="filename">
    </div>
    </div>
    
     <input type="submit" value="記事登録">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
<a href="index.php">index.phpへ</a>

</body>
</html>
