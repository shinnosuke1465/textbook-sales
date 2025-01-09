import $ from "jquery";

$(document).ready(function () {
    const $searchInput = $('.js-university-search');
    const $resultsList = $('.js-university-search-result');
    const $resetButton = $('.js-reset-button');

    // URLクエリパラメータを取得
    const urlParams = new URLSearchParams(window.location.search);
    const initialKeyword = urlParams.get('keyword'); // 初期キーワード（オプション）

    // ページロード時に大学リストを初期表示
    fetchUniversities({ keyword: initialKeyword });

    // 入力イベントを監視
    $searchInput.on('input', function () {
        const keyword = $(this).val();

        // 入力値が空なら全ての大学を表示
        if (keyword === '') {
            $resetButton.hide();
            fetchUniversities(); // 全大学を再取得
        } else {
            $resetButton.show();
            fetchUniversities({ keyword: keyword }); // キーワードに基づく検索
        }
    });

    // リセットボタンのクリックイベント
    $resetButton.on('click', function () {
        $searchInput.val(''); // 検索欄をクリア
        $resetButton.hide(); // ボタンを非表示
        fetchUniversities(); // 全大学を再取得
    });

    // 大学名クリックイベント
    $resultsList.on('click', '.js-university-link', function (event) {
        event.preventDefault(); // デフォルトのリンク動作を無効化

        const universityId = $(this).data('id');
        const universityName = $(this).data('name');

        // /facultyページにクエリパラメータを追加して遷移
        window.location.href = `/faculty?university_id=${universityId}&university_name=${encodeURIComponent(universityName)}`;
    });

    // Ajaxで大学リストを取得して表示
    function fetchUniversities(params = {}) {
        $.ajax({
            url: '/university/search',
            method: 'GET',
            data: params,
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
                console.error('大学リストの取得に失敗しました。');
            }
        });
    }
});
