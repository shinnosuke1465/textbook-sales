import $ from "jquery";

$(document).ready(function () {
    // 並び替えセレクトボックスの変更時にフォームを送信
    $('#sort').on('change', function () {
        $(this).closest('form').submit(); // フォームを送信
    });

    // ページネーションセレクトボックスの変更時にフォームを送信
    $('#pagination').on('change', function () {
        $(this).closest('form').submit(); // フォームを送信
    });
});
