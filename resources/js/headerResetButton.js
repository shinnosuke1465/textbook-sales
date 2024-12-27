import $ from "jquery";

$(document).ready(function () {
    // 検索欄と結果表示エリアの要素
    const $headerSearchInput = $('.js-header-input'); // トップページ検索欄
    const $headerResetButton = $('.js-reset-button'); // トップページのリセットボタン

    // 検索欄の入力イベント
    $headerSearchInput.on('input', function () {
        const keyword = $(this).val();

        // キーワードが空ならリセットボタンを非表示、入力があれば表示
        if (keyword === '') {
            $headerResetButton.hide();
        } else {
            $headerResetButton.show();
        }
    });

    // リセットボタンのクリックイベント
    $headerResetButton.on('click', function () {
        $headerSearchInput.val(''); // 検索欄をクリア
        $(this).hide(); // リセットボタンを非表示

        // クエリパラメータを削除してルートURLにリダイレクト
        window.location.href = window.location.origin + window.location.pathname;
    });
});
