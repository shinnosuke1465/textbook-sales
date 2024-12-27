import $ from "jquery";

$(document).ready(function () {
    // 検索欄と結果表示エリアの要素
    const $searchInput = $('.js-university-search');
    const $resultsList = $('.js-university-search-result');
    const $resetButton = $('.js-reset-button');

    // 入力イベントを監視
    $searchInput.on('input', function () {
        const keyword = $(this).val();

        // 入力値が空ならボタンを非表示、値があれば表示
        if (keyword === '') {
            $resetButton.hide();
            $resultsList.empty(); // 結果もクリア
        } else {
            $resetButton.show();
        }

        // Ajaxで検索リクエストを送信
        $.ajax({
            url: '/university/search',
            method: 'GET',
            data: { keyword: keyword },
            success: function (data) {
                $resultsList.empty();
                if (data.length > 0) {
                    data.forEach(function (university) {
                        $resultsList.append('<li class="pg-university-inner-list-item">' +
                            '<a class="pg-university-inner-list-item__anchor" href="/textbooks?university_id=' + university.id +  '&keyword=' + university.name + '">' +
                            university.name +
                            '</a></li>');
                    });
                } else {
                    $resultsList.append('<li>該当する大学がありません。</li>');
                }
            },
            error: function () {
                console.error('検索に失敗しました。');
            }
        });
    });

    // リセットボタンのクリックイベント
    $resetButton.on('click', function () {
        $searchInput.val(''); // 検索欄をクリア
        $resultsList.empty(); // 結果をクリア
        $resetButton.hide(); // ボタンを非表示
    });
});
