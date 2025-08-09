
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



// document.addEventListener('DOMContentLoaded', function () {
//   const swiper_top = new Swiper('.swiper--top', {
//     slidesPerView: 'auto',      // CSS の幅をそのまま使う
//     loop: true,                 // 無限ループ
//     speed: 5000,                // 一周あたりの時間（ミリ秒）
//     spaceBetween: 30,           // スライド間の余白
//     allowTouchMove: false,      // タッチスワイプ禁止
//     freeMode: true,             // freeMode を有効化すると“慣性スクロール”が働く
//     freeModeMomentum: false,    // 慣性をオフにして一定速に
//     autoplay: {
//       delay: 0,                 // 途切れなく再生
//       disableOnInteraction: false,
//     },
//   });

//   const swiper_bottom = new Swiper('.swiper--bottom', {
//     slidesPerView: 'auto',      // CSS の幅をそのまま使う
//     loop: true,                 // 無限ループ
//     speed: 5000,                // 一周あたりの時間（ミリ秒）
//     spaceBetween: 30,           // スライド間の余白
//     allowTouchMove: false,      // タッチスワイプ禁止
//     freeMode: true,             // freeMode を有効化すると“慣性スクロール”が働く
//     freeModeMomentum: false,    // 慣性をオフにして一定速に
//     autoplay: {
//       delay: 0,                 // 途切れなく再生
//       disableOnInteraction: false,
//       reverseDirection: true,
//     },
//   });
// });




document.addEventListener('DOMContentLoaded', () => {
  // ─── 共通オプション ───
  const commonOptions = {
    slidesPerView: 'auto',
    loop: true,
    speed: 5000,
    spaceBetween: 21,            // ← スマホをデフォルトにする
    allowTouchMove: false,
    freeMode: true,
    freeModeMomentum: false,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
      // reverseDirection: false
    },
    // 768px 以上は 30 に上書き
    breakpoints: {
      768: { spaceBetween: 30 }
    }
  };

  // ─── スライダー初期化用ヘルパー ───
  function initAutoSwiper(selector, reverse = false) {
    const opts = {
      ...commonOptions,
      autoplay: {
        ...commonOptions.autoplay,
        ...(reverse && { reverseDirection: true }),
      },
    };
    new Swiper(selector, opts);
  }

  // トップは通常回転、ボトムは逆回転
  initAutoSwiper('.swiper--top');
  initAutoSwiper('.swiper--bottom', true);
});

//トップページのタブの動き
// document.addEventListener('DOMContentLoaded', () => {
//   const buttons = document.querySelectorAll('.top .c-tab__btn');
//   const contents = document.querySelectorAll('.top .c-tab__content');

//   buttons.forEach(button => {
//     button.addEventListener('click', () => {
//       const target = button.dataset.tab;

//       buttons.forEach(btn => btn.classList.remove('is-active'));
//       contents.forEach(content => content.classList.remove('is-active'));

//       button.classList.add('is-active');
//       document.getElementById(target).classList.add('is-active');
//     });
//   });
// });


//トップページのタブの切替（ページの途中なのでJS）
document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll('.js-tab-btn');
  const contents = document.querySelectorAll('.js-tab-content');

  buttons.forEach(button => {
    button.addEventListener('click', () => {
      const target = button.dataset.tab;

      buttons.forEach(btn => btn.classList.remove('is-active'));
      contents.forEach(content => content.classList.remove('is-active'));

      button.classList.add('is-active');
      document.getElementById(target).classList.add('is-active');
    });
  });
});
