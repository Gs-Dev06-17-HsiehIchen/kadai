// 最初の画面
$(function () {
    $('#start').on('click', function () {
        $('#info').slideUp();
    });
});

//-----初期設定
function initFunc() {
    selectArray = [-1, -1, -1, -1, -1];
    scoreArray = [0, 0, 0, 0, 0];
    qNum = selectArray.length;
}

function preloadFunc() {
    for (var i = 0; i < arguments.length; i++) {
        $("<img>").attr("src", arguments[i]);
    }
}

function againFunc() {
    moveFunc(-1);
    for (var i in selectArray) {
        var selectID = selectArray[i];
        $("#" + i + "_" + selectID).removeClass("selected");
    }
    initFunc(); //---初期化
}

function quesFunc() {
    var idArray = this.id.split("_");
    var qID = Number(idArray[0]);
    var ansID = Number(idArray[1]);
    var selectID = selectArray[qID];
    if (ansID == selectID) return;
    $("#" + qID + "_" + ansID).addClass("selected");
    $("#" + qID + "_" + selectID).removeClass("selected");
    selectArray[qID] = ansID;
    moveFunc(qID);

    scoreArray[qID] = Number($(this).attr("sc"));
    if (qID + 1 >= qNum) resultFunc();
}

function resultFunc() {
    var totalScore = 0;
    for (var i in scoreArray) {
        totalScore += scoreArray[i];
    }

    switch (true) {
    case totalScore >= 80:
        var lv = 4;
        break;
    case totalScore >= 60:
        var lv = 3;
        break;
    case totalScore >= 40:
        var lv = 2;
        break;
    case totalScore >= 20:
        var lv = 1;
        break;
    default:
        var lv = 0;
    }

    $("#resultPoint").text(totalScore);
    $("#resultImage").css("background-image", "url('images/lv" + lv + ".png')");
    var myData = resultArray[lv];
    $("#resultTitle").text(myData.split(",")[0]);
    $("#resultText").text(myData.split(",")[1]);
}

function moveFunc(vol) {
    var myPos = (vol + 1) * -650;
    $("#qContainer").delay(500).animate({
        left: myPos
    }, 500);
}

$(function () {
    initFunc(); //---初期化
    $.get("result.csv", function (myData) {
        resultArray = myData.split("\r\n")
    });
    preloadFunc("images/lv0.png", "images/lv1.png", "images/lv2.png", "images/lv3.png", "images/lv4.png", "images/againOn.png");
    $("ul>li").click(quesFunc);
    $("#againButton").click(againFunc);
});