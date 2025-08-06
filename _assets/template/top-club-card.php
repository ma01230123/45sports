<!-- top-club-card.php start-->
<?php
$club_page = get_page_by_path('club');
// 子ページを取得するクエリ
$club_children = new WP_Query(array(
  'post_type' => 'page',
  'post_parent' => $club_page->ID,
  'posts_per_page' => -1,
  'order' => 'ASC',
  'orderby' => 'menu_order',
));
?>
<?php
while ($club_children->have_posts()):
  $club_children->the_post(); ?>
  <article class="c-card-club" style="border:2px solid <?php the_field('cf-area-color'); ?>;">
    <div class="c-card-club__area" style="background:<?php the_field('cf-area-color'); ?>;">
      <?php the_field('cf-area-name'); ?>
    </div>
    <h3 class="c-card-club__title c-ttl c-ttl--21" style="color:<?php the_field('cf-area-color'); ?>;">
      <?php if (get_field('cf-corporation')): ?>
        <?php the_field('cf-corporation'); ?><br>
      <?php endif; ?>
      <?php the_field('cf-name'); ?>
    </h3>
    <div class="c-card-club__address">
      <?php
      $text = get_field('cf-address');
      echo nl2br(esc_html($text));
      ?>
    </div>
    <div class="c-card-club__img">
      <?php if (get_field('image')): ?>
        <img src="<?php the_field('cf-look'); ?>">
      <?php else: ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.jpg">
      <?php endif; ?>
    </div><!-- /.c-card-club__img -->
    <div class="c-card-club__btn c-btn-club" style="border:2px solid <?php the_field('cf-area-color'); ?>;">
      <a href="<?php echo esc_url(get_permalink()); ?>" style="color:<?php the_field('cf-area-color'); ?>;">クラブ紹介はこちら　　<i
          class="fa-solid fa-angle-right"></i></a>
    </div><!-- /.c-card-club__btn -->
  </article>
<?php endwhile; ?>
<!-- top-club-card.php end-->
