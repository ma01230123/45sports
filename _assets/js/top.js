
// 特殊文字をエスケープするfunction
function escapeStr(idname) {
  var str = $('#' + idname).val();
  str = str.replace(/&/g, "&amp;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/\n/g, "<br>");

  return str
}

//スクロールしたらふわっと表示

// document.addEventListener("DOMContentLoaded", function () {

// const header = document.querySelector('header');
// const content = document.querySelector('.js-content');

// function onScrollCallback(entries) {
//   entries.forEach(entry => {
//     if (!entry.isIntersecting) {
//       header.classList.add('is-scroll');
//       content.classList.add('is-scroll');
//     } else {
//       header.classList.remove('is-scroll');
//       content.classList.remove('is-scroll');
//     }
//   });
// }
// const onScrollObserver = new IntersectionObserver(onScrollCallback);

// onScrollObserver.observe(document.querySelector('.p-top-mv'));

// });



jQuery(function ($) {

  // トップページメインビジュアルスライダー
$('.js-top-mv').slick({
  autoplay: true, //自動でスクロール
  autoplaySpeed: 5000, //自動再生のスライド切り替えまでの時間を設定
  speed: 1000, //スライドが流れる速度を設定
  cssEase: "linear", //スライドの流れ方を等速に設定
  fade: true,
  slidesToShow: 1, //表示するスライドの数
  swipe: false, // 操作による切り替えはさせない
  arrows: false, //矢印非表示
  pauseOnFocus: false, //スライダーをフォーカスした時にスライドを停止させるか
  pauseOnHover: false, //スライダーにマウスホバーした時にスライドを停止させるか
  dots: false,
});

});


