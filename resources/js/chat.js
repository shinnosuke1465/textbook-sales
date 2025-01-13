import $ from 'jquery';

$(document).ready(function () {
    // CSRFトークンを設定
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // メッセージ送信処理
    function sendMessage() {
        const messageInput = $('.pg-transaction-chatPage-inner-message__input');
        const message = messageInput.val();

        if (!message.trim()) {
            alert('メッセージを入力してください。');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/transaction/chat', // 送信先URLを正しく指定
            data: {
                chat_room_id: chat_room_id,
                user_id: user_id,
                message: message,
            },
            success: function (data) {
                console.log('Message sent successfully:', data);

                // 自分の送信メッセージのみを画面に即時追加
                $('.messages').append(
                    `<div class="message">
                        <span>${current_user_name}:</span>
                        <div class="commonMessage">
                            <div>${message}</div>
                        </div>
                    </div>`
                );

                // 入力フィールドをクリア
                messageInput.val('');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                console.error(jqXHR.responseText);
                alert('メッセージの送信に失敗しました。');
            },
        });
    }

    // Enterキーでメッセージ送信
    $('.pg-transaction-chatPage-inner-message__input').off('keypress').on('keypress', function (event) {
        if (event.which === 13) {
            event.preventDefault();
            sendMessage();
        }
    });

    // 送信ボタンでメッセージ送信
    $('.pg-transaction-chatPage-inner-message__form').off('submit').on('submit', function (event) {
        event.preventDefault();
        sendMessage();
    });

    // Laravel Echoでリアルタイム受信
    window.Echo.channel(`chat-room-${chat_room_id}`) // 動的なチャンネル名を使用
        .listen('.ChatMessageSent', (e) => {
            console.log('New message received:', e);

            // サーバーから受信したメッセージのみを描画
            if (e.message.user_id !== user_id) {
                $('.messages').append(
                    `<div class="message">
                        <span>${chat_room_user_name}:</span>
                        <div class="commonMessage">
                            <div>${e.message.message}</div>
                        </div>
                    </div>`
                );
            }
        });
});
