<?php 
/** 
 Template Name:サムネ＋黒文字ページ用 
 **/
?>
<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail">
  <div class="c-thumbnail__img c-thumbnail__img--mini">
    <?php the_post_thumbnail(); ?>
  </div>
  <div class="c-thumbnail__body c-inner">
  <h1 class="c-thumbnail__title c-ttl-thumbnail c-ttl-thumbnail--blackShadow">
      <?php the_title(); ?>
    </h1>
</div>
</div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div class="c-inner l-page">
  <?php the_content(); ?>
</div>
<div style="height:8rem"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>

<?php get_footer(); ?>