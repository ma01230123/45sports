const gulp = require('gulp');
const del = require('del');

//pug
var pug = require('gulp-pug');


//scss
const sass = require('gulp-dart-sass'); //Dart Sass はSass公式が推奨 @use構文などが使える
const plumber = require("gulp-plumber"); // エラーが発生しても強制終了させない
const notify = require("gulp-notify"); // エラー発生時のアラート出力
const browserSync = require("browser-sync"); //ブラウザリロード
const autoprefixer = require('gulp-autoprefixer'); //ベンダープレフィックス自動付与
const postcss = require("gulp-postcss"); //css-mqpackerを使うために必要
const mqpacker = require('css-mqpacker'); //メディアクエリをまとめる


//画像圧縮
const imagemin = require("gulp-imagemin");
const imageminMozjpeg = require("imagemin-mozjpeg");
const imageminPngquant = require("imagemin-pngquant");
const imageminSvgo = require("imagemin-svgo");


// 入出力するフォルダを指定
const srcBase = '_assets';
const assetsBase = '_assets';
//毎回変更!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// const distBase = '../../Local Sites/14test/app/public/wp-content/themes/test/assets';
// const distSrc = '../../Local Sites/14test/app/public/wp-content/themes/test';
const distBase = '../../Local Sites/45sports/app/public/wp-content/themes/sports/assets';
const distSrc = '../../Local Sites/45sports/app/public/wp-content/themes/sports';



const srcPath = {
  'scss': assetsBase + '/scss/**/*.scss',
  'js': assetsBase + '/js/**/*.js',
  'img': assetsBase + '/img/**/*{jpg,jpeg,png,gif}',
  'svg': assetsBase + '/img/**/*{svg,ico}',
  'font': assetsBase + '/font/**/*',
  // 'html': srcBase + '/**/*.html',
  //pugコンパイル用パス
  'pug': srcBase + '/**/!(_)*.pug',
  //pug監視用パス
  'pugAll': srcBase + '/**/*.pug',
  'php': srcBase + '/**/*.php'
};


const distPath = {
  'css': distBase + '/css/',
  'js': distBase + '/js/',
  'img': distBase + '/img/',
  'svg': distBase + '/img/',
  'font': distBase + '/font/',
  // 'html': distBase + '/',
  'pug': distSrc + '/',
  'php': distSrc + '/',
};


/**
 * clean
 */
const clean = () => {
  return del([distBase + '/**'], {
    force: true
  });
}

//ベンダープレフィックスを付与する条件
const TARGET_BROWSERS = [
  'last 2 versions',
  // 'ie >= 11',
  'iOS >= 7',
  'Android >= 4.4'
];

/**
 * sass
 *
 */
var cssSass = () => {
  return gulp.src(srcPath.scss, {
    sourcemaps: true
  })
    .pipe(
      //エラーが出ても処理を止めない
      plumber({
        errorHandler: notify.onError('Error:<%= error.message %>')
      }))
    .pipe(sass({
      outputStyle: 'expanded'
    })) //指定できるキー expanded compressed
    .pipe(autoprefixer(TARGET_BROWSERS))
    .pipe(postcss([mqpacker()])) // メディアクエリをまとめる
    .pipe(gulp.dest(distPath.css, {
      sourcemaps: './'
    })) //コンパイル先
    .pipe(browserSync.stream())
    .pipe(notify({
      message: 'Sassをコンパイルしました！',
      onLast: true
    }))
}

/**
 * 画像圧縮
 */
const imgImagemin = () => {
  return gulp.src(srcPath.img)
    .pipe(
      imagemin(
        [
          imageminMozjpeg({
            quality: 80
          }),
          imageminPngquant(),
          imageminSvgo({
            plugins: [{
              removeViewbox: false
            }]
          })
        ], {
        verbose: true
      }
      )
    )
    .pipe(gulp.dest(distPath.img))
}

/**
 * svg
 */
 const svg = () => {
  return gulp.src(srcPath.svg)
    .pipe(gulp.dest(distPath.svg))
}

/**
 * html
 */
// const html = () => {
//   return gulp.src(srcPath.html)
//     .pipe(gulp.dest(distPath.html))
// }

/**
 * pug
 */
const compilePug = () => {
  return gulp.src(srcPath.pug)
    .pipe(pug({
      pretty: true
    }))
    .pipe(gulp.dest(distPath.pug));
};





/**
 * js
 */
const js = () => {
  return gulp.src(srcPath.js)
    .pipe(gulp.dest(distPath.js))
}


/**
 * php
 */
const php = () => {
  return gulp.src(srcPath.php)
    .pipe(gulp.dest(distPath.php))
}

/**
 * 独自fontをsrc配下に読み込む際の対応
 */
const font = () => {
  return gulp.src(srcPath.font)
    .pipe(gulp.dest(distPath.font))
}

/**
 * ローカルサーバー立ち上げ
 */
const browserSyncFunc = () => {
  browserSync.init(browserSyncOption);
}

const browserSyncOption = {
  // server: distBase
  //環境によって変更する!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  proxy: 'http://45sports.local/'
}


/**
 * リロード
 */
const browserSyncReload = (done) => {
  browserSync.reload();
  done();
}

/**
 *
 * ファイル監視 ファイルの変更を検知したら、browserSyncReloadでreloadメソッドを呼び出す
 * series 順番に実行
 * watch('監視するファイル',処理)
 */
const watchFiles = () => {
  gulp.watch(srcPath.scss, gulp.series(cssSass))
  // gulp.watch(srcPath.html, gulp.series(html, browserSyncReload))
  gulp.watch(srcPath.pugAll, gulp.series(compilePug, browserSyncReload))
  gulp.watch(srcPath.js, gulp.series(js, browserSyncReload))
  gulp.watch(srcPath.img, gulp.series(imgImagemin, browserSyncReload))
  gulp.watch(srcPath.svg, gulp.series(svg,browserSyncReload))
  gulp.watch(srcPath.php, gulp.series(php, browserSyncReload))
  gulp.watch(srcPath.font, gulp.series(font, browserSyncReload))
}


/**
 * seriesは「順番」に実行
 * parallelは並列で実行
 *
 * 一度cleanでdistフォルダ内を削除し、最新のものをdistする
 */
exports.default = gulp.series(
  clean,
  gulp.parallel( cssSass, js, imgImagemin, font, svg),
  gulp.parallel(watchFiles, browserSyncFunc)
);

