<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>読書記録</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <script type="text/javascript" src="js/jquery.raty.js">
    </script>
    <script type="text/javascript" src="js/qrcodelib.js"></script>
    <script type="text/javascript" src="js/webcodecamjs.js"></script>
    <script src="js/bookrecord.js"></script>
</head>

<body>

    <header>
        <img src="img/TokyoRocket_white.png" width="80px" alt="">
    </header>


    <div class="title">
        <div class="title-left">
            <img src="img/bird.png" width="50px" alt=""></div>
        <div class="title-right">
            <h1>読書記録</h1>
            <h3>本の記録をはじめる</h3>
        </div>

    </div>

    <div class="inner-wrapper">
        <div class="inner-left">
            <button class="search">
                <p>キーワードで検索</p>
                <img src="img/search.png" width="50px" alt="">
            </button>
            <button class="scan">
                <p>バーコードで検索</p>
                <img src="img/scan.png" width="50px" alt="">
            </button>

        </div>
        <div class="inner-right">
            <div class="keyword-search">
                <input class="keyword-search" name="q" type="text" placeholder="タイトル、著者、ISBN">
            </div>

            <div class="barcode-search">
                <canvas style="border: solid thick; width: 180px; height:50px;"></canvas>
                <p>ISBN</p>
                <input type="text" id="isbn">
            </div>

            <div class="add">
                <button id="search_btn">
                    <p>本棚に追加</p><img src="img/book.png" width="30px" alt="">
                </button>
            </div>
        </div>
    </div>
    <!-- Main[Start] -->

    <main>
        <form class="record" method="post" action="insert.php">
            <div class="book-info">
                <div class="book-info-left">
                    <div>書名
                        <span id="book_title"></span>
                    </div>
                    <div>著者
                        <span id="book_authors"></span>
                    </div>
                    <div style="width: 30%;">
                        <img id="book_img" style="width:auto; height:180px;">
                    </div>
                </div>
                <div class="book-info-right">
                    <div>
                        <p>感想</p>
                        <textarea name="comment" id="" cols="30" rows="10"></textarea>
                    </div>

                    <p>評価</p>
                    <div class="score">
                        <input type="hidden" id="score_saved" name="score" value="">

                    </div>

                </div>
            </div>

            <button value="送信">送信</button>
            <input type="hidden" name="name">
            <input type="hidden" name="author">
            <input type="hidden" name="thumbnail">
        </form>



    </main>
    <a href="list.php">MY本棚</a>
</body>

</html>