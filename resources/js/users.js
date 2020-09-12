// 画像がアップロードされた後に、プレビューを表示する機能を実装する
// アップロードファイルの有無を確認し、ファイルがあれば、(.is-active)を追加して、ファイルを表示させる

// イベント名、対象となる要素、コールバック関数
$(document).on("change", "#file_photo", function(e) {
  // ユーザのコンピュータで、読み込んだファイルを保持しておくために必要
  var reader;
  // ファイルの有無を判定
  if (e.target.files.length) {
    // jsで操作したいのでFileReaderのオブジェクトを作成する
    reader = new FileReader;
    // イベント発生
    reader.onload = function(e) {
      var userThumbnail;
      userThumbnail = document.getElementById('thumbnail');
      // 取得したファイルを表示させるために、.is-activeクラスを付与
      $("#userImgPreview").addClass("is-active");
      // プレビュー画像を表示するためにimgタグのsrc属性に、e.target.resultで取得したファイル名を設定
      userThumbnail.setAttribute('src', e.target.result);
    };
    return reader.readAsDataURL(e.target.files[0]);
  }
});