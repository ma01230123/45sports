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
      <div class="p-top-club__warp">
        <?php get_template_part('template/top-club-card'); ?>
      </div>
    </div><!-- /.p-top-club__inner -->
    <div class="p-top-club__triangle"></div>
  </section>

  <!-- トップ　おしらせ -->
  <section class="p-top-news">
    <div class="p-top-news__inner c-inner">
      <h2 class="c-ttl-img">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-note.png" alt="">
        お知らせ
        <span>NEWS</span>
      </h2>
      <div class="p-top-news__tab">
        <?php get_template_part('template/top-tab'); ?>
      </div>
    </div>
    <div class="p-top-news__btn c-btn">
      <a href="<?php echo esc_url(home_url('/')); ?>news">
        お知らせ一覧
      </a>
    </div>
    </div><!-- /.c-inner -->
  </section><!-- /.p-top-news -->


  <!-- トップ　登録制度について-->
  <section class="p-top-consider">
    <div class="c-inner">
      <div class="p-top-consider__inner">
        <h2 class="p-top-consider__title">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-consider.png" alt="">
          <span>総合型地域スポーツクラブ</span>
          <span>登録制度について</span>

        </h2>
        <p class="p-top-consider__text">
          本制度は、国の第２期スポーツ基本計画に則り、日本スポーツ協会及び都道府県体育・スポーツ協会が関係機関と連携いて策定した制度です。本制度では、「総合型地域スポーツクラブ」の登録基準が示されており、すべての基準を満たしたクラブを「登録クラブ」として認定しています。<br>
          地域住民や行政からの信頼性の向上やクラブ運営に対する透明性の確保を図ることで、地域に根ざしたクラブづくりを推進していきます。
        </p>
        <div class="p-top-consider__btn c-btn">
          <a href="<?php echo esc_url(home_url('/')); ?>consider">
            詳しくはこちら
          </a>
        </div>
      </div><!-- /.p-top-consider__inner -->
    </div><!-- /.c-inner -->
  </section>





  <!-- トップ　アクセス -->
  <section class="p-top-access">
    <h2 class="c-ttl-img">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-access.png" alt="">
      アクセス
      <span>Access</span>
    </h2>
    <div class="p-top-access__map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d699.3542560957293!2d135.19921661966436!3d34.68849091750406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60008ef641e566d7%3A0x9721a18edd6ed3fb!2z56We5oi45ZWG5bel6LK_5piT44K744Oz44K_44O844OT44Or!5e0!3m2!1sja!2sjp!4v1754478704911!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- /.p-top-access__map -->
  </section>
  <!-- トップ　リンク -->
  <section class="p-top-link">
    <div class="c-inner">
      <ul class="p-top-link__items">
        <?php
        $club_page = get_page_by_path('club');
        // 子ページを取得するクエリ
        $club_children = new WP_Query(array(
          'post_type' => 'page',
          'post_parent' => $club_page->ID,
          'posts_per_page' => -1,
          'order' => 'ASC',
          'orderby' => 'menu_order',
        ));
        ?>
        <?php
        while ($club_children->have_posts()):
          $club_children->the_post(); ?>
          <li class="p-top-link__item c-btn-link" style="background:<?php the_field('cf-area-color'); ?>;">
            <a href="<?php echo esc_url(get_permalink()); ?>" >
              <h3>
                <?php if (get_field('cf-corporation')): ?>
                  <?php the_field('cf-corporation'); ?><br>
                <?php endif; ?>
                <?php the_field('cf-name'); ?>
              </h3>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    </div><!-- /.c-inner -->
  </section>


</main>








<?php get_footer(); ?>

