<?php get_header(); ?>
<div class="u-headerHight"></div>
<!-- 固定ページパンくずリスト -->
<?php get_template_part('template/bread'); ?>
<div class="l-single">
  <div class="c-inner">
    <div class="l-single__content">
      <div class="c-inner--650">
        <h1 class="l-single__title c-ttl-orange c-ttl-orange--22">
          <?php the_title(); ?>
        </h1>
        <time class="l-single__time u-fw300" datetime="<?php the_time('c'); ?>">
          <?php the_time('Y.m.d'); ?>
        </time>
        <!-- <div class="l-single__category c-btn-category">
        <?php the_category(); ?>
      </div> -->
        <div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
        <?php the_content(); ?>
      </div><!-- /.c-inner-650 -->
    </div><!-- /.l-single__content -->



    <div style="height:8rem"></div>
    <div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>
    <div style="height:8rem" aria-hidden="true" class="wp-block-spacer"></div>




  </div>
</div>





<?php get_footer(); ?>