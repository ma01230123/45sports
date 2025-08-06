<?php get_header(); ?>
<!-- トップ 　メインビジュアル -->
<main>

  <div class="p-top-mv">
    <!-- "club" の子ページを取得 -->
    <?php
    $club_page = get_page_by_path('club');
    // 子ページを取得するクエリ
    $club_children = new WP_Query(array(
      'post_type' => 'page',
      'post_parent' => $club_page->ID,
      'posts_per_page' => -1,
      'orderby' => 'rand',
      'cache_results' => false,
      'update_post_meta_cache' => false,
      'update_post_term_cache' => false,
      'no_found_rows' => true,
    ));
    ?>
    <div class="swiper swiper--top p-top-mv__slider-top">
      <div class="swiper-wrapper">
        <?php
        // 変数をテンプレートに渡す
        set_query_var('club_children', $club_children);
        get_template_part('template/slider');
        ?>
      </div>
    </div>
    <div class="p-top-mv__text">
      スポーツ
      <span class="p-top-mv__text-small">でつながる、</span><br class="u-hidden-pc u-hidden-tab">
      <span class="p-top-mv__text-blue">ま<span class="p-top-mv__text-narrow">ち</span></span>
      <span class="p-top-mv__text-narrow">・</span>
      <span class="p-top-mv__text-orange">ひ<span class="p-top-mv__text-narrow">と</span></span>
      <span class="p-top-mv__text-narrow">・</span>
      <span class="p-top-mv__text-green">世代</span>
    </div><!-- /.p-top-mv__text -->
    <div class="swiper swiper--bottom p-top-mv__slider-bottom">
      <div class="swiper-wrapper">
        <?php
        // 変数をテンプレートに渡す
        set_query_var('club_children', $club_children);
        get_template_part('template/slider');
        ?>
      </div>
    </div>
  </div>



  <!-- トップ　兵庫県協議会とは？-->
  <section class="p-top-about">
    <div class="p-top-about__inner c-inner">
      <div class="p-top-about__content">
        <div class="p-top-about__content-title">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-about-logo.png" alt="">
          <h2 class="c-ttl c-ttl--44 u-ls01"><span class="c-ttl c-ttl--32 u-ls01">総合型地域スポーツクラブ</span><br>
            兵庫県協議会とは？</h2>
        </div>
        <p class="p-top-about__content-text">
          兵庫県におけるスポーツ推進の基本理念である<br>
          「スポーツ立県ひょうご」の実現に向けて、<br>
          総合型地域スポーツクラブの持続可能な<br class="u-hidden-pc u-hidden-tab">運営体制の構築を図り、<br>
          総合型クラブが「社会的な仕組み」として<br>
          地域社会に定着することを目的とした組織です。<br>
          <span class="u-color-orange">日本スポーツ協会に認定された</span><br>
          兵庫県内18のクラブで構成されています。
        </p>
        <div class="p-top-about__content-btn c-btn u-hidden-sp u-hidden-tab">
          <a href="<?php echo esc_url(home_url('/')); ?>about">
            詳しくはこちら
          </a>
        </div>
      </div><!-- /.p-top-about__content -->
      <div class="p-top-about__map">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-about-map.png" alt="">
        <div class="p-top-about__content-btn c-btn u-hidden-pc">
          <a href="<?php echo esc_url(home_url('/')); ?>about">
            詳しくはこちら
          </a>
        </div>
      </div><!-- /.p-top-about__map -->

    </div>
    <div class="p-top-about__triangle"></div>
  </section><!-- /.p-top-about -->

  <!-- トップ　各クラブのご紹介 -->
  <section class="p-top-club">
    <div class="p-top-club__inner c-inner">
      <h2 class="c-ttl-img c-ttl-img--white">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-club.png" alt="">
        各クラブのご紹介
        <span>Club Introduction</span>
      </h2>
      

    </div><!-- /.p-top-club__inner -->

  </section>

  <!-- トップ　登録制度について-->
  <section class="p-top-consider">
    <!-- <div class="p-top-product__inner">
      <div class="p-top-product__warp">
        <div class="p-top-product__title-en c-ttl-bordering c-ttl-bordering--2row">
          PRODUCT<br class="u-hidden-sp">
          INTRODUCTION
        </div>
        <h2 class="p-top-product__title-ja c-text-20">製品紹介</h2>
        <p class="p-top-product__text">
          電気的エネルギーを機械的な動作に変換する装置を”ソレノイド”と呼んでいます。信和工業は”ソレノイド”を活用した流体制御機器で皆様のお役に立ち豊かな暮らしに貢献いたします。
        </p>
      </div>

    </div> -->
  </section>


  <!-- トップ　メッセージ -->
  <section class="p-top-news">
    <div class="c-inner">
      <?php get_template_part('template/news-tab'); ?>
    </div>
    </div><!-- /.c-inner -->
  </section><!-- /.p-top-message -->


  <!-- トップ　アクセス -->
  <section class="p-top-access">

  </section>
  <!-- トップ　リンク -->
  <section class="p-top-link">
    <ul class="p-top-link__items">

      <li class="p-top-link__item">

      </li>
    </ul>
  </section>


</main>








<?php get_footer(); ?>

