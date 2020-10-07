
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // チャット画面で文字入力後、エンターキーが押されたらPOST通信を実施
    $('.messageInputForm_input').keypress(function (event) {
        if(event.which === 13){
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/chat/chat',
                data: {
                    chat_room_id: chat_room_id,
                    user_id: user_id,
                    message: $('.messageInputForm_input').val(),
                },
            
            })
            
            .done(function(data){
                //console.log(data);
                event.target.value = '';
            });

        }
    });

    window.Echo.channel('ChatRoomChannel')
    .listen('ChatPusher', (e) => {
        console.log(e, e.message.user_id);
        if(e.message.user_id === user_id){
            console.log(true);
        $('.messages').append(
            '<div class="message"><div class="message-right"><span style="padding-top:40px; padding-right:18px">' + e.message.created_at + '</span><div class="commonMessage"><div>' + 
            e.message.message + '</div></div>' + '<span style="padding-top:30px; padding-right:18px">' + current_user_name + '</span>' + '</div></div>');
        }else{
            console.log(false);
        $('.messages').append(
            '<div class="message"><div class="message-right"><span>' + e.message.created_at + '</span><span>' + chat_room_user_name + 
            '</span><div class="commonMessage"><div>' +
            e.message.message + '</div></div></div></div>');    
        }
    });

    $(function(){
        var imgHeight = $('.js-chatPage').outerHeight(); //画像の高さを取得。これがイベント発火位置になる
        var pageHeader = $('.js-chatHeader'); //ヘッダーコンテンツ
      
        $(window).on('load scroll', function(){
           if ($(window).scrollTop() < pageHeader) {
             //メインビジュアル内にいるので、クラスを外す。
             pageHeader.removeClass('headerColor-default');
           }else {
             //メインビジュアルより下までスクロールしたので、クラスを付けて色を変える
             pageHeader.addClass('headerColor-default');
           }
        });

    });

});
