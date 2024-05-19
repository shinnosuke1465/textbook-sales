import $ from 'jquery';

$(document).on("change", "#university_id", function() {
  var universityId = $(this).val();
  var facultySelect = $("#faculty_id");
  facultySelect.empty(); // 既存のオプションをクリア

  // 大学が選択されていなければ、初期状態の選択オプションのみを追加
  if (!universityId) {
    facultySelect.append('<option value="">選択してください</option>');
    return;
  }

  // 「選択してください」オプションを先頭に追加
  facultySelect.append('<option value="">選択してください</option>');

  // AJAXリクエストを使用して選択された大学の学部データを取得
  $.ajax({
    url: `/faculties/${universityId}`,
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      data.forEach(function(faculty) {
        facultySelect.append(new Option(faculty.name, faculty.id));
      });
    },
    error: function(xhr, status, error) {
      console.error('Error:', error);
    }
  });
});
