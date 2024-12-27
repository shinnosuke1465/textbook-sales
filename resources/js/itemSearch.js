import $ from "jquery";

$(document).ready(function () {
    const $headerInput = $(".js-header-input"); // ヘッダーの検索欄
    const $resetButton = $(".c-header-form__reset"); // ヘッダーのリセットボタン
    const $itemResultsList = $(".js-item-search-result"); // 教科書一覧表示エリア

    // URLクエリパラメータを取得
    const urlParams = new URLSearchParams(window.location.search);
    const universityName = urlParams.get("university_name"); // 大学名
    const universityId = urlParams.get("university_id"); // 大学ID
    const facultyName = urlParams.get("faculty_name"); // 学部名
    const facultyId = urlParams.get("faculty_id"); // 学部ID
    const textbookName = urlParams.get("textbook_name"); // 教科書名

    // ヘッダー検索欄に大学名、学部名、教科書名をセット
    if (universityName) {
        let headerValue = universityName; // 初期値は大学名
        if (facultyName) {
            headerValue += ` ${facultyName}`; // 学部名を追加
        }
        if (textbookName) {
            headerValue += ` ${textbookName}`; // 教科書名を追加
        }
        $headerInput.val(headerValue); // 検索欄にセット
        $resetButton.show(); // リセットボタンを表示
    }

    // 教科書一覧を取得して表示
    if (universityId && facultyId) {
        $.ajax({
            url: "/item/search",
            method: "GET",
            data: { university_id: universityId, faculty_id: facultyId },
            success: function (data) {
                $itemResultsList.empty(); // 教科書リストをクリア
                if (data.length > 0) {
                    data.forEach(function (textbook) {
                        $itemResultsList.append(
                            `<li class="pg-item-inner-list-item">
                                <a href="#" class="pg-item-inner-list-item__anchor js-item-link"
                                   data-id="${textbook.id}"
                                   data-name="${textbook.name}">
                                    ${textbook.name}
                                </a>
                            </li>`
                        );
                    });
                } else {
                    $itemResultsList.append('<li>該当する教科書がありません。</li>');
                }
            },
            error: function () {
                console.error("教科書の取得に失敗しました。");
            },
        });
    }

    // 教科書名をクリックしたときにヘッダー検索欄を更新
    $itemResultsList.on("click", ".js-item-link", function (event) {
        event.preventDefault(); // デフォルトのリンク動作を無効化

        const textbookName = $(this).data("name"); // 教科書名を取得

        // ヘッダー検索欄に大学名、学部名、教科書名を表示
        if (universityName && facultyName && textbookName) {
            const fullHeaderValue = `${universityName} ${facultyName} ${textbookName}`;
            $headerInput.val(fullHeaderValue);
            $resetButton.show(); // リセットボタンを表示
        }

        // トップページに遷移して教科書を選択
        const textbookId = $(this).data("id");
        const queryString = `textbook_id=${textbookId}&university_id=${universityId}&faculty_id=${facultyId}&university_name=${encodeURIComponent(universityName)}&faculty_name=${encodeURIComponent(facultyName)}&textbook_name=${encodeURIComponent(textbookName)}`;
        window.location.href = `/textbooks?${queryString}`;
    });

    // リセットボタンクリック時にリストと検索欄をクリア
    $resetButton.on("click", function () {
        $headerInput.val(""); // 検索欄をクリア
        $resetButton.hide(); // リセットボタンを非表示
        $itemResultsList.empty(); // 教科書リストをクリア
    });
});
