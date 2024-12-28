import $ from "jquery";

$(document).ready(function () {
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
                            '<a class="pg-university-inner-list-item__anchor js-university-link" href="#" data-id="' + university.id + '" data-name="' + university.name + '">' +
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

    // 大学名クリックイベント
    $resultsList.on('click', '.js-university-link', function (event) {
        event.preventDefault(); // デフォルトのリンク動作を無効化

        const universityId = $(this).data('id');
        const universityName = $(this).data('name');

        // /facultyページにクエリパラメータを追加して遷移
        window.location.href = `/faculty?university_id=${universityId}&university_name=${encodeURIComponent(universityName)}`;
    });

    // リセットボタンのクリックイベント
    $resetButton.on('click', function () {
        $searchInput.val(''); // 検索欄をクリア
        $resultsList.empty(); // 結果をクリア
        $resetButton.hide(); // ボタンを非表示
    });
});
