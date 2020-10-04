// like した場合、dislikeした場合共に、下記の3つの情報をPOST通信で送信するようにする
// to_user_id ・・ 表示されているユーザー
// from_user_id ・・ ログインしているユーザー
// status ・・ like か dislike

$(function(){

var currentUserIndex = 0;
var postLike = function (to_user_id, like) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });
  $.ajax({
    // POST通信で3つの情報を送信
    type: "POST",
    url: "/api/like",
    data: {
      to_user_id: to_user_id,
      from_user_id: from_user_id,
      like: like,
    },
    success: function () {
      console.log("success")
    }
  });
}
$("#tinderslide").jTinder({
  // 起動メソッド
  onDislike: function (item) {
    currentUserIndex++;
    checkUserNum();
    var to_user_id = item[0].dataset.user_id
    postLike(to_user_id, 'dislike')
  },
  onLike: function (item) {
    currentUserIndex++;
    checkUserNum();
    var to_user_id = item[0].dataset.user_id
    postLike(to_user_id, 'like')
  },
  animationRevertSpeed: 200,
  animationSpeed: 400,
  threshold: 1,
  likeSelector: '.like',
  dislikeSelector: '.dislike'
});

$('.actions .like, .actions .dislike').on('click', function (e) {
  window.console.log('ajaxは動いてるよ');
  window.console.log(currentUserIndex);
  window.console.log(usersNum);
  window.console.log(usersNumSelected );

  e.preventDefault();

  $("#tinderslide").jTinder($(this).attr('class'));
});

function checkUserNum() {
  // スワイプするユーザー数とスワイプした回数が同じになればaddClassする
  if (currentUserIndex === usersNum || currentUserIndex === usersNumSelected ) {
    $(".noUser").addClass("is-active");
    $("#actionBtnArea").addClass("is-none")
    return;
  }
}

$('.reactions .like').on('click', function () {
    window.console.log('ajaxは動いてるよ');
    $(this).addClass('is-liked');
    document.getElementById("text").innerHTML ="いいね済み";
    
    $.ajax({
      // POST通信で3つの情報を送信
      type: "POST",
      url: "/api/like",
      data: {
        to_user_id: $(this).data('to_user_id'),
        from_user_id: $(this).data('from_user_id'),
        like: 'like',
      },
      success: function() {
        console.log('成功');
      },
      error: function(){
        console.log('失敗');
      }
    })
  });  

});
