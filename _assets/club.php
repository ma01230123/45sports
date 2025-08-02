<?php
/**
 Template Name:クラブページ用
 **/
?>
<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail c-thumbnail--lineup">
  <div class="c-thumbnail__img">
    <?php the_post_thumbnail(); ?>
  </div>
  <div class="c-thumbnail__skew"></div>
  <div class="c-thumbnail__skew c-thumbnail__skew--right"></div>
  <div class="c-thumbnail__body c-inner">
    <!-- <div class="c-thumbnail__title-en c-ttl-thumbnail-lineup">
    LINE UP
  </div> -->
    <h1 class="c-thumbnail__title c-ttl-thumbnail c-ttl-thumbnail--black u-fwm">
      <span style="color:<?php the_field('cf-area-color'); ?>"><?php the_field('cf-area-name'); ?></span>

      <?php the_field('cf-corporation'); ?>
      <?php the_field('cf-name'); ?>
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
      <div class="c-tab__content <?php if ($active_tab === 'tab01')
        echo 'is-active'; ?>">
        <?php the_content(); ?>
      </div>

      <div class="c-tab__content <?php if ($active_tab === 'tab02')
        echo 'is-active'; ?>">
        <?php
        // 固定ページのスラッグ（例：club-k01）
        $slug = get_post_field('post_name', get_post());

        // club-*** → post-*** に変換
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

      <div class="c-tab__content <?php if ($active_tab === 'tab03')
        echo 'is-active'; ?>">
        <p>
          <?php
            $text = get_field('cf-map-text');
            // HTML エスケープ＋改行を <br> に変換して出力
            echo nl2br(esc_html($text));
          ?>
        </p>
        <?php get_template_part('template/club-map'); ?>
      </div>
    </div>
  </div>
</div>
<div style="height:8rem"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<?php get_footer(); ?>

