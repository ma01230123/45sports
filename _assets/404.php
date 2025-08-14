<?php get_header(); ?>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>

<!-- 固定ページタイトル部分 -->
<div class="l-page">
  <div class="c-inner">
    <div class="l-page__title">
      <h1 class="c-ttl c-ttl--30">
      Not Found
      </h1>
    </div><!-- /.l-page__title -->
    <div style="height:6rem" aria-hidden="true" class="wp-block-spacer"></div>
    <div class="l-page__content">
      <div class="c-inner">
        <div class="c-inner-700 u-tac">
          申し訳ありません。お探しのページはありませんでした。
          <div style="height:5rem" aria-hidden="true" class="wp-block-spacer"></div>
          <div class="c-btn">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="u-m0auto">TOPに戻る</a>
          </div>
        </div>
      </div>
    </div><!-- /.l-page__content -->
  </div>
</div>

<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>

<?php get_footer(); ?>
