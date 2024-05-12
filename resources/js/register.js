document.getElementById('university_id').addEventListener('change', function() {
  var universityId = this.value;
  var facultySelect = document.getElementById('faculty_id');
  facultySelect.innerHTML = ''; // 既存のオプションをクリア

  // 大学が選択されていなければ、初期状態の選択オプションのみを追加
  if (!universityId) {
      facultySelect.appendChild(new Option('選択してください', ''));
      return;
  }

  // 「選択してください」オプションを先頭に追加
  facultySelect.appendChild(new Option('選択してください', ''));

  // AJAXリクエストを使用して選択された大学の学部データを取得
  fetch(`/faculties/${universityId}`)
      .then(response => response.json()) //response(web.phpで取得した大学に関連する学部)のlist
      .then(data => { //data=response
          data.forEach(faculty => {
              var option = new Option(faculty.name, faculty.id);
              facultySelect.appendChild(option);
          });
      })
      .catch(error => console.error('Error:', error));
});
