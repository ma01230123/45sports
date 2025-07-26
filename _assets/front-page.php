<?php get_header(); ?>
<!-- トップ 　メインビジュアル -->
<div class="p-top-mv">
  <div class="p-top-mv__inner">
    <div class="p-top-mv__img js-top-mv">
      <div>
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top-mv01.jpg"
            media="(min-width: 640px)">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-mv01_sp.jpg" alt="">
        </picture>
      </div>
      <div>
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top-mv02.jpg"
            media="(min-width: 640px)">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-mv02_sp.jpg" alt="">
        </picture>
      </div>
      <div>
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top-mv03.jpg"
            media="(min-width: 640px)">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-mv03_sp.jpg" alt="">
        </picture>
      </div>
    </div>
    <div class="p-top-mv__cover">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-mv-cover.png" alt="">
    </div>
  </div>
</div>



<!-- トップ　メッセージ -->
<section class="p-top-message">
  <div class="c-inner">
    <div class="p-top-message__inner">
      <div class="p-top-message__body">
        <h2 class="p-top-message__title c-text-25 u-fwb u-underline">経営理念</h2>
        <div class="p-top-message__text">
          私たちは<br>
          品質とより高度な技術革新で<br>
          社会に愛される企業を目指します
        </div>
      </div><!-- /.p-top-message__body -->
      <div class="p-top-message__img">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-message.png" alt="">
      </div>

    </div>
  </div><!-- /.c-inner -->
</section><!-- /.p-top-message -->

<!-- トップ　黒の背景　強みと製品　-->
<div class="p-top-bg">
  <div class="c-inner">
    <!-- トップ　強み-->
    <section class="p-top-strength">
      <div class="p-top-strength__inner">
        <div class="p-top-strength__warp">
          <div class="p-top-strength__title-en c-ttl-bordering">
            STRENGTH
          </div>
          <h2 class="p-top-strength__title-ja c-text-20">信和工業の強み</h2>
          <p class="p-top-strength__text">
            給湯器の品質上重要なガス通路部、水通路部のメカ制御部品と樹脂加工部品の製造を事業として成長しております。
          </p>
        </div><!-- /.p-top-strength__warp -->
        <!-- テンプレート　topStrengthCard　の呼び出し -->
        <?php get_template_part('template/topStrengthCard'); ?>
      </div>
    </section><!-- /.p-top-strength -->

    <!-- トップ　製品一覧-->
    <section class="p-top-product">
      <div class="p-top-product__inner">
        <div class="p-top-product__warp">
          <div class="p-top-product__title-en c-ttl-bordering c-ttl-bordering--2row">
            PRODUCT<br class="u-hidden-sp">
            INTRODUCTION
          </div>
          <h2 class="p-top-product__title-ja c-text-20">製品紹介</h2>
          <p class="p-top-product__text">
            電気的エネルギーを機械的な動作に変換する装置を”ソレノイド”と呼んでいます。信和工業は”ソレノイド”を活用した流体制御機器で皆様のお役に立ち豊かな暮らしに貢献いたします。
          </p>
        </div><!-- /.p-top-product__warp -->
        <!-- テンプレート　topProductCard　の呼び出し -->
        <?php get_template_part('template/topProductCard'); ?>
      </div>
    </section><!-- /.p-top-product -->
  </div>
</div>

<!-- トップ　リンク -->
<section class="p-top-link">
  <ul class="p-top-link__flex">
    <li class="p-top-link__item">
      <div class="p-top-link__item-title-en c-ttl-white c-ttl-white--2row">
      Product
      </div>
      <h2 class="p-top-link__item-title-jp">製品事例</h2>
      <p class="p-top-link__item-text">
        品質の追求。これは、ものづくり企業としては当然のこと。お客様が求める製品を、より高い品質、より安い価格で提供することに挑み続けています。
      </p>
      <div class="p-top-link__item-link c-btn-skeleton c-btn-skeleton--small">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>examples">
          詳しく見る</a>
      </div>
    </li>
    <li class="p-top-link__item">
      <div class="p-top-link__item-title-e c-ttl-white c-ttl-white--2row">
        Production<br class="u-hidden-sp">
        Equipment
      </div>
      <h2 class="p-top-link__item-title-jp">生産設備</h2>
      <p class="p-top-link__item-text">
        〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇
      </p>
      <div class="p-top-link__item-link c-btn-skeleton c-btn-skeleton--small">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>production">詳しく見る</a>
      </div>
    </li>
    <li class="p-top-link__item">
      <div class="p-top-link__item-title-en c-ttl-white c-ttl-white--2row">
        Environmental<br>Initiatives
      </div>
      <h2 class="p-top-link__item-title-jp">環境への取り組み</h2>
      <p class="p-top-link__item-text">
        廃プラスチックを粉砕・溶融して原材料化し、リサイクルすることです。 製造工程で発生した、不良品やロス品をリペレット加工して再び原料として、使用しています。
      </p>
      <div class="p-top-link__item-link c-btn-skeleton c-btn-skeleton--small">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>environmental">詳しく見る</a>
      </div>
    </li>
  </ul>
</section>

<!-- トップ　求人情報 -->
<section class="p-top-recruit">
  <div class="c-inner">
    <div class="p-top-recruit__title-flex">
      <div class="p-top-recruit__title-flex-left">
        <div class="p-top-recruit__title-en c-ttl-white c-ttl-white--40">
          RECRUIT
        </div>
        <h2 class="p-top-recruit__title-jp">
          採用情報
        </h2>
      </div>
      <div class="p-top-recruit__title-flex-right">
        男性女性問わず働きやすい環境が整っています。ものづくりに興味がある方、職場環境を重視する方、私たちと一緒に働きませんか？
      </div>
    </div>
    <div class="p-top-recruit__mv">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top-recruit-mv.png"
          media="(min-width: 640px)">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/top-recruit-mv_sp.png" alt="">
      </picture>
    </div>
    <div class="p-top-recruit__content">
      <!-- テンプレート　topProductCard　の呼び出し -->
      <?php get_template_part('template/topRecruitCard'); ?>
    </div>
    <div class="p-top-recruit__link c-btn-orange">
      <a href="<?php echo esc_url(home_url('/')); ?>recruit-form">
        エントリーする
      </a>
    </div>
  </div><!-- /.c-inner -->
</section>



<!-- トップ　新着情報 -->
<section class="p-top-news">
  <div class="c-inner">
    <div class="p-top-news__inner">
      <div class="p-top-news__left">
        <div class="p-top-news__title-en c-ttl-orange c-ttl-orange--50">
          NEWS
        </div>
        <h2 class="p-top-news__title-jp c-text-18">
          ニュース
        </h2>
      </div>

      <?php
    $myposts = get_posts(array(
      'post_type' => 'post', // 投稿タイプ
      'posts_per_page' => '4', // 3件を取得
      'orderby' => 'DESC'
    ));
    ?>
      <div class="p-top-news__right c-card-top-news">
        <?php foreach ($myposts as $post) : setup_postdata($post); ?>
        <article class="c-card-top-news__item animate">
          <div class="c-card-top-news__item-warp">
            <time class="c-card-top-news__item-published" datetime="<?php the_time('c'); ?>">
              <?php the_time('Y年m月d日'); ?>
            </time>
            <div class="c-card-top-news__item-category c-btn-category">
              <?php the_category(); ?>
            </div>
            <a href="<?php echo esc_url(get_permalink($post)); ?>" class="c-card-top-news__item-link">
              <h3 class="c-card-top-news__item-title">
                <?php echo esc_html(get_the_title()); ?>
              </h3>
            </a>
          </div>
        </article>
        <?php endforeach; wp_reset_postdata(); ?>
        <div class="p-top-news__top-link">
          <a href="<?php echo esc_url(home_url('/')); ?>new">
            ニュースの一覧を見る
          </a>
        </div>
      </div>
    </div>
  </div><!-- /.c-inner -->
</section>


<section class="p-top-topics">
  <div class="c-inner">
    <div class="p-top-topics__title-en c-ttl-orange c-ttl-orange--50">
      TOPICS
    </div>
    <h2 class="p-top-topics__title-jp c-text-18">
      トピックス
    </h2>

    <?php
    $myposts = get_posts(array(
      'post_type' => 'post', 
      'post__in' => array(91, 93, 226),//表示したい記事のID
      'order' => 'ASC', 
      'orderby' => 'post__in',
    ));
    ?>

    <div class="p-top-topics__content c-card-top-topics">
      <?php foreach ($myposts as $post) : setup_postdata($post); ?>
      <article class="c-card-top-topics__item">
        <a href="<?php echo esc_url(get_permalink($post)); ?>" class="c-card-top-topics__item-link">
          <div class="c-card-top-topics__item-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('thumbnail'); ?>
            <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.jpg" width="100" height="100" alt="デフォルト画像" />
            <?php endif ; ?>
          </div>
          <h3 class="c-card-top-topics__item-title c-text-18">
            <?php echo esc_html(get_the_title()); ?>
          </h3>
        </a>
      </article>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
  </div>
</section>







<?php get_footer(); ?>