<?php get_header(); ?>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div class="l-page">
  <div class="c-inner">
    <div class="l-page__title">
      <h1 class="c-ttl c-ttl--30">
        <?php the_title(); ?>
      </h1>
    </div><!-- /.l-page__title -->
    <div class="l-page__content">
      <?php the_content(); ?>
    </div><!-- /.l-page__content -->
  </div>
</div>

<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
<div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>

<?php get_footer(); ?>

