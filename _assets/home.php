<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail c-thumbnail--mini">
  <div class="c-thumbnail__body c-inner">
    <h1 class="c-thumbnail__title c-ttl-thumbnail c-ttl-thumbnail--black">
      ニュース一覧&emsp;<span class="c-ttl-orange c-ttl-orange--22 ">NEWS</span>
    </h1>
  </div><!-- /.c-thumbnail__body -->
</div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>

<div class="c-inner">
<div class="l-home">
<?php get_template_part('template/newsContent'); ?>
</div><!-- /.l-home -->
</div><!-- /.c-inner -->

<div style="height:8rem"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>


<?php get_footer(); ?>