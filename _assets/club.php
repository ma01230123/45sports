<?php
/**
 Template Name:クラブページ用
 **/
?>
<?php get_header(); ?>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail">
  <div class="c-thumbnail__img">
    <?php the_post_thumbnail(); ?>
  </div>
  <div class="c-thumbnail__skew"></div>
  <div class="c-thumbnail__skew c-thumbnail__skew--right"></div>
  <div class="c-thumbnail__body c-inner">
    <h1 class="c-thumbnail__title c-ttl-thumbnail">
      <span class="c-ttl-thumbnail__area"><?php the_field('cf-area-name'); ?></span>
      <span class="c-ttl-thumbnail__text">

        <?php the_field('cf-corporation'); ?>
        <?php the_field('cf-name'); ?>
      </span>
    </h1>
  </div>
</div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div class="c-inner l-page">

  <?php
  $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'tab01'; // デフォルトは tab01
  ?>
  <div class="c-tab">
    <div class="c-tab__btn-wrap">
      <a class="c-tab__btn <?php if ($active_tab === 'tab01')
        echo 'is-active'; ?>" href="?tab=tab01">基本情報</a>
      <a class="c-tab__btn <?php if ($active_tab === 'tab02')
        echo 'is-active'; ?>" href="?tab=tab02">お知らせ</a>
      <a class="c-tab__btn <?php if ($active_tab === 'tab03')
        echo 'is-active'; ?>" href="?tab=tab03">アクセス</a>
    </div>


    <div class="c-tab__contents">
      <!-- 基本情報のコンテンツ -->
      <div class="c-tab__content <?php if ($active_tab === 'tab01')
        echo 'is-active'; ?>">
        <h2 class="c-ttl-img">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-note.png" alt="">
          基本情報
          <span>Information</span>
        </h2>
        <div class="c-tab__content-information">
          <?php the_content(); ?>
        </div><!-- /.c-tab__content-information -->
      </div>
      <!-- お知らせのコンテンツ -->
      <div class="c-tab__content <?php if ($active_tab === 'tab02')
        echo 'is-active'; ?>">
        <h2 class="c-ttl-img">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-note.png" alt="">
          お知らせ
          <span>NEWS</span>
        </h2>
        <hr class="c-hr-news">
        <?php
        $slug = get_post_field('post_name', get_post());

        $custom_post_type = str_replace('club-', 'post-', $slug);

        // ページャー用
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // クエリ
        $args = array(
          'post_type' => $custom_post_type,
          'posts_per_page' => 5,
          'paged' => $paged,
        );

        $custom_query = new WP_Query($args);
        // 変数をテンプレートに渡す
        set_query_var('custom_query', $custom_query);

        // ループテンプレートを呼び出す
        get_template_part('template/tab-loop');
        ?>
      </div>
      <!-- アクセスのコンテンツ -->
      <div class="c-tab__content <?php if ($active_tab === 'tab03') echo 'is-active'; ?>">
      <h2 class="c-ttl-img">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-access.png" alt="">
        アクセス
        <span>Access</span>
      </h2>
        <p>
          <?php
          $text = get_field('cf-map-text');
          // HTML エスケープ＋改行を <br> に変換して出力
          echo nl2br(esc_html($text));
          ?>
        </p>
        <div style="height:5rem" aria-hidden="true" class="wp-block-spacer"></div>
        <div class="c-map">
          <?php get_template_part('template/club-map'); ?>
        </div><!-- /.c-map -->
      </div>
    </div>
  </div>
</div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<?php get_footer(); ?>

