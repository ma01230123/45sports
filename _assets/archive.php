<?php get_header(); ?>
<!-- <div class="u-headerHight"></div> -->
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<!-- ページタイトル部分 -->

<div class="c-inner">
  <div class="l-home">
    <h1 class="c-ttl-img">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-note.png" alt="">
      お知らせ
      <span>NEWS</span>
    </h1>
    <div class="l-home__content">
      <?php get_template_part('template/home-tab'); ?>
    </div><!-- /.l-home__content -->
  </div><!-- /.l-home -->
</div><!-- /.c-inner -->

<div style="height:8rem"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>


<?php get_footer(); ?>

