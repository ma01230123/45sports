
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
//「js-target.animate」が目印　「is-active」クラスを付ける
  // 画面が読み込まれてから　ｊｓがスタート
  document.addEventListener("DOMContentLoaded", function () {
    //アニメーションのコールバック関数
  function inViewCallback(entries, obs) {
    entries.forEach(entry => {
      if (!entry.isIntersecting) {
        return;
      }

      entry.target.classList.add('is-active');
      obs.unobserve(entry.target);
    });
  }
   //アニメーションのオブザーバーの設定
  const inViewObserver = new IntersectionObserver(inViewCallback, {
    threshold: 0.2,
  });
  //アニメーションコールバック関数の呼び出し
  document.querySelectorAll('.js-target,.animate').forEach(el => {
    inViewObserver.observe(el);
  });


// const header = document.querySelector('header');
// const content = document.querySelector('.js-content');
// const toTop = document.getElementById('js-toTop');



// function onScrollCallback(entries) {
//   entries.forEach(entry => {
//     if (!entry.isIntersecting) {
//       header.classList.add('is-scroll');
//       content.classList.add('is-scroll');
//       toTop.classList.add('is-scroll');
//     } else {
//       header.classList.remove('is-scroll');
//       content.classList.remove('is-scroll');
//       toTop.classList.remove('is-scroll');
//     }
//   });
// }
// const onScrollObserver = new IntersectionObserver(onScrollCallback,options);

// onScrollObserver.observe(header);

// toTop.addEventListener('click', e => {
//   e.preventDefault();

//   window.scrollTo({
//     top: 0,
//     behavior: 'smooth',
//   });
// });

});


document.addEventListener('DOMContentLoaded', function() {
  window.addEventListener('scroll', handleScroll);
  handleScroll();
});

// スクロールイベントが発生したときに呼び出される関数
function handleScroll() {
  var toTopBtn = document.getElementById('js-toTop');
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      toTopBtn.classList.add('is-scroll');
  } else {
      toTopBtn.classList.remove('is-scroll');
  }
}

// ボタンがクリックされたときに呼び出される関数
function scrollToTop() {
  window.scrollTo({
      top: 0,
      behavior: 'smooth'
  });
}



document.addEventListener('DOMContentLoaded', function () {
  // ハンバーガーメニューのアイコンとメニュー本体の要素を取得
  var iconButton = document.querySelector('.js-icon');
  var contentMenu = document.querySelector('.js-content');

  // ハンバーガーメニューのクリックイベントを設定
  iconButton.addEventListener('click', function () {
    // メニュー本体に 'is-active' クラスをトグルして表示・非表示を切り替え
    if(iconButton.classList.contains('is-checked')){
      submenuToggleButtons.forEach(function(element){
        element.classList.remove('is-checked');
        element.lastElementChild.classList.remove('is-checked');
      });
    };
    contentMenu.classList.toggle('is-checked');
    iconButton.classList.toggle('is-checked');
  });
  
  var submenuToggleButtons = document.querySelectorAll('.menu-item-has-children');
  // サブメニューのトグルボタン
  submenuToggleButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      // event.preventDefault(); 
      this.lastElementChild.classList.toggle('is-checked'); // サブメニューの表示・非表示を切り替え
      this.classList.toggle('is-checked'); // サブメニューの表示・非表示を切り替え
    });
  });
});



jQuery(function ($) {

//ハッシュタグをクリックした時の動き
  $(document).ready(function () {
    //位置・時間調整
    var time = 500;
    var adjust = -100;
    jQuery(window).scroll(function () {
      var winW = $(window).width();
      var SpW = 640;
        if (winW <= SpW) {
          adjust = -80;
        }
      });
    //URLのハッシュ値を取得
    var urlHash = location.hash;
    //ハッシュ値があればページ内スクロール
    if (urlHash) {
      //スクロールを0に戻しておく
      $('body,html').stop().scrollTop(0);
      setTimeout(function () {
        //ロード時の処理を待ち、時間差でスクロール実行
        scrollToAnchor(urlHash);
      }, 100);
    }

    //通常のクリック時
    $('a[href^="#"]').on('click', function (event) {
      event.preventDefault();
      // ハッシュ値を取得して URI デコードする
      var decodedHash = decodeURI(this.hash);
      // ハッシュの確認
      // console.log(decodedHash);
      //リンク先が#か空だったらhtmlに
      var hash = decodedHash == "#" || decodedHash == "" ? 'html' : decodedHash;
      //スクロール実行
      // alert(adjust);
      scrollToAnchor(hash);
      return false;
    });

    // 関数：スムーススクロール
    // 指定したアンカー(#ID)へアニメーションでスクロール
    function scrollToAnchor(hash) {
      var target = $(hash);
      if(target.length){
        var position = target.offset().top + adjust;
        $('body,html').stop().animate({ scrollTop: position }, time, 'swing');
      }
    }
  });

  $(document).ready(function() {
    $('a[href^="#"]').on('click', function (event) {
        event.preventDefault();
        var decodedHash = decodeURI(this.hash);
        var hash = decodedHash == "#" || decodedHash == "" ? 'html' : decodedHash;
        scrollToAnchor(hash);
    });
});


});


