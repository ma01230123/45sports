<!-- slider.php start-->
<!-- Slides -->
<?php
$club_children = get_query_var('club_children');
while ($club_children->have_posts()):
  $club_children->the_post(); ?>
  <div class="swiper-slide c-slide">
    <?php
    $slide_id = (int) get_post_meta(get_the_ID(), 'cf-slide', true);
    $slide_url = $slide_id ? wp_get_attachment_image_url($slide_id, 'full') : '';
    if ($slide_url):
    ?>
      <img src="<?php echo $slide_url; ?>">
    <?php else: ?>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.jpg">
    <?php endif; ?>
    <div class="c-slide__title" style="-webkit-text-stroke: 4px <?php the_field('cf-area-color'); ?>;">
      <?php if (get_field('cf-corporation')): ?>
        <?php the_field('cf-corporation'); ?><br>
      <?php endif; ?>
      <?php the_field('cf-name'); ?>
    </div><!-- /.c-slide__title -->
    <div class="c-slide__bg" style="background:<?php the_field('cf-area-color'); ?>;"></div><!-- /.c-slide__bg -->
  </div>
<?php endwhile; ?>
<!-- slider.php end-->
