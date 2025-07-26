<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail">
  <div class="c-thumbnail__img">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/company.jpg" alt="">
  </div>
  <h1 class="c-thumbnail__title c-ttl-thumbnail">
    Not Found
  </h1>
</div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div style="height:6rem" aria-hidden="true" class="wp-block-spacer"></div>
<div class="c-inner">
  <div class="c-inner-700 u-tac">
    申し訳ありません。お探しのページはありませんでした。
    <div style="height:5rem" aria-hidden="true" class="wp-block-spacer"></div>
    <div class="c-btn-red">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>company-guide" class="u-m0auto">TOPに戻る</a>
    </div>
  </div>
</div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>

<?php get_footer(); ?>