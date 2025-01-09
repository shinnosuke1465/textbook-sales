import $ from "jquery";

$(document).ready(function () {
    const $headerInput = $('.js-header-input'); // ヘッダーの検索欄
    const $resetButton = $('.c-header-form__reset'); // ヘッダーのリセットボタン
    const $facultyResultsList = $('.js-faculty-search-result'); // 学部一覧表示エリア
    const $searchInput = $('.js-faculty-search');

    // URLクエリパラメータを取得
    const urlParams = new URLSearchParams(window.location.search);
    const universityName = urlParams.get('university_name'); // 大学名
    const universityId = urlParams.get('university_id'); // 大学ID

    // ヘッダー検索欄に大学名をセット
    if (universityName) {
        $headerInput.val(universityName); // 大学名をセット
        $resetButton.show(); // リセットボタンを表示
    }

     // ページロード時に学部リストを初期表示
    if (universityId) {
        fetchFaculties({ university_id: universityId });
    }
    // 入力イベントを監視
    $searchInput.on('input', function () {
        const keyword = $(this).val();

        // 入力値が空ならボタンを非表示、値があれば表示
        if (keyword === '') {
            // キーワードが空なら全ての学部を表示
            fetchFaculties({ university_id: universityId });
        } else {
            // キーワードがある場合はフィルタリング
            fetchFaculties({ university_id: universityId, keyword: keyword });
        }
    });

    // 学部リストを取得して表示
    function fetchFaculties(params) {
        $.ajax({
            url: '/faculty/search',
            method: 'GET',
            data: params,
            success: function (data) {
                $facultyResultsList.empty();
                if (data.length > 0) {
                    const uniqueFaculties = new Set();
                    data.forEach(function (faculty) {
                        if (!uniqueFaculties.has(faculty.name)) {
                            uniqueFaculties.add(faculty.name);
                            $facultyResultsList.append('<li class="pg-faculty-inner-list-item" data-faculty-id="' + faculty.id + '" data-name="' + faculty.name + '">' +
                                '<a class="pg-faculty-inner-list-item__anchor js-faculty-link" href="#">' + faculty.name + '</a></li>');
                        }
                    });
                } else {
                    $facultyResultsList.append('<li>該当する学部がありません。</li>');
                }
            },
            error: function () {
                console.error('学部リストの取得に失敗しました。');
            }
        });
    }

    // 学部名をクリックしたら/itemページに遷移
    $facultyResultsList.on('click', '.js-faculty-link', function (event) {
        event.preventDefault(); // デフォルトのリンク動作を無効化

        const $facultyItem = $(this).closest('.pg-faculty-inner-list-item');
        const facultyId = $facultyItem.data('faculty-id'); // 学部IDを取得
        const facultyName = $facultyItem.data('name'); // 学部名を取得

        // ヘッダー検索欄を更新
        if (universityName && facultyName) {
            $headerInput.val(`${universityName} ${facultyName}`); // 大学名と学部名をセット
        }

        // /itemページに遷移
        const queryString = `university_id=${universityId}&faculty_id=${facultyId}&university_name=${encodeURIComponent(universityName)}&faculty_name=${encodeURIComponent(facultyName)}`;
        window.location.href = `/item?${queryString}`;
    });

    // リセットボタンクリック時に大学名と学部リストをクリア
    $resetButton.on('click', function () {
        $headerInput.val(''); // 検索欄をクリア
        $resetButton.hide(); // リセットボタンを非表示
        $facultyResultsList.empty(); // 学部リストをクリア
    });
});
