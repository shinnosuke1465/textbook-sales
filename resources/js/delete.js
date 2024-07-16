import $ from "jquery";

$(document).ready(function(){
    $('.js-delete').on('click', function(event){
        event.preventDefault();
        var id = $(this).data('id');// data-id属性の値を取得
        if (confirm('本当に削除してもいいですか?')) {
            $('#delete_' + id).submit(); // フォームを送信
        }
    });
});
