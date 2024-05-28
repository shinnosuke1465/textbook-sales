import $ from "jquery";

//file_photoというIDを持つ要素が変更されたとき関数が呼ばれる
$(document).on("change", "#avatar", function (e) {
    var reader;
    //選択されたファイルが1つ以上あるとき
    if (e.target.files.length) {
        //FileReaderオブジェクトを作成。JavaScriptでファイル操作をしたい時はFileReaderのオブジェクトを作成
        reader = new FileReader();
        //FileReaderがファイルの読み込みを完了したときに実行される
        reader.onload = function (e) {
            var userThumbnail;
            //idが'thumbnail'の要素を取得。プレビュー画像を表示する<img>タグを指している。
            userThumbnail = document.getElementById("thumbnail");
            userThumbnail.removeAttribute("src");
            //idが'userImgPreview'の要素に'is-active'クラスを追加。これによりプレビュー画像がアクティブになり、画像が表示される
            $("#userImgPreview").addClass("is-active");
            //imgタグのsrc属性を、読み込んだ画像のデータURLに設定
            userThumbnail.setAttribute("src", e.target.result);
        };
        //ユーザーが選択した最初のファイルをデータURLとして読み込みます。
        return reader.readAsDataURL(e.target.files[0]);
    }
});
