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

                // 自分の送信メッセージを画面に追加
                appendMessage({
                    user_name: current_user_name,
                    avatar: current_user_avatar,
                    message: message,
                    time: formatTime(new Date()),
                    isCurrentUser: true,
                });

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

    // メッセージをDOMに追加する関数
    function appendMessage({ user_name, avatar, message, time, isCurrentUser }) {
        const messageContainer = $('<div>').addClass('message');
        const userAvatar = $('<figure>')
            .addClass('c-header__image')
            .append(
                $('<img>')
                    .attr('src', avatar || '/images/avatar-default.svg')
                    .attr('alt', user_name)
            );
        const userName = $('<span>')
            .addClass('pg-transaction-chatPage-inner-message__name')
            .text(user_name);
        const messageContent = $('<div>').addClass('commonMessage').append(
            $('<div>').text(message),
            $('<div>').addClass('message-time').text(time)
        );

        messageContainer.append(userAvatar, userName, messageContent);
        $('.messages').append(messageContainer);

        // 自動スクロール
        $('.messagesArea').scrollTop($('.messagesArea')[0].scrollHeight);
    }

    // 時刻フォーマット
    function formatTime(date) {
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`;
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

            // サーバーから受信したメッセージを描画
            if (e.message.user_id !== user_id) {
                appendMessage({
                    user_name: chat_room_user_name,
                    avatar: chat_room_user_avatar,
                    message: e.message.message,
                    time: formatTime(new Date(e.message.created_at)),
                    isCurrentUser: false,
                });
            }
        });
});
