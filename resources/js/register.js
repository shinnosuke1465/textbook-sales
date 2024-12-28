import $ from "jquery";

$(document).ready(function () {
    const $universitySelect = $("#university_id");
    const $facultySelect = $("#faculty_id");
    const $newUniversityWrapper = $("#new_university_wrapper");
    const $newFacultyWrapper = $("#new_faculty_wrapper");
    const $newUniversityInput = $("#new_university");
    const $newFacultyInput = $("#new_faculty");

    // ページ読み込み時: 大学が選択されていたら学部をロード
    // (編集画面やバリデーションエラー時の戻りなどを考慮)
    const initialUniVal = $universitySelect.val();
    if (initialUniVal && initialUniVal !== "__other__") {
        loadFaculties(initialUniVal);
    }

    // 大学<select>のchangeイベント
    $universitySelect.on("change", function () {
        const universityId = $(this).val();

        // 大学を「その他（新規追加）」にした場合
        if (universityId === "__other__") {
            // 既存の学部一覧は不要になるのでクリア
            $facultySelect.empty();
            // 「選択してください」か、あるいは学部も「その他」オンリーにする
            $facultySelect.append('<option value="">選択してください</option>');
            $facultySelect.append('<option value="__other__">その他（新規追加）</option>');

            // 大学名入力欄を表示してクリア
            $newUniversityWrapper.show();
            $newUniversityInput.val("");

            // 学部入力欄も一旦非表示にしてクリア
            $newFacultyWrapper.hide();
            $newFacultyInput.val("");
        } else {
            // 大学が既存のIDのとき
            // 大学名入力欄は非表示
            $newUniversityWrapper.hide();
            $newUniversityInput.val("");

            // 学部一覧をロード
            if (universityId) {
                loadFaculties(universityId);
            } else {
                // 大学を未選択に戻した場合
                $facultySelect.empty();
                $facultySelect.append('<option value="">選択してください</option>');
                $facultySelect.append('<option value="__other__">その他（新規追加）</option>');
            }
        }
    });

    // 学部<select>のchangeイベント
    $facultySelect.on("change", function () {
        const facultyVal = $(this).val();
        if (facultyVal === "__other__") {
            // 「その他」を選んだら新規学部用の入力欄を表示
            $newFacultyWrapper.show();
            $newFacultyInput.val("");
        } else {
            // 既存または空の場合は学部入力欄を消す
            $newFacultyWrapper.hide();
            $newFacultyInput.val("");
        }
    });

    /**
     * 大学ID を指定して学部リストを AJAX で取得し、<select> に反映する。
     * 最後に「その他」オプションを追加する。
     */
    function loadFaculties(universityId) {
        $.ajax({
            url: `/faculties/${universityId}`,
            method: "GET",
            dataType: "json",
            success: function (data) {
                // <select>を空にする
                $facultySelect.empty();

                // 先頭に「選択してください」
                $facultySelect.append('<option value="">選択してください</option>');

                // Ajaxで取得した既存学部を追加
                data.forEach(function (faculty) {
                    $facultySelect.append(
                        new Option(faculty.name, faculty.id)
                    );
                });

                // 最後に「その他（新規追加）」を追加
                $facultySelect.append('<option value="__other__">その他（新規追加）</option>');
            },
            error: function (xhr, status, error) {
                console.error("学部一覧の取得に失敗しました:", error);
            },
        });
    }
});
