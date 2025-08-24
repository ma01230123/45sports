<?php
/**
 Template Name:サムネ表示　H1　非表示ページ用
 **/
?>
<?php get_header(); ?>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail-simple">
  <div class="c-thumbnail-simple__img">
    <?php the_post_thumbnail(); ?>
  </div>
</div>
<div class="c-inner">
<div class="l-page-simple">
    <?php the_content(); ?>
  </div>
</div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<?php get_footer(); ?>

