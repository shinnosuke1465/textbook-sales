import $ from "jquery";

//ページがロードされた時の処理
$(document).ready(function () {
    var universityId = $("#university_id").val(); //大学のidを取得
    var facultySelect = $("#faculty_id"); //学科のselectタグを取得

    //編集画面で大学学部を初期表示
    // 初期表示で大学が選択されている場合、関連する学部データを取得
    if (universityId) {
        loadFaculties(universityId);
    }

    //大学選択時に学部データをロード
    $(document).on("change", "#university_id", function () {
        var universityId = $(this).val();
        facultySelect.empty(); // 既存のオプションをクリア

        // 大学が選択されていなければ、初期状態の選択オプションのみを追加
        if (!universityId) {
            facultySelect.append('<option value="">選択してください</option>');
            return;
        }

        // 「選択してください」オプションを先頭に追加
        facultySelect.append('<option value="">選択してください</option>');

        //選択された大学の学部データを取得
        loadFaculties(universityId);
    });

    function loadFaculties(universityId){
        // AJAXリクエストを使用して選択された大学の学部データを取得
        $.ajax({
            url: `/faculties/${universityId}`,
            method: "GET",
            dataType: "json",
            success: function (data) {
                data.forEach(function (faculty) {
                    facultySelect.append(new Option(faculty.name, faculty.id)); //select要素に<option id="id">name</option>を追加していく
                });
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            },
        });
    }
});
