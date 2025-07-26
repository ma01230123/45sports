<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページタイトル部分 -->
<div class="c-thumbnail">
  <div class="c-thumbnail__img">
    <?php the_post_thumbnail(); ?>
  </div>
    <h1 class="c-thumbnail__title c-ttl-thumbnail">
      <?php the_title(); ?>
    </h1>
    <div class="c-thumbnail__title-en c-ttl-thumbnail-en">
    <?php echo get_post_field( 'post_name', get_the_ID() ); ?>
    </div>
</div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div style="height:6rem" aria-hidden="true" class="wp-block-spacer"></div>
<div class="c-inner l-page">
  <?php the_content(); ?>
</div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>

<?php get_footer(); ?>