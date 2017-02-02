$(function () {

    var video = new WebCodeCamJS("canvas").init({
        resultFunction: function (result) {
            $('#isbn').val(result.code);
        }
    });

    $(".search").click(function () {
        $(".barcode-search").hide();
        $(".keyword-search").show();
        $(".add").show();
        video.stop();
    });
    $(".scan").click(function () {
        $(".keyword-search").hide();
        $(".barcode-search").show();
        $(".add").show();
        video.play();
    });

    //
    //★評価システムを設置★
    //
    $.fn.raty.defaults.path = "img";
    $('.score').raty({
        click: function (score, evt) {
            $('#score_saved').val(score);
        }
    });

    //★ISBNより書籍を検索★
    //
    $('#search_btn').on('click', function () {
        if ($('.keyword-search').is(':visible')) {
            var q = $('input[name="q"]').val();
        } else {
            var q = $('#isbn').val();
        }
        var url = "https://www.googleapis.com/books/v1/volumes?q=" + q;
        //ajaxでURLを投げて検索
        $.ajax({
            type: "get",
            url: url,
            dataType: "json"
        }).done(function (json) {
            //書籍情報を表示(書名、著者、表紙画像)
            //書名
            var title = json.items["0"].volumeInfo.title;
            console.log(json.items["0"].volumeInfo);
            $('#book_title').html(title);
            $('#book_title_saved').val(title);
            $('input[name="name"]').val(title);
            //著者
            var authors_list = json.items["0"].volumeInfo.authors;
            //複数の場合を考慮
            var authors = '';
            for (var i = 0; i < authors_list.length; i++) {
                authors = authors + authors_list[i];
                //最後の著者以外はカンマ区切りでつなげる
                if (i != authors_list.length - 1) {
                    authors = authors + ' & ';
                }
            }
            $('#book_authors').html(authors);
            $('#book_authors_saved').val(authors);
            $('input[name="author"]').val(authors);
            //表紙画像
            var book_img = json.items["0"].volumeInfo.imageLinks.thumbnail;
            $('#book_img').attr('src', book_img);
            $('#book_img_saved').val(book_img);
            $('input[name="thumbnail"]').val(book_img);
            var description = json.items["0"].volumeInfo.description;
            $('#book_description_saved').val(description);
        });
        //検索後にISBNが変更されると厄介なので、念の為格納
        if (isbn.length == 13) {
            isbn = isbn.substr(3);
        }
        $('#isbn_saved').val(isbn);
    });



});